<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Roleusers extends CI_Controller {
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
      if(CheckMenuRole('roleusers')){
        redirect("errors");
      }
			$data['title'] = 'Role Users';
			$data['main'] = 'setup/role-users';
			$data['js'] = 'script/role-users';
			$data['modal'] = 'modal/role';	
			$data['group_role'] = $this->admin->get('tb_group_role');
			$this->load->view('dashboard',$data,FALSE); 

    }else{
      redirect("login");
    }				  
						
	}

  public function getItem()
  {

      $data = [];
      $parent_key = '1';
      $row = $this->db->query("SELECT A.*, CASE WHEN IFNULL(B.id,'')='' THEN 'N' ELSE 'Y' END AS SELECTED
                              FROM tb_menu A
                              LEFT JOIN `tb_group_menu` B ON A.`id`=B.`id_menu` AND B.id_group=" . $this->input->get("id", TRUE) ."  
                              WHERE A.aktif=1")->result_array();
      foreach($row as $key => $item)
      {                   
        $data[]= [    'id' => $item['id'],
                      'parent' => $item['parent_id']== 0 ? "#" : $item['parent_id'],
                      'text'  => $item['menu'],   
                      'state' => array(
                              'selected' => ($item['SELECTED'] == 'Y' ? TRUE : FALSE),
                              'opened' => ($item['SELECTED'] == 'N' ? TRUE : FALSE)
                              )          
                ];
      }
    
        echo json_encode($data);
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
          0=>'nama_user',
          1=>'email',
          2=>'group',
          
      );
      $valid_sort = array(
          0=>'nama_user',
          1=>'email',
          2=>'group',
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
      $this->db->select("tb_group_user.*,nama_user,email,group");
      $this->db->from("tb_group_user");
      $this->db->join('tb_user', 'tb_user.id_user = tb_group_user.id_user');
      $this->db->join('tb_group_role', 'tb_group_role.id = tb_group_user.id_group_role');
      $this->db->where('tb_group_user.id_group_role', $this->input->get('id',true));

      $pengguna = $this->db->get();
      $data = array();
      foreach($pengguna->result() as $r)
      {

          $data[] = array( 
                      $r->nama_user,
                      $r->email,
                      $r->group,
                      '<a href="javascript::void(0)" data-id='. $r->id .' onclick="removeRole(this)" class="btn btn-warning btn-sm "  >
                        Hapus
                      </a>',
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
  
  public function dataTableModal()
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
          0=>'nama_user',
          1=>'email',
          
      );
      $valid_sort = array(
          0=>'nama_user',
          1=>'email',
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
      $this->db->select("tb_user.*");
      $this->db->from("tb_user");
      $this->db->join('tb_group_user', 'tb_user.id_user = tb_group_user.id_user AND tb_group_user.id_group_role=' . $this->input->get("id", TRUE), 'LEFT');
      $this->db->where('id_group_role', NULL);

      $pengguna = $this->db->get();
      $data = array();
      foreach($pengguna->result() as $r)
      {

          $data[] = array( 
                      '<input type="checkbox" name="selected_courses[]" value="'.$r->id_user.'">',
                      $r->nama_user,
                      $r->email,
                 );
      }
      $total_pengguna = $this->totalPenggunaModal($search, $valid_columns, $this->input->get("id", TRUE));

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
    $this->db->from("tb_group_user");
    $this->db->join('tb_user', 'tb_user.id_user = tb_group_user.id_user');
    $this->db->join('tb_group_role', 'tb_group_role.id = tb_group_user.id_group_role');
    $this->db->where('tb_group_user.id_group_role', $this->input->get('id',true));
    $query = $this->db->get();
    $result = $query->row();
    if(isset($result)) return $result->num;
    return 0;
  }
  public function totalPenggunaModal($search, $valid_columns,$id)
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
    $this->db->from("tb_user");
    $this->db->join('tb_group_user', 'tb_user.id_user = tb_group_user.id_user AND tb_group_user.id_group_role=' . $id, 'LEFT');
    $this->db->where('id_group_role', NULL);
   
    $query = $this->db->get();
    $result = $query->row();
    if(isset($result)) return $result->num;
    return 0;
  }

  public function add()
  {
    $str = $this->input->post('id_user');
      if(!empty($str)){
          $str = substr($str, 0, -1);
          $str = explode(";",$str);            
      }
      foreach($str as $k => $value) {
          $arr_data = array(
            'id_group_role'=> $this->input->post("id_group_menu", TRUE) , 
            'id_user'=> $value, 
          );
          $this->db->insert('tb_group_user',$arr_data);
      }
      $response['error']= FALSE;
      $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }

  public function delete()
  {
    $response = [];
      $response['error'] = TRUE; 
      if($this->admin->deleteTable("id",$this->input->get('id',TRUE), 'tb_group_user' )){
        $response['error'] = FALSE;
      } 

      $this->output->set_content_type('application/json')->set_output(json_encode($response)); 
  }
}
