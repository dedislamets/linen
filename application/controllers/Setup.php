<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setup extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin');
    }

    public function index()
    {

        if ($this->admin->logged_id()) {

            $data['title'] = 'Home';
            $data['main'] = 'setup/index';
            $data['js'] = 'script/setup';
            $data['setup'] = $this->admin->getmaster('tb_setting');
            $this->load->view('dashboard', $data, FALSE);
        } else {

            redirect("login");
        }
    }
    public function aplikasi()
    {

        if ($this->admin->logged_id()) {

            $data['title'] = 'Home';
            $data['main'] = 'setup/aplikasi';
            $data['js'] = 'script/aplikasi';
            $data['modal'] = 'modal/aplikasi';
            $data['setup'] = $this->admin->getmaster('setup');
            $this->load->view('dashboard', $data, FALSE);
        } else {

            redirect("login");
        }
    }
    public function simpan()
    {
        $this->form_validation->set_rules('serial_com', 'serial_com', 'required');
        $this->form_validation->set_rules('power', 'power', 'required');
        $this->form_validation->set_rules('ip', 'ip', 'required');
        $this->form_validation->set_rules('port_ip', 'port_ip', 'required');
        $this->form_validation->set_message('required', '<div class="alert alert-danger" >
            <div class="header"><b><i class="fa fa-exclamation-circle"></i> {field}</b> harus diisi</div></div>');


        if ($this->form_validation->run() == TRUE) {

            $config['allowed_types']   = 'gif|jpg|jpeg|png';
            $config['upload_path']     = './upload/logo/';
            $config['overwrite']       = true;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            $filename = "";
            // print("<pre>".print_r($_FILES['file'],true)."</pre>");exit();

            if (!empty($_FILES['file'])) {
                if (!$this->upload->do_upload('file')) {
                    $data['error'] = 'The following error occured : ' . $this->upload->display_errors() . 'Click on "Remove" and try again!';
                    $this->output->set_content_type('application/json')->set_output(json_encode($data));
                } else {
                    $uploaded_data = $this->upload->data();
                    $filename = $uploaded_data['file_name'];
                }
            }

            $data = array(
                'port_com'         =>  $this->input->post('serial_com'),
                'power'   =>  $this->input->post('power'),
                'baud'   =>  $this->input->post('baud'),
                'speed'   =>  $this->input->post('speed'),
                'ip'   =>  $this->input->post('ip'),
                'port_ip'   =>  $this->input->post('port_ip'),
                'default_scan'   =>  $this->input->post('default_scan'),
                'company'   =>  $this->input->post('company'),
                'pic_1'   =>  $this->input->post('pic_1'),
                'pic_2'   =>  $this->input->post('pic_2'),
                'pic_1_nik'   =>  $this->input->post('pic_1_nik'),
                'pic_2_nik'   =>  $this->input->post('pic_2_nik')
            );
            if ($filename !== "") {
                $data['Logo'] = $filename;
            }
            $this->db->set($data);
            $this->db->update('tb_setting');

            $this->session->set_flashdata('message', '<div class="alert alert-success" >
            <b><i class="fa fa-exclamation-circle"></i> Berhasil</b> update !!</div>');
            redirect('setup');
        } else {

            $this->session->set_flashdata('message', '<div class="alert alert-danger" >
            <div class="header"><b><i class="fa fa-exclamation-circle"></i> Field</b> tidak boleh kosong !!</div></div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function dataTable()
    {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $order = $this->input->get("order");
        $search = $this->input->get("search");
        $search = $search['value'];
        $col = 10;
        $dir = "";

        if (!empty($order)) {
            foreach ($order as $o) {
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }

        if ($dir != "asc" && $dir != "desc") {
            $dir = "desc";
        }

        $valid_columns = array(
            0 => 'app_code',
            1 => 'base_url',
            2 => 'tabel_user',
            3 => 'key_tbl',
            4 => 'field_password',
            5 => 'driver',
            6 => 'encrypt_type'
        );
        $valid_sort = array(
            0 => 'app_code',
            1 => 'base_url',
            2 => 'tabel_user',
            3 => 'key_tbl',
            4 => 'field_password',
            5 => 'driver',
            6 => 'encrypt_type'
        );
        if (!isset($valid_sort[$col])) {
            $order = null;
        } else {
            $order = $valid_sort[$col];
        }
        if ($order != null) {
            $this->db->order_by($order, $dir);
        }

        if (!empty($search)) {
            $x = 0;
            foreach ($valid_columns as $sterm) {
                if ($x == 0) {
                    $this->db->like($sterm, $search);
                } else {
                    $this->db->or_like($sterm, $search);
                }
                $x++;
            }
        }
        $this->db->limit($length, $start);
        $pengguna = $this->db->get("app_tbl");
        // echo $this->db->last_query();exit();
        $data = array();
        foreach ($pengguna->result() as $r) {
            $data[] = array(
                $r->app_code,
                $r->base_url,
                $r->tabel_user,
                $r->key_tbl,
                $r->field_password,
                $r->driver,
                $r->encrypt_type,
                '<button type="button" rel="tooltip" class="btn btn-sm " onclick="editmodal(this)"  data-id="' . $r->app_code . '"  >
                          Edit
                        </button>',
            );
        }
        $total_aplikasi = $this->totalAplikasi();

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_aplikasi,
            "recordsFiltered" => $total_aplikasi,
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }

    public function totalAplikasi()
    {
        $query = $this->db->select("COUNT(*) as num")->get("app_tbl");
        $result = $query->row();
        if (isset($result)) return $result->num;
        return 0;
    }

    public function app_edit()
    {
        $id = $this->input->get('id');
        $arr_par = array('app_code' => $id);
        $data = $this->admin->getmaster('app_tbl', $arr_par);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function Reset()
    {
        $response = [];
        $response['msg'] = "";
        $response['error'] = FALSE;

        try {
            $this->db->truncate('linen_kotor_detail');
            $this->db->truncate('linen_kotor');
            $this->db->truncate('linen_bersih_detail');
            $this->db->truncate('linen_bersih');
            $this->db->truncate('linen_keluar_detail');
            $this->db->truncate('linen_keluar');
            $this->db->truncate('linen_rusak');
            $this->db->truncate('linen_rusak_detail');
            $this->db->truncate('new_request_linen');
            $this->db->truncate('new_request_linen_detail');
            $this->db->truncate('new_request_linen_detail_image');
            $this->db->truncate('request_jemput');
            $this->db->truncate('request_linen');
            $this->db->truncate('request_linen_detail');
            $this->db->truncate('tb_notifikasi');
            $this->db->truncate('tb_inspeksi');
            $this->db->truncate('tb_inspeksi_image');
            $this->db->truncate('tb_penerimaan');
            $this->db->truncate('tb_penerimaan_detail');
            $this->db->truncate('tb_vbs');
            $this->db->truncate('logs_apk');

            $db_error = $this->db->error();
            if (!empty($db_error)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
            }
        } catch (Exception $e) {
            $response['msg'] = $e->getMessage();
            $response['error'] = TRUE;
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }
    public function Save()
    {

        $response = [];
        $response['error'] = TRUE;
        $response['msg'] = "Gagal menyimpan.. Terjadi kesalahan pada sistem";
        $recLogin = $this->session->userdata('user_id');
        $data = array(
            'app_code'          => $this->input->get('app_code'),
            'base_url'          => $this->input->get('base_url'),
            'tabel_user'        => $this->input->get('tabel_user'),
            'key_tbl'           => $this->input->get('key_tbl'),
            'field_password'    => $this->input->get('field_password'),
            'driver'            => $this->input->get('driver'),
            'encrypt_type'      => $this->input->get('encrypt_type'),
        );


        $this->db->trans_begin();

        if ($this->input->get('txtCode') != "") {

            $this->db->set($data);
            $this->db->where('app_code', $this->input->get('txtCode'));
            $result  =  $this->db->update('app_tbl');

            if (!$result) {
                print("<pre>" . print_r($this->db->error(), true) . "</pre>");
            } else {
                $response['error'] = FALSE;
            }
        } else {

            $result  = $this->db->insert('app_tbl', $data);

            if (!$result) {
                print("<pre>" . print_r($this->db->error(), true) . "</pre>");
            } else {
                $response['error'] = FALSE;
            }
        }


        $this->db->trans_complete();

        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }
}
