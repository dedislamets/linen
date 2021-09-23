<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Role extends CI_Controller {
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
      if(CheckMenuRole('role')){
        redirect("errors");
      }
			$data['title'] = 'Role Access';
			$data['main'] = 'setup/role';
			$data['js'] = 'script/role';
			$data['modal'] = 'modal/role';	
			$data['group_role'] =  $this->admin->get('tb_group_role');
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

  public function getMenuSelected()
  {

      $data = [];
      $data = $this->db->query("SELECT A.*, CASE WHEN IFNULL(B.id,'')='' THEN 'N' ELSE 'Y' END AS SELECTED,B.id AS id_group_menu
                              FROM tb_menu A
                              LEFT JOIN `tb_group_menu` B ON A.`id`=B.`id_menu`   
                              WHERE A.aktif=1 AND B.id_group=" . $this->input->get("id", TRUE) )->result();
      
      $this->output->set_content_type('application/json')->set_output(json_encode($data));
  }

  public function getPermissionMenu()
  {

    $data = [];
    $data = $this->db->query("SELECT IFNULL(B.create,0)AS `create`,IFNULL(B.edit,0)AS `edit`,IFNULL(B.delete,0)AS `delete`,
                                IFNULL(B.print,0)AS `print`,A.id_menu ,C.`menu`,C.`permit`
                                FROM tb_group_menu A
                                LEFT JOIN tb_group_menu_permission B ON A.id=B.id_group_menu
                                LEFT JOIN tb_menu C ON C.id=A.`id_menu`
                                WHERE A.id=" . $this->input->get("id_group_menu", TRUE) )->row();
    
    $this->output->set_content_type('application/json')->set_output(json_encode($data));
  }

	public function set_status_checked(){

    $response = [];
    $response['error'] = FALSE; 
    $recLogin = $this->session->userdata('user_id');

    $arr_data = array(
      'id_group'=> $this->input->get("group", TRUE) , 
      'id_menu' => $this->input->get("menu", TRUE)
    );

    if($this->input->get("aktif", TRUE) == "true"){ 
      $this->db->delete('tb_group_menu',$arr_data);
      $this->db->insert('tb_group_menu',$arr_data);
    }else{
      $this->db->delete('tb_group_menu',$arr_data);
    }

    $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }

  public function set_status_checked_permission(){
    $response = [];
    $response['error'] = FALSE; 
    $recLogin = $this->session->userdata('user_id');
    $arr_data = array(
      'id_group_menu'=> $this->input->get("id_group_menu", TRUE) , 
    );

    $tipe = $this->input->get("type", TRUE) ;
    if($tipe == "chkPrint"){ 
      $arr_data['print'] = $this->input->get("checked", TRUE);
    }elseif($tipe == "chkInput"){
      $arr_data['create'] = $this->input->get("checked", TRUE);
    }elseif($tipe == "chkEdit"){
      $arr_data['edit'] = $this->input->get("checked", TRUE);
    }elseif($tipe == "chkDelete"){
      $arr_data['delete'] = $this->input->get("checked", TRUE);
    }

    $result_header = $this->admin->getmaster('tb_group_menu_permission',array('id_group_menu' => $this->input->get('id_group_menu', TRUE)));
    if($result_header){
      $this->db->set($arr_data);
      $this->db->where(array( "id_group_menu" => $this->input->get('id_group_menu') ));
      $this->db->update('tb_group_menu_permission');
    }else{
      $this->db->insert('tb_group_menu_permission',$arr_data);
    }

    $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }
}
