<?php
session_start();

putenv("ORACLE_HOME=/u01/app/oracle/product/11.2.0/xe");
putenv("LD_LIBRARY_PATH=/u01/app/oracle/product/11.2.0/xe/lib:/ipc/Informatica/9.5.1/server/bin:/oradev/instantclient_12_1");
include "../general/generales.inc";
require("../general/ac_db_inc.php");

require("ee_busqueda_sp.inc");
$dbOracle = new DbOracle("test_db", "Movi");

$UR="ssamx_debug_ur";
if(isset($_SESSION['ur']))
		$UR = $_SESSION['ur'] ;

switch($_REQUEST['action']) {
		case "Insert":				
				$getTotalP = $_REQUEST["getTotalP"];						
				$getEstado = $_REQUEST["getEstado"];						
				$getNivel = $_REQUEST["getNivel"];	
				$getCoP = strtoupper($_REQUEST["getCoP"]);	
				$getIdUR = $_REQUEST["getIdUR"];	
				$getDescrip = $_REQUEST["getDescrip"];	
					// echo $getTotalP;
					// echo $getEstado;
					// echo $getNivel;
					// echo $getCoP;
					// echo $getIdUR;
				 // $sql = "INSERT INTO plan_plantilla (ESTADO,UNIDAD,NIVEL,CODIGO_PUESTO,TOTAL_PLAZAS,FCH_PROCESO,FCH_CARGA) VALUES ('$getEstado', '$getIdUR', '$getNivel', '$getCoP', '$getTotalP' ,SYSDATE-TO_DATE(),SYSDATE-TO_DATE())";
				 $sql = "INSERT INTO plan_plantilla (ESTADO,UNIDAD,NIVEL,CODIGO_PUESTO,TOTAL_PLAZAS,FCH_PROCESO,FCH_CARGA) VALUES ('$getEstado', '$getIdUR', '$getNivel', '$getCoP', $getTotalP,SYSDATE,SYSDATE)";
				 $sql2 = "INSERT INTO cat_puestos (CODIGO,DESCRIPCION,CORTA) VALUES ('$getCoP', '$getDescrip', '$getDescrip')";
				 // ECHO $sql;
				$res = $dbOracle->execute($sql, "Query Example");	   
				$res2 = $dbOracle->execute($sql2, "Query Example");	   
		BREAK;
		case "Update":




				$getTotalP = $_REQUEST["getTotalP"];						
				$getEstado = $_REQUEST["getEstado"];						
				$getNivel = $_REQUEST["getNivel"];	
				$getCoP = $_REQUEST["getCoP"];	
				$getIdUR = $_REQUEST["getIdUR"];	
				
				$Res = buscarMovimiento($CveMvto, $Rfc, $Qna, $Anio, $CodPuesto, $TipoFOMOPE, $UR);

					//echo "UPDATE plan_plantilla SET total_plazas = $getTotalP WHERE estado='$getEstado' and unidad='$getIdUR' and nivel='$getNivel' and codigo_puesto='$getCoP'";	
				$sql = "UPDATE plan_plantilla SET total_plazas = $getTotalP WHERE estado='$getEstado' and unidad='$getIdUR' and nivel='$getNivel' and codigo_puesto='$getCoP'";

				$res = $dbOracle->execute($sql, "Query Example");
				
				echo "getTotalP >$getTotalP< <br>";
				echo "getEstado >$getEstado< <br>";
				echo "getNivel >$getNivel< <br>";
				echo "getCoP >$getCoP< <br>";
				echo "getIdUR >$getIdUR< <br>";
				echo "Ingresando movimientos..";
				print_r($_SESSION);

		BREAK;
		case "Search":				
				if(isset($_REQUEST["inputSearchBlock"]))
				{ 


					?>
					<div class="container">
						<div class="row">
					<?php



							$search = strtoupper($_REQUEST["inputSearchBlock"]);
							$sql = preparaConsulta($search, $UR);
							$res = $dbOracle->execFetchAll($sql, "Query Example");							
							$count = 0;						
								foreach ($res as $row) { 

									$CURP=$row['CURP'];
									$Sexo = strtoupper(substr($CURP, 10,1));

									$Archivo = "../images/empleados/$CURP.jpg";
									if (!file_exists($Archivo)) {
										 if($Sexo == 'M')
										 	 $Archivo = "../images/mujer.jpg";
										 else
										 	$Archivo = "../images/corporate-researcher-color.png";
									}




						?>
									<div class="[ col-sm-4 ]">
										<div class="[ panel panel-default ] panel-google-plus">
	<div class="panel-google-plus-tags" id="tagsEdit" dataEstado="<?php echo "$UR";?>" dataURId="<?php echo $row['DESCRIPCION_UR'];?>" dataUR="<?php echo $UR ;?>" dataCoP="<?php echo $row['PUESTO'];?>" dataDescrip="<?php echo $row['DESCRIPCION_PUESTO'];?>" dataNivel="<?php echo "SSAMX_NIVEL";?>" dataTotalP="<?php echo "SSAMX_TOTAL_PLAZAS";?>" dataCURP="<?php echo $row['CURP'];?>" dataRFC="<?php echo $row['RFC'];?>"  dataImagen="<?php echo $Archivo;?>" dataNombre="<?php echo $row['NOMBRE'];?>" dataRama="<?php echo $row['RAMA'];?>">
												<ul>
													<li>Editar</li>
												</ul>
											</div>
											<div class="panel-heading">

<!--												
												<span class="[ img-circle pull-left ] fa fa-user-md fa-3x" style="color:#1ab394;margin-top:-10px;" id="" alt="Mouse0270" ></span>
-->			

							<img alt="image" class=" pull-left img-circle" src="<?php echo $Archivo ?>" style="  width: 45px;">
												<h5><?php echo $row['RFC'];?></h5>
												<h5><?php echo $row['NOMBRE'];?></h5>
												<!--h5><span>Shared publicly</span> - <span>Jun 27, 2014</span> </h5-->
							
												
											</div>
											<div class="panel-body"><BR>
												<div class="row" style="color:#21544a;">
													<p class="col-sm-12">Codigo de Puesto: <i style="font-weight: 500;"><?php echo $row['PUESTO'];?></i></p>
													<p class="col-sm-12">Descripción: <i style="font-weight:500;font-size:12px;"><?php echo $row['DESCRIPCION_PUESTO'];?></i></p>
												</div>
												<div class="row" style="color:#21544a;">
													<p class="col-sm-7 "> Rama:  <i style="font-weight: 500;"> <?php echo $row['RAMA'];?> </i> </p>
													<p class="col-sm-5">Num. Empleado:  <i style="font-weight: 500;"> <?php echo $row['NUEMP'];?> </i></p>
												</div>
											</div>
										</div>
									</div> <?php $count++;
								} 
							if($count > 0){ }else{ echo '<div class="[ col-sm-4 col-lg-offset-4 text-center ]" style="margin-top:6%"><h1 style="color:#f5f5f5">No hay resultados...</h1></div>'; } ?>			
						</div>
					</div><?php }		   
		BREAK;
	}

