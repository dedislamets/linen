<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('admin');
	   
	}
	public function index()
	{		
		if($this->admin->logged_id()){
        	
            $data['title'] = 'Model';
            $data['main'] = 'model/index';
			$data['js'] = 'script/model';
			// $data['modal'] = 'modal/pengguna';

			$data['apps'] = $this->admin->getmaster('app_tbl');
			$sql = "select distinct c.campaignid,campaign,c.periodeid,d.awal,d.akhir,parameterid 
					from paket_parameter pp, campaign c , periode d
					where c.campaignid=pp.campaignid and d.periodeid=c.periodeid and parameterid in (28,36) order by c.periodeid desc";
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
	        1=>'item',
	        2=>'model',
	    );
	    $valid_sort = array(
	        0=>'paketid',
	        1=>'item',
	        2=>'model',
	    );

	    $sql_select = "select * from ( 
					select ROW_NUMBER() OVER (ORDER BY d.paketid) as row,d.paketid,d.item , e.MODEL,b.nilai_parameter, case when parameterid=28 then 'By Qty' else 'By Amount' end jenis ";
		$sql ="		from paket_parameter b ,campaign c , paket_item d
					left join mesdb..TBL_ICITEM e on e.ITEMNO=d.item
					where c.campaignid=b.campaignid and parameterid in (28,36) and d.paketid=b.paketid and 
					c.campaign='". $this->input->get('campaign') ."' and  
					(
					d.item LIKE '%".$this->input->get('search')['value']."%' 
					OR e.model LIKE '%".$this->input->get('search')['value']."%'
					OR d.paketid LIKE '%".$this->input->get('search')['value']."%' ) " ;
		$sql_limit =")temp where row > ". $start ." and row <= ". ($start + $length) ." ORDER BY ". $valid_columns[$this->input->get("order")[0]['column']]."   ". $this->input->get("order")[0]['dir'] ." " ;

		$pengguna = $this->db->query($sql_select . $sql . $sql_limit);
		// echo $this->db->last_query();exit();
	    $data = array();
	    foreach($pengguna->result() as $r)
	    {
	      	$data[] = array( 
	                    $r->paketid,
	                    $r->item,
	                    $r->MODEL,
	                    $r->nilai_parameter,
	                    $r->jenis,
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
