<?php
sleep(1);
require('../../bd/bd.php');

$db = new DbCnnx();

if($_REQUEST['noCliente']!='')
{
	$noCliente= $_REQUEST['noCliente'];
	@$txtSucu= $_REQUEST['txtSucu'];
	@$TypeAutocomplite= $_REQUEST['TypeAutocomplite'];
	@$TypeReportFumi= $_REQUEST['TypeReportFumi'];
	$DirJson='';
	@$fecha_actual = new DateTime(date("Y-m-d",time()));
	
	$QuerySearch = "SELECT cont.NOMBRE_C,cont.APP_PATERNO_C,cont.APP_MATERNO_C,cont.EMAIL,emp.GIRO,emp.NOMBRE,emp.APP_PATERNO,emp.APP_MATERNO,emp.ESTADO,emp.DEL_MPIO,emp.COLONIA,emp.CP,emp.CALLE,emp.NUM_EXT,emp.NUM_INT FROM empresas AS emp,contactos AS cont  WHERE emp.no_cliente=$noCliente AND cont.no_cliente=$noCliente;";
	$rec = $db->combo($QuerySearch);
	$count = 0;
	while ($row = $rec->fetch_assoc()) {
		$count++;
		$NombreCliente=$row['NOMBRE'].' '.$row['APP_PATERNO'].' '.$row['APP_MATERNO'];
		$NombreClienteMo=$row['NOMBRE_C'].' '.$row['APP_PATERNO_C'].' '.$row['APP_MATERNO_C'];
		$DireccionCliente=$row['CALLE'].' / '.$row['NUM_INT'].' / '.$row['NUM_EXT'].' / '.$row['COLONIA'].' / '.$row['DEL_MPIO'].' / '.$row['ESTADO'].'-'.$row['CP'];		

		if($row['EMAIL']==''){$Correo='';}else{$Correo=$row['EMAIL'];}
		if($row['GIRO']==''){$Giro='GIRO';}else{$Giro=$row['GIRO'];}
		
		if($row['NOMBRE']==''){
			$ResultFinal = $NombreClienteMo.' # '.$DireccionCliente.' # '.$Giro.' # '.@$txtSucu.' # '.@$Correo;
		}else{
			$ResultFinal = $NombreCliente.' # '.$DireccionCliente.' # '.$Giro.' # '.@$txtSucu.' # '.@$Correo;}
	}
	if (@$count>0){
		
		switch ($TypeAutocomplite) {
			case "OrdenDeTrabajo":
					
					$QuerySearchOrden = "SELECT * FROM ordent_ext WHERE NO_CLIENTE='$noCliente' AND ID_ORDENT LIKE '".$noCliente."%$TypeReportFumi' GROUP BY NO_CLIENTE";
					$recOrdenDeT = $db->combo($QuerySearchOrden);
					$QuerySearchOrdenRefac = "SELECT ID_REFACCIONES,PIEZAS_REFACCION FROM ordent_ext WHERE NO_CLIENTE='$noCliente' AND ID_ORDENT LIKE '".$noCliente.$TypeReportFumi."%' AND (ID_REFACCIONES !='' OR PIEZAS_REFACCION !='')";
					$recOrdenDeTRefac = $db->combo($QuerySearchOrdenRefac);
						if($TypeReportFumi=='OT'){$DirJson='OrdenDeTrabajo';}
						$getRutaJson = "../../repositorio/DataJson/DataExtintores/$DirJson/$txtSucu/dataReport$noCliente.json";
					if($recOrdenDeT->num_rows >=1 ){
						$QuerySearchOrdenStore = "SELECT FECHA_REGISTRO,NO_FOLIO,RUTA_JSON FROM ordent_ext WHERE NO_CLIENTE='$noCliente' AND ID_ORDENT LIKE '".$noCliente."%$TypeReportFumi' GROUP BY NO_CLIENTE";
						$recOrdenStore = $db->select($QuerySearchOrdenStore);
						$fecha_entrada = new DateTime($recOrdenStore[0]["FECHA_REGISTRO"]);
						$getNoFolio = $recOrdenStore[0]["NO_FOLIO"];
						$DiffDateTime = $fecha_actual->diff($fecha_entrada);
							if($DiffDateTime->days >=30 ){
									
									$QuerySearchOrden = "SELECT * FROM ordent_ext WHERE NO_CLIENTE='$noCliente' AND ID_ORDENT LIKE '".$noCliente."$TypeReportFumi%' AND ID_OBJETO <> ''"; $recReport = $db->combo($QuerySearchReport);
									$Id=1;	 $i=0;		
									if($TypeReportFumi=='LAM'){
										while ($rowOrdenT = $recOrdenDeT->fetch_assoc()) {		
											$array[$i]= array(
												"Id" => "$Id",
												"Ubicacion" => $rowOrdenT['UBICACION'],
												"Mosquito" => '',
												"Mosca" => '',
												"Palomilla" => '',
												"Escarabajo" => '',
												"Limpieza" => '',
												"Estatus" => '',
												"Obser" => ''
											);
											$Id++;
										}
									}else{
										while ($rowOrdenT = $recOrdenDeT->fetch_assoc()) {			
											$array[$i]= array(
												"Id" => "$Id",
												"Ubicacion" => $rowOrdenT['UBICACION'],
												"Consumo" => '',
												"Limpieza" => '',
												"Estatus" => '',
												"Obser" => ''
											);
											$Id++;
											$i++;
										}
									}
									
									$arr_clientes = array(
										"rows" => $array			
									);  //Creamos el JSON
									$json_string = json_encode($arr_clientes); 
									file_put_contents($getRutaJson, $json_string);
									$Query1 ="DELETE FROM ordent_ext WHERE NO_FOLIO='$getNoFolio'"; $db->query($Query1);
									$Query2 ="DELETE FROM valid_modulo WHERE ID_VALID='$getNoFolio'"; $db->query($Query2);
									
									echo $ReportResultFinal = $ResultFinal.' # # # # # # # # # '.$getRutaJson.' # # ';
									break;
									
								$count2 = 0;
							}else{
								$countRefac = 0;
								while($rowRefac = $recOrdenDeTRefac->fetch_assoc()) {
									$countRefac++;
									$ID_REFACCIONES[]=$rowRefac['ID_REFACCIONES'];
									$PIEZAS_REFACCION[]=$rowRefac['PIEZAS_REFACCION'];
								}
								$ID_REFAC_IMPLOD = implode(",", $ID_REFACCIONES);
								$ID_PIEZ_IMPLOD = implode(",", $PIEZAS_REFACCION);
								$count2 = 0;
								while ($rowOrdenT = $recOrdenDeT->fetch_assoc()) {
									$count2++;
									$NO_FOLIO=$rowOrdenT['NO_FOLIO'];
									$FECHA_RECOLECT=$rowOrdenT['FECHA_RECOLECT'];
									$FECHA_ENTREGA=$rowOrdenT['FECHA_ENTREGA'];
									$TYPE_SERVICE=$rowOrdenT['TYPE_SERVICE'];
									$CANTIDAD_MANGUE=$rowOrdenT['CANTIDAD_MANGUE'];
									$SERVICIO_MANGUE=$rowOrdenT['SERVICIO_MANGUE'];
									$PH_MANGUE=$rowOrdenT['PH_MANGUE'];
									$EXTE_PRESTADOS=$rowOrdenT['EXTE_PRESTADOS'];
									$EXTE_RECOLECT=$rowOrdenT['EXTE_RECOLECT'];
									$EXTE_FALTANTES=$rowOrdenT['EXTE_FALTANTES'];
									$CANTIDAD_AA=$rowOrdenT['CANTIDAD_AA'];
									$SERVICIO_AA=$rowOrdenT['SERVICIO_AA'];
									$PH_AA=$rowOrdenT['PH_AA'];
									$TECNICO_APLICADOR=$rowOrdenT['TECNICO_APLICADOR'];
									$RUTA_JSON=$rowOrdenT['RUTA_JSON'];
									$RUTA_PDF=$rowOrdenT['RUTA_PDF'];
									$CLIENTE_VALID=$rowOrdenT['CLIENTE_VALID'];
									$NEXTSTEP_POLIZA=$rowOrdenT['NEXTSTEP_POLIZA'];
									$NEXTSTEP_PH=$rowOrdenT['NEXTSTEP_PH'];
									$NEXTSTEP_CHECKLIST=$rowOrdenT['NEXTSTEP_CHECKLIST'];
									if($TECNICO_APLICADOR==''){}else{
										$sqlIdTables = "SELECT ID FROM alta_tecnico_aplicador WHERE NOMBRE='$TECNICO_APLICADOR' limit 1"; $stmtArea = $db->combo($sqlIdTables);
										while ($fila = $stmtArea->fetch_assoc()) { @$TECNICO_APLICADOR=$fila["ID"]; }
									}
									$RESPONSABLE_AREA=$rowOrdenT['RESPONSABLE_AREA'];
									if($RESPONSABLE_AREA==''){}else{
										$sqlIdTables = "SELECT ID FROM altas_responsable_area WHERE NOMBRE='$RESPONSABLE_AREA' limit 1"; $stmtArea = $db->combo($sqlIdTables);
										while ($fila = $stmtArea->fetch_assoc()) { @$RESPONSABLE_AREA=$fila["ID"]; }
									}
									$AREA_ADMINISTRACION=$rowOrdenT['AREA_ADMINISTRACION'];
									if($AREA_ADMINISTRACION==''){}else{
										$sqlIdTables = "SELECT ID FROM alta_area_administracion WHERE NOMBRE='$AREA_ADMINISTRACION' limit 1"; $stmtArea = $db->combo($sqlIdTables);
										while ($fila = $stmtArea->fetch_assoc()) { @$AREA_ADMINISTRACION=$fila["ID"]; }
									}
								}
							}
					}
					
					if (@$count2>0){
						$SQL0 = "SELECT * FROM valid_modulo WHERE ID_VALID='$NO_FOLIO'";
						$rowss = $db->select($SQL0);
						@$VALID = $rowss[0]['VALID'];
						if(@$rowss[0]['ID_VALID'] !=''){  $VALID = 'true'; }
						 echo $ReportResultFinal = $ResultFinal.' # '.$FECHA_RECOLECT.' # '.$FECHA_ENTREGA.' # '.$TYPE_SERVICE.' # '.$CANTIDAD_MANGUE.' # '.$SERVICIO_MANGUE.' # '.$PH_MANGUE.' # '.$EXTE_PRESTADOS.' # '.$EXTE_RECOLECT.' # '.$EXTE_FALTANTES.' # '.$CANTIDAD_AA.' # '.$SERVICIO_AA.' # '.$PH_AA.' # '.$TECNICO_APLICADOR.' # '.$RESPONSABLE_AREA.' # '.$AREA_ADMINISTRACION.' # '.$NO_FOLIO.' # '.$VALID.' # '.$getRutaJson.' # '.$RUTA_PDF.' # '.$CLIENTE_VALID.' # '.$NEXTSTEP_POLIZA.' # '.$NEXTSTEP_PH.' # '.$NEXTSTEP_CHECKLIST.' # '.$ID_REFAC_IMPLOD.' # '.$ID_PIEZ_IMPLOD;
					}else{
						// echo $ResultFinal.' # # # # # # # # # '.$getRutaJson.' # # ';
						echo $ResultFinal;
					}
					
				break;
			case "PolizaGarantia":
					
					$QuerySearchOrden = "SELECT * FROM poliza_ext WHERE NO_CLIENTE='$noCliente' AND ID_PG_PH LIKE '".$noCliente."%$TypeReportFumi' GROUP BY NO_CLIENTE";
					$recOrdenDeT = $db->combo($QuerySearchOrden);
						$getRutaJson = "../../repositorio/DataJson/DataExtintores/PolizaGarantia/$txtSucu/dataReport$noCliente.json";
					if($recOrdenDeT->num_rows >=1 ){
						$QuerySearchOrdenStore = "SELECT FECHA_REGISTRO,NO_FOLIO,RUTA_JSON FROM poliza_ext WHERE NO_CLIENTE='$noCliente' AND ID_PG_PH LIKE '".$noCliente."%$TypeReportFumi' GROUP BY NO_CLIENTE";
						$recOrdenStore = $db->select($QuerySearchOrdenStore);
						$fecha_entrada = new DateTime($recOrdenStore[0]["FECHA_REGISTRO"]);
						$getNoFolio = $recOrdenStore[0]["NO_FOLIO"];
						$DiffDateTime = $fecha_actual->diff($fecha_entrada);
							
								$count2 = 0;
								while ($rowOrdenT = $recOrdenDeT->fetch_assoc()) {
									$count2++;
									$NO_FOLIO=$rowOrdenT['NO_FOLIO'];
									$EXAMEN_VISUAL=$rowOrdenT['EXAMEN_VISUAL'];
									$MEDIO_PRUEBA=$rowOrdenT['MEDIO_PRUEBA'];
									$PRESION_OPERACION=$rowOrdenT['PRESION_OPERACION'];
									$PRESION_PRUEBA=$rowOrdenT['PRESION_PRUEBA'];
									$DURACION_PRUEBA=$rowOrdenT['DURACION_PRUEBA'];
									$OBSERV_POLIZA=$rowOrdenT['OBSERV_POLIZA'];
									$TECNICO_APLICADOR=$rowOrdenT['TECNICO_APLICADOR'];
									$RUTA_JSON=$rowOrdenT['RUTA_JSON'];
									$RUTA_PDF=$rowOrdenT['RUTA_PDF'];
									$RUTA_PDF_PH=$rowOrdenT['RUTA_PDF_PH'];
									$CLIENTE_VALID=$rowOrdenT['CLIENTE_VALID'];
									if($TECNICO_APLICADOR==''){}else{
										$sqlIdTables = "SELECT ID FROM alta_tecnico_aplicador WHERE NOMBRE='$TECNICO_APLICADOR' limit 1"; $stmtArea = $db->combo($sqlIdTables);
										while ($fila = $stmtArea->fetch_assoc()) { @$TECNICO_APLICADOR=$fila["ID"]; }
									}
									$RESPONSABLE_AREA=$rowOrdenT['RESPONSABLE_AREA'];
									if($RESPONSABLE_AREA==''){}else{
										$sqlIdTables = "SELECT ID FROM altas_responsable_area WHERE NOMBRE='$RESPONSABLE_AREA' limit 1"; $stmtArea = $db->combo($sqlIdTables);
										while ($fila = $stmtArea->fetch_assoc()) { @$RESPONSABLE_AREA=$fila["ID"]; }
									}
									$AREA_ADMINISTRACION=$rowOrdenT['AREA_ADMINISTRACION'];
									if($AREA_ADMINISTRACION==''){}else{
										$sqlIdTables = "SELECT ID FROM alta_area_administracion WHERE NOMBRE='$AREA_ADMINISTRACION' limit 1"; $stmtArea = $db->combo($sqlIdTables);
										while ($fila = $stmtArea->fetch_assoc()) { @$AREA_ADMINISTRACION=$fila["ID"]; }
									}
								}
							
					}
					
					if (@$count2>0){
						$SQL0 = "SELECT * FROM valid_modulo WHERE ID_VALID='$NO_FOLIO'";
						$rowss = $db->select($SQL0);
						@$VALID = $rowss[0]['VALID'];
						if(@$rowss[0]['ID_VALID'] !=''){  $VALID = 'true'; }
						 echo $ReportResultFinal = $ResultFinal.' # '.$EXAMEN_VISUAL.' # '.$MEDIO_PRUEBA.' # '.$PRESION_OPERACION.' # '.$PRESION_PRUEBA.' # '.$DURACION_PRUEBA.' # '.$OBSERV_POLIZA.' # '.$TECNICO_APLICADOR.' # '.$RESPONSABLE_AREA.' # '.$AREA_ADMINISTRACION.' # '.$NO_FOLIO.' # '.$VALID.' # '.$getRutaJson.' # '.$RUTA_PDF.' # '.$RUTA_PDF_PH.' # '.$CLIENTE_VALID;
					}else{
						$QuerySearchArea = "SELECT * FROM ordent_ext WHERE NO_CLIENTE='$noCliente' AND ID_ORDENT LIKE '".$noCliente."OT' GROUP BY NO_CLIENTE";
							$recAreas = $db->select($QuerySearchArea);
							@$TECNICO_APLICADOR = $recAreas[0]['TECNICO_APLICADOR'];																			
							if($TECNICO_APLICADOR==''){}else{
								$sqlIdTables = "SELECT ID FROM alta_tecnico_aplicador WHERE NOMBRE='$TECNICO_APLICADOR' limit 1"; $stmtArea = $db->combo($sqlIdTables);
								while ($fila = $stmtArea->fetch_assoc()) { @$TECNICO_APLICADOR=$fila["ID"]; }
							}
							$RESPONSABLE_AREA=$recAreas[0]['RESPONSABLE_AREA'];
							if($RESPONSABLE_AREA==''){}else{
								$sqlIdTables = "SELECT ID FROM altas_responsable_area WHERE NOMBRE='$RESPONSABLE_AREA' limit 1"; $stmtArea = $db->combo($sqlIdTables);
								while ($fila = $stmtArea->fetch_assoc()) { @$RESPONSABLE_AREA=$fila["ID"]; }
							}
							$AREA_ADMINISTRACION=$recAreas[0]['AREA_ADMINISTRACION'];
							if($AREA_ADMINISTRACION==''){}else{
								$sqlIdTables = "SELECT ID FROM alta_area_administracion WHERE NOMBRE='$AREA_ADMINISTRACION' limit 1"; $stmtArea = $db->combo($sqlIdTables);
								while ($fila = $stmtArea->fetch_assoc()) { @$AREA_ADMINISTRACION=$fila["ID"]; }
							} 
						 
						// echo $ResultFinal.' # # # # # # # # # '.$getRutaJson.' # # ';
						echo $ResultFinal.' # # # # # # # '.$TECNICO_APLICADOR.' # '.$RESPONSABLE_AREA.' # '.$AREA_ADMINISTRACION;
					}
					
				break;
			case "CheckList":
					
					$QuerySearchCheck = "SELECT * FROM checklist_ext WHERE NO_CLIENTE='$noCliente' AND ID_CHECKLIST LIKE '".$noCliente."%$TypeReportFumi' GROUP BY NO_CLIENTE";
					$recOrdenDeT = $db->combo($QuerySearchCheck);
						$getRutaJson = "../../repositorio/DataJson/DataExtintores/CheckList/$txtSucu/dataReport$noCliente.json";
					if($recOrdenDeT->num_rows >=1 ){
						$QuerySearchOrdenStore = "SELECT FECHA_REGISTRO,NO_FOLIO,RUTA_JSON FROM checklist_ext WHERE NO_CLIENTE='$noCliente' AND ID_CHECKLIST LIKE '".$noCliente."%$TypeReportFumi' GROUP BY NO_CLIENTE";
						$recOrdenStore = $db->select($QuerySearchOrdenStore);
						$fecha_entrada = new DateTime($recOrdenStore[0]["FECHA_REGISTRO"]);
						$getNoFolio = $recOrdenStore[0]["NO_FOLIO"];
						$DiffDateTime = $fecha_actual->diff($fecha_entrada);
							
							$count2 = 0;
							while ($rowOrdenT = $recOrdenDeT->fetch_assoc()) {
								$count2++;
								$NO_FOLIO=$rowOrdenT['NO_FOLIO'];
								$FECHA_CHECKLIST=$rowOrdenT['FECHA_CHECKLIST'];
								$NUM_EXT_LIBE=$rowOrdenT['NUM_EXT_LIBE'];
								$OBSERVATION=$rowOrdenT['OBSERVATION'];
								$AREA_OPERATIVA=$rowOrdenT['AREA_OPERATIVA'];									
								$RUTA_JSON=$rowOrdenT['RUTA_JSON'];
								$RUTA_PDF=$rowOrdenT['RUTA_PDF'];																		
							}						
					}
					
					if (@$count2>0){						
						 echo $ReportResultFinal = $ResultFinal.' # '.$NUM_EXT_LIBE.' # '.$FECHA_CHECKLIST.' # '.$OBSERVATION.' # '.$AREA_OPERATIVA.' # '.$RUTA_JSON.' # '.$RUTA_PDF.' # '.$NO_FOLIO;
					}else{						
						echo $ResultFinal;
					}
					
				break;
			default:
				echo $ResultFinal;
		}
		
	}
	else{}

}else{
	echo 'vacio';
}?>
