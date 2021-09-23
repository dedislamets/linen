<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jqgrid extends CI_Model
{
    function getAllData($start,$limit,$sidx,$sord,$where){
        $this->db->select('*');
        $this->db->limit($limit);
        if($where != NULL)
            $this->db->where($where,NULL,FALSE);
        $this->db->order_by($sidx,$sord);
        $query = $this->db->get('info',$limit,$start);

        return $query->result();
    }
}