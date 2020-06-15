<?php
include "../general/generales.inc";
require('../general/ac_db_inc.php');
include "trns_vacantes_recibe_excel.inc";
include '../Classes/PHPExcel/IOFactory.php';



$var= actualizaPlazasVacantes("vacantes_regreso.xlsx");


?>