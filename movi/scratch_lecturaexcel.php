<?php
include "../general/generales.inc";
require("../general/ac_db_inc.php");
include '../Classes/PHPExcel/IOFactory.php';

$inputFileName = 'vacantes_regreso.xlsx';

//  Read your Excel workbook
try {
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($inputFileName);
} catch (Exception $e) {
    die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) 
    . '": ' . $e->getMessage());
}

//  Get worksheet dimensions

$sheet = $objPHPExcel->getSheet(0);
$highestRow = $sheet->getHighestRow();
$highestColumn = $sheet->getHighestColumn();

//  Loop through each row of the worksheet in turn
for ($row = 1; $row <= $highestRow; $row++) {
    //  Read a row of data into an array
    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, 
    NULL, TRUE, FALSE);
    foreach($rowData[0] as $k=>$v){
        if ($row >1 and ($k+1) == 7){
            echo "Row: ".$row."- Col: ".($k+1)." = ".$v."|";

        }

    }
        
    echo "<br />";
}





?>