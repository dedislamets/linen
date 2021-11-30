 <?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pengawasan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('admin');
	   	$this->load->model('M_menu','',TRUE);
	   	date_default_timezone_set("Asia/Jakarta");
	   	
	}
	public function index()
	{		
    	if(!empty($this->input->get('user_id', true))){
    		$checking = $this->admin->getmaster('tb_user', array('id_user' => $this->input->get('user_id', true)));
    		if (!empty($checking)) {
                foreach ($checking as $apps) {
                    $role = ChangeRole($apps->id_user);
                    $session_data = array(
                        'user_id'   => $apps->id_user,
                        'username'   => $apps->nama_user,
                        'id_atasan'   => $apps->id_atasan,
                        'nama'   => $apps->nama_user,
                        'role'  => $role[0]->group,
                        'role_id'  => $role[0]->id_group_role,
                        'email' => $apps->email,
                        'cabang' => $apps->cabang,
                        'gender' => $apps->jenis_kelamin
                    );
                    $this->session->set_userdata($session_data);
                    redirect("pengawasan");

                }
            }
    	}
		if($this->admin->logged_id())
	    {

	    	if(CheckMenuRole('pengawasan')){
		        redirect("errors");
		    }
			$data['title'] = 'Pengawasan Sheet';
			$data['main'] = 'inspeksi/index';
			$data['js'] = 'script/inspeksi';
			$data['soal'] = $this->admin->getmaster('tb_soal');
			$tanggal = date("Y-m-d");
	  		if(!empty(htmlspecialchars($this->input->get('tanggal', true)))){
	  			$tanggal = htmlspecialchars($this->input->get('tanggal', true));
	  		}

			foreach ($data['soal'] as $key => $value) {
	      		$arr_par = array( 
		      		'id_soal' => $value->id ,
		      		'tanggal' => $tanggal
		      	);
		      	$inspeksi_image = $this->admin->get_array('tb_inspeksi_image',$arr_par,'current_date desc');
		      	if(!empty($inspeksi_image)){
		      		$data['soal'][$key]->flag = TRUE;
		      		$data['soal'][$key]->current_date = $inspeksi_image['current_date'];

		      	}else{
		      		$data['soal'][$key]->flag = FALSE;
		      	}
	      	}
			
			$this->load->view('dashboard',$data,FALSE); 

	    }else{
	        redirect("login");

	    }				  
						
	}

	public function penilaian()
	{	
		if(!empty($this->input->get('user_id', true))){
    		$checking = $this->admin->getmaster('tb_user', array('id_user' => $this->input->get('user_id', true)));
    		if (!empty($checking)) {
                foreach ($checking as $apps) {
                    $role = ChangeRole($apps->id_user);
                    $session_data = array(
                        'user_id'   => $apps->id_user,
                        'username'   => $apps->nama_user,
                        'id_atasan'   => $apps->id_atasan,
                        'nama'   => $apps->nama_user,
                        'role'  => $role[0]->group,
                        'role_id'  => $role[0]->id_group_role,
                        'email' => $apps->email,
                        'cabang' => $apps->cabang,
                        'gender' => $apps->jenis_kelamin
                    );
                    $this->session->set_userdata($session_data);
                    redirect("pengawasan/penilaian");

                }
            }
    	}	
		if($this->admin->logged_id())
	    {
	    	// if(CheckMenuRole('pengawasan/penilaian')){
		    //     redirect("errors");
		    // }
			$data['title'] = 'Pengawasan Sheet';
			$data['main'] = 'inspeksi/penilaian';
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

			$this->db->select("tb_soal.id as id_judul,nama_user, judul, class, MAX(`current_date`) AS last_update,deskripsi");
			$this->db->from("tb_inspeksi");
			$this->db->join("tb_soal","tb_soal.id=tb_inspeksi.id_soal");
			$this->db->join("tb_user","tb_user.id_user=tb_inspeksi.id_pengawas");
			$this->db->where(array( 
		      		'id_inspektor' => $this->session->userdata('user_id') ,
		      		'tanggal' => $tanggal
		      		// 'parent_id' => NULL
		      	));
			$this->db->group_by("tb_soal.id,nama_user, judul, class,deskripsi");
			$data['soal'] = $this->db->get()->result();
			
			$total_flag = $pending = $done = 0;
			$total_flag_sub = $pending_sub = $done_sub = 0;
			foreach ($data['soal'] as $key => $value) {
	      		$data['soal'][$key]->jam = date("H:i", strtotime($value->last_update));

	      		//cari soal tanpa sub
	      		$arr_par = array('id_judul' => $value->id_judul, 'parent_id' => NULL);
      			$row = $this->admin->getmaster('tb_soal_detail',$arr_par);

      			foreach ($row as $k => $val) {
		      		$arr_par = array( 
			      		'id_soal_detail' => $val->id ,
			      		'tanggal' => $tanggal
			      	);
		      		$inspeksi_image = $this->admin->api_array('tb_inspeksi_image',$arr_par);
			      	if(!empty($inspeksi_image)){
			      		$total_flag++;
			      	}

			      	$inspeksi = $this->admin->get_array('tb_inspeksi',$arr_par);
			      	if(!empty($inspeksi)){
			      		if($inspeksi['nilai'] > 0){
			      			$done++;
			      			$total_flag--;
			      		}
			      	}

			      	$this->db->from("tb_soal_detail A");
		      		$this->db->join("tb_inspeksi B","A.id=B.id_soal_detail");
		      		$this->db->where("parent_id",$val->id);
		      		$this->db->where("tanggal",$tanggal);
		      		$this->db->where("nilai > 0");
		      		$sub_dinilai = $this->db->get()->result_array();
		      		$data['soal'][$key]->count_sub_submit = count($sub_dinilai);
		      		
      			}

      			//cari soal yg ada sub nya
      			$arr_par = array( 
		      		'id_judul' => $value->id_judul ,
	      			"IFNULL(parent_id,'')<>''" => NULL
		      	);
		      	$sub_komponen = $this->admin->api_array('tb_soal_detail',$arr_par);
		      	if(!empty($sub_komponen)){
		      		foreach ($sub_komponen as $k => $val) {
			      		$arr_par = array( 
				      		'id_soal_detail' => $val['id'] ,
				      		'tanggal' => $tanggal
				      	);
				      	$inspeksi = $this->admin->get_array('tb_inspeksi',$arr_par);
				      	if(!empty($inspeksi)){
				      		if($inspeksi['nilai'] > 0){
				      			$total_flag_sub++;
				      		}
				      	}

				      	$arr_par = array( 
				      		'id_soal_detail' => $val['id'] ,
				      		'tanggal' => $tanggal
				      	);
				      	$inspeksi_image = $this->admin->api_array('tb_inspeksi_image',$arr_par);
				      	if(!empty($inspeksi_image)){
				      		$done_sub++;
			      			$total_flag_sub--;
				      	}

				      	$inspeksi = $this->admin->get_array('tb_inspeksi',$arr_par);
				      	if(!empty($inspeksi)){
				      		if($inspeksi['nilai'] > 0){
				      			$done++;
				      			$total_flag--;
				      		}
				      	}

				      	
			      	}
		      	}

		      	if(count($sub_komponen) == count($sub_dinilai) && count($sub_komponen) > 0){
		      		$data['soal'][$key]->flag_done = TRUE;
	      			$done++;
	      		}


      			$task = "<b>". count($row)."</b> Task : Selesai <b>". $done ."</b>, Pending <b>". $total_flag ."</b>";
      			if(count($sub_komponen)>0){
      				$task .="<br/><b>". count($sub_komponen) ."</b> Sub : Selesai <b>". $done_sub ."</b>, Pending <b>". abs($total_flag_sub) ."</b>";
      			}
      			$data['soal'][$key]->task =  $task;
      			$done = $total_flag = $done_sub = $total_flag_sub =0;
	      	}

	      	// Data Pending
	      	$this->db->select("tb_soal.id as id_judul,nama_user, judul, class, MAX(`current_date`) AS last_update,deskripsi, tanggal");
			$this->db->from("tb_inspeksi");
			$this->db->join("tb_soal","tb_soal.id=tb_inspeksi.id_soal");
			$this->db->join("tb_user","tb_user.id_user=tb_inspeksi.id_pengawas");
			$this->db->where(array( 
		      		'id_inspektor' => $this->session->userdata('user_id') 
		      	));
			$this->db->where('nilai = 0');
			$this->db->where('tanggal <>', date("Y-m-d"));
			$this->db->group_by("tb_soal.id,nama_user, judul, class,deskripsi");
			$data['pending'] = $this->db->get()->result();
			
			$total_flag = $pending = $done = 0;
			$total_flag_sub = $pending_sub = $done_sub = 0;
			foreach ($data['pending'] as $key => $value) {
	      		$data['pending'][$key]->jam = date("H:i", strtotime($value->last_update));

	      		//cari soal tanpa sub
	      		$arr_par = array('id_judul' => $value->id_judul, 'parent_id' => NULL);
      			$row = $this->admin->getmaster('tb_soal_detail',$arr_par);

      			foreach ($row as $k => $val) {
		      		$arr_par = array( 
			      		'id_soal_detail' => $val->id ,
			      		'tanggal' => $value->tanggal
			      	);
		      		$inspeksi_image = $this->admin->api_array('tb_inspeksi_image',$arr_par);
			      	if(!empty($inspeksi_image)){
			      		$total_flag++;
			      	}

			      	$inspeksi = $this->admin->get_array('tb_inspeksi',$arr_par);
			      	if(!empty($inspeksi)){
			      		if($inspeksi['nilai'] > 0){
			      			$done++;
			      			$total_flag--;
			      		}
			      	}

			      	$this->db->from("tb_soal_detail A");
		      		$this->db->join("tb_inspeksi B","A.id=B.id_soal_detail");
		      		$this->db->where("parent_id",$val->id);
		      		$this->db->where("tanggal",$tanggal);
		      		$this->db->where("nilai > 0");
		      		$sub_dinilai = $this->db->get()->result_array();
		      		$data['pending'][$key]->count_sub_submit = count($sub_dinilai);
      			}

      			//cari soal yg ada sub nya
      			$arr_par = array( 
		      		'id_judul' => $value->id_judul ,
	      			"IFNULL(parent_id,'')<>''" => NULL
		      	);
		      	$sub_komponen = $this->admin->api_array('tb_soal_detail',$arr_par);
		      	if(!empty($sub_komponen)){
		      		foreach ($sub_komponen as $k => $val) {
			      		$arr_par = array( 
				      		'id_soal_detail' => $val['id'] ,
				      		'tanggal' => $value->tanggal
				      	);
				      	$inspeksi = $this->admin->get_array('tb_inspeksi',$arr_par);
				      	if(!empty($inspeksi)){
				      		if($inspeksi['nilai'] > 0){
				      			$total_flag_sub++;
				      		}
				      	}

				      	$arr_par = array( 
				      		'id_soal_detail' => $val['id'] ,
				      		'tanggal' => $value->tanggal
				      	);
				      	$inspeksi_image = $this->admin->api_array('tb_inspeksi_image',$arr_par);
				      	if(!empty($inspeksi_image)){
				      		$done_sub++;
			      			$total_flag_sub--;
				      	}

				      	
			      	}
		      	}

		      	if(count($sub_komponen) == count($sub_dinilai) && count($sub_komponen) > 0){
		      		$data['pending'][$key]->flag_done = TRUE;
	      			$done++;
	      		}

      			$task = "<b>". count($row)."</b> Task : Selesai <b>". $done ."</b>, Pending <b>". $total_flag ."</b>";
      			if(count($sub_komponen)>0){
      				$task .="<br/><b>". count($sub_komponen) ."</b> Sub : Selesai <b>". $done_sub ."</b>, Pending <b>". abs($total_flag_sub) ."</b>";
      			}
      			$data['pending'][$key]->task =  $task;
      			$done = $total_flag = $done_sub = $total_flag_sub =0;
	      	}
			
			$this->load->view('dashboard',$data,FALSE); 

	    }else{
	        redirect("login");

	    }				  
						
	}
	public function save(){
		if($this->admin->logged_id())
	    {
	    	try {
	    		foreach ($this->input->post('id_soal_detail') as $key => $value) {
			    	$exist = $this->admin->get_array('tb_inspeksi',array( 'id_soal_detail' => $value, 'tanggal' => date("Y-m-d")));
		            if(empty($exist)){
		            	$arr = [
			                'id_soal' => htmlspecialchars($this->input->post('id_soal', true)),
			                'id_soal_detail' => $value,
			                'nilai' => 0,
			                'tanggal' => date("Y-m-d"),
			                'catatan' => htmlspecialchars($this->input->post('catatan', true)[$key]),
			                'id_pengawas' => $this->session->userdata('user_id'),
			                'id_inspektor' => $this->session->userdata('id_atasan'),
		            	];

			        		$this->db->insert('tb_inspeksi', $arr);
		            }else{
		            	$arr = [
			                'catatan' => htmlspecialchars($this->input->post('catatan', true)[$key]),
		            	];
		            	$this->db->set($arr);
				        $this->db->where(array( 'id_soal_detail' => $value, 'tanggal' => date("Y-m-d")));
				        $result  =  $this->db->update('tb_inspeksi');  
		            }
		    	}

		    	$data['success'] = TRUE;

		    	$msg = $this->session->userdata('username') .'  melakukan submit data pengawasan checksheet A hari ini.';
		      	$data['message'] = $msg;

		      	$data_notif = array(
		        	'short_msg'   => $msg,
		        	'long_msg'    => $msg,
		        	'url'         => 'pengawasan',
		        	'sent_to'     => $this->session->userdata('id_atasan'),      
		      	);
		      	$this->db->insert('tb_notifikasi', $data_notif);

		    	$data_token = $this->admin->api_array('tb_token_push',array( 'id_user' => $this->session->userdata('user_id') ));
		        if(!empty($data_token)){
		            foreach ($data_token as $key => $value) {
		            	$this->admin->send_notif_app_get('single',$value['token'], $this->session->userdata('username') ." melakukan submit data pengawasan checksheet A hari ini.");
		            }
		        }
	    	} catch (Exception $e) {
	    		$data['error'] = $this->db->error();
	    	}
	    	

			$this->output->set_content_type('application/json')->set_output(json_encode($data));
	    }
	}
	public function savesv(){
		if($this->admin->logged_id())
	    {
	    	try {

	    		$tanggal = date("Y-m-d");
		  		if(!empty(htmlspecialchars($this->input->post('tanggal', true)))){
		  			$tanggal = date("Y-m-d", strtotime(htmlspecialchars($this->input->post('tanggal', true)))) ;
		  		}
	    		foreach ($this->input->post('id_soal_detail') as $key => $value) {
			    	
	            	$arr = [
		                'nilai' => htmlspecialchars($this->input->post('nilai', true)[$key]),
	            	];
	            	$this->db->set($arr);
			        $this->db->where(array( 'id_soal_detail' => $value, 'tanggal' => $tanggal));
			        $result  =  $this->db->update('tb_inspeksi');  

		    	}

		    	$data['success'] = TRUE;

		    	$msg = $this->session->userdata('username') .'  melakukan submit data pengawasan checksheet A hari ini.';
		      	$data['message'] = $msg;

		     //  	$data_notif = array(
		     //    	'short_msg'   => $msg,
		     //    	'long_msg'    => $msg,
		     //    	'url'         => 'pengawasan',
		     //    	'sent_to'     => $this->session->userdata('id_atasan'),      
		     //  	);
		     //  	$this->db->insert('tb_notifikasi', $data_notif);

		    	// $data_token = $this->admin->api_array('tb_token_push',array( 'id_user' => $this->session->userdata('user_id') ));
		     //    if(!empty($data_token)){
		     //        foreach ($data_token as $key => $value) {
		     //        	$this->admin->send_notif_app_get('single',$value['token'], "Dedi melakukan submit data pengawasan checksheet A hari ini.");
		     //        }
		     //    }
	    	} catch (Exception $e) {
	    		$data['error'] = $this->db->error();
	    	}
	    	

			$this->output->set_content_type('application/json')->set_output(json_encode($data));
	    }
	}

	public function soal($id){
		$tanggal = date("Y-m-d");
  		if(!empty(htmlspecialchars($this->input->get('tanggal', true)))){
  			$tanggal = htmlspecialchars($this->input->get('tanggal', true));
  		}
  		$data['tanggal'] = $tanggal;
      	$arr_par = array(
      		'id_judul' => $id,
      		'parent_id' => NULL
      	);
      	$row = $this->admin->getmaster('tb_soal_detail',$arr_par);

      	unset($arr_par);
      	$data['soal'] = $row;
      	$total_flag=0;
      	$total_skor = 0;
      	$total_penilaian = 0;
      	foreach ($row as $key => $value) {
      		$total_skor += $value->skor_max;

      		$arr_par = array( 
	      		'id_soal_detail' => $value->id ,
	      		'tanggal' => $tanggal
	      	);
	      	$data['soal'][$key]->nilai = 0;
	      	$inspeksi = $this->admin->get_array('tb_inspeksi',$arr_par);
	      	if(!empty($inspeksi)){
	      		$data['soal'][$key]->catatan = $inspeksi['catatan'];
	      		$data['soal'][$key]->nilai = intval($inspeksi['nilai']);
	      		$data['soal'][$key]->skor = $inspeksi['nilai'] * $value->bobot;
	      		$total_penilaian += $inspeksi['nilai'] * $value->bobot;
	      		$data['soal'][$key]->tanggal = $inspeksi['tanggal'];
	      		if($inspeksi['nilai'] > 0){
	      			$data['soal'][$key]->flag_done = TRUE;
	      		}else{
	      			$data['soal'][$key]->flag_done = FALSE;
	      		}
	      	}

	      	$arr_par = array( 
	      		'id_soal_detail' => $value->id ,
	      		'tanggal' => $tanggal
	      	);
	      	$inspeksi_image = $this->admin->api_array('tb_inspeksi_image',$arr_par);
	      	if(!empty($inspeksi_image)){
	      		$data['soal'][$key]->flag = TRUE;
	      		$total_flag++;
	      	}else{
	      		$data['soal'][$key]->flag = FALSE;
	      	}

	      	$data['soal'][$key]->jml = 0;
	      	$arr_par = array( 
	      		'parent_id' => $value->id ,
      			"IFNULL(parent_id,'')<>''" => NULL
	      	);
	      	$sub_komponen = $this->admin->api_array('tb_soal_detail',$arr_par);
	      	if(!empty($sub_komponen)){
	      		$data['soal'][$key]->count_sub = count($sub_komponen);

	      		$this->db->from("tb_soal_detail A");
	      		$this->db->join("tb_inspeksi_image B","A.id=B.id_soal_detail");
	      		$this->db->where("parent_id",$value->id);
	      		$this->db->where("tanggal",$tanggal);
	      		$sub_submit = $this->db->get()->result_array();  
	      		$data['soal'][$key]->count_sub_submit = count($sub_submit);
	      		if(count($sub_komponen) == count($sub_submit)){
	      			$data['soal'][$key]->flag_done = TRUE;
	      			$total_flag++;
	      		}


	      		$this->db->from("tb_soal_detail A");
	      		$this->db->join("tb_inspeksi B","A.id=B.id_soal_detail");
	      		$this->db->where("parent_id",$value->id);
	      		$this->db->where("tanggal",$tanggal);
	      		$this->db->where("nilai > 0");
	      		$sub_dinilai = $this->db->get()->result_array(); 
	      		$data['soal'][$key]->count_sub_dinilai = count($sub_dinilai);


	      		$bobot = 0; 
	      		foreach ($sub_komponen as $k => $val) {
	      			$arr_par = array( 
			      		'id_soal_detail' => $val['id'] ,
			      		'tanggal' => $tanggal
			      	);
			      	$inspeksi = $this->admin->get_array('tb_inspeksi',$arr_par);
			      	if(!empty($inspeksi)){
			      		$val['catatan'] = $inspeksi['catatan'];
			      		$val['nilai'] = intval($inspeksi['nilai']);
			      		$val['skor'] = $inspeksi['nilai'] * $val['bobot'];
			      		$total_penilaian += $inspeksi['nilai'] * $val['bobot'];
			      		$val['tanggal'] = $inspeksi['tanggal'];
			      		if($inspeksi['nilai'] > 0){
			      			$val['flag_done'] = TRUE;
			      		}else{
			      			$val['flag_done']  = FALSE;
			      		}
			      	}

			      	$arr_par = array( 
			      		'id_soal_detail' => $val['id'] ,
			      		'tanggal' => $tanggal
			      	);
			      	$inspeksi_image = $this->admin->api_array('tb_inspeksi_image',$arr_par);
			      	if(!empty($inspeksi_image)){
			      		$val['flag'] = TRUE;
			      	}else{
			      		$val['flag'] = FALSE;
			      	}

	      			$data['soal'][$key]->sub[$val['title_sub']]['data'][] = $val;
	      			$bobot = (
	      				empty($data['soal'][$key]->sub[$val['title_sub']]['total_bobot']) ? 0 : $data['soal'][$key]->sub[$val['title_sub']]['total_bobot']) + $val['bobot'];
	      			$total_skor += $val['skor_max'];
	      			$data['soal'][$key]->sub[$val['title_sub']]['total_bobot'] =  $bobot ;

	      		
	      		}
	      		if(!empty(htmlspecialchars($this->input->get('f', true)))){
	      			$data['soal'][$key]->count_sub += count($data['soal'][$key]->sub);
		  		}

	      	}
      	}
      	$data['total_penilaian'] = $total_penilaian;
      	$data['total_skor'] = $total_skor ;
      	$data['task'] = "Task Selesai <b>". $total_flag ."</b> dari <b>". count($row)."</b> Komponen";
      	if($total_flag == count($row))
      		$data['task'] = "Task completed";

      	$soal = $this->admin->get_array('tb_soal',array( 'id' => $id));
      	$data['deskripsi'] = $soal['deskripsi'];
      	
      	$this->output->set_content_type('application/json')->set_output(json_encode($data));
  	}
  	public function getImages($id_soal_detail){
  		$tanggal = date("Y-m-d");
  		if(!empty(htmlspecialchars($this->input->post('tanggal', true)))){
  			$tanggal = htmlspecialchars($this->input->post('tanggal', true));
  		}
      	$arr_par = array( 
      		'id_soal_detail' => $id_soal_detail ,
      		'tanggal' => $tanggal
      	);
      	$row = $this->admin->getmaster('tb_inspeksi_image',$arr_par);
      	$arr_data=array();
      	$arr_caption = array();
      	foreach ($row as $key => $value) {

      		$arr = array(
      			// 'type'=> $tipe, 
      			'key' => $value->id,
      			'width' => '120px',
      			'url' => base_url()."pengawasan/delete",
      			'caption' => $value->filename,
      		);

      		$tipe = explode(".", $value->filename)[1];
      		if(in_array($tipe,array("xls","xlsx"))){
      			$arr['type'] = "office";
      		}
      		if(in_array($tipe,array("mp4"))){
      			$arr['type'] = "video";
      		}
      		if(in_array($tipe,array("pdf"))){
      			$arr['type'] = "pdf";
      		}
      		
      		$arr_data[] = $arr;

      		$arr_caption[] = base_url()."upload/pengawasan/". $value->filename; 

      	}
      	$data['data'] = $arr_data;
      	$data['caption'] = $arr_caption;
      	
      	$this->output->set_content_type('application/json')->set_output(json_encode($data));
  	}
  	public function getImagessp($id_soal_detail){
  		$tanggal = date("Y-m-d");
  		if(!empty(htmlspecialchars($this->input->get('tanggal', true)))){
  			$tanggal = htmlspecialchars($this->input->get('tanggal', true));
  		}
      	$arr_par = array( 
      		'id_soal_detail' => $id_soal_detail ,
      		'tanggal' => $tanggal
      	);
      	$row = $this->admin->getmaster('tb_inspeksi_image',$arr_par);
      	$arr_data=array();
      	$arr_caption = array();
      	foreach ($row as $key => $value) {

      		$arr = array(
      			// 'type'=> $tipe, 
      			'key' => $value->id,
      			'width' => '120px',
      			// 'url' => base_url()."pengawasan/delete",
      			'caption' => $value->filename,
      		);

      		$tipe = explode(".", $value->filename)[1];
      		if(in_array($tipe,array("xls","xlsx"))){
      			$arr['type'] = "office";
      		}
      		if(in_array($tipe,array("mp4"))){
      			$arr['type'] = "video";
      		}
      		if(in_array($tipe,array("pdf"))){
      			$arr['type'] = "pdf";
      		}
      		
      		$arr_data[] = $arr;

      		$arr_caption[] = base_url()."upload/pengawasan/". $value->filename; 

      	}
      	$data['data'] = $arr_data;
      	$data['caption'] = $arr_caption;
      	
      	$this->output->set_content_type('application/json')->set_output(json_encode($data));
  	}
  	public function upload(){
  		$config['upload_path'] = './upload/pengawasan/';
	    $config['allowed_types'] = 'gif|jpg|png|jpeg|xls|xlsx|pdf';
	    $config['max_size'] = '5120';

	    $data['success'] = TRUE;

	    try {
	    	$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if(empty($_FILES['filefoto'])){
				$data['error'] = 'The following error occured : '.$this->upload->display_errors().'Click on "Remove" and try again!';
				echo "{}";
				exit();
			}

			$files = $_FILES;
		    $cpt = count($_FILES['filefoto']['name']);
		    for($i=0; $i<$cpt; $i++)
		    {           
		        $_FILES['filefoto']['name']= $files['filefoto']['name'][$i];
		        $_FILES['filefoto']['type']= $files['filefoto']['type'][$i];
		        $_FILES['filefoto']['tmp_name']= $files['filefoto']['tmp_name'][$i];
		        $_FILES['filefoto']['error']= $files['filefoto']['error'][$i];
		        $_FILES['filefoto']['size']= $files['filefoto']['size'][$i];  

		        if (!$this->upload->do_upload("filefoto")) {
			        $data['error'] = 'The following error occured : '.$this->upload->display_errors().'Click on "Remove" and try again!';
			        $this->output->set_content_type('application/json')->set_output(json_encode($data));
			    } else {
			    	$file = $this->upload->data();
			    	$filename =$file['file_name'];
			    	$data['filename'][] = $filename;
			    	$data['upload'] = "done";

			    	$arr = [
		                'id_soal' => htmlspecialchars($this->input->post('id_soal', true)),
		                'id_soal_detail' => htmlspecialchars($this->input->post('id_soal_detail', true)),
		                'filename' => $filename,
		                'tanggal' => date("Y-m-d"),
	            	];

	        		$this->db->insert('tb_inspeksi_image', $arr);
			       $this->output->set_content_type('application/json')->set_output(json_encode($data));
			    }
			    
		    }
	    } catch (Exception $e) {
	    	$data['success'] = TRUE;
	    	$data['error']= $e;
	    	$this->output->set_content_type('application/json')->set_output(json_encode($data));
	    }   
  	}

  	public function delete(){
  		$data['success'] = TRUE;
  		$image = $this->admin->get_array('tb_inspeksi_image',array('id' => htmlspecialchars($this->input->post('key', true))));
      	if(!empty($image)){
	  		if($this->admin->deleteTable("id", htmlspecialchars($this->input->post('key', true)), 'tb_inspeksi_image' )){
	  			
	  			$file= FCPATH. "upload/pengawasan/" . $image['filename'];
	  			if(file_exists($file))
				{
				    unlink($file);
				}
	  		}
      	}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
  	}

}
