<?php
session_start();
include "../general/generales.inc";
include "trns_vacantes_recibe_excel.inc";
include '../Classes/PHPExcel/IOFactory.php';
require('../general/ac_db_inc.php');


$ds         =  DIRECTORY_SEPARATOR; 
$storeFolder  = 'recepcion' ;  
$UnZipPath    = '../staging/'  ;

if (is_array($_FILES)) { 
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds; 
  //  print_r($_FILES);

    $NumArch = count($_FILES);

    for($Ind=0;$Ind < $NumArch; $Ind++){
        //echo $_FILES['file']['name'][$Ind] . "<br>";
        $tempFile = $_FILES['file']['tmp_name'];         
        $targetFile =  $targetPath. $_FILES['file']['name'];
        move_uploaded_file($tempFile,$targetFile);
        $Var= actualizaPlazasVacantes($targetFile);
	



    }// fin de for    
    
}else {                                                           
    $result  = array();
    $files = scandir($storeFolder);                 
    if ( false!==$files ) {
        foreach ( $files as $file ) {
            if ( '.'!=$file && '..'!=$file) {       
                $obj['name'] = $file;
                $obj['size'] = filesize($storeFolder.$ds.$file);
                $result[] = $obj;
            }
        }// foreach
    } // if ( false!==$files )
    header('Content-type: text/json');              
    header('Content-type: application/json');
    echo json_encode($result);
}

?>