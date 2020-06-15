<?php



function capturaPersonalesIncidencias(){

return "<div id=\"home\" class=\"tab-pane active\">
			<div class=\"row\">
				<div class=\"col-xs-12 col-sm-3 center\">
				<div class=\"space space-4\"></div>
				
					<span class=\"profile-picture\">
<img class=\"editable img-responsive\" style=\"width: 200px;border-radius: 50%;\" alt=\"Servidor Público\" id=\"avatar2\" src=\"../css/assets/images/avatars/profile-pic.jpg\">
					</span>

					<div class=\"space space-4\"></div>


				</div><!-- /.col -->

				<div class=\"col-xs-12 col-sm-9\">








							   <div class=\"bs-example tabs-container with-nav-tabs panel-success\">									
									<div class=\"form-group form-group-sm\">
										<label class=\"control-label col-xs-2\">Unidad Responsable:</label>
										<div class=\"col-xs-3 control-label-txtEstado\">
											<input type=\"text\" id=\"txtEstado\" name=\"txtEstado\" class=\"form-control txtEstado text-uppercase\" disabled>
										</div>
										<label class=\"control-label col-xs-3\">Unidad Responsable:</label>
										<div class=\"col-xs-4\">
											
											<input type=\"text\" id=\"txtUrDesc\" name=\"txtUrDesc\" class=\"form-control txtUrDesc text-uppercase\" disabled>

										</div>
									</div>								

									<div class=\"form-group form-group-sm\">
										<label class=\"control-label col-xs-2\">CURP:</label>
										<div class=\"col-xs-3 control-label-txtCURP\">
											<input type=\"text\" id=\"txtCURP\" name=\"txtCURP\" class=\"form-control txtCURP text-uppercase\" disabled >
										</div>
										<label class=\"control-label col-xs-3\">RFC</label>
										<div class=\"col-xs-4 control-label-txtRFC\">
											<input type=\"text\" id=\"txtRFC\" name=\"txtRFC\" class=\"form-control txtRFC text-uppercase\" pattern=\"[A-Z]\" disabled >
										</div>
									</div>


									<div class=\"form-group form-group-sm\">
										<label class=\"control-label col-xs-2\">Nombre:</label>
										<div class=\"col-xs-3 control-label-txtNombre\">
											<input type=\"text\" id=\"txtNombre\" name=\"txtNombre\" class=\"form-control txtNombre text-uppercase\" disabled >
										</div>
										<label class=\"control-label col-xs-3\">Rama:</label>
										<div class=\"col-xs-4 control-label-txtRama\">
											<input type=\"text\" id=\"txtRama\" name=\"txtRama\" class=\"form-control txtRama text-uppercase\" pattern=\"[A-Z]\" disabled >
										</div>
									</div>




									<div class=\"form-group form-group-sm\">
										<label class=\"control-label col-xs-2\">Codigo de Puesto:</label>
										<div class=\"col-xs-3 control-label-txtCoP\">
											<input type=\"text\" id=\"txtCoP\" name=\"txtCoP\" class=\"form-control txtCoP text-uppercase\" disabled>
										</div>
										<label class=\"control-label col-xs-3\">Descripcion:</label>
										<div class=\"col-xs-4 control-label-txtDescrip\">
											<input type=\"text\" id=\"txtDescrip\" name=\"txtDescrip\" class=\"form-control txtDescrip text-uppercase\" pattern=\"[A-Z]\" disabled>
										</div>
									</div>




									<div class=\"form-group form-group-sm\">
										<label class=\"control-label col-xs-2\">Movimiento:</label>
										<div class=\"col-xs-3 control-label-txtCoP\">

										<select class=\"form-control\" id=\"listaMovimientos\">
										    <option values=2201 >2201-Licencia o prorroga sin goce de sueldo por asuntos particulares</option>
										    <option>8001-Descuento por faltas injustificadas</option>
										    <option>8002-Suspensión por sanción disciplinaria</option>
										    <option>9201-Prima dominical</option>
										    <option>9204-Pago estimulo trimestral</option>
										    <option>9205-Pago de estímulo anua</option>
										    <option>9207-Asistencia perfecta</option>
										    <option>9303-Pago de tesis</option>
										  </select>



										</div>
										<label class=\"control-label col-xs-3\">Numero:</label>
										<div class=\"col-xs-4 control-label-txtDescrip\">
											<input type=\"text\" id=\"txtOcurrencias\" name=\"txtOcurrencias\" class=\"form-control txtOcurrencias text-uppercase\" pattern=\"[0-9]\" >
										</div>
									</div>







									<div class=\"form-group form-group-sm\">
								
























				</div><!-- /.col -->
			</div><!-- /.row -->

			<div class=\"space-20\"></div>

		</div>
";

}// fin de capturaPersonales


?>
