<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'third_party/mobile_detect.php';

class Newrequest extends CI_Controller {
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
      if(CheckMenuRole('newrequest')){
        redirect("errors");
      }
			$data['title'] = 'New Linen Request';
			$data['main'] = 'request/new-list';
			$data['js'] = 'script/new-request';
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
          6=>'status',
      );
      $valid_sort = array(
          0=>'tgl_request',
          1=>'ruangan',
          2=>'no_request',
          3=>'requestor',
          4=>'jenis',
          5=>'qty',
          6=>'status',
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
      $this->db->select('tgl_request,ruangan,new_request_linen.no_request,requestor,new_request_linen_detail.jenis,qty,status,new_request_linen_detail.id');
      $this->db->from("new_request_linen");
      $this->db->join("new_request_linen_detail","new_request_linen.no_request=new_request_linen_detail.no_request");
      if($this->session->userdata('role') != "Administrator" && $this->session->userdata('role') != "Unit Laundry"){
        $this->db->where("requestor", $this->session->userdata('nama'));
      }
      $pengguna = $this->db->get();
      $data = array();
      foreach($pengguna->result() as $r)
      {

          $data[] = array( 
                      $r->id,
                      $r->tgl_request,
                      $r->ruangan,
                      $r->no_request,
                      $r->requestor,
                      $r->jenis,
                      $r->qty,
                      $r->status,
                      
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
    $this->db->from("new_request_linen");
    $this->db->join("new_request_linen_detail","new_request_linen.no_request=new_request_linen_detail.no_request");
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
          // 5=>'status',
      );
      $valid_sort = array(
          0=>'no_request',
          1=>'tgl_request',
          2=>'requestor',
          3=>'ruangan',
          4=>'total_request',
          // 5=>'status',
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
      $this->db->from("new_request_linen");
      if($this->session->userdata('role') != "Administrator" && $this->session->userdata('role') != "Unit Laundry"){
        $this->db->where("requestor", $this->session->userdata('nama'));
      }
      $pengguna = $this->db->get();
      $data = array();
      foreach($pengguna->result() as $r)
      {

          
          if($this->session->userdata('role') != "Unit Laundry"){
            $data[] = array( 
                      $r->no_request,
                      $r->tgl_request,
                      $r->requestor,
                      $r->ruangan,
                      $r->total_request,
                      "",
                      '<a href="newrequest/edit/'.$r->no_request.'"  class="btn btn-warning btn-sm "  >
                        <i class="icofont icofont-edit"></i>Edit
                      </a>
                      <button type="button" rel="tooltip" class="btn btn-danger btn-sm " onclick="hapus(this)"  data-id="'.$r->id.'" >
                        <i class="icofont icofont-trash"></i>Hapus
                      </button> '
                    );
          }else{
            $data[] = array( 
                        $r->no_request,
                        $r->tgl_request,
                        $r->requestor,
                        $r->ruangan,
                        $r->total_request,
                        "" ,
                        '<a href="newrequest/edit/'.$r->no_request.'"  class="btn btn-warning btn-sm "  >
                          <i class="icofont icofont-edit"></i>Lihat
                        </a>'
                      );
          }
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
    $this->db->from("new_request_linen");
    $query = $this->db->get();
    $result = $query->row();
    if(isset($result)) return $result->num;
    return 0;
  }



  public function edit($id){
    if($this->admin->logged_id())
    {  
      if(CheckMenuRole('newrequest')){
        redirect("errors");
      }
      $data['title'] = 'Edit Linen Request';
      $data['title'] = 'Approval New Linen Request';
      $data['main'] = 'request/new-create';
      $data['js'] = 'script/new-request-create';
      $data['mode'] ='edit';
      $data['totalrow'] = 0;
      $data['data'] = $this->admin->get_array('new_request_linen',array( 'no_request' => $id));
      $data['data_detail'] = $this->admin->get_result_array('new_request_linen_detail',array( 'no_request' => $id));
      
      $data['data_detail'][0]['images']['images_default'] = "no-image-icon-0.jpg";
      foreach ($data['data_detail'] as $key => $value) {
          $data['data_detail'][$key]['images'] = $this->admin->get_result_array('new_request_linen_detail_image',array( 'id_request' => $data['data']['id'], 'id_request_detail' => $value['id']));
          foreach ($data['data_detail'][$key]['images']  as $k => $val) {
            if($k == 0) $data['data_detail'][$key]['images_default'] =  $val['filename'];
          }
      }

      if($this->session->userdata('role') == "Administrator" || $this->session->userdata('role') == "Unit Laundry"){
        $data['title'] = 'Approval New Linen Request';
        $data['main'] = 'request/approve';
        $data['js'] = 'script/approve-new-request';
        $data['mode'] ='edit';
        $data['totalrow'] = 0;
      }else{
        if(!empty($this->input->get('rd',TRUE))){
          if($this->input->get('rd',TRUE) == 'yes'){
            $this->db->set(array( "read" => 1));
            $this->db->where(array( "id" => $this->input->get('id',TRUE)  ));
            $this->db->update('tb_notifikasi');
          }
        }
        $data['user'] = $this->admin->getmaster('tb_user');
        $data['ruangan'] = $this->admin->getmaster('tb_ruangan');
        $data['jenis'] = $this->admin->get_result_array('jenis_barang');
        
        // $data['no_request'] = $id;
      }
      // print("<pre>".print_r($data,true)."</pre>");exit();
      $this->load->view('dashboard',$data,FALSE); 
    }else{
      redirect('login');
    }
  }
  public function create(){
    if($this->admin->logged_id())
    {
      if(CheckMenuRole('newrequest')){
        redirect("errors");
      }
      $data['title'] = 'New Request Linen';
      $data['main'] = 'request/new-create';
      $data['js'] = 'script/new-request-create';
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
    }else{
      redirect("login");
    }   
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
          'jenis'       => $this->input->post('jenis'),
          'total_request'   => $this->input->post('total_qty'),         
      );

      $this->db->trans_begin();

      if($this->input->post('id_request') != "") {

          $this->db->set($data);
          $this->db->where('id', $this->input->post('id_request'));
          $result  =  $this->db->update('new_request_linen');  
          $response['id']= $this->input->post('no_request', TRUE);
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
                  $data['spesifikasi'] = $this->input->post('spesifikasi'.$i);
                  $data['qty'] = $this->input->post('qty'.$i);
                  $data['link'] = $this->input->post('link'.$i);

                  if(!empty($this->input->post('id_detail'.$i) )){
                    $this->db->set($data);
                    $this->db->where(array( "id" => $this->input->post('id_detail'.$i) ));
                    $this->db->update('new_request_linen_detail');
                  }else{
                    $data['status'] = "Pending";
                    $this->db->insert('new_request_linen_detail', $data);
                  }
                }
              }
          }
      }else{  

          $result  = $this->db->insert('new_request_linen', $data);
          $last_id = $this->db->insert_id();
          $response['id']= $this->input->post('no_request', TRUE);
          if(!$result){
              print("<pre>".print_r($this->db->error(),true)."</pre>");
          }else{
              $response['error']= FALSE;
              $response['msg']= "";

              $total = intval($this->input->post('total-row'));
              for ($i=1; $i <= $total ; $i++) { 
                if(!empty($this->input->post('jenis'.$i) )){
                  unset($data);
                  $data['no_request'] = $this->input->post('no_request');
                  $data['jenis'] = $this->input->post('jenis'.$i);
                  $data['spesifikasi'] = $this->input->post('spesifikasi'.$i);
                  $data['qty'] = $this->input->post('qty'.$i);
                  $data['link'] = $this->input->post('link'.$i);
                  $data['status'] = "Pending";
                  $this->db->insert('new_request_linen_detail', $data);
                  
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

  
  public function get(){

      $id= $this->input->get("id",TRUE);

      $data['data'] = $this->admin->get_array('new_request_linen',array( 'id' => $id));

      $data['data_detail'] = $this->admin->get_result_array('new_request_linen_detail',array( 'no_request' => $data['data']['no_request']));

      $this->output->set_content_type('application/json')->set_output(json_encode($data));
  }

  public function getImages($id_soal_detail){
        $arr_par = array( 
          'id_request_detail' => $id_soal_detail 
        );
        $row = $this->admin->getmaster('new_request_linen_detail_image',$arr_par);
        $arr_data=array();
        $arr_caption = array();
        foreach ($row as $key => $value) {

          $arr = array(
            // 'type'=> $tipe, 
            'key' => $value->id,
            'width' => '120px',
            'url' => base_url()."pengawasan/delete",
            'caption' => $value->filename,
          );

          $tipe = explode(".", $value->filename)[1];
          if(in_array($tipe,array("xls","xlsx"))){
            $arr['type'] = "office";
          }
          if(in_array($tipe,array("mp4"))){
            $arr['type'] = "video";
          }
          if(in_array($tipe,array("pdf"))){
            $arr['type'] = "pdf";
          }
          
          $arr_data[] = $arr;

          $arr_caption[] = base_url()."upload/baru/". $value->filename; 

        }
        $data['data'] = $arr_data;
        $data['caption'] = $arr_caption;
        
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

  public function upload(){
      $config['upload_path'] = './upload/baru/';
      $config['allowed_types'] = 'gif|jpg|png|jpeg|xls|xlsx|pdf';
      $config['max_size'] = '5120';

      $data['success'] = TRUE;

      try {
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if(empty($_FILES['filefoto'])){
          $data['error'] = 'The following error occured : '.$this->upload->display_errors().'Click on "Remove" and try again!';
          echo "{}";
          exit();
        }

        $files = $_FILES;
        $cpt = count($_FILES['filefoto']['name']);
        for($i=0; $i<$cpt; $i++)
        {           
            $_FILES['filefoto']['name']= $files['filefoto']['name'][$i];
            $_FILES['filefoto']['type']= $files['filefoto']['type'][$i];
            $_FILES['filefoto']['tmp_name']= $files['filefoto']['tmp_name'][$i];
            $_FILES['filefoto']['error']= $files['filefoto']['error'][$i];
            $_FILES['filefoto']['size']= $files['filefoto']['size'][$i];  

            if (!$this->upload->do_upload("filefoto")) {
              $data['error'] = 'The following error occured : '.$this->upload->display_errors().'Click on "Remove" and try again!';
              $this->output->set_content_type('application/json')->set_output(json_encode($data));
          } else {
            $file = $this->upload->data();
            $filename =$file['file_name'];
            $data['filename'][] = $filename;
            $data['upload'] = "done";

            $arr = [
                    'id_request' => htmlspecialchars($this->input->post('id_request', true)),
                    'id_request_detail' => htmlspecialchars($this->input->post('id_request_detail', true)),
                    'filename' => $filename,
                    'tanggal' => date("Y-m-d"),
                ];

              $this->db->insert('new_request_linen_detail_image', $arr);
             $this->output->set_content_type('application/json')->set_output(json_encode($data));
          }
          
        }
      } catch (Exception $e) {
        $data['success'] = TRUE;
        $data['error']= $e;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
      }   
  }

  public function approved(){

      if($this->session->userdata('role') != "Administrator" && $this->session->userdata('role') != "Unit Laundry"){
        $response['error']= TRUE;
        $response['msg']= "Anda tidak memilik akses";
      }else{

        $data = array(
            'status' => "Approved",   
        );

        $this->db->set($data);
        $this->db->where('id', $this->input->get('id'));
        $result  =  $this->db->update('new_request_linen_detail');  
        if(!$result){
            $response['error']= TRUE;
            $response['msg']= "Terdapat Error";
        }else{
            $response['error']= FALSE;

            $msg = $this->session->userdata('username') .'  melakukan Approve pengajuan linen baru .';
            $request_detail = $this->admin->get_array('new_request_linen_detail',array( 'id' => $this->input->get('id')));
            $request = $this->admin->get_array('new_request_linen',array( 'no_request' => $request_detail['no_request']));
            $user = $this->admin->get_array('tb_user',array( 'nama_user' => $request['requestor']));

            $data_notif = array(
              'short_msg'   => $msg,
              'long_msg'    => $msg,
              'url'         => 'newrequest/edit/'. $request_detail['no_request'],
              'sent_to'     => $user['id_user'],      
            );
            $this->db->insert('tb_notifikasi', $data_notif);

            $data_token = $this->admin->api_array('tb_token_push',array( 'id_user' => $this->session->userdata('user_id') ));
            if(!empty($data_token)){
                foreach ($data_token as $key => $value) {
                  $this->admin->send_notif_app_get('single',$value['token'], $this->session->userdata('username') ." melakukan Approve pengajuan linen baru .");
                }
            }
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($response));
      }
  }
  public function rejected(){

      if($this->session->userdata('role') != "Administrator" && $this->session->userdata('role') != "Unit Laundry"){
        $response['error']= TRUE;
        $response['msg']= "Anda tidak memilik akses";
      }else{

        $data = array(
            'status' => "Rejected",   
        );

        $this->db->set($data);
        $this->db->where('id', $this->input->get('id'));
        $result  =  $this->db->update('new_request_linen_detail');  
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
