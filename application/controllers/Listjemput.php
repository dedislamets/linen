<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'third_party/mobile_detect.php';

class Listjemput extends CI_Controller {
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
      if(CheckMenuRole('Listjemput')){
        redirect("errors");
      }
			$data['title'] = 'Jemput Linen';
			$data['main'] = 'request/jemput';
			$data['js'] = 'script/jemput';
			$data['modal'] = 'modal/jemput';
      $data['ruangan'] = $this->admin->getmaster('tb_ruangan');

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
          0=>'no_request',
          1=>'tgl_request',
          2=>'requestor',
          3=>'ruangan',
          4=>'status_request',
      );
      $valid_sort = array(
          0=>'no_request',
          1=>'tgl_request',
          2=>'requestor',
          3=>'ruangan',
          4=>'status_request',
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
      $this->db->from("request_jemput");

      $pengguna = $this->db->get();
      $data = array();
      foreach($pengguna->result() as $r)
      {
        $btn= '<button type="button" rel="tooltip" class="btn btn-danger btn-sm " onclick="hapus(this)"  data-id="'.$r->id.'" ><i class="icofont icofont-trash"></i>Hapus</button> ';
        if($r->status_request == "Selesai") $btn= "";
        $data[] = array( 
                    $r->created_date,
                    $r->no_request,
                    $r->ruangan,
                    $r->requestor,
                    $r->pic_jemput,
                    $r->remark,
                    $r->status_request,
                    $btn,
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
    $arr_par = array('id' => $id);
    $data = $this->admin->getmaster('request_jemput',$arr_par);
    foreach ($data as $key => $value) {
      $data[$key]->tanggal = date("Y-m-d", strtotime($value->created_date));
    }
    $this->output->set_content_type('application/json')->set_output(json_encode($data));
  }

  public function create(){
    if($this->admin->logged_id())
    {
      $data['mode'] ='new';
      $nomor_transaksi = "JP-" . date("Ymd-his");

      $data['no_request'] = $nomor_transaksi;

      $data['tanggal'] = date("Y-m-d");

      
    }else{
      $data['status'] = "error";
      $data['msg'] = "Tidak ada akses!!";
    }

    $this->output->set_content_type('application/json')->set_output(json_encode($data));
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
          'remark'       => $this->input->post('remark'),
          'status_request'     => "Pending",           
      );

      $this->db->trans_begin();

      if($this->input->post('id_request') != "") {

          $this->db->set($data);
          $this->db->where('id', $this->input->post('id_request'));
          $result  =  $this->db->update('request_jemput');  
          $response['id']= $this->input->post('id_request', TRUE);
          if(!$result){
              print("<pre>".print_r($this->db->error(),true)."</pre>");
          }else{
              $response['error']= FALSE;
          }
      }else{  

          $result  = $this->db->insert('request_jemput', $data);
          $last_id = $this->db->insert_id();
          $response['id']= $last_id;
          if(!$result){
              print("<pre>".print_r($this->db->error(),true)."</pre>");
          }else{
              $response['error']= FALSE;
          }
      }

    $this->db->trans_complete();                      
    $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }

  public function proses(){

      if($this->session->userdata('role') != "Administrator" && $this->session->userdata('role') != "Unit Laundry"){
        $response['error']= TRUE;
        $response['msg']= "Anda tidak memilik akses";
      }else{

        $data = array(
            'status_request' => "Selesai",   
            'jemput_date' => date("Y-m-d H:i:s"),
            'pic_jemput' => $this->input->post('pic_jemput')
        );

        $this->db->set($data);
        $this->db->where('id', $this->input->post('id_request'));
        $result  =  $this->db->update('request_jemput');  
        if(!$result){
            $response['error']= TRUE;
            $response['msg']= "Terdapat Error";
        }else{
            $response['error']= FALSE;
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($response));
      }
  }
  
}
