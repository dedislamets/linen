<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frame extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin');
    }

    public function index()
    {
        $this->load->view('frame');

    }



}