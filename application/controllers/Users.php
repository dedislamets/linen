<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Users extends CI_Controller {
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
      if(CheckMenuRole('users')){
        redirect("errors");
      }
			$data['title'] = 'Master Users';
			$data['main'] = 'users/list';
			$data['js'] = 'script/users';
			$data['modal'] = 'modal/users';
      $data['group'] = $this->admin->getmaster('tb_group_role');
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
            0=>'id_user',
            1=>'nama_user',
            2=>'email',
            3=>'department',
            4=>'jenis_kelamin',
        );
        $valid_sort = array(
            0=>'id_user',
            1=>'nama_user',
            2=>'email',
            3=>'department',
            4=>'jenis_kelamin',
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
        $this->db->from("tb_user");
        // $this->db->join('tb_group_role', 'tb_group_role.id = tb_user.id_role','left');
        $pengguna = $this->db->get();
        $data = array();
        foreach($pengguna->result() as $r)
        {

            $data[] = array( 
                        $r->id_user,
                        $r->nama_user,
                        $r->email,
                        $r->jenis_kelamin,
                        $r->department,
                        $r->status,
                        '<button type="button" rel="tooltip" class="btn btn-warning btn-sm " onclick="editmodal(this)"  data-id="'.$r->id_user.'"  >
                          <i class="icofont icofont-ui-edit"></i>Edit
                        </button>
                        <button type="button" rel="tooltip" class="btn btn-danger btn-sm " onclick="hapus(this)"  data-id="'.$r->id_user.'" >
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
        $this->db->from("tb_user");
        // $this->db->join('tb_group_role', 'tb_group_role.id = tb_user.id_role','left');
        $query = $this->db->get();
      	$result = $query->row();
      	if(isset($result)) return $result->num;
      	return 0;
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
      $this->db->where('id_atasan', NULL);

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
      $this->db->where('id_atasan', NULL);
     
      $query = $this->db->get();
      $result = $query->row();
      if(isset($result)) return $result->num;
      return 0;
    }

    public function dataTableModalBahawan()
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
      $this->db->where('id_atasan', $this->input->get("id"));

      $pengguna = $this->db->get();
      $data = array();
      foreach($pengguna->result() as $r)
      {

          $data[] = array( 
                      $r->nama_user,
                      $r->email,
                      '<a href="javascript::void(0)" data-id='. $r->id_user .' onclick="removeRole(this)" class="btn btn-warning btn-sm "  >
                        Hapus
                      </a>',
                 );
      }
      $total_pengguna = $this->totalPenggunaModalBawahan($search, $valid_columns, $this->input->get("id", TRUE));

      $output = array(
          "draw" => $draw,
          "recordsTotal" => $total_pengguna,
          "recordsFiltered" => $total_pengguna,
          "data" => $data
      );
      echo json_encode($output);
      exit();
    }

    public function totalPenggunaModalBawahan($search, $valid_columns,$id)
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
      $this->db->where('id_atasan', $this->input->get("id"));
     
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
            'id_atasan'=>  $this->input->post('id_atasan') 
          );
          $this->db->set($arr_data);
          $this->db->where('id_user', $value);
          $this->db->update('tb_user'); 
      }
      $response['error']= FALSE;
      $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

  	public function edit(){
      	$id = $this->input->get('id');
      	$arr_par = array('id_user' => $id);
      	$row = $this->admin->getmaster('tb_user',$arr_par);
      	$data['parent'] = $row;
      	$this->output->set_content_type('application/json')->set_output(json_encode($data));
  	}

  	public function Save()
  	{       
      
        $response = [];
        $response['error'] = TRUE; 
        $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
        $recLogin = $this->session->userdata('user_id');
        $data = array(
              'nama_user'   => $this->input->post('nama_user',TRUE),
              'email'       => $this->input->post('email',TRUE),
              'department'  => $this->input->post('department',TRUE),
              'jenis_kelamin'      => $this->input->post('jenis_kelamin',TRUE)
        );
        if(!empty($this->input->post('password',TRUE))){
            $new_password = $this->Acak($this->input->post('password', TRUE), "goldenginger");
            $data['password'] = $new_password;
        }
        if(!empty($this->input->post('ada_bawahan',TRUE))){
            $data['ada_bawahan'] = 1;
        }else{
            $data['ada_bawahan'] = 0;

            $this->db->set(array('id_atasan' => NULL));
            $this->db->where('id_atasan', $this->input->post('id',TRUE));
            $this->db->update('tb_user');
        }

        if(!empty($this->input->post('status',TRUE))){
            $data['status'] = 1;
        }else{
            $data['status'] = 0;
        }

        $this->db->trans_begin();

        if($this->input->post('id') != "") {
            $this->db->set($data);
            $this->db->where('id_user', $this->input->post('id',TRUE));
            $result  =  $this->db->update('tb_user');  

            if(!$result){
                  print("<pre>".print_r($this->db->error(),true)."</pre>");
            }else{
                  $response['error']= FALSE;
            }
        }else{  

            $result  = $this->db->insert('tb_user', $data);
              
            if(!$result){
                  print("<pre>".print_r($this->db->error(),true)."</pre>");
            }else{
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
      if($this->admin->deleteTable("id_user",$this->input->get('id',TRUE), 'tb_user' )){
        $response['error'] = FALSE;
      } 

      $this->output->set_content_type('application/json')->set_output(json_encode($response)); 
  	}

    public function delete_bawahan()
    {
      $response = [];
      $response['error'] = TRUE; 
      $this->db->set(array('id_atasan' => NULL));
      $this->db->where('id_user', $this->input->post('id',TRUE));
      $this->db->update('tb_user'); 

      $this->output->set_content_type('application/json')->set_output(json_encode($response)); 
    }

    function Acak($varMsg,$strKey) {
      try {
          $Msg = $varMsg;
          $char_replace="";
          $intLength = strlen($Msg);
          $intKeyLength = strlen($strKey);
          $intKeyOffset = $intKeyLength;
          $intKeyChar = ord(substr($strKey, -1));
          for ($n=0; $n < $intLength ; $n++) { 
              $intKeyOffset = $intKeyOffset + 1;

              if($intKeyOffset > $intKeyLength) {
                  $intKeyOffset = 1;
              }
              $intAsc = ord(substr($Msg,$n, 1));

              if($intAsc > 32 && $intAsc < 127){
                  $intAsc = $intAsc - 32;
                  $intAsc = $intAsc + $intKeyChar;

                  while ( $intAsc > 94) {
                     $intAsc = $intAsc - 94;
                  }

                  $intSkip = $n+1 % 94;
                  $intAsc = $intAsc + $intSkip;
                  if($intAsc > 94){
                      $intAsc = $intAsc - 94;
                  }

                  $char_replace .= chr($intAsc + 32);
                  
                  $Msg = $char_replace . substr($varMsg, $n+1) ;
              }

              $intKeyChar = ord(substr($strKey, $intKeyOffset-1));
          }
          return $Msg;
      } catch (Exception $e) {
          
      }
  }
}
