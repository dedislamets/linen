<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Barang extends CI_Controller {
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
      if(CheckMenuRole('barang')){
        redirect("barang");
      }
			$data['title'] = 'Master Barang';
			$data['main'] = 'barang/index';
			$data['js'] = 'script/barang';
			$data['modal'] = 'modal/barang';
      $data['jenis'] = $this->admin->getmaster('jenis_barang');

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
          0=>'serial',
          1=>'jenis',
          2=>'nama_ruangan',
          3=>'fmedis',
          4=>'berat',
          5 => 'harga',
          6 => 'spesifikasi'
      );
      $valid_sort = array(
          0=>'serial',
          1=>'jenis',
          2=>'nama_ruangan',
          3=>'fmedis',
          4=>'berat',
          5 => 'harga',
          6 => 'spesifikasi'
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
      $this->db->select("barang.*,jenis,berat,harga,fmedis,spesifikasi");
      $this->db->from("barang");
      $this->db->join('jenis_barang', 'barang.id_jenis = jenis_barang.id');

      $pengguna = $this->db->get();
      $data = array();
      foreach($pengguna->result() as $r)
      {

          $data[] = array( 
                      $r->serial,
                      $r->jenis,
                      $r->spesifikasi,
                      $r->nama_ruangan,
                      $r->fmedis,
                      $r->berat,
                      $r->harga,
                      '<button type="button" rel="tooltip" class="btn btn-warning btn-sm " onclick="editmodal(this)"  data-id="'.$r->serial.'"  >
                        <i class="icofont icofont-ui-edit"></i>Edit
                      </button>
                      <button type="button" rel="tooltip" class="btn btn-danger btn-sm " onclick="hapus(this)"  data-id="'.$r->serial.'" >
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
    $this->db->select("barang.*,jenis,berat");
    $this->db->from("barang");
    $this->db->join('jenis_barang', 'barang.id_jenis = jenis_barang.id');

    $query = $this->db->get();
    $result = $query->row();
    if(isset($result)) return $result->num;
    return 0;
  }

  public function edit(){
      $id = $this->input->get('id');
      $arr_par = array('serial' => $id);
      $data = $this->admin->getmaster('barang',$arr_par);
      $this->output->set_content_type('application/json')->set_output(json_encode($data));
  }

  public function Save()
  {       
      
    $response = [];
    $response['error'] = TRUE; 
    $data=[];
    $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
    $json_scan = json_decode($this->input->post('scan'));

    $this->db->trans_begin();
    foreach ($json_scan as $value) {
      $data = array(
        'serial'          => $value->serial,
        'tanggal_register'=> date("Y-m-d", strtotime($this->input->post('tanggal'))),
        'nama_ruangan'    => $this->input->post('ruangan'),
        'id_jenis'        => $this->input->post('id_jenis'),       
      );

      $this->db->insert('barang', $data);
    }
    $response['error']= FALSE;
    // print("<pre>".print_r($data,true)."</pre>");
  
    $this->db->trans_complete();                      
    $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }

  public function update()
  {       
      
    $response = [];
    $response['error'] = TRUE; 
    $data=[];
    $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";

    $data = array(
        'id_jenis'        => $this->input->post('id_jenis'),       
      );

    $this->db->set($data);
    $this->db->where(
      array( 
        "serial" => $this->input->post('serial') 
      ));
    $result = $this->db->update('barang');

    if(!$result){
      print("<pre>".print_r($this->db->error(),true)."</pre>");
    }else{
      $response['error']= FALSE;
    }
  
    $this->db->trans_complete();                      
    $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }

  public function delete()
  {
      $response = [];
      $response['error'] = TRUE; 
      if($this->admin->deleteTable("serial",$this->input->get('id'), 'barang' )){
        $response['error'] = FALSE;
      } 

      $this->output->set_content_type('application/json')->set_output(json_encode($response)); 
  }

  public function create(){
    if($this->admin->logged_id())
    {
      $data['title'] = 'Register Linen';
      $data['main'] = 'barang/create';
      $data['js'] = 'script/barang-create';
      $data['totalrow'] = 0;
      

      $data['keluar'] = array();
      $data['data_detail_keluar'] = array();
   
      $data['kategori'] = $this->admin->getmaster('kategori');
      $data['ruangan'] = $this->admin->getmaster('tb_ruangan');
      $data['jenis'] = $this->admin->getmaster('jenis_barang');
   

      $this->load->view('dashboard',$data,FALSE); 
    }else{
      redirect('login');
    }
  }

}
