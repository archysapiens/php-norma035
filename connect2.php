<?php
/*****
* Example of OracleConnectManager class.
*
*
*
* Written by Mohammad Ashrafuddin Ferdousi.
* email: it.codeperl@gmail.com
* Licensed under GNU, GPL.
*
*
*/
//including the oracle_connect_manager.php to available the OracleConnectManager Class.
require_once('general/oracle_connect_manager.php');
//Creating an object of OracleConnectManager Class.
$oracleManagerClass = new OracleConnectManager();
//Set the connection.
$oracleManagerClass->setConnection();
//Establishing the oracle connection. The paramiters are set by the OracleConnectionManager class's Default values.
$conn = $oracleManagerClass->establishConnection();
//if connection success enter the condition and execute the query. else echo message and exit.
if ($conn) {
$stid = oci_parse($conn, "SELECT * FROM employees");
oci_set_prefetch($stid, 60);
oci_execute($stid);
 
$data = array();
while (($row = oci_fetch_array($stid, OCI_ASSOC))) {
$data[] = $row;
}
oci_free_statement($stid);
oci_close($conn);
} else {
echo 'Database Connection Error!';
exit();
}
//print the fetched data as an array.
print('<pre>');
print_r($data);
print('</pre>');
//end
?>