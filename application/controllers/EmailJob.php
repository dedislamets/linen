<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class EmailJob extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('admin');
	   	$this->load->helper('url');
	   	$this->load->helper('string');
	}
	public function index()
	{			
			$message = $this->load->view('email/template_email','',true); 
            $note = $this->load->view('email/notifikasi','',true);

			$message=str_replace("#content#", $note, $message);
			$message=str_replace("#horizontal_line#", "<hr width=100% size=1 />", $message);

	        $this->load->library('phpmailer_lib');
	        $mail = $this->phpmailer_lib->load();

	        $setup_tbl    = $this->admin->api_getmaster('setup');
	        $range_date = $setup_tbl[0]->range_date;
	        $range_notifikasi = $setup_tbl[0]->range_notifikasi;
	        // print("<pre>".print_r($setup_tbl[0]->range_notifikasi,true)."</pre>");exit();
	        $this->db->select("*,DATEDIFF(day, GETDATE(), DATEADD(day,". $range_date .",last_update_date)) as day_diff");
		    $this->db->from('login');
		    $this->db->where(array('aktif' => 1, 'eternal' => 0, 'email <>' => ''));
		    $pengguna = $this->db->get();

		    $arr = array();

		    if ($pengguna->num_rows() > 0 ){
		    	$no=0;
		        foreach ($pengguna->result() as $apps) {
		        	
		        	if($apps->day_diff > 0 && $apps->day_diff < $range_notifikasi)
		        	{
		        		$no++;
			        	//Create token
			        	$token = random_string('alnum', 8);
			        	$data = array( 
		                    'user_id'       =>  $apps->user_id,
		                    'token_code'	=>  $token,
		                );
		                $this->db->insert('token_tbl',$data);

			        	$app_tbl    = $this->admin->api_getmaster('app_tbl',"app_code='". $apps->apps ."'");

			        	unset($arr["#link#"]);
						$arr["nama_pengguna"] = $apps->nama_pengguna;
						$arr["apps"] 			= strtoupper($apps->apps);
						$arr["username"] 		= $apps->user_id;
						$arr["email"] 			= $apps->email;
						$arr["by"] 				= $apps->user_id;
						$arr["base_url"] 		= $app_tbl[0]->base_url;
						$arr["token"] 			= $token;
						$arr['last_update_date'] = date("d M Y", strtotime($apps->last_update_date));
						$arr["#link#"]			= "http://air.modena.co.id/pm/lock/update?" . http_build_query($arr);

						print("<pre>".print_r($arr,true)."</pre>");

						unset($arr["nama_pengguna"]);
						unset($arr["apps"]);
						unset($arr["username"]);
						unset($arr["email"]);
						unset($arr["by"]);
						unset($arr["last_update_date"]);
						unset($arr["token"]);

						$arr["#nama_pengguna#"] = $apps->nama_pengguna;
						$arr["#apps#"] 			= strtoupper($apps->apps);
						$arr["#day_diff#"] 		= $apps->day_diff;
						$template = str_replace( array_keys($arr), array_values($arr), $message );

						$mail->addAddress($apps->email);
						// $mail->addAddress('dedi.supatman@modena.co.id');
			        	$mail->Subject = 'Peringatan akun '. strtoupper($apps->apps) .' anda akan segera expired.';
				        $mail->Body = $template;
				        

				        if(!$mail->send()){
				            echo 'Message could not be sent.';
				            echo 'Mailer Error: ' . $mail->ErrorInfo;
				        }else{
				            echo 'Message has been sent<br>';
				        }	
			    	}
	            }

	            if($no==0)
	            	echo "Data tidak ditemukan.";

	        }else{
	        	echo "Data tidak ditemukan.";
	        }
					  
						
	}

}
