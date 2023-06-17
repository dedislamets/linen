<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('admin');
	   
	}
	public function index()
	{		
		if($this->admin->logged_id()){
        	
        	// redirect('pengguna');

            $data['title'] = 'Home';
            $data['main'] = 'dashboard';
			$data['js'] = 'dashboard/js';

			$this->db->select('count(*) jml');
			$this->db->from('barang');
			$query = $this->db->get();
			$data['total_linen'] = $query->row_array(); 

			$this->db->select('count(epc) total');
			$this->db->from('linen_kotor');
			$this->db->join('linen_kotor_detail','linen_kotor_detail.no_transaksi=linen_kotor.NO_TRANSAKSI','LEFT');
            $this->db->where('STATUS','CUCI');
            $query = $this->db->get();
			$data['total_kotor'] = $query->row_array(); 


			$this->db->select('count(ifnull(SERIAL,0)) total');
			$this->db->from('barang');
			$this->db->join('linen_kotor_detail','linen_kotor_detail.`epc`=barang.`serial`','LEFT');
            $this->db->where('linen_kotor_detail.epc IS NULL');
            $this->db->where('serial not in (select epc from linen_rusak_detail lrd)');
            $query = $this->db->get();
			$data['total_serial_blm_pakai'] = $query->row_array(); 

            $this->db->select('count(ifnull(epc,0)) total');
            $this->db->from('linen_bersih');
            $this->db->join('linen_bersih_detail','linen_bersih_detail.no_transaksi=linen_bersih.NO_TRANSAKSI','LEFT');
            $this->db->where('keluar','0');
            $this->db->where('epc not in (select epc from linen_rusak_detail lrd)');

            $query = $this->db->get();
            $data['total_bersih'] = $query->row_array(); 
			// echo $this->db->last_query(); exit();

			$this->db->select('count(ifnull(epc,0)) total');
			$this->db->from('linen_keluar');
			$this->db->join('linen_keluar_detail','linen_keluar_detail.no_transaksi=linen_keluar.NO_TRANSAKSI','LEFT');
            $this->db->where('kotor','0');
            $query = $this->db->get();
			$data['total_keluar'] = $query->row_array(); 

			$this->db->select('tb_ruangan.ruangan,count(epc) total');
			$this->db->from('tb_ruangan');
			$this->db->join('linen_keluar','tb_ruangan.ruangan=linen_keluar.ruangan','LEFT');
			$this->db->join('linen_keluar_detail','linen_keluar_detail.no_transaksi=linen_keluar.NO_TRANSAKSI and kotor=0','LEFT');
            $this->db->group_by('tb_ruangan.ruangan');
            $this->db->order_by('count(epc) desc');
            $data['ruangan'] = $this->db->get()->result();

            $this->db->select('ruangan, sum(qty-qty_keluar) AS jml');
            $this->db->from('request_linen A');
            $this->db->join('request_linen_detail B', 'A.no_request = B.no_request');
            $this->db->where_in('flag_ambil', array(0,1));
            $this->db->group_by('ruangan');
            $records = $this->db->get()->result_array();

            $data_chart=[];
            $arr_qty = array();
            $arr_data=array();
            foreach($records as $row) {
                $data_chart['labels'][] = $row['ruangan'];
                $arr_qty['data'][]=$row['jml'];
                $color = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
                $arr_qty['backgroundColor'][] = $color;
                $arr_data[] = array(
                	'ruangan' => $row['ruangan'],
                	'jml' => $row['jml'],
                	'backgroundColor' => $color );
            }
            $data_chart['datasets'][]= $arr_qty;
            $data['chart_rs'] = json_encode($data_chart);
            $data['data_req_chart'] = $arr_data;

            $this->db->select('TANGGAL,TIMESTAMPDIFF(DAY,TANGGAL,CURDATE()) as umur, epc,B.no_transaksi,RUANGAN,jenis');
			$this->db->from('linen_keluar A');
			$this->db->join('linen_keluar_detail B','B.no_transaksi=A.NO_TRANSAKSI');
			$this->db->join('barang C','C.serial=B.epc');
			$this->db->join('jenis_barang D','D.id=C.id_jenis');
            $this->db->where('kotor','0');
            $this->db->order_by('TIMESTAMPDIFF(DAY,TANGGAL,CURDATE()) desc');
            $this->db->limit(10);
            $query = $this->db->get();
			$data['data_umur_keluar'] = $query->result(); 

            $this->db->select('tgl_request,A.no_request, requestor,ruangan,A.jenis as jenis_linen, B.jenis,qty,B.id');
            $this->db->from('new_request_linen A');
            $this->db->join('new_request_linen_detail B','B.no_request=A.no_request');
            $this->db->where('status','Pending');
            $this->db->order_by('created_date asc');
            $this->db->limit(10);
            $query = $this->db->get();
            $data['pengajuan_linen_baru'] = $query->result();
            // echo $this->db->last_query(); exit();

            $this->db->from('request_jemput A');
            $this->db->where('status_request','Pending');
            $this->db->order_by('created_date asc');
            $query = $this->db->get();
            $data['jemput'] = $query->result(); 
            $data['jemput_count'] = $query->num_rows();

            $this->db->select('A.defect,COUNT(B.id) as jml');
			$this->db->from('tb_defect A');
            $this->db->join('linen_rusak B','A.defect=B.DEFECT','LEFT');
            $this->db->join('linen_rusak_detail C','C.no_transaksi=B.NO_TRANSAKSI','LEFT');
            $this->db->group_by('A.defect');
            $this->db->order_by('COUNT(B.id) DESC');
            $query = $this->db->get();
			$data['defect'] = $query->result(); 

            $this->db->from('tb_notifikasi');
            $this->db->where('read',0);
            $query = $this->db->where('sent_to', $this->session->userdata('user_id'))->get();
            $data['notifikasi'] = $query->result();
            $data['notifikasi_count'] = $query->num_rows();

            $total_linen = $this->db->query("SELECT count(*) as qty,ifnull(sum(berat),0)  as berat
                                FROM `linen_kotor` 
                                LEFT JOIN `linen_kotor_detail` ON `linen_kotor_detail`.`no_transaksi`=`linen_kotor`.`NO_TRANSAKSI` 
                                LEFT JOIN  barang ON barang.`serial`=linen_kotor_detail.`epc`
                                LEFT JOIN jenis_barang ON `jenis_barang`.id=barang.`id_jenis`
                                WHERE MONTH(tanggal)=MONTH(CURDATE()) AND YEAR(tanggal)=YEAR(CURDATE()) and TOTAL_QTY>0" )->result();
            $total_linen_real = $this->db->query("SELECT ifnull(sum(TOTAL_BERAT_REAL),0) as berat
                                FROM `linen_kotor` 
                                WHERE MONTH(tanggal)=MONTH(CURDATE()) AND YEAR(tanggal)=YEAR(CURDATE()) and TOTAL_QTY>0" )->result();
            $data['total_linen_all']= $total_linen;
            $data['total_linen_real']= $total_linen_real;

            $total_rewash = $this->db->query("SELECT count(*) as qty, ifnull(sum(berat),0) as sum_berat
                                FROM `linen_kotor` 
                                LEFT JOIN `linen_kotor_detail` ON `linen_kotor_detail`.`no_transaksi`=`linen_kotor`.`NO_TRANSAKSI` 
                                LEFT JOIN  barang ON barang.`serial`=linen_kotor_detail.`epc`
                                LEFT JOIN jenis_barang ON `jenis_barang`.id=barang.`id_jenis`
                                WHERE MONTH(tanggal)=MONTH(CURDATE()) AND YEAR(tanggal)=YEAR(CURDATE()) and kategori='Rewash' and TOTAL_QTY>0")->result();

            $data['total_rewash']= $total_rewash;

            $total_rewash_real = $this->db->query("SELECT ifnull(sum(TOTAL_BERAT_REAL),0) as sum_berat
                                FROM `linen_kotor` 
                                WHERE MONTH(tanggal)=MONTH(CURDATE()) AND YEAR(tanggal)=YEAR(CURDATE()) and kategori='Rewash' and TOTAL_QTY>0")->result();
            $data['total_rewash_real']= $total_rewash_real;

            $data['percentage'] = ($total_rewash[0]->qty > 0 ? ($total_rewash[0]->qty/$total_linen[0]->qty )*100 : 0);
            $data['percentage_berat'] = ($total_rewash_real[0]->sum_berat > 0 ? ($total_rewash_real[0]->sum_berat/$total_linen[0]->berat )*100 : 0);
            
            
            // print("<pre>".print_r($data,true)."</pre>");exit();
            $data['modal'] = 'modal/dashboard';
			$this->load->view('dashboard',$data,FALSE); 

        }else{

            redirect("login");

        }				  			
	}

    public function notifikasi($id){
        $this->db->from('tb_notifikasi');
        $this->db->where('read',0);
        $query = $this->db->where('sent_to', $id)->get();
        $data['notifikasi'] = $query->result();
        $data['notifikasi_count'] = $query->num_rows();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

	public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
	
}
