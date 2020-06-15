<?php
require("../general/ac_db_inc.php");
$dbOracle = new DbOracle("test_db", "JaviSoft");

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
					//echo "UPDATE plan_plantilla SET total_plazas = $getTotalP WHERE estado='$getEstado' and unidad='$getIdUR' and nivel='$getNivel' and codigo_puesto='$getCoP'";	
				$sql = "UPDATE plan_plantilla SET total_plazas = $getTotalP WHERE estado='$getEstado' and unidad='$getIdUR' and nivel='$getNivel' and codigo_puesto='$getCoP'";
				$res = $dbOracle->execute($sql, "Query Example");
		BREAK;
		case "Search":				
				if(isset($_REQUEST["inputSearchBlock"]))
				{ ?>
					<div class="container">
						<div class="row"><?php
							$search = strtoupper($_REQUEST["inputSearchBlock"]);
							$sql = "SELECT cu.descripcion as descripunidad,cp.descripcion,pa.* FROM plan_plantilla pa, cat_puestos cp, cat_ur cu WHERE pa.codigo_puesto=cp.codigo and pa.unidad=cu.ur and (pa.estado LIKE '%$search%' OR pa.unidad LIKE '%$search%' OR pa.nivel LIKE '%$search%' OR pa.codigo_puesto LIKE '%$search%') ORDER BY pa.unidad OFFSET 1 ROWS FETCH NEXT 9 ROWS ONLY";
							$res = $dbOracle->execFetchAll($sql, "Query Example");							
							$count = 0;						
								foreach ($res as $row) { ?>
									<div class="[ col-sm-4 ]">
										<div class="[ panel panel-default ] panel-google-plus">
											<div class="panel-google-plus-tags" id="tagsEdit" dataEstado="<?php echo $row['ESTADO'];?>" dataURId="<?php echo $row['UNIDAD'];?>" dataUR="<?php echo $row['DESCRIPUNIDAD'];?>" dataCoP="<?php echo $row['CODIGO_PUESTO'];?>" dataDescrip="<?php echo $row['DESCRIPCION'];?>" dataNivel="<?php echo $row['NIVEL'];?>" dataTotalP="<?php echo $row['TOTAL_PLAZAS'];?>">
												<ul>
													<li>Editar</li>
												</ul>
											</div>
											<div class="panel-heading">

<!--												
												<span class="[ img-circle pull-left ] fa fa-user-md fa-3x" style="color:#1ab394;margin-top:-10px;" id="" alt="Mouse0270" ></span>
-->	
							
							<img alt="image" class=" pull-left img-circle" src="../images/empleados/<?php echo $count ?>.jpg" style="  width: 45px;">
												<h5><?php echo $row['DESCRIPUNIDAD'];?></h5>
												<!--h5><span>Shared publicly</span> - <span>Jun 27, 2014</span> </h5-->
							
												
											</div>
											<div class="panel-body"><BR>
												<div class="row" style="color:#21544a;">
													<p class="col-sm-12">Codigo de Puesto: <i style="font-weight: 500;"><?php echo $row['CODIGO_PUESTO'];?></i></p>
													<p class="col-sm-12">Descripcion: <i style="font-weight:500;font-size:12px;"><?php echo strtolower($row['DESCRIPCION']);?></i></p>
												</div>
												<div class="row" style="color:#21544a;">
													<p class="col-sm-5 col-lg-offset-2">Total de plazas:  <i style="font-weight: 500;"> <?php echo $row['TOTAL_PLAZAS'];?> </i> </p>
													<p class="col-sm-5">Nivel:  <i style="font-weight: 500;"> <?php echo $row['NIVEL'];?> </i></p>
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

