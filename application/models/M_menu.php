<?php
class M_menu extends CI_Model
 {
     function __construct()
     {
         parent::__construct();
     }
     
     // membaut menu submenu dinamis
     function getMenu($recnumlogin, $parent,$hasil,$ref=""){
        $w = $this->db->query("SELECT * from Fn_Menu (".$recnumlogin.") where ParentId='".$parent."' and IsActive=1 order by sort");
        foreach($w->result() as $h)
         {
            $cek_parent=$this->db->query("SELECT * from Fn_Menu (".$recnumlogin.") WHERE ParentId=".$h->Recnum." and IsActive=1");
            if(($cek_parent->num_rows())>0){
                 if(strtolower($ref)==strtolower($h->Web)){
                     $hasil .= '<li class="active">';
                }else{
                     $hasil .= '<li class="">';
                }
                $hasil .= '<a href="'.base_url().''. ($h->IsRequest==1 ? 'ListRequest?f='.$h->Web : $h->Web).'" class="dropdown-toggle" >
                                <i class="menu-icon fa fa-desktop" style="float: left;"></i>
                                <div class="menu-text">'.$h->IsName.' &nbsp;</div>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>

                            <b class="arrow"></b>';
            }else {
                if(strtolower($ref)==strtolower($h->Web)){
                     $hasil .= '<li class="active">';
                }else{
                     $hasil .= '<li class="">';
                }
                $hasil.='<a href="'.base_url().''.($h->IsRequest==1 ? 'ListRequest?f='.$h->Web : $h->Web).'">
                                <i class="menu-icon fa  fa-list-alt" style="font-size: 18px;float: left;"></i>
                                <div class="menu-text" >'.$h->IsName.' &nbsp;</div>
                            </a>

                            <b class="arrow"></b>
                          </li>';
            }
            $hasil .='<ul class="submenu">';
            $hasil = $this->getMenu($recnumlogin,$h->Recnum,$hasil);
            $hasil .='</ul>';              
            //$hasil .= "</li></li>";
        }
        return $hasil;//str_replace('<ul class="dropdown-menu"></ul>','',$hasil);
     }           
     
     // fungsi untuk menampilkan menu yang di klik
     public function read($id_menu){
                $this->db->where('id_menu',$id_menu);
                $sql_menu=$this->db->get('menu');
                        if($sql_menu->num_rows()==1){
                                return $sql_menu->row_array();   
                        }        
                }
 
}              
 ?>