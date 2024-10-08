<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Laporan extends CI_Controller
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
			$data['title'] = 'Laporan';
			$data['main'] = 'laporan/index';
			$data['js'] = 'script/laporan';
			$data['ruangan'] = $this->admin->getmaster('tb_ruangan');
			$bln = date('m');
			$thn = date('Y');

			if (!empty($this->input->get("b", TRUE))) {
				$bln = $this->input->get("b", TRUE);
				$thn = $this->input->get("t", TRUE);
			}

			// Laporan Medis
			$arr = array();
			$arr_sum = array();
			$laporan_medis  = $this->db->query("SELECT jenis_barang.jenis,
													DAY(tanggal)tgl,COUNT(epc) total 
												FROM `linen_kotor` 
												LEFT JOIN `linen_kotor_detail` ON `linen_kotor_detail`.`no_transaksi`=`linen_kotor`.`NO_TRANSAKSI` 
												LEFT JOIN  barang ON barang.`serial`=linen_kotor_detail.`epc`
												LEFT JOIN jenis_barang ON `jenis_barang`.id=barang.`id_jenis`
												WHERE fmedis='Medis' and 
												MONTH(tanggal)='" . $bln . "' AND YEAR(tanggal)=" . $thn . " 
												GROUP BY jenis_barang.jenis,tanggal
												HAVING COUNT(epc) >0
												ORDER BY tanggal,`jenis_barang`.`jenis`")->result();
			foreach ($laporan_medis as $key => $value) {
				$total = 0;
				$sum = 0;
				if (!empty($arr[$value->jenis][$value->tgl])) {
					$total = $arr[$value->jenis][$value->tgl];
				}
				if (!empty($arr_sum[$value->tgl])) {
					$sum = $arr_sum[$value->tgl];
				}
				$arr[$value->jenis][$value->tgl] = $total + $value->total;
				$arr_sum[$value->tgl] = $sum + $value->total;
			}
			$data['laporan_medis'] = $arr;
			$data['laporan_medis_sum'] = $arr_sum;

			// Laporan Non Medis
			$arr = array();
			$arr_sum = array();
			$laporan_non_medis  = $this->db->query("SELECT jenis_barang.jenis,
													DAY(tanggal)tgl,COUNT(epc) total 
												FROM `linen_kotor` 
												LEFT JOIN `linen_kotor_detail` ON `linen_kotor_detail`.`no_transaksi`=`linen_kotor`.`NO_TRANSAKSI` 
												LEFT JOIN  barang ON barang.`serial`=linen_kotor_detail.`epc`
												LEFT JOIN jenis_barang ON `jenis_barang`.id=barang.`id_jenis`
												WHERE fmedis='Non Medis' and 
												MONTH(tanggal)='" . $bln . "' AND YEAR(tanggal)=" . $thn . " 
												GROUP BY jenis_barang.jenis,tanggal
												HAVING COUNT(epc) >0
												ORDER BY tanggal,`jenis_barang`.`jenis`")->result();
			foreach ($laporan_non_medis as $key => $value) {
				$total = 0;
				$sum = 0;
				if (!empty($arr[$value->jenis][$value->tgl])) {
					$total = $arr[$value->jenis][$value->tgl];
				}
				if (!empty($arr_sum[$value->tgl])) {
					$sum = $arr_sum[$value->tgl];
				}
				$arr[$value->jenis][$value->tgl] = $total + $value->total;
				$arr_sum[$value->tgl] = $sum + $value->total;
			}
			$data['laporan_non_medis'] = $arr;
			$data['laporan_non_medis_sum'] = $arr_sum;

			// Laporan Infeksius
			$arr = array();
			$arr_sum = array();
			$laporan_rawat_inf  = $this->db->query("SELECT `tb_ruangan`.`ruangan`,F_INFEKSIUS as finfeksius,DAY(tanggal)tgl,epc ,berat as total
							FROM `linen_kotor` 
							LEFT JOIN `linen_kotor_detail` ON `linen_kotor_detail`.`no_transaksi`=`linen_kotor`.`NO_TRANSAKSI` 
							LEFT JOIN  tb_ruangan ON tb_ruangan.ruangan=linen_kotor_detail.`ruangan`
							LEFT JOIN  barang ON barang.`serial`=linen_kotor_detail.`epc`
							LEFT JOIN jenis_barang ON `jenis_barang`.id=barang.`id_jenis`
                            WHERE MONTH(tanggal)='" . $bln . "' AND YEAR(tanggal)=" . $thn . " AND F_INFEKSIUS='Infeksius'
                            ORDER BY tanggal,`tb_ruangan`.`ruangan`")->result();
			foreach ($laporan_rawat_inf as $key => $value) {
				$total = 0;
				$sum = 0;
				if (!empty($arr[$value->ruangan][$value->tgl])) {
					$total = $arr[$value->ruangan][$value->tgl];
				}
				if (!empty($arr_sum[$value->tgl])) {
					$sum = $arr_sum[$value->tgl];
				}
				$arr[$value->ruangan][$value->tgl] = $total + $value->total;
				$arr_sum[$value->tgl] = $sum + $value->total;
			}
			$data['laporan_rawat_inf'] = $arr;
			$data['laporan_rawat_inf_sum'] = $arr_sum;

			// Laporan Non Infeksius
			$arr = array();
			$arr_sum = array();
			$laporan_rawat_non_inf  = $this->db->query("SELECT `tb_ruangan`.`ruangan`,F_INFEKSIUS as finfeksius,DAY(tanggal)tgl,epc ,berat as total
							FROM `linen_kotor` 
							LEFT JOIN `linen_kotor_detail` ON `linen_kotor_detail`.`no_transaksi`=`linen_kotor`.`NO_TRANSAKSI` 
							LEFT JOIN  tb_ruangan ON tb_ruangan.ruangan=linen_kotor_detail.`ruangan`
							LEFT JOIN  barang ON barang.`serial`=linen_kotor_detail.`epc`
							LEFT JOIN jenis_barang ON `jenis_barang`.id=barang.`id_jenis`
                            WHERE MONTH(tanggal)='" . $bln . "' AND YEAR(tanggal)=" . $thn . " AND F_INFEKSIUS='Non Infeksius'
                            ORDER BY tanggal,`tb_ruangan`.`ruangan`")->result();
			foreach ($laporan_rawat_non_inf as $key => $value) {
				$total = 0;
				$sum = 0;
				if (!empty($arr[$value->ruangan][$value->tgl])) {
					$total = $arr[$value->ruangan][$value->tgl];
				}
				if (!empty($arr_sum[$value->tgl])) {
					$sum = $arr_sum[$value->tgl];
				}
				$arr[$value->ruangan][$value->tgl] = $total + $value->total;
				$arr_sum[$value->tgl] = $sum + $value->total;
			}
			$data['laporan_rawat_non_inf'] = $arr;
			$data['laporan_rawat_non_inf_sum'] = $arr_sum;

			// Laporan Infeksius 2
			$arr = array();
			$arr_sum = array();
			$laporan_rawat_inf  = $this->db->query("SELECT `tb_ruangan`.`ruangan`,F_INFEKSIUS as finfeksius,DAY(tanggal)tgl,epc ,jenis,berat,fmedis
									FROM `linen_kotor` 
									LEFT JOIN `linen_kotor_detail` ON `linen_kotor_detail`.`no_transaksi`=`linen_kotor`.`NO_TRANSAKSI` 
									LEFT JOIN  tb_ruangan ON tb_ruangan.ruangan=linen_kotor_detail.`ruangan`
									LEFT JOIN  barang ON barang.`serial`=linen_kotor_detail.`epc`
									LEFT JOIN jenis_barang ON `jenis_barang`.id=barang.`id_jenis`
									WHERE MONTH(tanggal)='" . $bln . "' AND YEAR(tanggal)=" . $thn . " AND F_INFEKSIUS='Infeksius'
									ORDER BY tanggal,jenis;")->result();
			foreach ($laporan_rawat_inf as $key => $value) {
				$total = 0;
				$sum = 0;
				if (!empty($arr[$value->jenis][$value->tgl])) {
					$total = $arr[$value->jenis][$value->tgl];
				}
				if (!empty($arr_sum[$value->tgl])) {
					$sum = $arr_sum[$value->tgl];
				}
				$arr[$value->jenis][$value->tgl] = $total + 1;
				$arr_sum[$value->tgl] = $sum + 1;
			}
			$data['laporan_rawat_inf_2'] = $arr;
			$data['laporan_rawat_inf_sum_2'] = $arr_sum;

			// Laporan Non Infeksius 2
			$arr = array();
			$arr_sum = array();
			$laporan_rawat_non_inf  = $this->db->query("SELECT `tb_ruangan`.`ruangan`,F_INFEKSIUS as finfeksius,DAY(tanggal)tgl,epc ,jenis,berat,fmedis
									FROM `linen_kotor` 
									LEFT JOIN `linen_kotor_detail` ON `linen_kotor_detail`.`no_transaksi`=`linen_kotor`.`NO_TRANSAKSI` 
									LEFT JOIN  tb_ruangan ON tb_ruangan.ruangan=linen_kotor_detail.`ruangan`
									LEFT JOIN  barang ON barang.`serial`=linen_kotor_detail.`epc`
									LEFT JOIN jenis_barang ON `jenis_barang`.id=barang.`id_jenis`
									WHERE MONTH(tanggal)='" . $bln . "' AND YEAR(tanggal)=" . $thn . " AND F_INFEKSIUS='Non Infeksius'
									ORDER BY tanggal,jenis;")->result();
			foreach ($laporan_rawat_non_inf as $key => $value) {
				$total = 0;
				$sum = 0;
				if (!empty($arr[$value->jenis][$value->tgl])) {
					$total = $arr[$value->jenis][$value->tgl];
				}
				if (!empty($arr_sum[$value->tgl])) {
					$sum = $arr_sum[$value->tgl];
				}
				$arr[$value->jenis][$value->tgl] = $total + 1;
				$arr_sum[$value->tgl] = $sum + 1;
			}
			$data['laporan_rawat_non_inf_2'] = $arr;
			$data['laporan_rawat_non_inf_sum_2'] = $arr_sum;

			// Laporan Rewash
			$arr = array();
			$arr_sum = array();
			$laporan_rawat_rewash  = $this->db->query("SELECT `tb_ruangan`.`ruangan`,F_INFEKSIUS,DAY(tanggal)tgl,epc ,jenis,berat,fmedis
									FROM `linen_kotor` 
									LEFT JOIN `linen_kotor_detail` ON `linen_kotor_detail`.`no_transaksi`=`linen_kotor`.`NO_TRANSAKSI` 
									LEFT JOIN  tb_ruangan ON tb_ruangan.ruangan=linen_kotor_detail.`ruangan`
									LEFT JOIN  barang ON barang.`serial`=linen_kotor_detail.`epc`
									LEFT JOIN jenis_barang ON `jenis_barang`.id=barang.`id_jenis`
									WHERE MONTH(tanggal)='" . $bln . "' AND YEAR(tanggal)=" . $thn . " AND kategori='Rewash'
									ORDER BY tanggal,jenis;")->result();
			foreach ($laporan_rawat_rewash as $key => $value) {
				$total = 0;
				$sum = 0;
				if (!empty($arr[$value->ruangan][$value->tgl])) {
					$total = $arr[$value->ruangan][$value->tgl];
				}
				if (!empty($arr_sum[$value->tgl])) {
					$sum = $arr_sum[$value->tgl];
				}
				$arr[$value->ruangan][$value->tgl] = $total + 1;
				$arr_sum[$value->tgl] = $sum + 1;
			}
			$data['laporan_rawat_rewash'] = $arr;
			$data['laporan_rawat_rewash_sum'] = $arr_sum;

			// Laporan Linen Kotor
			$arr = array();
			$arr_sum = array();
			$laporan_kotor  = $this->db->query("
				SELECT A.NO_TRANSAKSI,A.TANGGAL,A.PIC, case when A.STATUS = 'BERSIH' then 'DONE' else 'PENDING' end as status_name,
					`tb_ruangan`.`ruangan`,F_INFEKSIUS ,jenis,fmedis,jenis_barang.spesifikasi , count(B.epc) as jml,sum(jenis_barang.berat) as total_berat
				FROM `linen_kotor` A
				INNER JOIN `linen_kotor_detail` B ON B.`no_transaksi`=A.`NO_TRANSAKSI` 
				LEFT JOIN  tb_ruangan ON tb_ruangan.ruangan=B.`ruangan`
				LEFT JOIN  barang ON barang.`serial`=B.`epc`
				LEFT JOIN jenis_barang ON `jenis_barang`.id=barang.`id_jenis`
				WHERE MONTH(tanggal)='" . $bln . "' AND YEAR(tanggal)=" . $thn . " 
				group by A.NO_TRANSAKSI,A.TANGGAL,A.PIC,A.STATUS,`tb_ruangan`.`ruangan`
				ORDER BY tanggal,NO_TRANSAKSI,jenis;
			")->result();
			foreach ($laporan_kotor as $key => $value) {
				$total = 0;
				$sum = 0;
				if (!empty($arr[$value->ruangan][$value->TANGGAL])) {
					$total = $arr[$value->ruangan][$value->TANGGAL];
				}
				if (!empty($arr_sum[$value->TANGGAL])) {
					$sum = $arr_sum[$value->TANGGAL];
				}
				$arr[$value->ruangan][$value->TANGGAL] = $total + 1;
				$arr_sum[$value->TANGGAL] = $sum + 1;
			}
			$data['laporan_kotor'] = $laporan_kotor;
			$data['laporan_kotor_sum'] = $arr_sum;

			$total_linen = $this->db->query("SELECT count(*) as qty,ifnull(sum(berat),0)  as berat
                                FROM `linen_kotor` 
                                LEFT JOIN `linen_kotor_detail` ON `linen_kotor_detail`.`no_transaksi`=`linen_kotor`.`NO_TRANSAKSI` 
                                LEFT JOIN  barang ON barang.`serial`=linen_kotor_detail.`epc`
                                LEFT JOIN jenis_barang ON `jenis_barang`.id=barang.`id_jenis`
                                WHERE MONTH(tanggal)=MONTH(CURDATE()) AND YEAR(tanggal)=YEAR(CURDATE()) and TOTAL_QTY>0")->result();
			$total_linen_real = $this->db->query("SELECT ifnull(sum(TOTAL_BERAT_REAL),0) as berat
                                FROM `linen_kotor` 
                                WHERE MONTH(tanggal)=MONTH(CURDATE()) AND YEAR(tanggal)=YEAR(CURDATE()) and TOTAL_QTY>0")->result();
			$data['total_linen_all'] = $total_linen;
			$data['total_linen_real'] = $total_linen_real;

			$total_rewash = $this->db->query("SELECT count(*) as qty, ifnull(sum(berat),0) as sum_berat
                                FROM `linen_kotor` 
                                LEFT JOIN `linen_kotor_detail` ON `linen_kotor_detail`.`no_transaksi`=`linen_kotor`.`NO_TRANSAKSI` 
                                LEFT JOIN  barang ON barang.`serial`=linen_kotor_detail.`epc`
                                LEFT JOIN jenis_barang ON `jenis_barang`.id=barang.`id_jenis`
                                WHERE MONTH(tanggal)=MONTH(CURDATE()) AND YEAR(tanggal)=YEAR(CURDATE()) and kategori='Rewash' and TOTAL_QTY>0")->result();

			$data['total_rewash'] = $total_rewash;

			$total_rewash_real = $this->db->query("SELECT ifnull(sum(TOTAL_BERAT_REAL),0) as sum_berat
                                FROM `linen_kotor` 
                                WHERE MONTH(tanggal)=MONTH(CURDATE()) AND YEAR(tanggal)=YEAR(CURDATE()) and kategori='Rewash' and TOTAL_QTY>0")->result();
			$data['total_rewash_real'] = $total_rewash_real;

			$data['percentage'] = ($total_rewash[0]->qty > 0 ? ($total_rewash[0]->qty / $total_linen[0]->qty) * 100 : 0);
			$data['percentage_berat'] = ($total_rewash_real[0]->sum_berat > 0 ? ($total_rewash_real[0]->sum_berat / $total_linen[0]->berat) * 100 : 0);
			//print("<pre>" . print_r($data, true) . "</pre>");exit();


			$this->load->view('dashboard', $data, FALSE);
		} else {
			redirect("login");
		}
	}
	public function pembelian()
	{
		if ($this->admin->logged_id()) {
			$data['title'] = 'Laporan Pembelian';
			$data['main'] = 'laporan/penerimaan';
			$data['js'] = 'script/laporan';
			$data['ruangan'] = $this->admin->getmaster('tb_ruangan');
			$bln = date('m');
			$thn = date('Y');

			if (!empty($this->input->get("b", TRUE))) {
				$bln = $this->input->get("b", TRUE);
				$thn = $this->input->get("t", TRUE);
			}

			$arr = array();
			$arr_sum = array();
			$laporan_medis  = $this->db->query("SELECT jenis_barang.jenis,
					DAY(tb_penerimaan.current_insert)tgl,SUM(qty) total 
				FROM `tb_penerimaan` 
				LEFT JOIN `tb_penerimaan_detail` ON `tb_penerimaan_detail`.`no_penerimaan`=`tb_penerimaan`.`no_penerimaan` 
				LEFT JOIN jenis_barang ON `jenis_barang`.jenis=tb_penerimaan_detail.`jenis`
				WHERE 
				MONTH(tb_penerimaan.current_insert)='" . $bln . "' AND YEAR(tb_penerimaan.current_insert)='" . $thn . "'
				GROUP BY jenis_barang.jenis,DATE(tb_penerimaan.current_insert)
				ORDER BY DAY(tb_penerimaan.current_insert),jenis_barang.jenis")->result();
			foreach ($laporan_medis as $key => $value) {
				$total = 0;
				$sum = 0;
				if (!empty($arr[$value->jenis][$value->tgl])) {
					$total = $arr[$value->jenis][$value->tgl];
				}
				if (!empty($arr_sum[$value->tgl])) {
					$sum = $arr_sum[$value->tgl];
				}
				$arr[$value->jenis][$value->tgl] = $total + $value->total;
				$arr_sum[$value->tgl] = $sum + $value->total;
			}
			$data['laporan_medis'] = $arr;
			$data['laporan_medis_sum'] = $arr_sum;

			$arr_beli = array();
			$arr_beli_sum = array();
			$laporan_vendor  = $this->db->query("SELECT vendor_name,
					DAY(tb_penerimaan.current_insert)tgl,SUM(qty) total 
				FROM `tb_penerimaan` 
				LEFT JOIN `tb_penerimaan_detail` ON `tb_penerimaan_detail`.`no_penerimaan`=`tb_penerimaan`.`no_penerimaan` 
				LEFT JOIN tb_vendor ON `tb_vendor`.vendor_code=tb_penerimaan.`vendor_code`
				WHERE 
				MONTH(tb_penerimaan.current_insert)='" . $bln . "' AND YEAR(tb_penerimaan.current_insert)='" . $thn . "'
				GROUP BY vendor_name,DATE(tb_penerimaan.current_insert)
				ORDER BY DAY(tb_penerimaan.current_insert),vendor_name")->result();
			foreach ($laporan_vendor as $key => $value) {
				$total = 0;
				$sum = 0;
				if (!empty($arr[$value->vendor_name][$value->tgl])) {
					$total = $arr[$value->vendor_name][$value->tgl];
				}
				if (!empty($arr_beli_sum[$value->tgl])) {
					$sum = $arr_beli_sum[$value->tgl];
				}
				$arr_beli[$value->vendor_name][$value->tgl] = $total + $value->total;
				$arr_beli_sum[$value->tgl] = $sum + $value->total;
			}
			$data['laporan_vendor'] = $arr_beli;
			$data['laporan_vendor_sum'] = $arr_beli_sum;

			$this->load->view('dashboard', $data, FALSE);
		} else {
			redirect("login");
		}
	}

	public function storage()
	{
		if ($this->admin->logged_id()) {
			$data['title'] = 'Laporan Penyimpanan Linen';
			$data['main'] = 'laporan/storage';
			$data['js'] = 'script/laporan';

			$laporan_storage  = $this->db->query("select id, jenis, spesifikasi, count(id) jml from (
					select * from (
						SELECT linen_bersih_detail.epc ,jenis_barang.id , jenis_barang.`jenis`, `spesifikasi`, berat
						FROM linen_bersih_detail 
						INNER JOIN barang ON barang.`serial`=linen_bersih_detail.`epc`
						LEFT JOIN jenis_barang ON `jenis_barang`.id=barang.`id_jenis`
						WHERE status_linen <>'RUSAK' AND keluar=0
						UNION
						SELECT barang.`serial` AS epc ,jenis_barang.id , jenis_barang.`jenis`, `spesifikasi`, berat 
						FROM barang 
						LEFT JOIN linen_kotor_detail lkd ON lkd.`epc`=barang.`serial`
						LEFT JOIN jenis_barang ON `jenis_barang`.id=barang.`id_jenis`
						WHERE lkd.epc IS null
					) tgl_serial where epc not in (select epc from linen_rusak_detail lrd)
				) tbl_storage group by id, jenis, spesifikasi")->result();

			$data['laporan_storage'] = $laporan_storage;

			$this->load->view('dashboard', $data, FALSE);
		} else {
			redirect("login");
		}
	}

	public function rusak()
	{
		if ($this->admin->logged_id()) {
			$data['title'] = 'Laporan Linen Rusak';
			$data['main'] = 'laporan/rusak';
			$data['js'] = 'script/laporan';

			$laporan_rusak  = $this->db->query("select TANGGAL,DEFECT,jenis, spesifikasi, count(id) jml from (
									SELECT lr.TANGGAL ,lrd.epc ,lr.DEFECT ,jenis_barang.id , jenis_barang.`jenis`, `spesifikasi`, berat, lrd.jml_cuci 
									FROM linen_rusak lr 
									inner join linen_rusak_detail lrd on lrd.no_transaksi = lr.NO_TRANSAKSI 
									INNER JOIN barang ON barang.`serial`=lrd.`epc`
									LEFT JOIN jenis_barang ON `jenis_barang`.id=barang.`id_jenis`
									) tbl_rusak
								group by TANGGAL,DEFECT, jenis, spesifikasi")->result();

			$data['laporan_rusak'] = $laporan_rusak;

			$this->load->view('dashboard', $data, FALSE);
		} else {
			redirect("login");
		}
	}
}
