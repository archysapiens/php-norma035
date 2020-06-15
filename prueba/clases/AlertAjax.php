<?php

 class AlertAjax{


    public function numAlert(){
		@$nomUser=$_SESSION['sesionNomUser']; @$priviUser=$_SESSION['sesionPrivi'];
		
		$db = new DbCnnx();
		if($priviUser=='CLIENTE' or $priviUser=='TECNICO' or $priviUser=='RESPONSABLE' or $priviUser=='ADMINISTRACION'){
			if($priviUser=='CLIENTE'){ $ID_USER = htmlspecialchars($_COOKIE["id_emp"]); }
			
			// $SQL_numAlert=sprintf("SELECT * FROM valid_modulo WHERE ID_CLIENTE='$ID_USER' and NOMBRE_USER='$nomUser' and VALID='false'");
			$SQL_numAlert=sprintf("SELECT * FROM valid_modulo WHERE NOMBRE_USER='$nomUser' and VALID='false'");
		}else{
			// $SQL_numAlert=sprintf("select * from reportes_fumi where tecnico_aplicador='$nomUser' group by no_cliente");
			$SQL_numAlert = sprintf("CALL sqlNumAlertFumi('$nomUser')");
		}
		
		$rec = $db->combo($SQL_numAlert);
		$count = 0;
		while ($row = $rec->fetch_assoc()) {
			$count++;
			$rows = (object) $row;
		}
        
        if($count>0){
            $numbadge=$count;
            echo"<i class=\"fa fa-bell fa-fw\"></i><span class=\"label label-primary\">" .$numbadge. "</span>";
			?><script>
				$(document).ready(function () {
						Tinycon.setBubble(<?php echo $numbadge; ?>);
						Tinycon.setOptions({
							background: 'black'
						});				
				});
			</script> <?php
        }
        else{
            echo"<i class=\"fa fa-bell fa-fw\"></i><span class=\"label label-primary\"></span>";
        }	
    }
	
	public function contentAlert($sufijoMenu="",$sufifo=""){
		$db = new DbCnnx();
		$nomUser = $_SESSION['sesionNomUser'];
		$fa_graduation='data:image/png;base64,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';
		if($_SESSION['sesionPrivi']=='CLIENTE' or $_SESSION['sesionPrivi']=='TECNICO' or $_SESSION['sesionPrivi']=='RESPONSABLE' or $_SESSION['sesionPrivi']=='ADMINISTRACION'){
			if($_SESSION['sesionPrivi']=='CLIENTE'){ $ID_USER = htmlspecialchars($_COOKIE["id_emp"]);	 }					
			// $SQL_contentAlert=sprintf("SELECT * FROM valid_modulo WHERE ID_CLIENTE='$ID_USER' and NOMBRE_USER='$nomUser' and VALID='false'"); $rec = $db->combo($SQL_contentAlert);
			$SQL_contentAlert=sprintf("SELECT * FROM valid_modulo WHERE NOMBRE_USER='$nomUser' and VALID='false'"); $rec = $db->combo($SQL_contentAlert);
			while ($row = $rec->fetch_assoc()) {
				$rows = (object) $row;
				$findmeOT = 'OT';
				$findmePG = 'PG';
				$strposModule = strpos(substr($rows->ID_VALID, 0, 2), $findmeOT);
				$strposModulePG = strpos(substr($rows->ID_VALID, 0, 2), $findmePG);
				$strposModuleCP = strpos(substr($rows->ID_VALID, 0, 2), 'CP'); //MODULO DE CAPACITACION
				$strposModulePC = strpos(substr($rows->ID_VALID, 0, 2), 'PC');  //MODULO DE PROTECCION CIVIL(CAPACITACION)
				// var_dump($strposModuleCP);
				if($strposModule !== FALSE or $strposModulePG !== FALSE){ if(strlen($rows->NOTIFY)>37){ $add="..."; }else{$add='';} echo '<li><a href="'.$sufijoMenu.'Extintores/validExtintores.php" id="ValidModulo" value="'.$rows->ID_VALID.'" title="'.$rows->NOTIFY.'"><div class="text-small" style="font-size:10px;"><img src="'.$sufifo.'web/images/fa-icons/iconExt.png" width="15" height="15" style="margin-left:-8px;"/> '.substr($rows->NOTIFY,0,37).$add.' <small class="pull-right text-muted small" style="color:#18a689">Hace 4 min</small></div></a></li>';
				}else if($strposModuleCP !== FALSE or $strposModulePC !== FALSE){ if(strlen($rows->NOTIFY)>37){ $add="..."; }else{$add='';} echo '<li><a href="'.$sufijoMenu.'Capacitacion/validCapacitacion.php" id="ValidModulo" value="'.$rows->ID_VALID.'" title="'.$rows->NOTIFY.'"><div class="text-small" style="font-size:10px;"><img src="'.$fa_graduation.'" width="15" height="15" style="margin-left:-8px;"/> '.substr($rows->NOTIFY,0,37).$add.' <small class="pull-right text-muted small" style="color:#18a689">Hace 4 min</small></div></a></li>'; }			
				else{ if(strlen($rows->NOTIFY)>37){ $add="..."; }else{$add='';} echo '<li><a href="'.$sufijoMenu.'Fumigacion/validFumigacion.php" id="ValidModulo" value="'.$rows->ID_VALID.'" title="'.$rows->NOTIFY.'"><div class="text-small" style="font-size:10px;"><img src="'.$sufifo.'web/images/fa-icons/certificate.png" width="15" height="15" style="margin-left:-8px;"/> '.substr($rows->NOTIFY,0,37).$add.' <small class="pull-right text-muted small" style="color:#18a689">Hace 4 min</small></div></a></li>'; }			
			}
		}else{
			// $SQL_contentAlert=sprintf("select * from reportes_fumi where tecnico_aplicador='$nomUser' group by no_cliente");
			$SQL_contentAlert = sprintf("CALL sqlNumAlertFumi('$nomUser')"); }

		$rec = $db->combo($SQL_contentAlert);
		$count = 0;
		while ($row = $rec->fetch_assoc()) {
			$count++;
			$rows = (object) $row;			
		}
        if($count>0){} else{  echo""; }	
    }
	 
 }


 
 session_start();
 require('../bd/bd.php');
$funcion = @$_REQUEST['numAlert'];
$funcion2 = @$_REQUEST['contentAlert'];
$sufijo = @$_REQUEST['sufijo'];
$sufijoMenu = @$_REQUEST['sufijoMenu'];
$AlertAjax = new AlertAjax();


if($funcion2!=''){
	$resultado2 = $AlertAjax->$funcion2($sufijoMenu,$sufijo);
}
if($funcion!=''){
	$resultado = $AlertAjax->$funcion();
}




