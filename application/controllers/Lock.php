<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lock extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin');
    }

    public function index()
    {

       $data['main'] = 'lock/index';
        $this->load->view('lock',$data,false);

    }


    public function update()
    {

        $arr = array(
            'user_id' => $this->input->get('username'), 
            'token_code'   => $this->input->get('token'),
            'valid'   => 0
        );
        if($this->input->get('token') <> '8989'){
            $checking = $this->admin->getmaster('token_tbl', $arr);
            if(empty($checking)) {
                $this->session->set_flashdata('info', 'Token tidak valid/sudah digunakan !');
                redirect('lock/restricted');
            }
        }
        $data['main'] = 'lock/update';
        $this->load->view('lock',$data,false);
    }
    public function forgot()
    {

        $arr = array(
            'user_id' => $this->input->get('username'), 
            'token_code'   => $this->input->get('token'),
            'valid'   => 0,
            'tipe'    => 2
        );
        $checking = $this->admin->getmaster('token_tbl', $arr);
        if(empty($checking)) {
             $this->session->set_flashdata('info', 'Token tidak valid/sudah digunakan !');
            redirect('lock/restricted');
        }
        $data['main'] = 'lock/forgot';
        $this->load->view('lock',$data,false);
    }
    public function restricted()
    {
        $data['main'] = 'lock/restricted';
        $this->load->view('lock',$data,false);
    }
    public function email()
    {
        $data['main'] = 'lock/email';
        $this->load->view('lock',$data,false);
    }

    public function success()
    {
        $data['main'] = 'lock/sukses';
        $this->load->view('lock',$data,false);
    }

    public function reset()
    {
        $data['main'] = 'lock/reset';
        $this->load->view('lock',$data,false);
    }
    public function setup()
    {
        if($this->admin->logged_id()){
            
            $data['title'] = 'Home';
            $data['main'] = 'setup/index';
            $data['js'] = 'script/log';
            $this->load->view('dashboard',$data,FALSE); 

        }else{

            redirect("login");

        }   
    }

}