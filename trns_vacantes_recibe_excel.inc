<?php

function actualizaPlazasVacantes($ArchivoExcel){
	

try {
    $inputFileType = PHPExcel_IOFactory::identify($ArchivoExcel);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($ArchivoExcel);
} catch (Exception $e) {
    die('Error loading file "' . pathinfo($ArchivoExcel, PATHINFO_BASENAME) 
    . '": ' . $e->getMessage());
}


$sheet = $objPHPExcel->getSheet(0);
$highestRow = $sheet->getHighestRow();
$highestColumn = $sheet->getHighestColumn();

$db = new DbOracle("test_db", "ArchiSoft");
//  Loop through each row of the worksheet in turn
$Conv="";
$IdPzaVte="";
for ($row = 1; $row <= $highestRow; $row++) {
    //  Read a row of data into an array
    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, 
    NULL, TRUE, FALSE);
     $Conv="";
	$IdPzaVte="";

    foreach($rowData[0] as $k=>$v){

       if ($row >1 and ($k+1) == 1){
    		$IdPzaVte =  $v; 	
       	//echo "Row: ".$row."- Col: ".($k+1)." = ".$IdPzaVte."|";

        }

        
        if ($row >1 and ($k+1) == 7){
        	$Conv =  $v; 	
        //	echo "Row: ".$row."- Col: ".($k+1)." = ".$Conv."|";

        }

        if ($Conv != "" and $IdPzaVte != ""){
        	echo "Actualizar ". $IdPzaVte." con ". $Conv ."<br>";
			$sql = "update   PlazasVacantes_Xa 
			set CONVOCATORIA=:conv where plazavacante_id=:pzavteid";
			$res = $db->execute($sql, "Query Example", array(array(":pzavteid", $IdPzaVte, -1),
													array(":conv", $Conv, -1)	));
        }

    }    
    echo "<br />";
}

/**

	$sql = "update   PlazasVacantes_Xa 
	set CONVOCATORIA=:conv where plazavacante_id=:pzavteid";

	$res = $db->execute($sql, "Query Example", array(array(":pzavteid", $PzaVteId, -1),
											array(":conv", $Convocatoria, -1)	));
**/

}// fin de actualizaPlazasVacantes



?>