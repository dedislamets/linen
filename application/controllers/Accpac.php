<?php

ini_set('memory_limit','512M'); 
ini_set('sqlsrv.ClientBufferMaxKBSize','524288');
ini_set('pdo_sqlsrv.client_buffer_max_kb_size','524288');

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'third_party/spout-2.7.2/src/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

class Accpac extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('admin');
	   
	}
	public function index()
	{		
		if($this->admin->logged_id()){
        	
            $data['title'] = 'Home';
            $data['main'] = 'pengguna/accpac';
			$data['js'] = 'script/accpac';
			// $data['modal'] = 'modal/pengguna';

			$data['apps'] = $this->admin->getmaster('app_tbl');
			$sql = "select distinct c.campaignid,campaign,c.periodeid,d.awal,d.akhir 
					from paket_parameter pp, campaign c , periode d
					where c.campaignid=pp.campaignid and d.periodeid=c.periodeid and parameterid in (28,36) order by c.periodeid desc";
			$data['campaign'] = $this->db->query($sql)->result();

			$sql = "select IDCUST,NAMECUST from SGTDAT..ARCUS where SWACTV=1 and NAMECUST not like '%DUMMY%' 
					and NAMECUST not like '%PAMERAN%' and NAMECUST not like '%KARYAWAN%'";
			$data['dealer'] = $this->db->query($sql)->result();

			$data['awal'] =  date("Y-m-d", strtotime($data['campaign'][0]->awal));
			$data['akhir'] =  date("Y-m-d", strtotime($data['campaign'][0]->akhir));
			$data['code'] =  $data['dealer'][0]->IDCUST;

			// print("<pre>".print_r($data,true)."</pre>");exit();

			$this->load->view('dashboard',$data,FALSE); 

        }else{

            redirect("login");

        }				  				
	}

	public function dataTable()
	{

	    $draw = intval($this->input->get("draw"));
	    $start = intval($this->input->get("start"));
	    $length = intval($this->input->get("length"));
	    $order = $this->input->get("order");
	    $search= $this->input->get("search");
	    $search = $search['value'];
	    $col = 10;
	    $dir = "";

	    if(!empty($order))
	    {
	        foreach($order as $o)
	        {
	            $col = $o['column'];
	            $dir= $o['dir'];
	        }
	    }

	    if($dir != "asc" && $dir != "desc")
	    {
	        $dir = "desc";
	    }

	    $valid_columns = array(
	       	0=>'ORDDATE',
	        1=>'ORDNUMBER',
	        2=>'INVNUMBER',
	        3=>'QTYSHIPPED',
	        4=>'model',
	    );
	    $valid_sort = array(
	        0=>'ORDDATE',
	        1=>'ORDNUMBER',
	        2=>'INVNUMBER',
	        3=>'QTYSHIPPED',
	        4=>'model',
	    );

	    // $this->db->limit($length,$start);

	    $sql_select = "select * from ( 
					select distinct ROW_NUMBER() OVER (ORDER BY B.linenum ) as row,
						A.CUSTOMER ,AR.NAMECUST,
						SGTDAT.dbo.fnGetAccpacDate(A.ORDDATE) as ORDDATE,A.ORDNUMBER,A.INVNUMBER,convert(float,B.QTYSHIPPED) QTYSHIPPED,
						model";
		$sql ="		from SGTDAT..OEAUDH A
					inner join SGTDAT..OEAUDD B on A.DAYENDNUM = B.DAYENDNUM AND A.ENTRYNUM = B.ENTRYNUM
					inner join SGTDAT..ARCUS AR on AR.IDCUST=A.CUSTOMER 
					inner join mesdb..TBL_ICITEM tbl ON tbl.FMITEMNO=B.ITEM
					where 
					A.CUSTOMER='". $this->input->get('dealer') ."'  and B.TRANSTYPE<>3
					and convert(date,SGTDAT.dbo.fnGetAccpacDate(A.ORDDATE)) between convert(date,'". $this->input->get('awal') ."') and convert(date,'". $this->input->get('akhir') ."') and ";
		$sql .="	( ORDDATE LIKE '%".$this->input->get('search')['value']."%' 
						OR ORDNUMBER LIKE '%".$this->input->get('search')['value']."%' 
						OR INVNUMBER LIKE '%".$this->input->get('search')['value']."%' 
						OR QTYSHIPPED LIKE '%".$this->input->get('search')['value']."%' 
						OR model LIKE '%".$this->input->get('search')['value']."%' )";
		
		// print("<pre>".print_r($valid_columns,true)."</pre>");
		$sql_limit =")temp where  
				row > ". $start ." and row <= ". ($start + $length) ." ORDER BY ". $valid_columns[$this->input->get("order")[0]['column']]."   ". $this->input->get("order")[0]['dir'] ." " ;

		$pengguna = $this->db->query($sql_select . $sql . $sql_limit);
       // echo $this->db->last_query();exit();

	    $data = array();
	    foreach($pengguna->result() as $r)
	    {
	      	$data[] = array( 
	                    $r->ORDDATE,
	                    $r->ORDNUMBER,
	                    $r->INVNUMBER,
	                    $r->model,
	                    $r->QTYSHIPPED,
	               );
	    }
	    $total_pengguna = $this->totalPengguna($search, $valid_columns, $sql);

	    $output = array(
	        "draw" => $draw,
	        "recordsTotal" => $total_pengguna,
	        "recordsFiltered" => $total_pengguna,
	        "data" => $data
	    );
	    echo json_encode($output);
	    exit();
	}
	public function dataRingkas()
	{

	    $draw = intval($this->input->get("draw"));
	    $start = intval($this->input->get("start"));
	    $length = intval($this->input->get("length"));
	    $order = $this->input->get("order");
	    $search= $this->input->get("search");
	    $search = $search['value'];
	    $col = 10;
	    $dir = "";

	    if(!empty($order))
	    {
	        foreach($order as $o)
	        {
	            $col = $o['column'];
	            $dir= $o['dir'];
	        }
	    }

	    if($dir != "asc" && $dir != "desc")
	    {
	        $dir = "desc";
	    }

	    $valid_columns = array(
	        0=>'model',
	       
	    );
	    $valid_sort = array(
	        0=>'model',
	    );

	    // $this->db->limit($length,$start);

	    $sql_select = "select * from ( 
					select distinct ROW_NUMBER() OVER (ORDER BY model) as row,model,convert(float,sum(B.QTYSHIPPED)) qty";
		$sql ="		from SGTDAT..OEAUDH A
					inner join SGTDAT..OEAUDD B on A.DAYENDNUM = B.DAYENDNUM AND A.ENTRYNUM = B.ENTRYNUM
					inner join mesdb..TBL_ICITEM tbl ON tbl.FMITEMNO=B.ITEM
					
					where 
					A.CUSTOMER='". $this->input->get('dealer') ."'  and B.TRANSTYPE<>3
					and convert(date,SGTDAT.dbo.fnGetAccpacDate(A.ORDDATE)) between convert(date,'". $this->input->get('awal') ."') and convert(date,'". $this->input->get('akhir') ."') group by model";
		
		// print("<pre>".print_r($valid_columns,true)."</pre>");
		$sql_limit =")temp where 
				model LIKE '%".$this->input->get('search')['value']."%' and 

				row > ". $start ." and row <= ". ($start + $length) ." ORDER BY ". $valid_columns[$this->input->get("order")[0]['column']]."   ". $this->input->get("order")[0]['dir'] ." " ;

		$pengguna = $this->db->query($sql_select . $sql . $sql_limit);
       // echo $this->db->last_query();exit();

	    $data = array();
	    foreach($pengguna->result() as $r)
	    {
	      	$data[] = array( 
	                    $r->model,
	                    $r->qty,
	               );
	    }
	    $total_pengguna = $this->totalPengguna($search, $valid_columns, $sql);

	    $output = array(
	        "draw" => $draw,
	        "recordsTotal" => $total_pengguna,
	        "recordsFiltered" => $total_pengguna,
	        "data" => $data
	    );
	    echo json_encode($output);
	    exit();
	}

	public function totalPengguna($search, $valid_columns, $sql)
  	{
  		// echo $sql;
      if(!empty($search))
	    {
	        $x=0;
	        foreach($valid_columns as $sterm)
	        {
	            if($x==0)
	            {
	                $this->db->like($sterm,$search);
	            }
	            else
	            {
	                $this->db->or_like($sterm,$search);
	            }
	            $x++;
	        }                 
	    }
      $query = $this->db->query("select COUNT(*) as num" . $sql);
      $result = $query->row();
      if(isset($result)) return $result->num;
      return 0;
  	}

  	public function spout()
  	{
  		$campaign = $this->input->get('campaign',TRUE);

        $sql_select = "select * from ( 
					select distinct ROW_NUMBER() OVER (ORDER BY B.linenum ) as row,
						A.CUSTOMER ,AR.NAMECUST,
						SGTDAT.dbo.fnGetAccpacDate(A.ORDDATE) as ORDDATE,A.ORDNUMBER,A.INVNUMBER,convert(float,B.QTYSHIPPED) QTYSHIPPED,
						model";
		$sql ="		from SGTDAT..OEAUDH A
					inner join SGTDAT..OEAUDD B on A.DAYENDNUM = B.DAYENDNUM AND A.ENTRYNUM = B.ENTRYNUM
					inner join SGTDAT..ARCUS AR on AR.IDCUST=A.CUSTOMER 
					inner join mesdb..TBL_ICITEM tbl ON tbl.FMITEMNO=B.ITEM
					where 
					A.CUSTOMER='". $this->input->get('dealer') ."'  and B.TRANSTYPE<>3
					and convert(date,SGTDAT.dbo.fnGetAccpacDate(A.ORDDATE)) between convert(date,'". $this->input->get('awal') ."') and convert(date,'". $this->input->get('akhir') ."') ";
		
		$sql_limit =")temp";
		$data = $this->db->query($sql_select . $sql . $sql_limit)->result();

        // if(!empty($this->session->userdata('area'))){
        //   $array_area = explode(",", $this->session->userdata('area'));
        //   $new_arr = array_filter(array_map('trim',$array_area),'strlen');
        //   $area = implode(",", $new_arr);
        //   $this->db->where("IDGRP in ('". $area ."')");
        // }


        $writer = WriterFactory::create(Type::XLSX);
 
        $writer->openToBrowser("Data Pencapaian Dealer.xlsx");

        $sheet = $writer->getCurrentSheet();
		    $sheet->setName('Detail');

        $header = [
            'Tanggal',
            'Order ID',
          	'INVNUMBER',
          	'KODE DEALER',
          	'NAMA DEALER',
          	'MODEL',
          	'QTY',
        ];
        $writer->addRow($header);

        $data_excel   = array(); 
        $no     = 1;

        foreach ($data as $key) {
            $anggota = array(
                $key->ORDDATE,
                $key->ORDNUMBER,
                $key->INVNUMBER,
                $key->CUSTOMER,
                $key->NAMECUST,
                $key->model,
                $key->QTYSHIPPED,
            );

            array_push($data_excel, $anggota); 
        }

        $writer->addRows($data_excel); 

        $writer->close();	
  	}
}
