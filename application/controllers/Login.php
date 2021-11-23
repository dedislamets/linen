<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin');
        $this->load->helper('url');
        $this->load->helper('string');
    }

    public function index()
    {       
            // $password = $this->Acak('12345', "goldenginger");
            // print("<pre>".print_r($password,true)."</pre>");exit();
        if($this->admin->logged_id())
        {
            redirect("dashboard");

        }else{

            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            $this->form_validation->set_message('required', '<div class="alert alert-danger" >
                <div class="header"><b><i class="fa fa-exclamation-circle"></i> {field}</b> harus diisi</div></div>');

            //cek validasi
            if ($this->form_validation->run() == TRUE) {
                $username = $this->input->post("username", TRUE);
                $password = $this->Acak($this->input->post('password', TRUE), "goldenginger");
                $checking = $this->admin->check_login('tb_user', array('email' => $username), array('password' => $password), array('status' => 1));

                //jika ditemukan, maka create session
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
                        // print("<pre>".print_r($session_data,true)."</pre>");exit();
                        redirect('dashboard/');

                    }
                }else{

                    $data['error'] = '<div class="alert alert-danger">
                        <div class="header"><b><i class="fa fa-exclamation-circle"></i></b> Username atau Password salah!</div></div>';
                    $data['main'] = 'login/index';
                    $this->load->view('login', $data);
                }

            }else{
                $data['main'] = 'login/index';
                $this->load->view('login', $data);
            }

        }

    }

    

    public function keluar()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

    function TidakAcak($varMsg,$strKey) {
        try {
            $char_replace="";
            $Msg = $varMsg;
            $intLength = strlen($Msg);
            $intKeyLength = strlen($strKey);
            $intKeyOffset = $intKeyLength;
            $intLastChar = ord(substr($strKey, -1));
            

            for ($n=0; $n < $intLength ; $n++) { 
                $intKeyOffset = $intKeyOffset + 1;
                if($intKeyOffset > $intKeyLength) {
                    $intKeyOffset = 1;
                }
                $intAsc = ord(substr($Msg,$n, 1));

                if($intAsc > 32 && $intAsc < 127){
                    $intAsc = $intAsc - 32;
                    $intSkip = $n+1 % 94;
                    $intAsc = $intAsc - $intSkip;

                    if($intAsc < 1) {
                        $intAsc = $intAsc + 94;
                    }
                    $intAsc = $intAsc - $intLastChar;
                    while ( $intAsc < 1) {
                       $intAsc = $intAsc + 94;
                    }
                    $char_replace .= chr($intAsc + 32);
                    
                    $Msg = $char_replace . substr($varMsg, $n+1) ;
                    //$Msg = str_replace(substr($Msg, $n,1),chr($intAsc + 32), $Msg);
                    // echo $Msg . "-". chr($intAsc + 32) ."<br>";
                }
                $intLastChar = ord(substr($strKey, $intKeyOffset-1));
               
            }
            return $Msg;
        } catch (Exception $e) {
            echo $e;
        }
    }
    
    function Acak($varMsg,$strKey) {
        try {
            $Msg = $varMsg;
            $char_replace="";
            $intLength = strlen($Msg);
            $intKeyLength = strlen($strKey);
            $intKeyOffset = $intKeyLength;
            $intKeyChar = ord(substr($strKey, -1));
            for ($n=0; $n < $intLength ; $n++) { 
                $intKeyOffset = $intKeyOffset + 1;

                if($intKeyOffset > $intKeyLength) {
                    $intKeyOffset = 1;
                }
                $intAsc = ord(substr($Msg,$n, 1));

                if($intAsc > 32 && $intAsc < 127){
                    $intAsc = $intAsc - 32;
                    $intAsc = $intAsc + $intKeyChar;

                    while ( $intAsc > 94) {
                       $intAsc = $intAsc - 94;
                    }

                    $intSkip = $n+1 % 94;
                    $intAsc = $intAsc + $intSkip;
                    if($intAsc > 94){
                        $intAsc = $intAsc - 94;
                    }

                    $char_replace .= chr($intAsc + 32);
                    
                    $Msg = $char_replace . substr($varMsg, $n+1) ;
                }

                $intKeyChar = ord(substr($strKey, $intKeyOffset-1));
            }
            return $Msg;
        } catch (Exception $e) {
            
        }
    }
}