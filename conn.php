<?php

include 'general/DBCORA.php';

$db = new DbCnnx();    

//echo "db >>".$db . "<<";

$SQL = "SELECT * FROM employees";

$rows = $db->select($db ,$SQL);


/**

$conn = oci_connect('system', 'oracle', '192.168.1.65/orcl');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$stid = oci_parse($conn, 'SELECT * FROM employees');
oci_execute($stid);


echo "<table border='1'>\n";

while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";

    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "") . "</td>\n";
    }
    echo "</tr>\n";
} // while
echo "</table>\n";

**/
?>