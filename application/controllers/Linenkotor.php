<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Linenkotor extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('admin');
    $this->load->model('M_menu', '', TRUE);
  }
  public function index()
  {
    if ($this->admin->logged_id()) {
      if (CheckMenuRole('linenkotor')) {
        redirect("errors");
      }
      $data['title'] = 'Linen Masuk - Kotor';
      $data['main'] = 'linen/kotor';
      $data['js'] = 'script/linenkotor';
      $data['modal'] = 'modal/barang';

      $this->load->view('dashboard', $data, FALSE);
    } else {
      redirect("login");
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
      0 => 'TANGGAL',
      1 => 'NO_TRANSAKSI',
      2 => 'PIC',
      3 => 'TOTAL_QTY',
      4 => 'TOTAL_BERAT',
      5 => 'F_INFEKSIUS',
      6 => 'KATEGORI',
    );
    $valid_sort = array(
      0 => 'TANGGAL',
      1 => 'NO_TRANSAKSI',
      2 => 'PIC',
      3 => 'TOTAL_QTY',
      4 => 'TOTAL_BERAT',
      5 => 'F_INFEKSIUS',
      6 => 'KATEGORI',
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
    $this->db->select("id,CURRENT_INSERT,/*STR_TO_DATE(TANGGAL, '%d/%m/%Y')*/ TANGGAL,NO_TRANSAKSI,PIC,F_INFEKSIUS,KATEGORI,STATUS,TOTAL_BERAT,TOTAL_BERAT_REAL,TOTAL_QTY");
    $this->db->limit($length, $start);
    $this->db->from("linen_kotor");
    //$this->db->order_by("CURRENT_INSERT","DESC");
    $pengguna = $this->db->get();

    $data = array();
    foreach ($pengguna->result() as $r) {
      $status = $r->STATUS == 'BERSIH' ? "Done" : "Pending";
      $tbl_del = '<button type="button" rel="tooltip" class="btn btn-danger btn-sm " onclick="hapus(this)"  data-id="' . $r->id . '" >
                        <i class="icofont icofont-trash"></i>Hapus
                      </button>';
      if ($status == "Done") {
        $tbl_del = "";
      }
      $data[] = array(
        $r->TANGGAL,
        $r->NO_TRANSAKSI,
        $r->PIC,
        $r->F_INFEKSIUS,
        $r->KATEGORI,
        $r->TOTAL_QTY,
        $r->TOTAL_BERAT,
        ($r->TOTAL_BERAT_REAL == 0 ? $r->TOTAL_BERAT : $r->TOTAL_BERAT_REAL),
        $status,
        '<a href="linenkotor/edit/' . $r->id . '"  class="btn btn-warning btn-sm "  >
                        <i class="icofont icofont-edit"></i>Lihat
                      </a>' . $tbl_del,
      );
    }
    $total_pengguna = $this->totalPengguna($search, $valid_columns);

    $output = array(
      "draw" => $draw,
      "recordsTotal" => $total_pengguna,
      "recordsFiltered" => $total_pengguna,
      "data" => $data
    );
    echo json_encode($output);
    exit();
  }

  public function totalPengguna($search, $valid_columns)
  {
    $query = $this->db->select("COUNT(*) as num");
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
    $this->db->from("linen_kotor");
    $query = $this->db->get();
    $result = $query->row();
    if (isset($result)) return $result->num;
    return 0;
  }

  public function dataTableBrowse()
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
      0 => 'TANGGAL',
      1 => 'NO_TRANSAKSI',
      2 => 'PIC',
      3 => 'TOTAL_QTY',
      4 => 'TOTAL_BERAT',
    );
    $valid_sort = array(
      0 => 'TANGGAL',
      1 => 'NO_TRANSAKSI',
      2 => 'PIC',
      3 => 'TOTAL_QTY',
      4 => 'TOTAL_BERAT',
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
    $this->db->from("linen_kotor");
    $this->db->where("status", "CUCI");

    $pengguna = $this->db->get();
    $data = array();
    foreach ($pengguna->result() as $r) {

      $data[] = array(
        $r->TANGGAL,
        $r->NO_TRANSAKSI,
        $r->PIC,
        $r->TOTAL_QTY,
        $r->TOTAL_BERAT,
        '<button type="button" rel="tooltip" class="btn btn-warning btn-sm " onclick="pilih(' . $r->id . ')"  data-id="' . $r->id . '"  >
                        <i class="icofont icofont-ui-edit"></i>Pilih
                      </button>',
      );
    }
    $total_pengguna = $this->totalPenggunaBrowse($search, $valid_columns);

    $output = array(
      "draw" => $draw,
      "recordsTotal" => $total_pengguna,
      "recordsFiltered" => $total_pengguna,
      "data" => $data
    );
    echo json_encode($output);
    exit();
  }

  public function totalPenggunaBrowse($search, $valid_columns)
  {
    $query = $this->db->select("COUNT(*) as num");
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
    $this->db->from("linen_kotor");
    $this->db->where("status", "CUCI");

    $query = $this->db->get();
    $result = $query->row();
    if (isset($result)) return $result->num;
    return 0;
  }

  public function edit($id)
  {
    if ($this->admin->logged_id()) {
      $data['title'] = 'Edit Linen Masuk - Kotor';
      $data['main'] = 'linen/kotor-edit';
      $data['js'] = 'script/linenkotor-edit';
      $data['modal'] = 'modal/kotor';
      $data['mode'] = 'edit';
      $data['totalrow'] = 0;
      $data['pic'] = $this->admin->getmaster('tb_user');

      $this->db->select("id,/*STR_TO_DATE(TANGGAL, '%d/%m/%Y')*/ TANGGAL,NO_TRANSAKSI,PIC,STATUS,TOTAL_BERAT,TOTAL_BERAT_REAL,TOTAL_QTY,KATEGORI,F_INFEKSIUS");
      $this->db->from("linen_kotor");
      $data['data'] = $this->db->where("id", $id)->get()->row_array();

      $data['data_detail'] = $this->admin->get_result_array('linen_kotor_detail', array('no_transaksi' => $data['data']['NO_TRANSAKSI']));

      foreach ($data['data_detail'] as $key => $value) {
        $item = $this->admin->get_array('barang', array('serial' => $value['epc']));
        $jenis = $this->admin->get_array('jenis_barang', array('id' => $item['id_jenis']));
        $data['data_detail'][$key]['jenis'] = $jenis['jenis'];
        $data['data_detail'][$key]['berat'] = $jenis['berat'];
        $data['data_detail'][$key]['status'] = $this->admin->getLastHistory($value['epc']);
        $data['totalrow']++;
      }

      $this->load->view('dashboard', $data, FALSE);
    } else {
      redirect('login');
    }
  }

  public function detail($id)
  {
    $this->load->helper('string');

    $id_encrypted = $id;
    $id = base64_decode($id_encrypted);
    // print("<pre>" . print_r($id, true) . "</pre>");exit();

    $data['title'] = 'Detail Linen Kotor';
    $data['main'] = 'linen/kotor-edit';
    $data['js'] = 'script/linenkotor-edit';
    $data['modal'] = 'modal/kotor';
    $data['mode'] = 'detail';
    $data['totalrow'] = 0;
    $data['pic'] = $this->admin->getmaster('tb_user');

    $this->db->select("id,/*STR_TO_DATE(TANGGAL, '%d/%m/%Y')*/ TANGGAL,NO_TRANSAKSI,PIC,STATUS,TOTAL_BERAT,TOTAL_BERAT_REAL,TOTAL_QTY,KATEGORI,F_INFEKSIUS");
    $this->db->from("linen_kotor");
    $data['data'] = $this->db->where("id", $id)->get()->row_array();

    $data['data_detail'] = $this->admin->get_result_array('linen_kotor_detail', array('no_transaksi' => $data['data']['NO_TRANSAKSI']));

    foreach ($data['data_detail'] as $key => $value) {
      $item = $this->admin->get_array('barang', array('serial' => $value['epc']));
      $jenis = $this->admin->get_array('jenis_barang', array('id' => $item['id_jenis']));
      $data['data_detail'][$key]['jenis'] = $jenis['jenis'];
      $data['data_detail'][$key]['berat'] = $jenis['berat'];
      $data['data_detail'][$key]['status'] = $this->admin->getLastHistory($value['epc']);
      $data['totalrow']++;
    }

    $this->load->view('dashboard', $data, FALSE);
  }

  public function create()
  {
    if ($this->admin->logged_id()) {
      $data['title'] = 'Create Linen Masuk - Kotor';
      $data['main'] = 'linen/kotor-create';
      $data['js'] = 'script/linenkotor-edit';
      $data['modal'] = 'modal/kotor';
      $data['mode'] = 'new';
      $data['totalrow'] = 0;
      $data['totalrowmulti'] = 1;
      $data['totalrowhistory'] = 0;
      $data['totalrowbiaya'] = 0;

      $nomor_transaksi = "SV-" . date("Ymd-his");

      $data['no_transaksi'] = $nomor_transaksi;
      $data['pic'] = $this->admin->getmaster('tb_user');
      $data['data'] = array();

      $data['data_detail'] = array();

      $this->load->view('dashboard', $data, FALSE);
    } else {
      redirect('login');
    }
  }

  public function Save()
  {

    $response = [];
    $response['error'] = TRUE;
    $response['msg'] = "Gagal menyimpan.. Terjadi kesalahan pada sistem";
    $recLogin = $this->session->userdata('user_id');

    $tgl = str_replace('%2F', '/', $this->input->post('tanggal'));
    $data = array(
      'NO_TRANSAKSI'   => $this->input->post('no_transaksi'),
      'TANGGAL'   => date("Y-m-d", strtotime($tgl)),
      'PIC'       => $this->input->post('pic'),
      'F_INFEKSIUS'   => $this->input->post('f_infeksius'),
      'KATEGORI'      => $this->input->post('kategori'),
      'TOTAL_BERAT'   => $this->input->post('total_berat'),
      'TOTAL_BERAT_REAL'   => $this->input->post('total_berat_real'),
      'TOTAL_QTY'     => $this->input->post('total_qty'),
      'STATUS'     => 'CUCI',
    );

    $this->db->trans_begin();

    if ($this->input->post('id_kotor') != "") {

      $this->db->set($data);
      $this->db->where('id', $this->input->post('id_kotor'));
      $result  =  $this->db->update('linen_kotor');
      $response['id'] = $this->input->post('id_kotor', TRUE);
      if (!$result) {
        print("<pre>" . print_r($this->db->error(), true) . "</pre>");
      } else {
        $response['error'] = FALSE;

        $total = intval($this->input->post('total-row'));
        for ($i = 1; $i <= $total; $i++) {
          if (!empty($this->input->post('epc' . $i))) {
            unset($data);
            $data['no_transaksi'] = $this->input->post('no_transaksi');
            $data['epc'] = $this->input->post('epc' . $i);
            $data['ruangan'] = $this->input->post('ruangan' . $i);

            if (!empty($this->input->post('id_detail' . $i))) {
              $this->db->set($data);
              $this->db->where(array("epc" => $this->input->post('epc' . $i), "no_transaksi" => $this->input->post('no_transaksi')));
              $this->db->update('linen_kotor_detail');
            } else {
              $this->db->insert('linen_kotor_detail', $data);

              //update status keluar di linen bersih
              unset($data);
              $data['kotor'] = 1;
              $this->db->set($data);
              $this->db->where(
                array(
                  "epc" => $this->input->post('epc' . $i),
                  "kotor" => 0
                )
              );
              $this->db->update('linen_keluar_detail');
            }
          }
        }
      }
    } else {

      $result  = $this->db->insert('linen_kotor', $data);
      $last_id = $this->db->insert_id();
      $response['id'] = $last_id;
      if (!$result) {
        print("<pre>" . print_r($this->db->error(), true) . "</pre>");
      } else {
        $response['error'] = FALSE;

        $total = intval($this->input->post('total-row'));
        for ($i = 1; $i <= $total; $i++) {
          if (!empty($this->input->post('epc' . $i))) {
            unset($data);
            $data['no_transaksi'] = $this->input->post('no_transaksi');
            $data['epc'] = $this->input->post('epc' . $i);
            $data['ruangan'] = $this->input->post('ruangan' . $i);

            //get last history dulu untuk init rewash
            $last_cuci = $this->admin->getLastHistory($this->input->post('epc' . $i));

            $this->db->insert('linen_kotor_detail', $data);

            //update status keluar di linen bersih
            unset($data);
            $data['kotor'] = 1;
            $this->db->set($data);
            $this->db->where(
              array(
                "epc" => $this->input->post('epc' . $i),
                "kotor" => 0
              )
            );
            $this->db->update('linen_keluar_detail');

            //cek jika kategori rewash, maka transaksi sebelumnya dikurangin qtynya
            if ($this->input->post('kategori', TRUE) == "Rewash") {

              if (!empty($last_cuci)) {
                $last_no = $last_cuci['no_transaksi'];
                $last_detail_cuci = $this->admin->get_array(
                  "linen_kotor_detail",
                  array(
                    "no_transaksi" => $last_no,
                    "epc" => $this->input->post('epc' . $i)
                  )
                );
                if (!empty($last_detail_cuci)) {

                  //hitung qty last record
                  $last_jml = $this->admin->getmaster_num_rows("linen_kotor_detail", array("no_transaksi" => $last_no));

                  //get Total Berat
                  $last_total_berat = $this->admin->getTotalBeratTransaksi($last_no);
                  // print("<pre>".print_r($last_total_berat,true)."</pre>"); exit();

                  //hapus last record
                  $this->db->from("linen_kotor_detail");
                  $this->db->where(array("epc" => $this->input->post('epc' . $i), "no_transaksi" => $last_no))->delete();

                  //get berat
                  $berat = $this->admin->getBerat($this->input->post('epc' . $i));
                  //update qty last record
                  $this->db->set(array("TOTAL_QTY" => ($last_jml - 1), "TOTAL_BERAT" => ($last_total_berat - $berat)));
                  $this->db->where(array("no_transaksi" => $last_no));
                  $this->db->update('linen_kotor');
                }
              }
            }
          }
        }
      }
    }

    $this->db->trans_complete();
    $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }

  public function delete()
  {
    $response = [];
    $response['error'] = TRUE;
    if ($this->admin->deleteTable("id", $this->input->get('id', TRUE), 'linen_kotor_detail')) {
      $response['error'] = FALSE;
      $data['data_detail'] = $this->admin->get_result_array('linen_kotor_detail', array('no_transaksi' => $this->input->get('no_transaksi', TRUE)));

      $totalrow = 0;
      $berat = 0;
      foreach ($data['data_detail'] as $key => $value) {
        $item = $this->admin->get_array('barang', array('serial' => $value['epc']));
        $jenis = $this->admin->get_array('jenis_barang', array('id' => $item['id_jenis']));
        $berat += $jenis['berat'];

        $totalrow++;
      }
      unset($data);
      $data['total_berat'] = $berat;
      $data['total_qty'] = $totalrow;

      $this->db->set($data);
      $this->db->where(array("no_transaksi" => $this->input->get('no_transaksi')));
      $this->db->update('linen_kotor');

      $response['berat'] = $berat;
      $response['total'] = $totalrow;
    }

    $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }
  public function deletelist()
  {
    $response = [];
    $response['error'] = TRUE;
    $header = $this->admin->get_array('linen_kotor', array('id' => $this->input->get('id', TRUE)));
    // print("<pre>".print_r($header,true)."</pre>");exit();
    if ($this->admin->deleteTable("id", $this->input->get('id', TRUE), 'linen_kotor')) {
      $response['error'] = FALSE;
      $this->admin->deleteTable("no_transaksi", $header['NO_TRANSAKSI'], 'linen_kotor_detail');
    }

    $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }

  public function dataTableBrg()
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
      0 => 'serial',
      1 => 'jenis',
      2 => 'nama_ruangan',
      3 => 'berat',
    );
    $valid_sort = array(
      0 => 'serial',
      1 => 'jenis',
      2 => 'nama_ruangan',
      3 => 'berat',
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
    $this->db->select("barang.*,jenis,berat");
    $this->db->from("barang");
    $this->db->join('jenis_barang', 'barang.id_jenis = jenis_barang.id');
    $pengguna = $this->db->get();
    $data = array();
    foreach ($pengguna->result() as $r) {

      $data[] = array(
        $r->serial,
        $r->jenis,
        $r->nama_ruangan,
        $r->berat,
        '<button type="button" rel="tooltip" class="btn btn-warning btn-sm " onclick="pilih_item(this);void(0)"  data-id="' . $r->serial . '"  >
                        <i class="icofont icofont-ui-edit"></i>Pilih
                      </button>',
      );
    }
    $total_pengguna = $this->totalBrg($search, $valid_columns);

    $output = array(
      "draw" => $draw,
      "recordsTotal" => $total_pengguna,
      "recordsFiltered" => $total_pengguna,
      "data" => $data
    );
    echo json_encode($output);
    exit();
  }

  public function totalBrg($search, $valid_columns)
  {
    $query = $this->db->select("COUNT(*) as num");
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
    $this->db->select("barang.*,jenis,berat");
    $this->db->from("barang");
    $this->db->join('jenis_barang', 'barang.id_jenis = jenis_barang.id');
    $query = $this->db->get();
    $result = $query->row();
    if (isset($result)) return $result->num;
    return 0;
  }
  public function get()
  {
    if ($this->admin->logged_id()) {
      $id = $this->input->get("id", TRUE);

      $data['data'] = $this->admin->get_array('linen_kotor', array('id' => $id));

      $data['data_detail'] = $this->admin->get_result_array('linen_kotor_detail', array('no_transaksi' => $data['data']['NO_TRANSAKSI']));

      foreach ($data['data_detail'] as $key => $value) {
        $item = $this->admin->get_array('barang', array('serial' => $value['epc']));
        $jenis = $this->admin->get_array('jenis_barang', array('id' => $item['id_jenis']));
        $data['data_detail'][$key]['jenis'] = $jenis['jenis'];
        $data['data_detail'][$key]['berat'] = $jenis['berat'];
      }

      $this->output->set_content_type('application/json')->set_output(json_encode($data));
    } else {
      redirect("login");
    }
  }

  public function getItemScan()
  {
    $data['status'] = "success";
    if ($this->admin->logged_id()) {

      $epc = $this->input->get("epc", TRUE);

      $this->db->select("barang.*,jenis,berat");
      $this->db->from("barang");
      $this->db->join('jenis_barang', 'barang.id_jenis = jenis_barang.id');
      $data['data_detail'] = $this->db->where("serial", strtoupper($epc))->get()->result_array();
      $data['history'] = $this->admin->getLastHistory(strtoupper($epc));
      $data['jml_cuci'] = $this->admin->getJumlahCuci(strtoupper($epc));

      $this->output->set_content_type('application/json')->set_output(json_encode($data));
    } else {
      $data['status'] = "error";
    }
  }
}
