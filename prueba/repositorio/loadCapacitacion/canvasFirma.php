<?php
	sleep(1);
	require('../../bd/bd.php');
	$db = new DbCnnx();
	function after ($this, $inthat) {
			if (!is_bool(strpos($inthat, $this)))
			return substr($inthat, strpos($inthat,$this)+strlen($this)); };
	function before ($this, $inthat) {
			return substr($inthat, 0, strpos($inthat, $this)); };
	function between ($this, $that, $inthat){
			return before ($that, after($this, $inthat)); };

		$data = file_get_contents("php://input");
		$filteredData=substr($data, strpos($data, ",")+1);
		$filteredDataEncode = between(',', '&dataFilename=', $data);
		$filteredFilename = between('&dataFilename=', '&sucursal', $filteredData);
		$Sucursal=substr($filteredData, strpos($filteredData, "&sucursal=")+10);
		$Sucursal = between('&sucursal=', '&idInstructor=', $filteredData);
		$idInstructor=substr($filteredData, strpos($filteredData, "&idInstructor=")+14);

		$decodedData=base64_decode($filteredDataEncode);
		$fic_name = utf8_decode(trim($filteredFilename)).'.png';
		$nombre_ficheroFirmas = '../../web/UploadPdf/PdfCapacitacion/FormatosInstruc/'.$Sucursal.'/'.$idInstructor.'';
		if(file_exists($nombre_ficheroFirmas)) { }else { mkdir($nombre_ficheroFirmas, 0777, true); }
		$RutaDirFileFirma = $nombre_ficheroFirmas."/".$fic_name;
		
		$fp = fopen($RutaDirFileFirma, 'wb');
		$ok = fwrite( $fp, $decodedData);
		fclose( $fp );
		if($ok){ $SQL_UpdaValidDoc = "UPDATE mod_instructor SET RUTA_FIRMA='".substr($RutaDirFileFirma,6)."' WHERE ID_USER='$idInstructor'"; $rec = $db->query($SQL_UpdaValidDoc); } else{ echo "ERROR"; }
		
?>

