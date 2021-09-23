<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SPTest extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    /**
     * Model class with method for executing Stored procedures of all types
     * Multiple result sets are not supported.
     * @package Matrix
     * @subpackage Model
     * @author Vinu Felix <vinu.felix@aptean.com>
     * @return bool|array
     * @param string $spname The name of the stored procedure to be executed
     * @param array $spparams The array in the specific format that will be modified or used as input parameters
     * Example Syntax:
     * sqlsrv_runSP("sp_name");
     * sqlsrv_runSP("sp_name",$array_variable);
     * You CANNOT pass an array directly like sqlsrv_runSP("sp_name",array(array("...first value in...", SQLSRV_PARAM_IN)))
     * Array variable format:
     * $array_variable = array( 
     *              array("Some value", SQLSRV_PARAM_IN),
     *              array($var_2, SQLSRV_PARAM_OUT),
     *              array($var_3, SQLSRV_PARAM_INOUT) 
     *          );
     * 
     * Return types(for info purpose only) for SQLSRV_PARAM_INOUT and SQLSRV_PARAM_OUT are:
     *  SQLSRV_PHPTYPE_INT
     *  SQLSRV_PHPTYPE_DATETIME
     *  SQLSRV_PHPTYPE_FLOAT
     *  SQLSRV_PHPTYPE_STREAM
     *  SQLSRV_PHPTYPE_STRING
     *  For more constants refer http://www.php.net/manual/en/sqlsrv.constants.php
     * 
     * 
     */
  
    public function sqlsrv_runSP($spname,&$spparams=NULL){
        if($this->db->platform()!="sqlsrv") //if the driver is not sqlsrv the function will fail anyway
        {
           log_message('error', 'The DB driver platform is Incompatible'); 
           return FALSE;
        };
        
        if(is_null($spparams)){ //This SP does not have parameters. Execute it and return results as array(if any)
            $q1=$this->db->query($spname);
            $resarr=$q1->result_array(); 
            if(count($resarr) > 0){
                return $resarr;
            }else return TRUE; //No result but query was successful
         };
        if(!is_array($spparams)){// The SP parameters have to be an array
            log_message('error', 'SP Parameters has to be an array if its provided');
            return FALSE;
        };
        if(count($spparams,0) == 0 || ((count($spparams,1)/count($spparams,0))-1) <= 1){
            /*array should be in the format prescribed at http://msdn.microsoft.com/en-us/library/cc626303(v=sql.105).aspx 
             * The number of sub arrays should be atleast one and the number of columns in subarray atleast 2
             * array(
             * array("Some value", SQLSRV_PARAM_..)
             * )
             */
            log_message('error',"SP Parameter array is invalid.");
            return FALSE;
        };
        $qmarks="?"; // The previous if checks to make sure that atleast one row is there
        for($c=0;$c<(count($spparams,0)-1);$c++) $qmarks= "?," . $qmarks; // generate '?' placeholders =no. of arguments
        $tsql_callSP = "{call " . $spname . "(" . $qmarks . ")}"; // the final SP to be executed
        //Validate Parameter Array
        reset($spparams);
        foreach ($spparams as $param) {
          if(! ($param[1]==SQLSRV_PARAM_IN || $param[1]==SQLSRV_PARAM_OUT || $param[1]==SQLSRV_PARAM_INOUT)){
             log_message('error', 'SP Parameters array format is invalid');
             return FALSE;
          }  
        };
        reset($spparams);
        // Get CI DB Connection handler for direct query execution
        $q2 = sqlsrv_query($this->db->conn_id, $tsql_callSP, $spparams);
        if(!$q2){
            log_message('error',"Stored Procedure execution failed" . sqlsrv_errors());
            return sqlsrv_errors();
        }else{ //successful execution of Stored Procedure
                $resarr=array();//array_push requires the type to be array to function corectly
                while($ta=sqlsrv_fetch_array ($q2,SQLSRV_FETCH_ASSOC)){
                    array_push($resarr,$ta);
                };
                $resarr=$resarr[0]; //eliminate parent array
                sqlsrv_next_result($q2); //BUG in MS sqlsrv driver. This call is necesary to set the OUT variables
                return $resarr;
            
        }
    }

}
