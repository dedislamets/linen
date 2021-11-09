 <?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Inspeksi extends CI_Controller {
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
			$data['title'] = 'Inspeksi Sheet';
			$data['main'] = 'inspeksi/index';
			$data['js'] = 'script/inspeksi';
			$data['soal'] = $this->admin->getmaster('tb_soal');
			

			$this->load->view('dashboard',$data,FALSE); 

	    }else{
	        redirect("login");

	    }				  
						
	}

	public function soal($id){
      	$arr_par = array('id_judul' => $id);
      	$row = $this->admin->getmaster('tb_soal_detail',$arr_par);
      	$data['soal'] = $row;
      	
      	$this->output->set_content_type('application/json')->set_output(json_encode($data));
  	}

}
