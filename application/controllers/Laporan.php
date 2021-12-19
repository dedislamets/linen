<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Laporan extends CI_Controller {
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

			if(!empty($this->input->get("b", TRUE))){
				$bln=$this->input->get("b", TRUE);
				$thn=$this->input->get("t", TRUE);
			}
			
			$arr = array();
			$arr_sum = array();
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

			
			$arr = array();
			$arr_sum = array();
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

			$arr = array();
			$arr_sum = array();
			$laporan_rawat_non_inf  = $this->db->query("SELECT `tb_ruangan`.`ruangan`,finfeksius,DAY(tanggal)tgl,epc ,berat as total
							FROM `linen_kotor` 
							LEFT JOIN `linen_kotor_detail` ON `linen_kotor_detail`.`no_transaksi`=`linen_kotor`.`NO_TRANSAKSI` 
							LEFT JOIN  tb_ruangan ON tb_ruangan.ruangan=linen_kotor_detail.`ruangan`
							LEFT JOIN  barang ON barang.`serial`=linen_kotor_detail.`epc`
							LEFT JOIN jenis_barang ON `jenis_barang`.id=barang.`id_jenis`
                            WHERE MONTH(tanggal)='".$bln ."' AND YEAR(tanggal)=".$thn ." AND finfeksius='Non Infeksius'
                            ORDER BY tanggal,`tb_ruangan`.`ruangan`")->result();
			foreach ($laporan_rawat_non_inf as $key => $value) {
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
			$data['laporan_rawat_non_inf']= $arr;
			$data['laporan_rawat_non_inf_sum']= $arr_sum;

			$arr = array();
			$arr_sum = array();
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

			$arr = array();
			$arr_sum = array();
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
			
			// print("<pre>".print_r($data,true)."</pre>"); exit();

			$this->load->view('dashboard',$data,FALSE); 

	    }else{
	        redirect("login");

	    }				  
						
	}
	public function penerimaan()
	{		
		if($this->admin->logged_id())
	    {
			$data['title'] = 'Laporan Penerimaan';
			$data['main'] = 'laporan/penerimaan';
			$data['js'] = 'script/laporan';
			$data['ruangan'] = $this->admin->getmaster('tb_ruangan');
			$bln = date('m');
			$thn = date('Y');

			if(!empty($this->input->get("b", TRUE))){
				$bln=$this->input->get("b", TRUE);
				$thn=$this->input->get("t", TRUE);
			}
			
			$arr = array();
			$arr_sum = array();
			$laporan_medis  = $this->db->query("SELECT jenis_barang.jenis,
					DAY(tb_penerimaan.current_insert)tgl,SUM(qty) total 
				FROM `tb_penerimaan` 
				LEFT JOIN `tb_penerimaan_detail` ON `tb_penerimaan_detail`.`no_penerimaan`=`tb_penerimaan`.`no_penerimaan` 
				LEFT JOIN jenis_barang ON `jenis_barang`.jenis=tb_penerimaan_detail.`jenis`
				WHERE 
				MONTH(tb_penerimaan.current_insert)='". $bln ."' AND YEAR(tb_penerimaan.current_insert)='". $thn ."'
				GROUP BY jenis_barang.jenis,DATE(tb_penerimaan.current_insert)
				ORDER BY DAY(tb_penerimaan.current_insert),jenis_barang.jenis")->result();
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

			unset($arr);
			unset($arr_sum);
			$laporan_vendor  = $this->db->query("SELECT vendor_name,
					DAY(tb_penerimaan.current_insert)tgl,SUM(qty) total 
				FROM `tb_penerimaan` 
				LEFT JOIN `tb_penerimaan_detail` ON `tb_penerimaan_detail`.`no_penerimaan`=`tb_penerimaan`.`no_penerimaan` 
				LEFT JOIN tb_vendor ON `tb_vendor`.vendor_code=tb_penerimaan_detail.`vendor`
				WHERE 
				MONTH(tb_penerimaan.current_insert)='". $bln ."' AND YEAR(tb_penerimaan.current_insert)='". $thn ."'
				GROUP BY vendor_name,DATE(tb_penerimaan.current_insert)
				ORDER BY DAY(tb_penerimaan.current_insert),vendor_name")->result();
			foreach ($laporan_vendor as $key => $value) {
				$total = 0;
				$sum = 0;
				if(!empty($arr[$value->vendor_name][$value->tgl])){
					$total = $arr[$value->vendor_name][$value->tgl];
				}
				if(!empty($arr_sum[$value->tgl])){
					$sum = $arr_sum[$value->tgl];
				}
				$arr[$value->vendor_name][$value->tgl] = $total + $value->total ;
				$arr_sum[$value->tgl] = $sum + $value->total ;
			}
			$data['laporan_vendor']= $arr;
			$data['laporan_vendor_sum']= $arr_sum;

			$this->load->view('dashboard',$data,FALSE); 

	    }else{
	        redirect("login");

	    }				  
						
	}

}
