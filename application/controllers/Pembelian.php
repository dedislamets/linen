<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pembelian extends CI_Controller {
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
      if(CheckMenuRole('pembelian')){
        redirect("errors");
      }
			$data['title'] = 'Pembelian';
			$data['main'] = 'penerimaan/index';
			$data['js'] = 'script/penerimaan';
      $data['modal'] = 'modal/penerimaan';

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
          0=>'no_penerimaan',
          1=>'deskripsi',
          2=>'status',
      );
      $valid_sort = array(
          0=>'no_penerimaan',
          1=>'deskripsi',
          2=>'status',
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
      // $this->db->select("id,/*STR_TO_DATE(TANGGAL, '%d/%m/%Y')*/ TANGGAL,NO_TRANSAKSI,PIC,STATUS,RUANGAN,NO_REFERENSI");
      $this->db->limit($length,$start);
      $this->db->from("tb_penerimaan");

      $pengguna = $this->db->get();
      $data = array();
      foreach($pengguna->result() as $r)
      {
          $data[] = array( 
                      date("Y-m-d", strtotime($r->current_insert)),
                      $r->no_penerimaan,
                      $r->deskripsi,
                      $r->status,
                      ' <button type="button" rel="tooltip" class="btn btn-warning btn-sm " onclick="editmodal(this)"  data-id="'.$r->id.'"  >
                          <i class="icofont icofont-ui-edit"></i>Edit
                        </button>
                        <a href="pembelian/detail/'.$r->id.'"  class="btn btn-info btn-sm "  >
                          <i class="icofont icofont-edit"></i>Detail
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
    $this->db->from("tb_penerimaan");
    // $this->db->where("STATUS","CUCI");
    $query = $this->db->get();
    $result = $query->row();
    if(isset($result)) return $result->num;
    return 0;
  }


  public function create(){
    if($this->admin->logged_id())
    {
      $data['mode'] ='new';
      $nomor_transaksi = "PG-" . date("Ymd-his");

      $data['no_penerimaan'] = $nomor_transaksi;

      $data['tanggal'] = date("Y-m-d");

      
    }else{
      $data['status'] = "error";
      $data['msg'] = "Tidak ada akses!!";
    }

    $this->output->set_content_type('application/json')->set_output(json_encode($data));
  }
  public function edit($id){
    $arr_par = array('id' => $id);
    $data = $this->admin->getmaster('tb_penerimaan',$arr_par);
    foreach ($data as $key => $value) {
      $data[$key]->tanggal = date("Y-m-d", strtotime($value->current_insert));
    }
    $this->output->set_content_type('application/json')->set_output(json_encode($data));
  }

  public function detail($id)
  {
    if($this->admin->logged_id())
    {
      $data['title'] = 'Detail penerimaan';
      $data['main'] = 'penerimaan/detail';
      $data['js'] = 'script/penerimaan-create';
      $data['modal'] = 'modal/penerimaan-detail'; 
      $data['mode'] ='edit';
      $data['totalrow'] = 0;
      $data['user'] = $this->admin->getmaster('tb_user');
      $data['ruangan'] = $this->admin->getmaster('tb_ruangan');
      $data['jenis'] = $this->admin->get_result_array('jenis_barang');
      $data['vendor'] = $this->admin->get_result_array('tb_vendor');
      $data['data'] = $this->admin->get_array('tb_penerimaan',array( 'id' => $id));
      $data['no_request'] = $id;
      $data['data_detail'] = $this->admin->get_result_array('tb_penerimaan_detail',array( 'no_penerimaan' => $data['data']['no_penerimaan']));
      if(empty($data['data_detail'])) $data['mode'] ='new';
      $this->load->view('dashboard',$data,FALSE); 
    }else{
      redirect("login");
    } 
  }

  public function Save()
  {       
    $response = [];
    $response['error'] = TRUE; 
    $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
    $recLogin = $this->session->userdata('user_id');
    $data = array(
        'no_penerimaan'   => $this->input->post('no_penerimaan'),
        'status'   => $this->input->post('status'),
        'deskripsi'   => $this->input->post('deskripsi'),
        'input_by' => $recLogin
    );

    $this->db->trans_begin();

    if($this->input->post('id_penerimaan') != "") {

        $this->db->set($data);
        $this->db->where('id', $this->input->post('id_penerimaan'));
        $result  =  $this->db->update('tb_penerimaan');  

        if(!$result){
            print("<pre>".print_r($this->db->error(),true)."</pre>");
        }else{
            $response['error']= FALSE;
        }
    }else{  

        $result  = $this->db->insert('tb_penerimaan', $data);
        
        if(!$result){
            print("<pre>".print_r($this->db->error(),true)."</pre>");
        }else{
            $response['error']= FALSE;
        }
    }

    $this->db->trans_complete();                      
    $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }
  public function SaveDetail()
  {       
      
    $response = [];
    $response['error'] = TRUE; 
    $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
    $response['id']= $this->input->post('id_penerimaan',TRUE); 

    $this->db->trans_begin();
    $data = array();
    $total = intval($this->input->post('total-row'));
    for ($i=1; $i <= $total ; $i++) { 
      if(!empty($this->input->post('jenis'.$i) )){
        $data['no_penerimaan'] = $this->input->post('no_penerimaan');
        $data['jenis'] = $this->input->post('jenis'.$i);
        $data['vendor'] = $this->input->post('vendor'.$i);
        $data['qty'] = $this->input->post('qty'.$i);

        // print("<pre>".print_r($data,true)."</pre>");
        if(!empty($this->input->post('id_detail'.$i) )){
          $this->db->set($data);
          $this->db->where(array( "id" => $this->input->post('id_detail'.$i) ));
          $this->db->update('tb_penerimaan_detail');
        }else{
          $this->db->insert('tb_penerimaan_detail', $data);
        }

        $response['error']= FALSE;
      }
    }

    $this->db->trans_complete();                      
    $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }
  public function delete()
  {
      $response = [];
      $response['error'] = TRUE; 
      if($this->admin->deleteTable("id",$this->input->get('id',TRUE), 'tb_penerimaan_detail' )){
        $response['error'] = FALSE;
      } 

      $this->output->set_content_type('application/json')->set_output(json_encode($response)); 
  }
  public function deletelist()
  {
      $response = [];
      $response['error'] = TRUE; 
      $header = $this->admin->get_array('tb_penerimaan',array( 'id' => $this->input->get('id', TRUE)));
      if($this->admin->deleteTable("id",$this->input->get('id',TRUE), 'tb_penerimaan')){
        $response['error'] = FALSE;
        $this->admin->deleteTable("no_penerimaan",$header['no_penerimaan'], 'tb_penerimaan_detail');
      } 

      $this->output->set_content_type('application/json')->set_output(json_encode($response)); 
  }

  public function get(){
    if($this->admin->logged_id())
    {
      $id= $this->input->get("id",TRUE);

      $data['data'] = $this->admin->get_array('tb_penerimaan',array( 'id' => $id));

      $this->db->from('tb_penerimaan_detail');
      $this->db->where('no_penerimaan', $data['data']['no_penerimaan']);
      $data['data_detail'] = $this->db->get()->result_array();  
      $this->output->set_content_type('application/json')->set_output(json_encode($data));
      
    }else{
        redirect("login");
    } 

  }

  public function getDetail(){
    $id= $this->input->get("id",TRUE);
    $data['keluar'] = $this->admin->get_array('linen_keluar',array( 'id' => $id));;
    $data['data_detail_keluar'] = $this->admin->get_result_array('linen_keluar_detail',array( 'no_transaksi' => $data['keluar']['NO_TRANSAKSI']));
    $data['request'] = $this->admin->get_result_array('request_linen_detail',array( 'no_request' => $data['keluar']['NO_REFERENSI']));
    foreach ($data['data_detail_keluar'] as $key => $value) {
      $item = $this->admin->get_array('barang',array( 'serial' => $value['epc']));
      $jenis = $this->admin->get_array('jenis_barang',array( 'id' => $item['id_jenis']));
      $request = $this->admin->get_array('request_linen_detail',array( 'no_request' => $data['keluar']['NO_REFERENSI'], 'jenis' => $jenis['jenis']));

      $data['data_detail_keluar'][$key]['jenis'] = $jenis['jenis'];
      $data['data_detail_keluar'][$key]['berat'] = $jenis['berat'];
      $data['data_detail_keluar'][$key]['qty'] = $request['qty'];
      $data['data_detail_keluar'][$key]['ready'] = $request['qty_keluar'];
      $data['data_detail_keluar'][$key]['id_request'] = $request['id'];

      foreach ($data['request'] as $k => $v) {
        if($v['jenis'] == $jenis['jenis']){
          $data['request'][$k]['ready'] = $request['qty_keluar'];
        }
      }
    }



    $this->output->set_content_type('application/json')->set_output(json_encode($data));
      
  }

}
