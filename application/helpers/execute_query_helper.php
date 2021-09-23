<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
function Generate_Procedure ($SQL_Procedure)  {
	$CI =& get_instance();
	// Connect to DB. You can't pass $this->db, cause it's an object and the connection info    // needs and Connection resource.
	$serverName = $CI->db->hostname;
	$connectionInfo = array( "Database"=>$CI->db->database, "UID"=>$CI->db->username, "PWD"=>$CI->db->password);
	$conn = sqlsrv_connect( $serverName, $connectionInfo);
	if( $conn === false ){
		die( print_r( sqlsrv_errors(), true));
	}
 
	$tsql_callSP = $SQL_Procedure;
	$result = array(); 
	$stmt = sqlsrv_query($conn, $tsql_callSP, null);
	do {
		while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
		// Loop through each result set and add to result array
		$result[] = $row;
		}
	} while (sqlsrv_next_result($stmt));
	return $result;
}//end function
?>