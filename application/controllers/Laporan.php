<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Laporan extends CI_Controller {
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
				$data['title'] = 'Laporan';
				$data['main'] = 'laporan/index';
				$data['js'] = 'script/no-script';
				$data['ruangan'] = $this->admin->getmaster('tb_ruangan');

				$this->load->view('dashboard',$data,FALSE); 

	    }else{
	        redirect("login");

	    }				  
						
	}

}
