<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dealer extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('admin');
	   
	}
	public function index()
	{		
		if($this->admin->logged_id()){
        	
            $data['title'] = 'Model';
            $data['main'] = 'dealer/index';
			$data['js'] = 'script/dealer';

			$data['apps'] = $this->admin->getmaster('app_tbl');
			$sql = "select distinct c.campaignid,campaign,c.periodeid,d.awal,d.akhir 
					from paket_parameter pp, campaign c , periode d
					where c.campaignid=pp.campaignid and d.periodeid=c.periodeid and parameterid in(28,36) order by c.periodeid desc";
			$data['campaign'] = $this->db->query($sql)->result();

			$data['awal'] =  date("Y-m-d", strtotime($data['campaign'][0]->awal));
			$data['akhir'] =  date("Y-m-d", strtotime($data['campaign'][0]->akhir));

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
	        0=>'paketid',
	        1=>'IDCUST',
	        2=>'NAMECUST',
	    );
	    $valid_columns_2 = array(
	        0=>'PA.paketid',
	        1=>'IDCUST',
	        2=>'NAMECUST',
	    );

	    $sql_select = "select * from ( 
					select distinct ROW_NUMBER() OVER (ORDER BY PA.paketid) as row,PA.paketid,ARCUS.IDCUST,NAMECUST  ";
		$sql ="		from SGTDAT..ARCUS ARCUS
					INNER join paket_area PA on (PA.area=ARCUS.IDCUST or PA.area=ARCUS.IDGRP)
					inner join campaign c on c.campaignid=PA.campaignid 
					where c.campaign='". $this->input->get('campaign') ."'  ";
		$itex="";
		for ($i=0; $i <3 ; $i++) { 
			if($itex == ""){
				if($this->input->get('columns')[$i]['search']['value'] != ""){
					$itex .="and (" . $valid_columns_2[$i] . " like '%".$this->input->get('columns')[$i]['search']['value']."%' ";
				}
				
			}else{
				if($this->input->get('columns')[$i]['search']['value'] != "")
					$itex .="AND " . $valid_columns_2[$i] . " like '%".$this->input->get('columns')[$i]['search']['value']."%' ";
			}
		}

		if($itex !="")
			$itex .=")";
		$sql .=$itex;

		$sql_limit =")temp where row > ". $start ." and row <= ". ($start + $length) ." ORDER BY ". $valid_columns[$this->input->get("order")[0]['column']]."   ". $this->input->get("order")[0]['dir'] ." " ;

		$pengguna = $this->db->query($sql_select . $sql . $sql_limit);
		// echo $this->db->last_query();exit();
	    $data = array();
	    foreach($pengguna->result() as $r)
	    {
	      	$data[] = array( 
	                    $r->paketid,
	                    $r->IDCUST,
	                    $r->NAMECUST,
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

}
