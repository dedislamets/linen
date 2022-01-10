<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Model
{
    function logged_id()
    {
        return $this->session->userdata('user_id');
    }

    function check_login($table, $field1, $field2)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->group_start();
        $this->db->where($field1);
        // $this->db->or_where($field3);
        $this->db->group_end();
        $this->db->where($field2);
        $this->db->limit(1);
        $query = $this->db->get();
        // echo $this->db->last_query();
        // exit();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }
    function api_getmaster($tabel, $where='', $variable='*', $orderby=''){
        $sql = "SELECT ". $variable ." FROM ". $tabel;
        if($where !=''){
            $sql.= " WHERE ". $where ;
        }

        if($orderby !=''){
            $sql.= " ORDER BY ". $orderby ;
        }

        $query = $this->db->query($sql);
        return $query->result();    
    }

    function getmaster($tabel,$where='',$order=''){

        $this->db->from($tabel);
        if($where !=""){
            $this->db->where($where);
        }
        if($order !=""){
            $this->db->order_by($order);
        }
        $query = $this->db->get();
        // echo $this->db->last_query();exit();
        return $query->result();   
    }
    function getmaster_num_rows($tabel,$where='',$order=''){

        $this->db->from($tabel);
        if($where !=""){
            $this->db->where($where);
        }
        if($order !=""){
            $this->db->order_by($order);
        }
        $query = $this->db->get();
        return $query->num_rows();   
    }
    function getmaster_dm($tabel,$where='',$order=''){
        $this->db->from($tabel);
        if($where !=""){
            $this->db->where($where);
        }
        if($order !=""){
            $this->db->order_by($order);
        }
        $query = $this->db->get();
        return $query->result();    
    }

    function get_pm($tabel,$where='',$order=''){
        $this->db->from($tabel);
        if($where !=""){
            $this->db->where($where);
        }
        if($order !=""){
            $this->db->order_by($order);
        }
        $query = $this->db->get();
        return $query->result();    
    }
    
    function get($tabel,$where='',$order=''){
        $this->db->from($tabel);
        if($where !=""){
            $this->db->where($where);
        }
        if($order !=""){
            $this->db->order_by($order);
        }
        $query = $this->db->get();
        return $query->result();    
    }
    function get_row($tabel,$where='',$order=''){
        $this->db->from($tabel);
        if($where !=""){
            $this->db->where($where);
        }
        if($order !=""){
            $this->db->order_by($order);
        }
        $query = $this->db->get()->row();
        return $query;    
    }
    function api_array($tabel,$where='',$order=''){
        $this->db->from($tabel);
        if($where !=""){
            $this->db->where($where);
        }
        if($order !=""){
            $this->db->order_by($order);
        }
        $query = $this->db->get();
        return $query->result_array();    
    }
    function get_array($tabel,$where='',$order=''){
        $this->db->from($tabel);
        if($where !=""){
            $this->db->where($where);
        }
        if($order !=""){
            $this->db->order_by($order);
        }
        $query = $this->db->get();
        return $query->row_array();    
    }
    function get_like_array($tabel,$where='',$order=''){
        $this->db->from($tabel);
        if($where !=""){
            $this->db->like($where);
        }
        if($order !=""){
            $this->db->order_by($order);
        }
        $query = $this->db->get();
        return $query->result_array();    
    }
    function get_result_array($tabel,$where='',$order='', $desc='desc', $limit=''){
        $this->db->from($tabel);
        if($where !=""){
            $this->db->where($where);
        }
        if($order !=""){
            $this->db->order_by($order, $desc);
        }
        if($limit !=""){
            $this->db->limit($limit);
        }
        $query = $this->db->get();
        return $query->result_array();    
    }
    function deleteTable($recnum, $id, $table)
    {        
        
        $this->db->from($table);
        $this->db->where($recnum, $id)->delete();
        if ($this->db->affected_rows() > 0){
            return true;      
            
        }else{
            return false;
          
        }
    }

    function api_post($table,$array_data)
    {        
        $insert = $this->db->insert($table, $array_data);
        if($insert){
            $response['status']=200;
            $response['error']=false;
            $response['message']='Data berhasil ditambahkan.';
            return $response;
        }else{
            $response['status']=502;
            $response['error']=true;
            $response['message']='Data gagal ditambahkan.';
            return $response;
        }
    }

    function getLastHistory($epc){
        $sql = "SELECT * FROM (
                    SELECT B.no_transaksi,B.current_insert,epc,'kotor' AS FLAG, A.STATUS , '-' AS RUANGAN
                        FROM linen_kotor_detail B, linen_kotor A  
                        WHERE A.NO_TRANSAKSI=B.no_transaksi AND epc='".$epc."'
                    UNION ALL
                    SELECT B.no_transaksi,B.current_insert,epc,'bersih' AS FLAG , A.STATUS ,'-' AS RUANGAN
                        FROM linen_bersih_detail B, linen_bersih A
                        WHERE A.NO_TRANSAKSI=B.no_transaksi AND epc='".$epc."'
                    UNION ALL
                    SELECT B.no_transaksi,B.current_insert,epc,'keluar' AS FLAG , A.STATUS , A.RUANGAN
                        FROM linen_keluar_detail B, linen_keluar A
                        WHERE A.NO_TRANSAKSI=B.no_transaksi AND epc='".$epc."'
                    UNION ALL 
                    SELECT B.no_transaksi,B.current_insert,epc,'rusak' AS FLAG ,'RUSAK' AS STATUS,'-' AS RUANGAN
                        FROM linen_rusak_detail B, linen_rusak A
                        WHERE A.NO_TRANSAKSI=B.no_transaksi AND epc='".$epc."'
                )history 
                ORDER BY current_insert DESC LIMIT 1";

        return $this->db->query($sql)->row_array();
    }

    function getJumlahCuci($epc) {
        $sql =  "SELECT COUNT(*) jml FROM linen_kotor a JOIN linen_kotor_detail b ON a.no_transaksi=b.no_transaksi WHERE epc='". $epc ."'";
        return $this->db->query($sql)->row_array()['jml'];
    }
    function getTotalBeratTransaksi($no_transaksi) {
        $sql =  "SELECT TOTAL_BERAT FROM linen_kotor WHERE no_transaksi='". $no_transaksi ."'";
        return $this->db->query($sql)->row_array()['TOTAL_BERAT'];
    }

    function getBerat($epc){
        $berat = 0;
        $this->db->from('barang');
        $this->db->join('jenis_barang','barang.id_jenis=jenis_barang.id');
        $this->db->where(array( 'serial' => $epc));
        $data = $this->db->get()->row();
        if(!empty($data)){
            $berat = $data->berat;
        }
        return $berat;
    }
    function send_notif_app_get($type = 'single', $token = '', $message = '' ,$topics = ''){
        error_reporting(-1);
        ini_set('display_errors', 'On');
        
        $fields = NULL;
        
        if($type == "single") {
    
            $res = array();
            $res['body'] = $message;
            
            $fields = array(
                'to' => $token,
                'notification' => $res,
            );
            // echo json_encode($fields);
            
        }else if($type == "topics") {
            $res = array();
            $res['body'] = $message;
            
            $fields = array(
                'to' => '/topics/' . $topics,
                'notification' => $res,
            );
            
            // echo json_encode($fields);
            // echo 'Topics : '. $topics . '<br/>Message : ' . $message . '<br>';
        }
        
        // Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';
        $server_key = "AAAA-XXzNh4:APA91bFtdWD6MfsRH3PeYz62vYQdCNFNoXZdi5BaOyZ6AiEdIqQpYjuBplob5baO7RCU6iw-ElrX6GH60g95fTE6ltK2ejbC9XXPcfFOby4BMuVTSi2LEnPMHAxgMforeOFnJN_gCu7l";
        
        $headers = array(
            'Authorization: key=' . $server_key,
            'Content-Type: application/json'
        );
        $ch = curl_init();
 
        curl_setopt($ch, CURLOPT_URL, $url);
 
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        
        $result = curl_exec($ch);
        if ($result === FALSE) {
            // echo 'Curl failed: ' . curl_error($ch);
        }else{
            // echo "<br>Curl Berhasil";
        }
 
        curl_close($ch);
    }

}