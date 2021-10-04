<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Monitoring extends CI_Controller {
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
			$data['title'] = 'Monitoring';

			$this->load->view('monitoring',$data,FALSE); 

    }else{
        redirect("login");

    }				  
						
	}

}
