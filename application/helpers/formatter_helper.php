<?php  if (! defined('BASEPATH')) {

     exit('No direct script access allowed');

 }

function format_data($data, $tipe_data = "")
{       
        //vdebug($data);
        $res_data = "";
        if (is_object($data)) {

            $message = '<span class="vayes-debug-badge vayes-debug-badge-object">OBJECT</span>';

        } elseif (is_array($data)) {

            $message = '<span class="vayes-debug-badge vayes-debug-badge-array">ARRAY</span>';

        } elseif (is_string($data)) {

            if ($tipe_data == 'date') {
                if(empty($data)){
                    $res_data =  NULL;
                }else{
                    $res_data =  date("Y-m-d H:i:s",strtotime($data));
                }
                
            }elseif ($tipe_data == 'switch') {
                if($data == "on"){
                    $res_data =  1;
                }else{
                    $res_data =  0;
                }
                
            }elseif ($tipe_data == 'time') {
                if(empty($data)){
                    $res_data =  '1900-01-01 00:00:00.000';
                }else{
                    $res_data =  '1900-01-01 ' . $data;
                }
                
            }elseif ($tipe_data == 'number') {

                if(empty($data)){
                    $res_data =  0;
                }else{
                    $res_data =  implode("", explode(",", $data));
                }
                
            }

        } elseif (is_int($data)) {

            $message = '<span class="vayes-debug-badge vayes-debug-badge-integer">INTEGER</span>';

        // } elseif (is_true($data)) {

        //     $message = '<span class="vayes-debug-badge vayes-debug-badge-true">TRUE [BOOLEAN]</span>';

        } 
        // elseif (is_false($data)) {

        //     $message = '<span class="vayes-debug-badge vayes-debug-badge-false">FALSE [BOOLEAN]</span>';

        // } elseif (is_null($data)) {

        //     $message = '<span class="vayes-debug-badge vayes-debug-badge-null">NULL</span>';

        // } elseif (is_float($data)) {

        //     $message = '<span class="vayes-debug-badge vayes-debug-badge-float">FLOAT</span>';

        // } else {

        //     $message = 'N/A';

        // }

        //echo $res_data;

        return $res_data;

}
function filter_null($data)
{
        if (is_string($data)) {

            if (empty($data)) {
                $data = NULL;
            }

        } 

        echo $data;

        return $data;

}

function menu(){
    // print("<pre>".print_r($id,true)."</pre>");exit();
    

    $ci =& get_instance();
    $ci->load->database();
    $ci->load->library('session');

    $recLogin = $ci->session->userdata('role_id');
    
    $arr_menu=array();
    $menu = $ci->db->query("SELECT tmp.* FROM (
                                SELECT A.*,B.`menu` AS parent_menu 
                                FROM tb_menu A
                                LEFT JOIN tb_menu B ON A.`parent_id`=B.id
                                LEFT JOIN tb_group_menu C ON C.`id_menu`=A.id 
                                WHERE C.`id_group` like '%". $recLogin ."%' and A.aktif=1
                            ) tmp
                            UNION ALL
                            SELECT *,NULL AS parent_menu FROM tb_menu 
                            WHERE id IN (
                                SELECT DISTINCT A.parent_id FROM tb_menu A
                                LEFT JOIN tb_group_menu C ON C.`id_menu`=A.id 
                                WHERE A.parent_id>0 AND C.`id_group` like '%". $recLogin ."%'
                            ) ORDER BY parent_id,urut ASC ")->result();
    foreach($menu as $row)
    {

            if($row->parent_id == 0){
                $arr_menu[ $row->title ] [ $row->menu ] ['parent'] = $row->parent_id;
                $arr_menu[ $row->title ] [ $row->menu ] ['child'] = array();
                $arr_menu[ $row->title ] [ $row->menu ] ["data"][] = array(
                                            "id" => $row->id,
                                            "menu"    => $row->menu,
                                            "icon"    => $row->icon,
                                            "parent_id" => $row->parent_id,
                                            "link"    => $row->link,
                                            "aktif"   => 1,
                                            "title"   => $row->title
                                        );
            }else{
                // print("<pre>".print_r($row,true)."</pre>");
                $arr_menu[ $row->title ] [ $row->parent_menu ] ['child'][] = array(
                                            "id" => $row->id,
                                            "menu"    => $row->menu,
                                            "icon"    => $row->icon,
                                            "parent_id" => $row->parent_id,
                                            "link"    => $row->link,
                                            "aktif"   => 1,
                                            "title"   => $row->title
                                        );
            }

    }
          
    return $arr_menu;
}

function CheckMenuRole($link){
    
    $ci =& get_instance();
    $ci->load->database();
    $ci->load->library('session');

    $recLogin = $ci->session->userdata('user_id');
    $id_group = $ci->session->userdata('role_id');
    
    $menu = $ci->db->query("SELECT A.*,B.`menu` 
                            FROM tb_group_menu A
                            JOIN tb_menu B ON A.`id_menu`=B.`id`
                            JOIN tb_group_user C ON C.`id_group_role`=A.`id_group` 
                            WHERE  A.`id_group`=". $id_group ." AND B.`link`='". $link ."' AND C.`id_user`=". $recLogin )->result();   
    if($menu){
        return FALSE;
    }else{
        return TRUE;
    }      
    
}

function ChangeRole($recLogin=""){
    
    $ci =& get_instance();
    $ci->load->database();
    $ci->load->library('session');
    if($recLogin==""){

        $recLogin = $ci->session->userdata('user_id');
    }

    $menu = $ci->db->query("SELECT B.`id_group_role`,C.`group`
                            FROM tb_user A
                            JOIN tb_group_user B ON A.id_user=B.`id_user`
                            JOIN tb_group_role C ON C.`id`=B.`id_group_role`
                            WHERE B.`id_user`=". $recLogin )->result();
    
          
    return $menu;
}
function tgl_indo($tanggal){
    $bulan = array (
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);
    
    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun
 
    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
function tgl_waktu_indo($tanggal){
    setlocale(LC_ALL, 'id-ID', 'id_ID');
    echo strftime("%A, %d %B %Y %T", strtotime($tanggal)) . "\n";
}
function notifikasi(){
    $arr = array();
    $ci =& get_instance();
    $ci->load->database();
    $ci->load->library('session');

    $ci->db->from('tb_notifikasi');
    $ci->db->where('read',0);
    $query = $ci->db->where('sent_to', $ci->session->userdata('user_id'))->get();
    $arr['notifikasi'] = $query->result();
    $arr['notifikasi_count'] = $query->num_rows();
    return $arr;
}

