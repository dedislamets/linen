<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'third_party/mobile_detect.php';

class Listrequest extends CI_Controller {
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
      if(CheckMenuRole('listrequest')){
        redirect("errors");
      }
			$data['title'] = 'Linen Request';
			$data['main'] = 'request/list';
			$data['js'] = 'script/request';
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
          0=>'tgl_request',
          1=>'ruangan',
          2=>'no_request',
          3=>'requestor',
          4=>'jenis',
          5=>'qty',
          6=>'status_request',
      );
      $valid_sort = array(
          0=>'tgl_request',
          1=>'ruangan',
          2=>'no_request',
          3=>'requestor',
          4=>'jenis',
          5=>'qty',
          6=>'status_request',
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
      $this->db->from("request_linen");
      $this->db->join("request_linen_detail","request_linen.no_request=request_linen_detail.no_request");

      $pengguna = $this->db->get();
      $data = array();
      foreach($pengguna->result() as $r)
      {

          $data[] = array( 
                      $r->tgl_request,
                      $r->ruangan,
                      $r->no_request,
                      $r->requestor,
                      $r->jenis,
                      $r->qty,
                      $r->status_request,
                      
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
    $this->db->from("request_linen");
    $this->db->join("request_linen_detail","request_linen.no_request=request_linen_detail.no_request");
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
          0=>'no_request',
          1=>'tgl_request',
          2=>'requestor',
          3=>'ruangan',
          4=>'total_request',
          5=>'status_request',
      );
      $valid_sort = array(
          0=>'no_request',
          1=>'tgl_request',
          2=>'requestor',
          3=>'ruangan',
          4=>'total_request',
          5=>'status_request',
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
      $this->db->from("request_linen");

      $pengguna = $this->db->get();
      $data = array();
      foreach($pengguna->result() as $r)
      {

          $data[] = array( 
                      $r->no_request,
                      $r->tgl_request,
                      $r->requestor,
                      $r->ruangan,
                      $r->total_request,
                      $r->status_request,
                      '<a href="listrequest/edit/'.$r->no_request.'"  class="btn btn-warning btn-sm "  >
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
    $this->db->from("request_linen");
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

      $data['title'] = 'Request Linen';
      $data['main'] = 'request/create';
      $data['js'] = 'script/request-create';
      $data['modal'] = 'modal/request'; 
      $data['mode'] ='new';
      $data['totalrow'] = 0;
      $data['user'] = $this->admin->getmaster('tb_user');
      $data['ruangan'] = $this->admin->getmaster('tb_ruangan');
      $data['jenis'] = $this->admin->get_result_array('jenis_barang');
      $nomor_transaksi = "RL-" . date("Ymd-his");

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
          'no_request'   => $this->input->post('no_request'),
          'tgl_request'   => date("Y-m-d", strtotime($this->input->post('tanggal'))),
          'requestor'       => $this->input->post('requestor'),
          'ruangan'       => $this->input->post('ruangan'),
          'total_request'   => $this->input->post('total_qty'),
          'status_request'     => "Pending",           
      );

      $this->db->trans_begin();

      if($this->input->post('id_request') != "") {

          $this->db->set($data);
          $this->db->where('id', $this->input->post('id_request'));
          $result  =  $this->db->update('request_linen');  
          $response['id']= $this->input->post('id_request', TRUE);
          if(!$result){
              print("<pre>".print_r($this->db->error(),true)."</pre>");
          }else{
              $response['error']= FALSE;

              $total = intval($this->input->post('total-row'));
              for ($i=1; $i <= $total ; $i++) { 
                if(!empty($this->input->post('jenis'.$i) )){
                  unset($data);
                  $data['no_request'] = $this->input->post('no_request');
                  $data['jenis'] = $this->input->post('jenis'.$i);
                  $data['qty'] = $this->input->post('qty'.$i);

                  if(!empty($this->input->post('id_detail'.$i) )){
                    $this->db->set($data);
                    $this->db->where(array( "id" => $this->input->post('id_detail'.$i) ));
                    $this->db->update('request_linen_detail');
                  }else{
                    $this->db->insert('request_linen_detail', $data);
                  }
                }
              }
          }
      }else{  

          $result  = $this->db->insert('request_linen', $data);
          $last_id = $this->db->insert_id();
          $response['id']= $last_id;
          if(!$result){
              print("<pre>".print_r($this->db->error(),true)."</pre>");
          }else{
              $response['error']= FALSE;

              $total = intval($this->input->post('total-row'));
              for ($i=1; $i <= $total ; $i++) { 
                if(!empty($this->input->post('jenis'.$i) )){
                  unset($data);
                  $data['no_request'] = $this->input->post('no_request');
                  $data['jenis'] = $this->input->post('jenis'.$i);
                  $data['qty'] = $this->input->post('qty'.$i);
                  
                  $this->db->insert('request_linen_detail', $data);
                  
                }
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
      if($this->admin->deleteTable("id",$this->input->get('id',TRUE), 'linen_kotor_detail' )){
        $response['error'] = FALSE;
        $data['data_detail'] = $this->admin->get_result_array('linen_kotor_detail',array( 'no_transaksi' => $this->input->get('no_transaksi', TRUE)));

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
        $this->db->update('linen_kotor');

        $response['berat'] = $berat;
        $response['total'] = $totalrow;
      } 

      $this->output->set_content_type('application/json')->set_output(json_encode($response)); 
  }
  public function deletelist()
  {
      $response = [];
      $response['error'] = TRUE; 
      $header = $this->admin->get_array('linen_kotor',array( 'id' => $this->input->get('id', TRUE)));
      // print("<pre>".print_r($header,true)."</pre>");exit();
      if($this->admin->deleteTable("id",$this->input->get('id',TRUE), 'linen_kotor')){
        $response['error'] = FALSE;
        $this->admin->deleteTable("no_transaksi",$header['NO_TRANSAKSI'], 'linen_kotor_detail');
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
  public function get(){

      $id= $this->input->get("id",TRUE);

      $data['data'] = $this->admin->get_array('request_linen',array( 'id' => $id));

      $data['data_detail'] = $this->admin->get_result_array('request_linen_detail',array( 'no_request' => $data['data']['no_request']));

      $this->output->set_content_type('application/json')->set_output(json_encode($data));
  }
}
