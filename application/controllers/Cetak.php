<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cetak extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('admin');
	   	$this->load->model('M_menu','',TRUE);
	   	
	}
	public function index()
	{		
		if($this->admin->logged_id())
	    {
			$data['title'] = 'Laporan';
			$data['main'] = 'laporan/index';
			$data['js'] = 'script/laporan';
			$data['ruangan'] = $this->admin->getmaster('tb_ruangan');
			$bln = date('m');
			$thn = date('Y');
			$page=$this->input->get("p", TRUE);

			if(!empty($this->input->get("b", TRUE))){
				$bln=$this->input->get("b", TRUE);
				$thn=$this->input->get("t", TRUE);
			}
			$data['page'] = $page;

			$arr = array();
			$arr_sum = array();

			if ($page == 'medis'){	
				$laporan_medis  = $this->db->query("SELECT jenis_barang.jenis,
														DAY(tanggal)tgl,COUNT(epc) total 
													FROM `linen_kotor` 
													LEFT JOIN `linen_kotor_detail` ON `linen_kotor_detail`.`no_transaksi`=`linen_kotor`.`NO_TRANSAKSI` 
													LEFT JOIN  barang ON barang.`serial`=linen_kotor_detail.`epc`
													LEFT JOIN jenis_barang ON `jenis_barang`.id=barang.`id_jenis`
													WHERE fmedis='Medis' and 
													MONTH(tanggal)='". $bln."' AND YEAR(tanggal)=".$thn." 
													GROUP BY jenis_barang.jenis,tanggal
													HAVING COUNT(epc) >0
													ORDER BY tanggal,`jenis_barang`.`jenis`")->result();
				foreach ($laporan_medis as $key => $value) {
					$total = 0;
					$sum = 0;
					if(!empty($arr[$value->jenis][$value->tgl])){
						$total = $arr[$value->jenis][$value->tgl];
					}
					if(!empty($arr_sum[$value->tgl])){
						$sum = $arr_sum[$value->tgl];
					}
					$arr[$value->jenis][$value->tgl] = $total + $value->total ;
					$arr_sum[$value->tgl] = $sum + $value->total ;
				}
				$data['laporan_medis']= $arr;
				$data['laporan_medis_sum']= $arr_sum;
				$this->load->view('cetak',$data,FALSE); 
			}elseif ($page == 'rawat_infeksius_kg') {
				$laporan_rawat_inf  = $this->db->query("SELECT `tb_ruangan`.`ruangan`,finfeksius,DAY(tanggal)tgl,epc ,berat as total
								FROM `linen_kotor` 
								LEFT JOIN `linen_kotor_detail` ON `linen_kotor_detail`.`no_transaksi`=`linen_kotor`.`NO_TRANSAKSI` 
								LEFT JOIN  tb_ruangan ON tb_ruangan.ruangan=linen_kotor_detail.`ruangan`
								LEFT JOIN  barang ON barang.`serial`=linen_kotor_detail.`epc`
								LEFT JOIN jenis_barang ON `jenis_barang`.id=barang.`id_jenis`
	                            WHERE MONTH(tanggal)='".$bln ."' AND YEAR(tanggal)=".$thn ." AND finfeksius='Infeksius'
	                            ORDER BY tanggal,`tb_ruangan`.`ruangan`")->result();
				foreach ($laporan_rawat_inf as $key => $value) {
					$total = 0;
					$sum = 0;
					if(!empty($arr[$value->ruangan][$value->tgl])){
						$total = $arr[$value->ruangan][$value->tgl];
					}
					if(!empty($arr_sum[$value->tgl])){
						$sum = $arr_sum[$value->tgl];
					}
					$arr[$value->ruangan][$value->tgl] = $total + $value->total ;
					$arr_sum[$value->tgl] = $sum + $value->total ;
				}
				$data['laporan_rawat_inf']= $arr;
				$data['laporan_rawat_inf_sum']= $arr_sum;
				$this->load->view('cetak',$data,FALSE); 
			}elseif ($page == 'rawat_non_infeksius_kg') {
				$laporan_rawat_inf  = $this->db->query("SELECT `tb_ruangan`.`ruangan`,finfeksius,DAY(tanggal)tgl,epc ,berat as total
								FROM `linen_kotor` 
								LEFT JOIN `linen_kotor_detail` ON `linen_kotor_detail`.`no_transaksi`=`linen_kotor`.`NO_TRANSAKSI` 
								LEFT JOIN  tb_ruangan ON tb_ruangan.ruangan=linen_kotor_detail.`ruangan`
								LEFT JOIN  barang ON barang.`serial`=linen_kotor_detail.`epc`
								LEFT JOIN jenis_barang ON `jenis_barang`.id=barang.`id_jenis`
	                            WHERE MONTH(tanggal)='".$bln ."' AND YEAR(tanggal)=".$thn ." AND finfeksius='Non Infeksius'
	                            ORDER BY tanggal,`tb_ruangan`.`ruangan`")->result();
				foreach ($laporan_rawat_inf as $key => $value) {
					$total = 0;
					$sum = 0;
					if(!empty($arr[$value->ruangan][$value->tgl])){
						$total = $arr[$value->ruangan][$value->tgl];
					}
					if(!empty($arr_sum[$value->tgl])){
						$sum = $arr_sum[$value->tgl];
					}
					$arr[$value->ruangan][$value->tgl] = $total + $value->total ;
					$arr_sum[$value->tgl] = $sum + $value->total ;
				}
				$data['laporan_non_rawat_inf']= $arr;
				$data['laporan_non_rawat_inf_sum']= $arr_sum;
				$this->load->view('cetak',$data,FALSE); 
			}elseif ($page == 'rawat_infeksius_lb') {
				$laporan_rawat_inf  = $this->db->query("SELECT `tb_ruangan`.`ruangan`,finfeksius,DAY(tanggal)tgl,epc ,jenis,berat,fmedis
									FROM `linen_kotor` 
									LEFT JOIN `linen_kotor_detail` ON `linen_kotor_detail`.`no_transaksi`=`linen_kotor`.`NO_TRANSAKSI` 
									LEFT JOIN  tb_ruangan ON tb_ruangan.ruangan=linen_kotor_detail.`ruangan`
									LEFT JOIN  barang ON barang.`serial`=linen_kotor_detail.`epc`
									LEFT JOIN jenis_barang ON `jenis_barang`.id=barang.`id_jenis`
									WHERE MONTH(tanggal)='".$bln ."' AND YEAR(tanggal)=".$thn ." AND finfeksius='Infeksius'
									ORDER BY tanggal,jenis;")->result();
				foreach ($laporan_rawat_inf as $key => $value) {
					$total = 0;
					$sum = 0;
					if(!empty($arr[$value->jenis][$value->tgl])){
						$total = $arr[$value->jenis][$value->tgl];
					}
					if(!empty($arr_sum[$value->tgl])){
						$sum = $arr_sum[$value->tgl];
					}
					$arr[$value->jenis][$value->tgl] = $total + 1 ;
					$arr_sum[$value->tgl] = $sum + 1 ;
				}
				$data['laporan_rawat_inf_2']= $arr;
				$data['laporan_rawat_inf_sum_2']= $arr_sum;
				$this->load->view('cetak',$data,FALSE); 
			}elseif ($page == 'rawat_non_infeksius_lb') {
				$laporan_rawat_non_inf  = $this->db->query("SELECT `tb_ruangan`.`ruangan`,finfeksius,DAY(tanggal)tgl,epc ,jenis,berat,fmedis
									FROM `linen_kotor` 
									LEFT JOIN `linen_kotor_detail` ON `linen_kotor_detail`.`no_transaksi`=`linen_kotor`.`NO_TRANSAKSI` 
									LEFT JOIN  tb_ruangan ON tb_ruangan.ruangan=linen_kotor_detail.`ruangan`
									LEFT JOIN  barang ON barang.`serial`=linen_kotor_detail.`epc`
									LEFT JOIN jenis_barang ON `jenis_barang`.id=barang.`id_jenis`
									WHERE MONTH(tanggal)='".$bln ."' AND YEAR(tanggal)=".$thn ." AND finfeksius='Non Infeksius'
									ORDER BY tanggal,jenis;")->result();
				foreach ($laporan_rawat_non_inf as $key => $value) {
					$total = 0;
					$sum = 0;
					if(!empty($arr[$value->jenis][$value->tgl])){
						$total = $arr[$value->jenis][$value->tgl];
					}
					if(!empty($arr_sum[$value->tgl])){
						$sum = $arr_sum[$value->tgl];
					}
					$arr[$value->jenis][$value->tgl] = $total +1;
					$arr_sum[$value->tgl] = $sum + 1 ;
				}
				$data['laporan_rawat_non_inf_2']= $arr;
				$data['laporan_rawat_non_inf_sum_2']= $arr_sum;
				$this->load->view('cetak',$data,FALSE); 
			}elseif($page == 'keluar'){
				$this->load->view('cetak_thermal',$data,FALSE); 
			}

			// print("<pre>".print_r($data,true)."</pre>"); exit();	

	    }else{
	        redirect("login");

	    }				  
						
	}

}
