<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Notifikasi extends CI_Controller {
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
			
			$data['title'] = 'Notifikasi';
			$data['main'] = 'notifikasi/index';
			$data['js'] = 'script/no-script';
			
			$this->db->from('tb_notifikasi');
            $query = $this->db->where('sent_to', $this->session->userdata('user_id'))->get();
            $data['notif'] = $query->result();
            $data['notif_count'] = $query->num_rows();

			$this->load->view('dashboard',$data,FALSE); 

	    }else{
	        redirect("login");

	    }				  
						
	}

}
