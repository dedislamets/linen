<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'third_party/mobile_detect.php';

class Listrusak extends CI_Controller {
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
      if(CheckMenuRole('listrusak')){
        redirect("errors");
      }
			$data['title'] = 'Linen Rusak';
			$data['main'] = 'linen/rusak';
			$data['js'] = 'script/rusak';
			$data['modal'] = 'modal/barang';

			$this->load->view('dashboard',$data,FALSE); 

    }else{
        redirect("login");

    }				  
						
	}

  public function dataTableDetail()
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
          3=>'jenis',
          4=>'epc',
          5=>'jml_cuci',
          6=>'DEFECT',
      );
      $valid_sort = array(
          0=>'TANGGAL',
          1=>'NO_TRANSAKSI',
          2=>'PIC',
          3=>'jenis',
          4=>'epc',
          5=>'jml_cuci',
          6=>'DEFECT',
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
      $this->db->limit($length,$start);
      $this->db->from("linen_rusak");
      $this->db->join("linen_rusak_detail","linen_rusak.NO_TRANSAKSI=linen_rusak_detail.no_transaksi");
      $this->db->join("barang","barang.serial=linen_rusak_detail.epc");
      $this->db->join("jenis_barang","jenis_barang.id=barang.id_jenis");

      $pengguna = $this->db->get();
      $data = array();
      foreach($pengguna->result() as $r)
      {

          $data[] = array( 
                      $r->TANGGAL,
                      $r->NO_TRANSAKSI,
                      $r->PIC,
                      $r->jenis,
                      $r->epc,
                      $r->jml_cuci,
                      $r->DEFECT,
                 );
      }
      $total_pengguna = $this->totalDetail($search, $valid_columns);

      $output = array(
          "draw" => $draw,
          "recordsTotal" => $total_pengguna,
          "recordsFiltered" => $total_pengguna,
          "data" => $data
      );
      echo json_encode($output);
      exit();
  }

  public function totalDetail($search, $valid_columns)
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
    $this->db->from("linen_rusak");
    $this->db->join("linen_rusak_detail","linen_rusak.NO_TRANSAKSI=linen_rusak_detail.no_transaksi");
    $this->db->join("barang","barang.serial=linen_rusak_detail.epc");
    $this->db->join("jenis_barang","jenis_barang.id=barang.id_jenis");

    $query = $this->db->get();
    $result = $query->row();
    if(isset($result)) return $result->num;
    return 0;
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
          3=>'DEFECT',
      );
      $valid_sort = array(
          0=>'TANGGAL',
          1=>'NO_TRANSAKSI',
          2=>'PIC',
          3=>'DEFECT',
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
      $this->db->limit($length,$start);
      $this->db->from("linen_rusak");

      $pengguna = $this->db->get();
      $data = array();
      foreach($pengguna->result() as $r)
      {

          $data[] = array( 
                      $r->TANGGAL,
                      $r->NO_TRANSAKSI,
                      $r->PIC,
                      $r->DEFECT,
                      '<a href="listrequest/edit/'.$r->NO_TRANSAKSI.'"  class="btn btn-warning btn-sm "  >
                        <i class="icofont icofont-edit"></i>Edit
                      </a>
                      <button type="button" rel="tooltip" class="btn btn-danger btn-sm " onclick="hapus(this)"  data-id="'.$r->id.'" >
                        <i class="icofont icofont-trash"></i>Hapus
                      </button> ',
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
    $this->db->from("linen_rusak");
    $query = $this->db->get();
    $result = $query->row();
    if(isset($result)) return $result->num;
    return 0;
  }



  public function edit($id){
  
      $data['title'] = 'Edit Linen Request';
      $data['main'] = 'request/create';
      $data['js'] = 'script/request-create';
      $data['modal'] = 'modal/request'; 
      $data['mode'] ='edit';
      $data['totalrow'] = 0;
      $data['user'] = $this->admin->getmaster('tb_user');
      $data['ruangan'] = $this->admin->getmaster('tb_ruangan');
      $data['jenis'] = $this->admin->get_result_array('jenis_barang');
      $data['data'] = $this->admin->get_array('request_linen',array( 'no_request' => $id));

      $data['data_detail'] = $this->admin->get_result_array('request_linen_detail',array( 'no_request' => $data['data']['no_request']));
      $this->load->view('dashboard',$data,FALSE); 

  }
  public function create(){

      $data['title'] = 'Linen Rusak';
      $data['main'] = 'linen/rusak-create';
      $data['js'] = 'script/rusak-create';
      $data['modal'] = 'modal/request'; 
      $data['mode'] ='new';
      $data['totalrow'] = 0;
      $data['user'] = $this->admin->getmaster('tb_user');
      $data['ruangan'] = $this->admin->getmaster('tb_ruangan');
      $data['defect'] = $this->admin->getmaster('tb_defect');
      $data['jenis'] = $this->admin->get_result_array('jenis_barang');
      $nomor_transaksi = "NG-" . date("Ymd-his");

      $data['no_request'] = $nomor_transaksi;
      $data['data'] = array();

      $data['data_detail'] = array();

      $this->load->view('dashboard',$data,FALSE); 

  }

  public function Save()
  {       
      
      $response = [];
      $response['error'] = TRUE; 
      $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
      $data = array(
          'NO_TRANSAKSI'   => $this->input->post('no_transaksi'),
          'TANGGAL'   => date("Y-m-d", strtotime($this->input->post('tanggal'))),
          'PIC'       => $this->input->post('pic'),
          'DEFECT'       => $this->input->post('defect'),
          'CATATAN'   => $this->input->post('catatan'),       
      );
      $json_scan = json_decode($this->input->post('scan'));

      $this->db->trans_begin();

      if($this->input->post('id_rusak') != "") {

          $this->db->set($data);
          $this->db->where('id', $this->input->post('id_rusak'));
          $result  =  $this->db->update('linen_rusak');  
          $response['id']= $this->input->post('id_rusak', TRUE);
          if(!$result){
              print("<pre>".print_r($this->db->error(),true)."</pre>");
          }else{
              $response['error']= FALSE;

              $total = intval(count(json_decode($this->input->post('scan'))));
              for ($i=0; $i < $total ; $i++) { 
                
                  unset($data);
                  $data['no_transaksi'] = $this->input->post('no_transaksi');
                  $data['epc'] = $json_scan[$i]->serial;
                  $data['jml_cuci'] = $json_scan[$i]->jml_cuci;

                  if($json_scan[$i]->id == "0"){
                    $this->db->set($data);
                    $this->db->where(array( "id" => $json_scan[$i]->id ));
                    $this->db->update('linen_rusak_detail');
                  }else{
                    $this->db->insert('linen_rusak_detail', $data);
                  }
                
              }
          }
      }else{  

          $result  = $this->db->insert('linen_rusak', $data);
          $last_id = $this->db->insert_id();
          $response['id']= $last_id;
          if(!$result){
              print("<pre>".print_r($this->db->error(),true)."</pre>");
          }else{
              $response['error']= FALSE;

              $total = intval(count(json_decode($this->input->post('scan'))));
              for ($i=0; $i < $total ; $i++) { 
                  unset($data);
                  $data['no_transaksi'] = $this->input->post('no_transaksi');
                  $data['epc'] = $json_scan[$i]->serial;
                  $data['jml_cuci'] = $json_scan[$i]->jml_cuci;
                  
                  $this->db->insert('linen_rusak_detail', $data);

              }
          }
      }

    $this->db->trans_complete();                      
    $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }

  public function get(){

      $id= $this->input->get("id",TRUE);

      $data['data'] = $this->admin->get_array('request_linen',array( 'id' => $id));

      $data['data_detail'] = $this->admin->get_result_array('request_linen_detail',array( 'no_request' => $data['data']['no_request']));

      $this->output->set_content_type('application/json')->set_output(json_encode($data));
  }

  public function getDetail(){
    $id= $this->input->get("id",TRUE);
    $data['rusak'] = $this->admin->get_array('linen_rusak',array( 'id' => $id));;
    $data['data_detail_rusak'] = $this->admin->get_result_array('linen_rusak_detail',array( 'no_transaksi' => $data['keluar']['NO_TRANSAKSI']));
    foreach ($data['data_detail_rusak'] as $key => $value) {
      $item = $this->admin->get_array('barang',array( 'serial' => $value['epc']));
      $jenis = $this->admin->get_array('jenis_barang',array( 'id' => $item['id_jenis']));

      $data['data_detail_rusak'][$key]['jenis'] = $jenis['jenis'];
      $data['data_detail_rusak'][$key]['berat'] = $jenis['berat'];
    }

    $this->output->set_content_type('application/json')->set_output(json_encode($data));
      
  }
}
