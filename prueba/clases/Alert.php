<?php

 class Alert{


    public function numAlert($nomUser,$priviUser){
		$db = new DbCnnx();
		if($priviUser=='CLIENTE' or $priviUser=='TECNICO' or $priviUser=='RESPONSABLE' or $priviUser=='ADMINISTRACION'){
			if($priviUser=='CLIENTE'){ $ID_USER = htmlspecialchars($_COOKIE["id_emp"]); }
			
			// $SQL_numAlert=sprintf("SELECT * FROM valid_modulo WHERE ID_CLIENTE='$ID_USER' and NOMBRE_USER='$nomUser' and VALID='false'");
			$SQL_numAlert=sprintf("SELECT * FROM valid_modulo WHERE NOMBRE_USER='$nomUser' and VALID='false'");
		}else{
			// $SQL_numAlert=sprintf("SELECT * FROM reportes_fumi WHERE TECNICO_APLICADOR='$nomUser' GROUP BY NO_CLIENTE");
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
        }
        else{
            echo"<i class=\"fa fa-bell fa-fw\"></i><span class=\"label label-primary\"></span>";
        }	
    }
	
	public function contentAlert($sufijoMenu,$sufifo){
		$db = new DbCnnx();
		$nomUser = $_SESSION['sesionNomUser'];
		if($_SESSION['sesionPrivi']=='CLIENTE' or $_SESSION['sesionPrivi']=='TECNICO' or $_SESSION['sesionPrivi']=='RESPONSABLE' or $_SESSION['sesionPrivi']=='ADMINISTRACION'){
			if($_SESSION['sesionPrivi']=='CLIENTE'){ $ID_USER = htmlspecialchars($_COOKIE["id_emp"]);	 }					
			// $SQL_contentAlert=sprintf("SELECT * FROM valid_modulo WHERE ID_CLIENTE='$ID_USER' and NOMBRE_USER='$nomUser' and VALID='false'"); $rec = $db->combo($SQL_contentAlert);
			$SQL_contentAlert=sprintf("SELECT * FROM valid_modulo WHERE NOMBRE_USER='$nomUser' and VALID='false'"); $rec = $db->combo($SQL_contentAlert);
			while ($row = $rec->fetch_assoc()) {
				$rows = (object) $row;
				echo '<li><a href="'.$sufijoMenu.'Fumigacion/validFumigacion.php" id="ValidModulo" value="'.$rows->ID_VALID.'"><div class="text-small" style="font-size:10px;"><img src="'.$sufifo.'web/images/fa-icons/certificate.png" width="15" height="15" style="margin-left:-8px;"/> '.$rows->NOTIFY.' <small class="pull-right text-muted small" style="color:#18a689">Hace 4 min</small></div></a></li>';
			}
		}else{
			// $SQL_contentAlert=sprintf("SELECT * FROM reportes_fumi WHERE TECNICO_APLICADOR='$nomUser' GROUP BY NO_CLIENTE");
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
