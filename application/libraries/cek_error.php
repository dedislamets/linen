<?php if (! defined('BASEPATH')) exit('No direct script access allowed');  
 class cek_error   
 {  
      public function __construct()  
      {  
           $this->CI =& get_instance();  
           ini_set('display_errors','on');  
           error_reporting(E_ALL^E_NOTICE);  
      }  
      function inverse($x,$y){  
           if($y==0){  
                throw new Exception('0');  
           }else{  
                return ($x/$y)*100;  
           }  
      }  
 }  