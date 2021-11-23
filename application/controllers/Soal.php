 <?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Soal extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('admin');
	   	$this->load->model('M_menu','',TRUE);
	   	date_default_timezone_set("Asia/Jakarta");
	   	
	}
	public function index()
	{		
		if($this->admin->logged_id())
	    {
			$data['title'] = 'Soal Inspeksi';
			$data['main'] = 'inspeksi/soal';
			$data['js'] = 'script/penilaian';
			$data['modal'] = 'modal/penilaian';

			$tanggal = date("Y-m-d");
	      	// print("<pre>".print_r($tanggal,true)."</pre>");exit();

	  		if(!empty(htmlspecialchars($this->input->get('tanggal', true)))){
	  			$tanggal = date("Y-m-d", strtotime(htmlspecialchars($this->input->get('tanggal', true)))) ;
	  		}

	  		$data['tanggal'] = tgl_indo($tanggal);
	  		if($tanggal == date("Y-m-d"))
	  			$data['tanggal'] = "Hari ini"; 

			$this->db->from("tb_soal");
			$data['soal'] = $this->db->get()->result();
			
			foreach ($data['soal'] as $key => $value) {
      			$data['soal'][$key]->task = "18 Komponen";
	      	}
			
			$this->load->view('dashboard',$data,FALSE); 

	    }else{
	        redirect("login");

	    }			  
						
	}

	public function create()
	{		
		if($this->admin->logged_id())
	    {
			$data['title'] = 'Soal Inspeksi';
			$data['main'] = 'inspeksi/soal-create';
			$data['js'] = 'script/soal';
			$data['modal'] = 'modal/no-modal';
			$data['mode'] = 'new';

			$tanggal = date("Y-m-d");

	  		if(!empty(htmlspecialchars($this->input->get('tanggal', true)))){
	  			$tanggal = date("Y-m-d", strtotime(htmlspecialchars($this->input->get('tanggal', true)))) ;
	  		}

	  		$data['tanggal'] = tgl_indo($tanggal);
	  		if($tanggal == date("Y-m-d"))
	  			$data['tanggal'] = "Hari ini"; 


			$this->load->view('dashboard',$data,FALSE); 

	    }else{
	        redirect("login");

	    }			  
						
	}

	public function edit($id)
	{		
		if($this->admin->logged_id())
	    {
			$data['title'] = 'Soal Inspeksi';
			$data['main'] = 'inspeksi/soal-create';
			$data['js'] = 'script/soal';
			$data['modal'] = 'modal/soal';
			$data['mode'] = 'edit';

			$tanggal = date("Y-m-d");
	      	// print("<pre>".print_r($tanggal,true)."</pre>");exit();

	  		if(!empty(htmlspecialchars($this->input->get('tanggal', true)))){
	  			$tanggal = date("Y-m-d", strtotime(htmlspecialchars($this->input->get('tanggal', true)))) ;
	  		}

	  		$data['tanggal'] = tgl_indo($tanggal);
	  		if($tanggal == date("Y-m-d"))
	  			$data['tanggal'] = "Hari ini"; 

			$this->db->from("tb_soal")->where("id",$id);
			$data['soal'] = $this->db->get()->row();
			$data['soal']->task = "18 Komponen";
			
			$this->db->select("title_sub");
			$this->db->distinct();
			$this->db->from("tb_soal_detail");
			$this->db->where('id_judul',$id);
			$this->db->where('title_sub <>',NULL);
			$data['title_sub'] = $this->db->get()->result();

			$this->db->select("id,soal");
			$this->db->from("tb_soal_detail");
			$this->db->where('parent_id',NULL);
			$this->db->where('id_judul',$id);
			$data['parent'] = $this->db->get()->result();

			$this->load->view('dashboard',$data,FALSE); 

	    }else{
	        redirect("login");

	    }			  					
	}

	public function getedit($id){
      	$arr_par = array('id' => $id);
      	$row = $this->admin->getmaster('tb_soal_detail',$arr_par);
      	$data['parent'] = $row;
      	$this->output->set_content_type('application/json')->set_output(json_encode($data));
  	}

  	public function delete_komponen($id){
  		$response = [];
      	$response['error'] = TRUE; 
      	if($this->admin->deleteTable("id",$id, 'tb_soal_detail' )){
        	$response['error'] = FALSE;
      	} 

      	$this->output->set_content_type('application/json')->set_output(json_encode($response)); 
  	}

  	public function Save()
  	{       
      
        $response = [];
        $response['error'] = TRUE; 
        $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
        $recLogin = $this->session->userdata('user_id');
        $data = array(
              'id_judul'   => $this->input->post('id_judul',TRUE),
              'soal'       => $this->input->post('soal',TRUE),
              'bobot'  => $this->input->post('bobot',TRUE),
              'skor_max'  => $this->input->post('skor_max',TRUE),
              'nilai_max'      => $this->input->post('nilai_max',TRUE),
              'keterangan'      => $this->input->post('keterangan',TRUE)
        );
      
        if(!empty($this->input->post('punya_sub',TRUE))){
            $data['punya_sub'] = 1;
        }else{
            $data['punya_sub'] = 0;
        }

        if($this->input->post('parent_id',TRUE) != "0"){
            $data['parent_id'] = $this->input->post('parent_id',TRUE);
        }
        if(!empty($this->input->post('title_sub_baru',TRUE))){
            $data['title_sub'] = $this->input->post('title_sub_baru',TRUE);
        }else{
            if(empty($this->input->post('title_sub',TRUE))){
        		$data['title_sub'] = NULL;
	        }else{
	            $data['title_sub'] = $this->input->post('title_sub',TRUE);
	        }
        }

        $this->db->trans_begin();

        if($this->input->post('id_soal_detail') != "") {
            $this->db->set($data);
            $this->db->where('id', $this->input->post('id_soal_detail',TRUE));
            $result  =  $this->db->update('tb_soal_detail');  

            if(!$result){
                  print("<pre>".print_r($this->db->error(),true)."</pre>");
            }else{
                  $response['error']= FALSE;
            }
        }else{  

            $result  = $this->db->insert('tb_soal_detail', $data);
              
            if(!$result){
                  print("<pre>".print_r($this->db->error(),true)."</pre>");
            }else{
                  $response['error']= FALSE;
            }
          }

        $this->db->trans_complete();                      
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
  	}

  	public function submit()
  	{       
      
        $response = [];
        $response['error'] = TRUE; 
        $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
        $recLogin = $this->session->userdata('user_id');
        $data = array(
              'judul'   => $this->input->post('judul',TRUE),
              'deskripsi'       => $this->input->post('deskripsi',TRUE),
              'total_skor'  => $this->input->post('total_skor',TRUE),
              'class'  => $this->input->post('class',TRUE)
        );

        $this->db->trans_begin();

        if($this->input->post('id_soal') != "") {
            $this->db->set($data);
            $this->db->where('id', $this->input->post('id_soal',TRUE));
            $result  =  $this->db->update('tb_soal');  

            if(!$result){
                  print("<pre>".print_r($this->db->error(),true)."</pre>");
            }else{
                  $response['error']= FALSE;
            }
        }else{  

            $result  = $this->db->insert('tb_soal', $data);
              
            if(!$result){
                  print("<pre>".print_r($this->db->error(),true)."</pre>");
            }else{
                  $response['error']= FALSE;
            }
          }

        $this->db->trans_complete();                      
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
  	}
  	public function delete($id)
  	{
  		$response = [];
      	$response['error'] = TRUE; 
      	if($this->admin->deleteTable("id",$id, 'tb_soal' )){
        	$response['error'] = FALSE;
      	}
      	if($this->admin->deleteTable("id_judul",$id, 'tb_soal_detail' )){
        	$response['error'] = FALSE;
      	} 

      	redirect("soal");
  	}

}
