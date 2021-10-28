<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class LinenKeluar extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('admin');
	   	$this->load->model('M_menu','',TRUE);
	   	
	}
	public function index()
	{		
		if($this->admin->logged_id())
    {
      if(CheckMenuRole('linenkeluar')){
        redirect("errors");
      }
			$data['title'] = 'Linen Keluar';
			$data['main'] = 'linen/keluar';
			$data['js'] = 'script/linenkeluar';

			$this->load->view('dashboard',$data,FALSE); 

    }else{
        redirect("login");

    }				  
						
	}

  public function dataTable()
  {
      $draw = intval($this->input->get("draw"));
      $start = intval($this->input->get("start"));
      $length = intval($this->input->get("length"));
      $order = $this->input->get("order");
      $search= $this->input->get("search");
      $search = $search['value'];
      $col = 10;
      $dir = "";

      if(!empty($order))
      {
          foreach($order as $o)
          {
              $col = $o['column'];
              $dir= $o['dir'];
          }
      }

      if($dir != "asc" && $dir != "desc")
      {
          $dir = "desc";
      }

      $valid_columns = array(
          0=>'TANGGAL',
          1=>'NO_TRANSAKSI',
          2=>'PIC',
          3=>'RUANGAN',
          4=>'NO_REFERENSI',
          5=>'STATUS',
      );
      $valid_sort = array(
          0=>'TANGGAL',
          1=>'NO_TRANSAKSI',
          2=>'PIC',
          3=>'RUANGAN',
          4=>'NO_REFERENSI',
          5=>'STATUS',

      );
      if(!isset($valid_sort[$col]))
      {
          $order = null;
      }
      else
      {
          $order = $valid_sort[$col];
      }
      if($order !=null)
      {
          $this->db->order_by($order, $dir);
      }
      
      if(!empty($search))
      {
          $x=0;
          foreach($valid_columns as $sterm)
          {
              if($x==0)
              {
                  $this->db->like($sterm,$search);
              }
              else
              {
                  $this->db->or_like($sterm,$search);
              }
              $x++;
          }                 
      }
      $this->db->select("id,/*STR_TO_DATE(TANGGAL, '%d/%m/%Y')*/ TANGGAL,NO_TRANSAKSI,PIC,STATUS,RUANGAN,NO_REFERENSI");
      $this->db->limit($length,$start);
      $this->db->from("linen_keluar");
      // $this->db->WHERE("status <>'CUCI'");

      $pengguna = $this->db->get();
      $data = array();
      foreach($pengguna->result() as $r)
      {
          $data[] = array( 
                      $r->TANGGAL,
                      $r->NO_TRANSAKSI,
                      $r->PIC,
                      $r->RUANGAN,
                      $r->NO_REFERENSI,
                      $r->STATUS,
                      '<a href="linenkeluar/edit/'.$r->id.'"  class="btn btn-warning btn-sm "  >
                        <i class="icofont icofont-edit"></i>Lihat
                      </a> ',
                 );
      }
      $total_pengguna = $this->totalPengguna($search, $valid_columns);

      $output = array(
          "draw" => $draw,
          "recordsTotal" => $total_pengguna,
          "recordsFiltered" => $total_pengguna,
          "data" => $data
      );
      echo json_encode($output);
      exit();
  }

  public function dataRequest()
  {
      $draw = intval($this->input->get("draw"));
      $start = intval($this->input->get("start"));
      $length = intval($this->input->get("length"));
      $order = $this->input->get("order");
      $search= $this->input->get("search");
      $search = $search['value'];
      $col = 10;
      $dir = "";

      if(!empty($order))
      {
          foreach($order as $o)
          {
              $col = $o['column'];
              $dir= $o['dir'];
          }
      }

      if($dir != "asc" && $dir != "desc")
      {
          $dir = "desc";
      }

      $valid_columns = array(
          0=>'tgl_request',
          1=>'A.no_request',
          2=>'requestor',
          3=>'ruangan',
      );
      $valid_sort = array(
         0=>'tgl_request',
          1=>'A.no_request',
          2=>'requestor',
          3=>'ruangan',
      );
      if(!isset($valid_sort[$col]))
      {
          $order = null;
      }
      else
      {
          $order = $valid_sort[$col];
      }
      if($order !=null)
      {
          $this->db->order_by($order, $dir);
      }
      
      if(!empty($search))
      {
          $x=0;
          foreach($valid_columns as $sterm)
          {
              if($x==0)
              {
                  $this->db->like($sterm,$search);
              }
              else
              {
                  $this->db->or_like($sterm,$search);
              }
              $x++;
          }                 
      }
      $this->db->select("A.*");
      $this->db->distinct();
      $this->db->limit($length,$start);
      $this->db->from("request_linen A");
      $this->db->join("request_linen_detail B","A.no_request=B.no_request");
      $this->db->WHERE_IN("status_request",array("Pending","Parsial"));

      $pengguna = $this->db->get();
      $data = array();
      foreach($pengguna->result() as $r)
      {
          $data[] = array( 
                      $r->tgl_request,
                      $r->no_request,
                      $r->requestor,
                      $r->ruangan,
                      '<button type="button" rel="tooltip" class="btn btn-warning btn-sm " onclick="pilih('.$r->id.')"  data-id="'.$r->id.'"  >
                        <i class="icofont icofont-ui-edit"></i>Pilih
                      </button>',
                 );
      }
      $total_pengguna = $this->totalRequest($search, $valid_columns);

      $output = array(
          "draw" => $draw,
          "recordsTotal" => $total_pengguna,
          "recordsFiltered" => $total_pengguna,
          "data" => $data
      );
      echo json_encode($output);
      exit();
  }

  public function totalPengguna($search, $valid_columns)
  {
    $query = $this->db->select("COUNT(*) as num");
    if(!empty($search))
      {
          $x=0;
          foreach($valid_columns as $sterm)
          {
              if($x==0)
              {
                  $this->db->like($sterm,$search);
              }
              else
              {
                  $this->db->or_like($sterm,$search);
              }
              $x++;
          }                 
      }
    $this->db->from("linen_keluar");
    // $this->db->where("STATUS","CUCI");
    $query = $this->db->get();
    $result = $query->row();
    if(isset($result)) return $result->num;
    return 0;
  }

  public function totalRequest($search, $valid_columns)
  {
    $query = $this->db->select("COUNT(*) as num");
    if(!empty($search))
      {
          $x=0;
          foreach($valid_columns as $sterm)
          {
              if($x==0)
              {
                  $this->db->like($sterm,$search);
              }
              else
              {
                  $this->db->or_like($sterm,$search);
              }
              $x++;
          }                 
      }
    $this->db->from("request_linen A");
    $this->db->join("request_linen_detail B","A.no_request=B.no_request");
    $this->db->WHERE("status_request ='Pending'");

    $query = $this->db->get();
    $result = $query->row();
    if(isset($result)) return $result->num;
    return 0;
  }

  public function create(){
    if($this->admin->logged_id())
    {
      $data['title'] = 'Create Keluar';
      $data['main'] = 'linen/keluar-create';
      $data['js'] = 'script/linenkeluar-create';
      $data['modal'] = 'modal/keluar'; 
      $data['mode'] ='new';
      $data['totalrow'] = 0;
      $nomor_transaksi = "KL-" . date("Ymd-his");

      $data['no_transaksi'] = $nomor_transaksi;

      $data['keluar'] = array();
      $data['data_detail_keluar'] = array();
   

      $data['kategori'] = $this->admin->getmaster('kategori');
      $data['ruangan'] = $this->admin->getmaster('tb_ruangan');
      $data['pic'] = $this->admin->getmaster('tb_user');
   

      $this->load->view('dashboard',$data,FALSE); 
    }else{
      redirect('login');
    }
  }
  public function edit($id){
    if($this->admin->logged_id())
    {
      $data['title'] = 'Edit Keluar';
      $data['main'] = 'linen/keluar-create';
      $data['js'] = 'script/linenkeluar-create';
      $data['modal'] = 'modal/keluar'; 
      $data['mode'] ='edit';
      $data['totalrow'] = 0;

      $data['keluar'] = $this->admin->get_array('linen_keluar',array( 'id' => $id));;
      $data['data_detail_keluar'] = $this->admin->get_result_array('linen_keluar_detail',array( 'no_transaksi' => $data['keluar']['NO_TRANSAKSI']));
      foreach ($data['data_detail_keluar'] as $key => $value) {
        $item = $this->admin->get_array('barang',array( 'serial' => $value['epc']));
        $jenis = $this->admin->get_array('jenis_barang',array( 'id' => $item['id_jenis']));
        $data['data_detail_keluar'][$key]['jenis'] = $jenis['jenis'];
        $data['data_detail_keluar'][$key]['berat'] = $jenis['berat'];

        $data['totalrow'] ++;
        
      }

      $data['no_transaksi'] = $data['keluar']['NO_TRANSAKSI'];

      $data['kategori'] = $this->admin->getmaster('kategori');
      $data['ruangan'] = $this->admin->getmaster('tb_ruangan');
      $data['pic'] = $this->admin->getmaster('tb_user');
   
      // print("<pre>".print_r($data['data_detail_keluar'],true)."</pre>");exit();

      $this->load->view('dashboard',$data,FALSE); 
    }else{
      redirect('login');
    }
  }

  public function detail($id){
      $data['title'] = 'Edit Keluar';
      $data['main'] = 'linen/keluar-detail';
      $data['js'] = 'script/linenkeluar-detail';
      $data['modal'] = 'modal/keluar'; 
      $data['mode'] ='edit';
      $data['totalrow'] = 0;

      $data['keluar'] = $this->admin->get_array('linen_keluar',array( 'id' => $id));;
      $data['data_detail_keluar'] = $this->admin->get_result_array('linen_keluar_detail',array( 'no_transaksi' => $data['keluar']['NO_TRANSAKSI']));
      foreach ($data['data_detail_keluar'] as $key => $value) {
        $item = $this->admin->get_array('barang',array( 'serial' => $value['epc']));
        $jenis = $this->admin->get_array('jenis_barang',array( 'id' => $item['id_jenis']));
        $data['data_detail_keluar'][$key]['jenis'] = $jenis['jenis'];
        $data['data_detail_keluar'][$key]['berat'] = $jenis['berat'];

        $data['totalrow'] ++;
        
      }

      $data['no_transaksi'] = $data['keluar']['NO_TRANSAKSI'];

      $data['kategori'] = $this->admin->getmaster('kategori');
      $data['ruangan'] = $this->admin->getmaster('tb_ruangan');
      $data['pic'] = $this->admin->getmaster('tb_user');
   
      // print("<pre>".print_r($data['data_detail_keluar'],true)."</pre>");exit();

      $this->load->view('dashboard',$data,FALSE); 
  }

  public function Save()
  {       
    // print("<pre>".print_r(json_decode($this->input->post('scan')),true)."</pre>");
    // exit();
    $response = [];
    $response['error'] = TRUE; 
    $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
    $recLogin = $this->session->userdata('user_id');
    $data = array(
        'NO_TRANSAKSI'  => $this->input->post('no_transaksi'),
        'TANGGAL'       => date("Y-m-d", strtotime($this->input->post('tanggal'))),
        'PIC'           => $this->input->post('pic'),
        'RUANGAN'       => $this->input->post('ruangan'),
        'STATUS'        => $this->input->post('mode') == 'new' ? 'KIRIM' : $this->input->post('status'),
        'NO_REFERENSI'  => $this->input->post('no_referensi'),       
    );
    

    $this->db->trans_begin();

    if($this->input->post('id_keluar') != "") {

        $this->db->set($data);
        $this->db->where('id', $this->input->post('id_keluar'));
        $result  =  $this->db->update('linen_keluar');  

        $response['id']= $this->input->post('id_keluar', TRUE);
        if(!$result){
            print("<pre>".print_r($this->db->error(),true)."</pre>");
        }else{
            $response['error']= FALSE;
            $total = intval(count(json_decode($this->input->post('scan'))));
            $total_request = intval(count(json_decode($this->input->post('request'))));
            $json_scan = json_decode($this->input->post('scan'));
            $json_request = json_decode($this->input->post('request'));
            for ($i=0; $i < $total ; $i++) { 
            
              unset($data);
              $data['no_transaksi'] = $this->input->post('no_transaksi');
              $data['epc'] = $json_scan[$i]->serial;

              if(intval($json_scan[$i]->id) == 0){
                $this->db->insert('linen_keluar_detail', $data);
              }

              for ($r=0; $r < $total_request ; $r++) { 

                //update detail request linen
                if($json_request[$r]->jenis == $json_scan[$i]->jenis){
                  unset($data);
                  $data['qty_keluar'] = $json_request[$r]->ready;
                  $data['flag_ambil'] = (intval($json_request[$r]->ready) == intval($json_request[$r]->qty) ? 2 : 1);

                  $this->db->set($data);
                  $this->db->where(
                    array( 
                      "no_request" => $this->input->post('no_referensi') ,
                      "jenis" => $json_request[$r]->jenis
                    ));
                  $this->db->update('request_linen_detail');

                  //Jika flag ambil (ready=qty) = 1, maka update header
                  if(intval($json_request[$r]->ready) == intval($json_request[$r]->qty)){
                    unset($data);
                    $data['status_request'] = 'Done';

                    $this->db->set($data);
                    $this->db->where(
                      array( 
                        "no_request" => $this->input->post('no_referensi') 
                      ));
                    $this->db->update('request_linen');
                  }
                }
              }
              
            }

        }
    }else{  

        $result  = $this->db->insert('linen_keluar', $data);
        $last_id = $this->db->insert_id();
        $response['id']= $last_id;

        

        if(!$result){
            print("<pre>".print_r($this->db->error(),true)."</pre>");
        }else{
            $response['error']= FALSE;
           
            $total = intval(count(json_decode($this->input->post('scan'))));
            $total_request = intval(count(json_decode($this->input->post('request'))));
            $json_scan = json_decode($this->input->post('scan'));
            $json_request = json_decode($this->input->post('request'));
            for ($i=0; $i < $total ; $i++) { 

              unset($data);
              $data['no_transaksi'] = $this->input->post('no_transaksi');
              $data['epc'] = $json_scan[$i]->serial;
              
              $this->db->insert('linen_keluar_detail', $data);

              for ($r=0; $r < $total_request ; $r++) { 

                //update detail request linen
                if($json_request[$r]->jenis == $json_scan[$i]->jenis){
                  unset($data);
                  $data['qty_keluar'] = $json_request[$r]->ready;
                  $data['flag_ambil'] = (intval($json_request[$r]->ready) == intval($json_request[$r]->qty) ? 2 : 1);

                  $this->db->set($data);
                  $this->db->where(
                    array( 
                      "no_request" => $this->input->post('no_referensi') ,
                      "jenis" => $json_request[$r]->jenis
                    ));
                  $this->db->update('request_linen_detail');
                }
              }
                 
            }
            
        }
    }

    //update status header request linen jika komplit
    $cek_komplit_request = $this->admin->get_result_array('request_linen_detail',array( 'no_request' => $this->input->post('no_referensi')));
    $flag_status = "Done";
    foreach ($cek_komplit_request as $key => $value) {
      if($value['flag_ambil'] != 2){
        $flag_status = "Parsial";
      }
    }

    unset($data);
    $data['status_request'] = $flag_status;

    $this->db->set($data);
    $this->db->where(
      array( 
        "no_request" => $this->input->post('no_referensi') 
      ));
    $this->db->update('request_linen');

    $this->db->trans_complete();                      
    $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }

  public function savesignature(){

    // print("<pre>".print_r($_POST['signed'],true)."</pre>");
    //   $config['upload_path']          = FCPATH.'/upload/Signature/';
    //   $config['allowed_types']        = 'gif|jpg|jpeg|png';
    //   $config['file_name']            = $file_name;
    //   $config['overwrite']            = true;
    //   $config['max_size']             = 1024; // 1MB
    //   $config['max_width']            = 1080;
    //   $config['max_height']           = 1080;

    //   $this->load->library('upload', $config);

    //   if (!$this->upload->do_upload('avatar')) {
    //     $data['error'] = $this->upload->display_errors();
    //   } else {
    //     $uploaded_data = $this->upload->data();
    
    //     $this->session->set_flashdata('message', 'Avatar updated!');
    //     redirect(site_url('admin/setting'));
        
    //   }
      $folderPath = FCPATH.'/upload/signature/';
      $image_parts = explode(";base64,", $_POST['signed']);
      $image_type_aux = explode("image/", $image_parts[0]);   
      $image_type = $image_type_aux[1];  
      $image_base64 = base64_decode($image_parts[1]); 
      $imgfile = $this->input->post('id_keluar') . '.'.$image_type;
      $file = $folderPath . $imgfile;
      
      file_put_contents($file, $image_base64);

      $data['signature'] = $imgfile;
      $data['penerima'] = $this->input->post('penerima');

      $this->db->set($data);
      $this->db->where(
        array( 
          "id" => $this->input->post('id_keluar') ,
        ));
      $this->db->update('linen_keluar');
      $this->session->set_flashdata('message', 'Berhasil disimpan!');
      redirect(site_url('linenkeluar/detail/'. $this->input->post('id_keluar')));
  }

  public function delete()
  {
      $response = [];
      $response['error'] = TRUE; 
      if($this->admin->deleteTable("id",$this->input->get('id',TRUE), 'linen_bersih_detail' )){
        $response['error'] = FALSE;
        $data['data_detail'] = $this->admin->get_result_array('linen_bersih_detail',array( 'no_transaksi' => $this->input->get('no_transaksi', TRUE)));

        $totalrow = 0;
        $berat = 0;
        foreach ($data['data_detail'] as $key => $value) {
          $item = $this->admin->get_array('barang',array( 'serial' => $value['epc']));
          $jenis = $this->admin->get_array('jenis_barang',array( 'id' => $item['id_jenis']));
          $berat += $jenis['berat'];

          $totalrow ++;
        }
        unset($data);
        $data['total_berat'] = $berat;
        $data['total_qty'] = $totalrow;     

        $this->db->set($data);
        $this->db->where(array( "no_transaksi" => $this->input->get('no_transaksi') ));
        $this->db->update('linen_bersih');

        $response['berat'] = $berat;
        $response['total'] = $totalrow;
      } 

      $this->output->set_content_type('application/json')->set_output(json_encode($response)); 
  }
  public function deletelist()
  {
      $response = [];
      $response['error'] = TRUE; 
      $header = $this->admin->get_array('linen_bersih',array( 'id' => $this->input->get('id', TRUE)));
      // print("<pre>".print_r($header,true)."</pre>");exit();
      if($this->admin->deleteTable("id",$this->input->get('id',TRUE), 'linen_bersih')){
        $response['error'] = FALSE;
        $this->admin->deleteTable("no_transaksi",$header['NO_TRANSAKSI'], 'linen_bersih_detail');
      } 

      $this->output->set_content_type('application/json')->set_output(json_encode($response)); 
  }

  public function get(){
    if($this->admin->logged_id())
    {
      $id= $this->input->get("id",TRUE);

      $data['data'] = $this->admin->get_array('request_linen',array( 'id' => $id));

      $this->db->from('request_linen_detail');
      $this->db->where('no_request', $data['data']['no_request']);
      $this->db->where_in('flag_ambil', array(0,1));
      $data['data_detail'] = $this->db->get()->result_array();  
      // echo $this->db->last_query(); exit();

      $this->output->set_content_type('application/json')->set_output(json_encode($data));
      
    }else{
        redirect("login");
    } 

  }

  public function getDetail(){
    $id= $this->input->get("id",TRUE);
    $data['keluar'] = $this->admin->get_array('linen_keluar',array( 'id' => $id));;
    $data['data_detail_keluar'] = $this->admin->get_result_array('linen_keluar_detail',array( 'no_transaksi' => $data['keluar']['NO_TRANSAKSI']));
    foreach ($data['data_detail_keluar'] as $key => $value) {
      $item = $this->admin->get_array('barang',array( 'serial' => $value['epc']));
      $jenis = $this->admin->get_array('jenis_barang',array( 'id' => $item['id_jenis']));
      $request = $this->admin->get_array('request_linen_detail',array( 'no_request' => $data['keluar']['NO_REFERENSI'], 'jenis' => $jenis['jenis']));

      $data['data_detail_keluar'][$key]['jenis'] = $jenis['jenis'];
      $data['data_detail_keluar'][$key]['berat'] = $jenis['berat'];
      $data['data_detail_keluar'][$key]['qty'] = $request['qty'];
      $data['data_detail_keluar'][$key]['ready'] = $request['qty_keluar'];
      $data['data_detail_keluar'][$key]['id_request'] = $request['id'];
    }

    $this->output->set_content_type('application/json')->set_output(json_encode($data));
      
  }

}
