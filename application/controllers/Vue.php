<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Vue extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{		
		$data['main'] = 'vue/index';
		$data['js'] = 'script/vue';
		$this->load->view('dashboard',$data,FALSE); 			  
						
	}


}
