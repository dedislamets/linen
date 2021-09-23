<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pengguna extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('admin');
	   
	}
	public function index()
	{		
		if($this->admin->logged_id()){
        	
            $data['title'] = 'Home';
            $data['main'] = 'pengguna/list';
			$data['js'] = 'script/pengguna';

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
	        4=>'ITEMNO',
	        5=>'model',
	        6=>'paketid'
	    );
	    $valid_sort = array(
	        0=>'ORDDATE',
	        1=>'ORDNUMBER',
	        2=>'INVNUMBER',
	        3=>'QTYSHIPPED',
	        4=>'ITEMNO',
	        5=>'model',
	        6=>'paketid'
	    );

	    // $this->db->limit($length,$start);

	    $sql_select = "select * from ( 
					select distinct ROW_NUMBER() OVER (ORDER BY ORDNUMBER) as row, SGTDAT.dbo.fnGetAccpacDate(A.ORDDATE) as ORDDATE,A.ORDNUMBER,A.INVNUMBER,convert(float,B.QTYSHIPPED) QTYSHIPPED, tbl.ITEMNO,pki.paketid,model ";
		$sql ="		from SGTDAT..OEAUDH A
					inner join SGTDAT..OEAUDD B on A.DAYENDNUM = B.DAYENDNUM AND A.ENTRYNUM = B.ENTRYNUM
					inner join mesdb..TBL_ICITEM tbl ON tbl.FMITEMNO=B.ITEM
					inner join sgtdat..ICITEM I on I.FMTITEMNO=B.ITEM
					inner join paket_item Pki on Pki.item=tbl.itemno
					cross apply(
						select paketid from paket_parameter where paketid=pki.paketid and parameterid=28
					)BA
					cross apply (
						select ARCUS.* from SGTDAT..ARCUS ARCUS
						inner join paket_area PA on (PA.area=ARCUS.IDCUST or PA.area=ARCUS.IDGRP)
						where PA.paketid=BA.paketid and ARCUS.IDCUST=A.CUSTOMER
					)ARC
					inner join paket_reward F on F.paketid=BA.paketid and rewardid=1
					inner join campaign camp ON camp.campaignid=Pki.campaignid
					inner join periode PP on PP.periodeid=camp.periodeid 
					where 
					A.CUSTOMER='". $this->input->get('dealer') ."'  and B.TRANSTYPE<>3
					and camp.campaign='". $this->input->get('campaign') ."'
					and convert(date,SGTDAT.dbo.fnGetAccpacDate(A.ORDDATE)) between convert(date,'". $this->input->get('awal') ."') and convert(date,'". $this->input->get('akhir') ."') ";
		
		// print("<pre>".print_r($valid_columns,true)."</pre>");
		$sql_limit =")temp where (
				ORDDATE LIKE '%".$this->input->get('search')['value']."%' 
				OR ORDNUMBER LIKE '%".$this->input->get('search')['value']."%' 
				OR INVNUMBER LIKE '%".$this->input->get('search')['value']."%' 
				OR QTYSHIPPED LIKE '%".$this->input->get('search')['value']."%' 
				OR ITEMNO LIKE '%".$this->input->get('search')['value']."%' 
				OR model LIKE '%".$this->input->get('search')['value']."%'
				OR paketid LIKE '%".$this->input->get('search')['value']."%' ) and 

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
	                     $r->paketid,
	                    $r->ITEMNO,
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
	        0=>'paketid',
	        1=>'model',
	        2=>'qty',
	       
	    );
	    $valid_sort = array(
	        0=>'paketid',
	        1=>'model',
	        2=>'qty',
	    );

	    // $this->db->limit($length,$start);

	    $sql_select = "select * from ( 
					select distinct ROW_NUMBER() OVER (ORDER BY model) as row,pki.paketid,model,convert(float,sum(B.QTYSHIPPED)) qty,convert(varchar(12),nilai_parameter) as target ";
		$sql ="		from SGTDAT..OEAUDH A
					inner join SGTDAT..OEAUDD B on A.DAYENDNUM = B.DAYENDNUM AND A.ENTRYNUM = B.ENTRYNUM
					inner join mesdb..TBL_ICITEM tbl ON tbl.FMITEMNO=B.ITEM
					inner join sgtdat..ICITEM I on I.FMTITEMNO=B.ITEM
					inner join paket_item Pki on Pki.item=tbl.itemno
					cross apply(
						select top 1 paketid,nilai_parameter from paket_parameter where paketid=pki.paketid and parameterid=28 
						order by urutan_parameter asc
					)BA
					cross apply (
						select ARCUS.* from SGTDAT..ARCUS ARCUS
						inner join paket_area PA on (PA.area=ARCUS.IDCUST or PA.area=ARCUS.IDGRP)
						where PA.paketid=BA.paketid and ARCUS.IDCUST=A.CUSTOMER
					)ARC
					inner join paket_reward F on F.paketid=BA.paketid and rewardid=1
					inner join campaign camp ON camp.campaignid=Pki.campaignid
					inner join periode PP on PP.periodeid=camp.periodeid 
					where 
					--A.ORDDATE like '2020%' and
					A.CUSTOMER='". $this->input->get('dealer') ."'  and B.TRANSTYPE<>3
					--and I.ITEMNO IN ('MD0015W1106X01')
					--and pki.paketid in ('56SPMD-BOOSTER2020')
					and camp.campaign='". $this->input->get('campaign') ."'
					and convert(date,SGTDAT.dbo.fnGetAccpacDate(A.ORDDATE)) between convert(date,'". $this->input->get('awal') ."') and convert(date,'". $this->input->get('akhir') ."') group by model,pki.paketid,convert(varchar(12),nilai_parameter) ";
		
		// print("<pre>".print_r($valid_columns,true)."</pre>");
		$sql_limit =")temp where (
				model LIKE '%".$this->input->get('search')['value']."%'
				OR paketid LIKE '%".$this->input->get('search')['value']."%' ) and 

				row > ". $start ." and row <= ". ($start + $length) ." ORDER BY ". $valid_columns[$this->input->get("order")[0]['column']]."   ". $this->input->get("order")[0]['dir'] ." " ;

		$pengguna = $this->db->query($sql_select . $sql . $sql_limit);
       // echo $this->db->last_query();exit();

	    $data = array();
	    foreach($pengguna->result() as $r)
	    {
	      	$data[] = array( 
	                    $r->paketid,
	                    $r->model,
	                    $r->qty,
	                    $r->target,

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

	public function edit(){
        $id = $this->input->get('id');
        $apps = $this->input->get('apps'); 
        $arr_par = array('user_id' => $id, 'apps' => $apps);
        $data = $this->admin->getmaster('login',$arr_par);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function Save()
    {       
        
        $response = [];
        $response['error'] = TRUE; 
        $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
        $recLogin = $this->session->userdata('user_id');
        $data = array(
            'email'  			=> $this->input->get('email'),
            'eternal'      		=> $this->input->get('eternal'),             
        );
        if(!empty($this->input->get('password'))){
        	$data['password'] = $this->input->get('password');
        	$data['last_update_date'] = date('Y-m-d');
        }

        $this->db->trans_begin();

        $this->db->set($data);
        $this->db->where('user_id', $this->input->get('user_id'));
        $this->db->where('apps', $this->input->get('apps'));
        $result  =  $this->db->update('login');  

        if(!$result){
            print("<pre>".print_r($this->db->error(),true)."</pre>");
        }else{
            $response['error']= FALSE;
            if(!empty($this->input->get('password'))){
	        	$data_log = array(
                    'user_id'           => $this->input->get('user_id'),
                    'last_password'     => $this->input->get('password'),  
                    'log_by'            => $recLogin, 
                    'remark'            => 'Ganti Password' ,
                    'apps_log'      	=> $this->input->get('apps')
                );
                $this->db->insert('log_tbl', $data_log);
	        }
        }
        

        $this->db->trans_complete();
                            
      $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }
	public function aktifkan()
    {       
        
        $response = [];
        $response['error'] = TRUE; 
        $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
        $recLogin = $this->session->userdata('user_id');
        $data = array(
            'aktif'  			=> $this->input->get('aktif'),
            'last_update_date'  => date('Y-m-d'),             
        );
        if($this->input->get('aktif') == '1')
        	$data['password'] =  $this->input->get('password');

        $this->db->trans_begin();

        $this->db->set($data);
        $this->db->where('user_id', $this->input->get('user_id'));
        $this->db->where('apps', $this->input->get('apps'));
        $result  =  $this->db->update('login');  

        if(!$result){
            print("<pre>".print_r($this->db->error(),true)."</pre>");
        }else{
            $response['error']= FALSE;
        	$data_log = array(
                'user_id'           => $this->input->get('user_id'),
                'log_by'            => $recLogin, 
                'remark'            => 'Mengaktifkan User' ,
                'apps_log'      	=> $this->input->get('apps')
            );
            if($this->input->get('aktif') == '0'){
            	$data_log['remark'] = 'Non aktifkan User' ;
            }else{
            	$data_log['last_password']     = $this->input->get('password');
            }
            $this->db->insert('log_tbl', $data_log);
        }
        

        $this->db->trans_complete();
                            
      $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }
}
