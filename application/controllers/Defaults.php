<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Defaults extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('admin');
	    $this->load->model('M_menu','',TRUE);
	   
	}
	public function getimage()
	{		
		 
		$url = base_url() .'assets/profile/'. $this->input->get('id') ; 
		if ($this->checkRemoteFile($url)) {
		    echo "<img src='" . base_url() . "assets/profile/". $this->input->get('id') ."' >";
		} else {
		   echo "<img src='" . base_url() . "assets/profile/noprofile.jpg ' >";
		}
		
	}

	function checkRemoteFile($url)
	{
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL,$url);
	    // don't download content
	    curl_setopt($ch, CURLOPT_NOBODY, 1);
	    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    if(curl_exec($ch)!==FALSE)
	    {
	        return true;
	    }
	    else
	    {
	        return false;
	    }
	}

	
}
