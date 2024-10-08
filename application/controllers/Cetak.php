<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Cetak extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin');
		$this->load->model('M_menu', '', TRUE);
	}
	public function index()
	{
		$page = $this->input->get("p", TRUE);
		$data['setup'] = $this->admin->getmaster('tb_setting');
		if ($page == 'sticker') {
			$data['title'] = 'Laporan';
			$this->load->view('cetak_sticker', $data, FALSE);
		} else {
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
				$data['page'] = $page;

				$arr = array();
				$arr_sum = array();

				if ($page == 'medis') {
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
					$this->load->view('cetak', $data, FALSE);
				} elseif ($page == 'nonmedis') {
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
					$this->load->view('cetak', $data, FALSE);
				} elseif ($page == 'rawat_infeksius_kg') {
					$laporan_rawat_inf  = $this->db->query("SELECT `tb_ruangan`.`ruangan`,finfeksius,DAY(tanggal)tgl,epc ,berat as total
									FROM `linen_kotor` 
									LEFT JOIN `linen_kotor_detail` ON `linen_kotor_detail`.`no_transaksi`=`linen_kotor`.`NO_TRANSAKSI` 
									LEFT JOIN  tb_ruangan ON tb_ruangan.ruangan=linen_kotor_detail.`ruangan`
									LEFT JOIN  barang ON barang.`serial`=linen_kotor_detail.`epc`
									LEFT JOIN jenis_barang ON `jenis_barang`.id=barang.`id_jenis`
		                            WHERE MONTH(tanggal)='" . $bln . "' AND YEAR(tanggal)=" . $thn . " AND finfeksius='Infeksius'
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
					$this->load->view('cetak', $data, FALSE);
				} elseif ($page == 'rawat_non_infeksius_kg') {
					$laporan_rawat_inf  = $this->db->query("SELECT `tb_ruangan`.`ruangan`,finfeksius,DAY(tanggal)tgl,epc ,berat as total
									FROM `linen_kotor` 
									LEFT JOIN `linen_kotor_detail` ON `linen_kotor_detail`.`no_transaksi`=`linen_kotor`.`NO_TRANSAKSI` 
									LEFT JOIN  tb_ruangan ON tb_ruangan.ruangan=linen_kotor_detail.`ruangan`
									LEFT JOIN  barang ON barang.`serial`=linen_kotor_detail.`epc`
									LEFT JOIN jenis_barang ON `jenis_barang`.id=barang.`id_jenis`
		                            WHERE MONTH(tanggal)='" . $bln . "' AND YEAR(tanggal)=" . $thn . " AND finfeksius='Non Infeksius'
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
					$data['laporan_non_rawat_inf'] = $arr;
					$data['laporan_non_rawat_inf_sum'] = $arr_sum;
					$this->load->view('cetak', $data, FALSE);
				} elseif ($page == 'rawat_infeksius_lb') {
					$laporan_rawat_inf  = $this->db->query("SELECT `tb_ruangan`.`ruangan`,finfeksius,DAY(tanggal)tgl,epc ,jenis,berat,fmedis
										FROM `linen_kotor` 
										LEFT JOIN `linen_kotor_detail` ON `linen_kotor_detail`.`no_transaksi`=`linen_kotor`.`NO_TRANSAKSI` 
										LEFT JOIN  tb_ruangan ON tb_ruangan.ruangan=linen_kotor_detail.`ruangan`
										LEFT JOIN  barang ON barang.`serial`=linen_kotor_detail.`epc`
										LEFT JOIN jenis_barang ON `jenis_barang`.id=barang.`id_jenis`
										WHERE MONTH(tanggal)='" . $bln . "' AND YEAR(tanggal)=" . $thn . " AND finfeksius='Infeksius'
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
					$this->load->view('cetak', $data, FALSE);
				} elseif ($page == 'rawat_non_infeksius_lb') {
					$laporan_rawat_non_inf  = $this->db->query("SELECT `tb_ruangan`.`ruangan`,finfeksius,DAY(tanggal)tgl,epc ,jenis,berat,fmedis
										FROM `linen_kotor` 
										LEFT JOIN `linen_kotor_detail` ON `linen_kotor_detail`.`no_transaksi`=`linen_kotor`.`NO_TRANSAKSI` 
										LEFT JOIN  tb_ruangan ON tb_ruangan.ruangan=linen_kotor_detail.`ruangan`
										LEFT JOIN  barang ON barang.`serial`=linen_kotor_detail.`epc`
										LEFT JOIN jenis_barang ON `jenis_barang`.id=barang.`id_jenis`
										WHERE MONTH(tanggal)='" . $bln . "' AND YEAR(tanggal)=" . $thn . " AND finfeksius='Non Infeksius'
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
					$this->load->view('cetak', $data, FALSE);
				} elseif ($page == 'rewash') {
					$laporan_rewash  = $this->db->query("SELECT `tb_ruangan`.`ruangan`,finfeksius,DAY(tanggal)tgl,epc ,jenis,berat,fmedis
										FROM `linen_kotor` 
										LEFT JOIN `linen_kotor_detail` ON `linen_kotor_detail`.`no_transaksi`=`linen_kotor`.`NO_TRANSAKSI` 
										LEFT JOIN  tb_ruangan ON tb_ruangan.ruangan=linen_kotor_detail.`ruangan`
										LEFT JOIN  barang ON barang.`serial`=linen_kotor_detail.`epc`
										LEFT JOIN jenis_barang ON `jenis_barang`.id=barang.`id_jenis`
										WHERE MONTH(tanggal)='" . $bln . "' AND YEAR(tanggal)=" . $thn . " AND kategori='Rewash'
										ORDER BY tanggal,jenis;")->result();
					foreach ($laporan_rewash as $key => $value) {
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
					$data['laporan_rewash'] = $arr;
					$data['laporan_rewash_sum'] = $arr_sum;
					$this->load->view('cetak', $data, FALSE);
				} elseif ($page == 'keluar') {

					$this->load->helper('string');
					$id_encrypted = $this->input->get("id", TRUE);
					$id = base64_decode($id_encrypted);
					$berat = 0;
					$jml = 0;
					$data['keluar'] = $this->admin->get_array('linen_keluar', array('id' => $id));
					$ruangan = $this->admin->get_array('tb_ruangan', array('ruangan' => $data['keluar']['RUANGAN']));
					$data['ruangan'] = strtoupper($ruangan['finfeksius']);
					$data['data_detail_keluar'] = $this->admin->get_result_array('linen_keluar_detail', array('no_transaksi' => $data['keluar']['NO_TRANSAKSI']));
					foreach ($data['data_detail_keluar'] as $key => $value) {
						$jml++;
						$item = $this->admin->get_array('barang', array('serial' => $value['epc']));
						$jenis = $this->admin->get_array('jenis_barang', array('id' => $item['id_jenis']));

						$data['data_detail_keluar'][$key]['jenis'] = $jenis['jenis'];
						$data['data_detail_keluar'][$key]['berat'] = $jenis['berat'];
						$data['data_detail_keluar'][$key]['harga'] = $jenis['harga'];
						$berat += $jenis['berat'];
					}
					$data['berat'] = $berat;
					$data['jml'] = $jml;
					$data['no_transaksi'] = $data['keluar']['NO_TRANSAKSI'];
					$this->load->view('cetak_thermal_revisi', $data, FALSE);
				} elseif ($page == 'kotor') {

					$this->load->helper('string');
					$id_encrypted = $this->input->get("id", TRUE);
					$id = base64_decode($id_encrypted);
					$berat = 0;
					$jml = 0;
					$data['kotor'] = $this->admin->get_array('linen_kotor', array('id' => $id));
					$data['data_detail_kotor'] = $this->admin->get_result_array('linen_kotor_detail', array('no_transaksi' => $data['kotor']['NO_TRANSAKSI']));
					foreach ($data['data_detail_kotor'] as $key => $value) {
						$jml++;
						$item = $this->admin->get_array('barang', array('serial' => $value['epc']));
						$jenis = $this->admin->get_array('jenis_barang', array('id' => $item['id_jenis']));

						$data['data_detail_kotor'][$key]['jenis'] = $jenis['jenis'];
						$data['data_detail_kotor'][$key]['berat'] = $jenis['berat'];
						$data['data_detail_kotor'][$key]['harga'] = $jenis['harga'];
						$berat += $jenis['berat'];
					}
					$data['berat'] = $berat;
					$data['jml'] = $jml;
					$data['no_transaksi'] = $data['kotor']['NO_TRANSAKSI'];
					$this->load->view('cetak_thermal_kotor', $data, FALSE);
				} elseif ($page == 'linenkotor') {
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
					$data['laporan_kotor'] = $laporan_kotor;
					$this->load->view('cetak', $data, FALSE);
				} elseif ($page == 'storage') {
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
					$this->load->view('cetak', $data, FALSE);
				} elseif ($page == 'rusak') {
					$laporan_rusak  = $this->db->query("select TANGGAL,DEFECT,jenis, spesifikasi, count(id) jml from (
									SELECT lr.TANGGAL ,lrd.epc ,lr.DEFECT ,jenis_barang.id , jenis_barang.`jenis`, `spesifikasi`, berat, lrd.jml_cuci 
									FROM linen_rusak lr 
									inner join linen_rusak_detail lrd on lrd.no_transaksi = lr.NO_TRANSAKSI 
									INNER JOIN barang ON barang.`serial`=lrd.`epc`
									LEFT JOIN jenis_barang ON `jenis_barang`.id=barang.`id_jenis`
									) tbl_rusak
								group by TANGGAL,DEFECT, jenis, spesifikasi")->result();
					$data['laporan_rusak'] = $laporan_rusak;
					$this->load->view('cetak', $data, FALSE);
				}

				// print("<pre>".print_r($data,true)."</pre>"); exit();	

			} else {
				redirect("login");
			}
		}
	}
}
