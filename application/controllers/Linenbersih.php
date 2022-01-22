<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Linenbersih extends CI_Controller {
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
      if(CheckMenuRole('linenbersih')){
        redirect("errors");
      }
			$data['title'] = 'Linen Masuk Penyimpanan';
			$data['main'] = 'linen/bersih';
			$data['js'] = 'script/linenbersih';
			$data['modal'] = 'modal/barang';

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
          3=>'TOTAL_QTY',
          4=>'TOTAL_BERAT',
      );
      $valid_sort = array(
          0=>'TANGGAL',
          1=>'NO_TRANSAKSI',
          2=>'PIC',
          3=>'TOTAL_QTY',
          4=>'TOTAL_BERAT',
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
      $this->db->select("id,/*STR_TO_DATE(TANGGAL, '%d/%m/%Y')*/ TANGGAL,NO_TRANSAKSI,PIC,STATUS,TOTAL_BERAT,TOTAL_QTY,KATEGORI");
      $this->db->limit($length,$start);
      $this->db->from("linen_bersih");
      // $this->db->WHERE("status",'CUCI');

      $pengguna = $this->db->get();
      $data = array();
      foreach($pengguna->result() as $r)
      {
          $data[] = array( 
                      $r->TANGGAL,
                      $r->NO_TRANSAKSI,
                      $r->PIC,
                      $r->TOTAL_QTY,
                      $r->TOTAL_BERAT,
                      '<a href="linenbersih/proses/'.$r->id.'"  class="btn btn-warning btn-sm "  >
                        <i class="icofont icofont-edit"></i>Proses
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
    $this->db->from("linen_kotor");
    $this->db->where("STATUS","CUCI");
    $query = $this->db->get();
    $result = $query->row();
    if(isset($result)) return $result->num;
    return 0;
  }

  public function proses($id){
    if($this->admin->logged_id())
    {
      $data['title'] = 'Create Linen Masuk Penyimpanan';
      $data['main'] = 'linen/bersih-create';
      $data['js'] = 'script/linenbersih-create';
      $data['modal'] = 'modal/bersih'; 
      $data['mode'] ='new';
      $data['totalrow'] = 0;

      $data['kotor'] = $this->admin->get_array('linen_kotor',array( 'id' => $id));

      $data['bersih'] = $this->admin->get_array('linen_bersih',array( 'NO_TRANSAKSI' => $data['kotor']['NO_TRANSAKSI']));
      $data['data_detail_kotor'] = $this->admin->get_result_array('linen_kotor_detail',array( 'no_transaksi' => $data['kotor']['NO_TRANSAKSI']));
      foreach ($data['data_detail_kotor'] as $key => $value) {
        $item = $this->admin->get_array('barang',array( 'serial' => $value['epc']));
        $jenis = $this->admin->get_array('jenis_barang',array( 'id' => $item['id_jenis']));
        $data['data_detail_kotor'][$key]['jenis'] = $jenis['jenis'];
        $data['data_detail_kotor'][$key]['berat'] = $jenis['berat'];

        $data['totalrow'] ++;
        
      }

      if(!empty($data['bersih'])){
        $data['mode'] ='edit';
        $data['totalrow'] = 0;
      }

      $data['data_detail_bersih'] = $this->admin->get_result_array('linen_bersih_detail',array( 'no_transaksi' => $data['bersih']['NO_TRANSAKSI']));
      foreach ($data['data_detail_bersih'] as $key => $value) {
        $item = $this->admin->get_array('barang',array( 'serial' => $value['epc']));
        $jenis = $this->admin->get_array('jenis_barang',array( 'id' => $item['id_jenis']));
        $data['data_detail_bersih'][$key]['jenis'] = $jenis['jenis'];
        $data['data_detail_bersih'][$key]['berat'] = $jenis['berat'];

        $data['totalrow'] ++;
      }

      

      $data['kategori'] = $this->admin->getmaster('kategori');
      $data['pic'] = $this->admin->getmaster('tb_user');
   

      $this->load->view('dashboard',$data,FALSE); 
    }else{
      redirect('login');
    }
  }

  public function Save()
  {       
      
      $response = [];
      $response['error'] = TRUE; 
      $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
      $recLogin = $this->session->userdata('user_id');
      $data = array(
          'NO_TRANSAKSI'   => $this->input->post('NO_TRANSAKSI'),
          'TANGGAL'   => date("Y-m-d", strtotime($this->input->post('tanggal'))),
          'PIC'       => $this->input->post('pic'),
          'KATEGORI'       => $this->input->post('kategori'),
          'TOTAL_BERAT'   => $this->input->post('total_berat'),
          'TOTAL_QTY'     => $this->input->post('total_qty'),       
      );
      

      $this->db->trans_begin();

      if($this->input->post('id_bersih') != "") {

          $this->db->set($data);
          $this->db->where('id', $this->input->post('id_bersih'));
          $result  =  $this->db->update('linen_bersih');  

          $response['id']= $this->input->post('id_bersih', TRUE);
          $arr_rusak = array();
          if(!$result){
              print("<pre>".print_r($this->db->error(),true)."</pre>");
          }else{
              $response['error']= FALSE;
              $no_rusak = "NG-" . date("Ymd-his");
              $total = intval($this->input->post('total-row'));
              for ($i=1; $i <= $total ; $i++) { 
                if(!empty($this->input->post('epc'.$i) )){
                  unset($data);
                  $data['no_transaksi'] = $this->input->post('NO_TRANSAKSI');
                  $data['epc'] = $this->input->post('epc'.$i);
                  $data['ruangan'] = $this->input->post('ruangan'.$i);
                  $data['checked'] = ($this->input->post('checked'.$i) == "1" ? 1:0);
                  $data['status_linen'] = $this->input->post('flag'.$i);

                  if(!empty($this->input->post('id_detail'.$i) )){
                    $this->db->set($data);
                    $this->db->where(array( "epc" => $this->input->post('epc'.$i), "no_transaksi" => $this->input->post('NO_TRANSAKSI') ));
                    $this->db->update('linen_bersih_detail');
                  }else{
                    $this->db->insert('linen_bersih_detail', $data);
                  }

                  if($this->input->post('flag'.$i) == "RUSAK"){
                    $rusak_exist = $this->admin->get_array('linen_rusak_detail',array( 'epc' => $this->input->post('epc'.$i)));
                    if(empty($rusak_exist)){
                      array_push($arr_rusak, $this->input->post('epc'.$i));
                      unset($data);
                      $data['no_transaksi'] = $no_rusak;
                      $data['epc'] = $this->input->post('epc'.$i);
                      $data['jml_cuci'] = $this->admin->getJumlahCuci($this->input->post('epc'.$i))['jml'];

                      $this->db->insert('linen_rusak_detail', $data);
                    }
                  }
                }
              }

              if(!empty($arr_rusak)){
                unset($data);
                $data = array(
                    'NO_TRANSAKSI'   => $no_rusak,
                    'TANGGAL'   => date("Y-m-d"),
                    'PIC'       => $this->input->post('pic'),
                    'CATATAN'   => 'Rusak saat setelah pencucian',   
                );

                $this->db->insert('linen_rusak', $data);
              }
          }
      }else{  
          $data['STATUS'] = "BERSIH";

          $result  = $this->db->insert('linen_bersih', $data);
          $last_id = $this->db->insert_id();
          $response['id']= $last_id;

          unset($data);
          $data['STATUS'] = "BERSIH";

          $this->db->set($data);
          $this->db->where(array( "NO_TRANSAKSI" => $this->input->post('NO_TRANSAKSI') ));
          $this->db->update('linen_kotor');

          if(!$result){
              print("<pre>".print_r($this->db->error(),true)."</pre>");
          }else{
              $response['error']= FALSE;
              $arr_rusak = array();
              $no_rusak = "NG-" . date("Ymd-his");
              $total = intval($this->input->post('total-row'));
              for ($i=1; $i <= $total ; $i++) { 
                if(!empty($this->input->post('epc'.$i) )){
                  unset($data);
                  $data['no_transaksi'] = $this->input->post('NO_TRANSAKSI');
                  $data['epc'] = $this->input->post('epc'.$i);
                  $data['ruangan'] = $this->input->post('ruangan'.$i);
                  $data['checked'] = ($this->input->post('checked'.$i) == "1" ? 1:0);
                  $data['status_linen'] = $this->input->post('flag'.$i);

                  $this->db->insert('linen_bersih_detail', $data);

                  if($this->input->post('flag'.$i) == "RUSAK"){
                    array_push($arr_rusak, $this->input->post('epc'.$i));

                    unset($data);
                    $data['no_transaksi'] = $no_rusak;
                    $data['epc'] = $this->input->post('epc'.$i);
                    // $data['jml_cuci'] = $this->admin->getJumlahCuci($this->input->post('epc'.$i))['jml'];
                    $data['jml_cuci'] = 1;

                    $this->db->insert('linen_rusak_detail', $data);
                  }
                  
                  
                }
              }
              if(!empty($arr_rusak)){
                unset($data);
                $data = array(
                    'NO_TRANSAKSI'   => $no_rusak,
                    'TANGGAL'   => date("Y-m-d"),
                    'PIC'       => $this->input->post('pic'),
                    'CATATAN'   => 'Rusak saat setelah pencucian',   
                );

                $this->db->insert('linen_rusak', $data);
              }
          }
      }

    $this->db->trans_complete();                      
    $this->output->set_content_type('application/json')->set_output(json_encode($response));
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

  public function dataTableBrg()
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
          0=>'serial',
          1=>'jenis',
          2=>'nama_ruangan',
          3=>'berat',
      );
      $valid_sort = array(
          0=>'serial',
          1=>'jenis',
          2=>'nama_ruangan',
          3=>'berat',
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
      $this->db->select("barang.*,jenis,berat");
      $this->db->from("barang");
      $this->db->join('jenis_barang', 'barang.id_jenis = jenis_barang.id');
      $pengguna = $this->db->get();
      $data = array();
      foreach($pengguna->result() as $r)
      {

          $data[] = array( 
                      $r->serial,
                      $r->jenis,
                      $r->nama_ruangan,
                      $r->berat,
                      '<button type="button" rel="tooltip" class="btn btn-warning btn-sm " onclick="pilih_item(this);void(0)"  data-id="'.$r->serial.'"  >
                        <i class="icofont icofont-ui-edit"></i>Pilih
                      </button>',
                 );
      }
      $total_pengguna = $this->totalBrg($search, $valid_columns);

      $output = array(
          "draw" => $draw,
          "recordsTotal" => $total_pengguna,
          "recordsFiltered" => $total_pengguna,
          "data" => $data
      );
      echo json_encode($output);
      exit();
  }

  public function totalBrg($search, $valid_columns)
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
    $this->db->select("barang.*,jenis,berat");
    $this->db->from("barang");
    $this->db->join('jenis_barang', 'barang.id_jenis = jenis_barang.id');
    $query = $this->db->get();
    $result = $query->row();
    if(isset($result)) return $result->num;
    return 0;
  }
}
