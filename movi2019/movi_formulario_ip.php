<?php
function capturaAprobacion(){

return "

<script>

var BanderaAprobacion=0;

$('label').click(function(){
	var Item = event.target.id;
	console.log('Item >'+Item+'<');
	console.log('Item >'+$(Item)+'<');


});


$('#btn-aprobar').click(function(){
            var IdARef = event.target.id;
            var Demo = new RegExp(/^idemo-cedula/);
           console.log('a ref >>'+ IdARef +'<<');

           

           	$.confirm({
                icon: 'fa fa-check-circle fa-2x',
                title: 'Sistema de Movimientos de Personal',
                content: 'url:smweb_spc_aprobar.php',
                columnClass: 'medium',
                animationSpeed:800,
                animationBounce:1,
                animation: 'zoom',
                closeAnimation: 'zoom',
                 animationBounce: 1.5,
                animateFromElement: false,
                theme: 'material',
                type: 'green',
                buttons: {
                    Aceptar: {
                         btnClass: 'btn-green',
                         action:function () {
                        }
                    }
                }
            });

           

    });


$('#btn-comentar').click(function(){
            var IdARef = event.target.id;
            var Demo = new RegExp(/^idemo-cedula/);
           console.log('a ref >>'+ IdARef +'<<');

           

           	$.confirm({
                icon: 'fa fa-check-circle fa-2x',
                title: 'Sistema de Movimientos de Personal',
                content: 'url:smweb_spc_comentario.php',
                columnClass: 'medium',
                animationSpeed:800,
                animationBounce:1,
                animation: 'zoom',
                closeAnimation: 'zoom',
                 animationBounce: 1.5,
                animateFromElement: false,
                theme: 'material',
                type: 'orange',
                buttons: {
                    Aceptar: {
                         btnClass: 'btn-green',
                         action:function () {
                        }
                    }
                }
            });

           

    });

$('#btn-cancelar').click(function(){
            var IdARef = event.target.id;
            var Demo = new RegExp(/^idemo-cedula/);
           console.log('a ref >>'+ IdARef +'<<');

           

           	$.confirm({
                icon: 'fa fa-check-circle fa-2x',
                title: 'Sistema de Movimientos de Personal',
                content: 'url:smweb_spc_cancelar.php',
                columnClass: 'medium',
                animationSpeed:800,
                animationBounce:1,
                animation: 'zoom',
                closeAnimation: 'zoom',
                 animationBounce: 1.5,
                animateFromElement: false,
                theme: 'material',
                type: 'red',
                buttons: {
                    Aceptar: {
                         btnClass: 'btn-green',
                         action:function () {
                        }
                    }
                }
            });

           

    });


</script>



<div id=\"home\" class=\"tab-pane active\">
			<div class=\"row\">
				<div class=\"col-xs-12 col-sm-2 center\">
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>


		<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>										
								<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>

					<span class=\"\">

											
<i class=\"ace-icon fa fa-check-circle  big-icon\"></i>

					</span>




				</div><!-- /.col -->

				<div class=\"col-xs-12 col-sm-10\">
					<h4 class=\"blue\">
						<span class=\"middle\"> </span>

				
					</h4>




















					<div class=\"profile-user-info\">

						<div class=\"profile-info-row\">
												<div class=\"profile-info-name blue\"> Personales</div>

												<div class=\"profile-info-value col-xs-6 \">
													<span>
					

<label id=\"switch-p\">
												<input id=\"iswitch-p\" name=\"switch-field-1\" class=\"green  ace ace-switch ace-switch-6 \" type=\"checkbox\">
														<span class=\"lbl\"></span>
													</label>




													</span>
												</div>
											</div>

						<div class=\"profile-info-row\">
												<div class=\"profile-info-name blue\"> Contacto </div>

												<div class=\"profile-info-value col-xs-6 \">
													<span>


<label id=\"switch-c\">
														<input id=\"iswitch-c\" name=\"switch-field-1\" class=\"ace ace-switch ace-switch-6\" type=\"checkbox\">
														<span class=\"lbl\"></span>
													</label>




													</span>
												</div>
											</div>




						<div class=\"profile-info-row\">
							<div class=\"profile-info-name blue\"> Documentos</div>

							<div class=\"profile-info-value col-xs-6 \">
								<span>





								</span>
							</div>
						</div>

						<div class=\"profile-info-row\">
							<div class=\"profile-info-name blue\"> Clave de Pago</div>

							<div class=\"profile-info-value  col-xs-6 \">
								<span>


<label id=\"switch-cl\">
														<input id=\"iswitch-cl\" name=\"switch-field-1\" class=\"ace ace-switch ace-switch-6\" type=\"checkbox\">
														<span class=\"lbl\"></span>
													</label>



								</span>
							</div>
						</div>




					</div>

					<div class=\"hr hr-8 dotted\"></div>

					<div class=\"profile-user-info\">






							<div class=\"col-xs-12\">

							<div class=\"col-xs-2\">
										<a id=\"btn-aprobar\" href=\"#\" class=\"btn btn-app btn-success disabled\">
											<i class=\"ace-icon fa fa-check-circle  bigger-230\"></i>
											Aprobar
										</a>
							</div>			
							<div class=\"col-xs-2\">			
										<button id=\"btn-comentar\" class=\"btn btn-app btn-warning\">
											<i class=\"ace-icon fa fa-pencil-square-o bigger-230\"></i>
											Comentario
										</button>
							</div>			
							<div class=\"col-xs-2\">			

										<button id=\"btn-cancelar\" class=\"btn btn-app btn-danger \">
											<i class=\"ace-icon fa fa-trash-o bigger-230\"></i>
											Cancelar
											</button>
							</div>	
							<div class=\"col-xs-6\">			
									</div>		
									</div>










					</div>
				</div><!-- /.col -->
			</div><!-- /.row -->


























			<div class=\"space-20\"></div>

		</div>

";
} // fin de function capturaAprobacion()




function capturaDocumentos(){

/** Base 
	http://www.ran.salud.gob.mx/movwebopc2/form-elements.html

**/

return "

<style>
img {
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 5px;
    width: 150px;
}

img:hover {
    box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
}
</style>

<script>

$('a').click(function(){
            var IdARef = event.target.id;
            var Demo = new RegExp(/^idemo-cedula/);
           console.log('a ref >>'+ IdARef +'<<');

           if(Demo.test(IdARef)){

           	$.confirm({
                icon: 'fa fa-search fa-2x',
                title: 'Sistema de Movimientos de Personal',
                content: 'url:smweb_demo_cedula.html',
                columnClass: 'medium',
                animationSpeed:800,
                animationBounce:1,
                animation: 'zoom',
                closeAnimation: 'zoom',
                 animationBounce: 1.5,
                animateFromElement: false,
                theme: 'material',
                type: 'blue',
                buttons: {
                    Aceptar: {
                         btnClass: 'btn-green',
                         action:function () {
                        }
                    }
                }
            });

           }// fin de  if(Demo.test(IdARef)){

    });

</script>




<div id=\"home\" class=\"tab-pane active\">
			<div class=\"row\">
				<div class=\"col-xs-12 col-sm-2 center\">
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>				
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>		
		<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>										
								<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>

					<span class=\"\">

											
<i class=\"ace-icon fa fa-paperclip big-icon\"></i>

					</span>




				</div><!-- /.col -->

				<div class=\"col-xs-12 col-sm-10\">
					<h4 class=\"blue\">
						<span class=\"middle\"> </span>

						<span class=\"label label-purple arrowed-in-right\">
							<i class=\"ace-icon fa fa-circle smaller-80 align-middle\"></i>
							Servidor Publico
						</span>
					</h4>

					<div class=\"profile-user-info\">

						<div class=\"profile-info-row\">
												<div class=\"profile-info-name blue\"> Acta de Nacimiento </div>

												<div class=\"profile-info-value col-xs-6 \">
													<span>
													<label id=\"switch-d\">
														<input id=\"iswitch-d\" name=\"switch-field-1\" class=\"ace ace-switch ace-switch-6\" type=\"checkbox\">
														<span class=\"lbl\"></span>
													</label>
<a target=\"_blank\" href=\"../images/demo_acta.jpg\">
  <img src=\"../images/demo_acta.jpg\" alt=\"Acta de Nacimiento\" style=\"width:150px\">
</a>




													</span>
													
												</div>
												<div class=\"profile-info-value col-xs-6 \">
													<span>				
												</div>
											</div>

						<div class=\"profile-info-row\">
												<div class=\"profile-info-name blue\"> Cedula Profesional </div>

												<div class=\"profile-info-value col-xs-6 \">
												<span>
													<label id=\"switch-d\">
														<input id=\"iswitch-d\" name=\"switch-field-1\" class=\"ace ace-switch ace-switch-6\" type=\"checkbox\">
														<span class=\"lbl\"></span>
													</label>
													<span>

					<a  id=\"demo-cedula\" href=\"#\" >
  						<img id=\"idemo-cedula\" src=\"../images/cemo_cedula.jpg\" alt=\"Cedula Profesional\" style=\"width:150px\">
					</a>

							
													</span>
												</div>
												<div class=\"profile-info-value col-xs-6 \">
													<span>
				
													</span>
												</div>
											</div>




						<div class=\"profile-info-row\">
							<div class=\"profile-info-name blue\"> Titulo</div>

							<div class=\"profile-info-value col-xs-6 \">
							<span>
													<label id=\"switch-d\">
														<input id=\"iswitch-d\" name=\"switch-field-1\" class=\"ace ace-switch ace-switch-6\" type=\"checkbox\">
														<span class=\"lbl\"></span>
													</label>
								<span>

					<a target=\"_blank\" href=\"../images/demo_titulo.jpg\">
  <img src=\"../images/demo_titulo.jpg\" alt=\"Cedula Profesional\" style=\"width:150px\">
</a>

								</span>
							</div>
							<div class=\"profile-info-value col-xs-6 \">
													<span>
				
													</span>
												</div>
						</div>

						<div class=\"profile-info-row\">
							<div class=\"profile-info-name blue\"> Comprobante Domicilio </div>

							<div class=\"profile-info-value  col-xs-6 \">
							<span>
													<label id=\"switch-d\">
														<input id=\"iswitch-d\" name=\"switch-field-1\" class=\"ace ace-switch ace-switch-6\" type=\"checkbox\">
														<span class=\"lbl\"></span>
													</label>
								<span>

					<a target=\"_blank\" href=\"../images/demo_cfe.jpg\">
  <img src=\"../images/demo_cfe.jpg\" alt=\"Comprobante Domicilio\" style=\"width:150px\">
</a>

								</span>
							</div>
							<div class=\"profile-info-value col-xs-6 \">
													<span>
				
													</span>
												</div>
						</div>


						<div class=\"profile-info-row\">
							<div class=\"profile-info-name blue\"> Identificación </div>

							<div class=\"profile-info-value  col-xs-6 \">
							<span>
													<label id=\"switch-d\">
														<input id=\"iswitch-d\" name=\"switch-field-1\" class=\"ace ace-switch ace-switch-6\" type=\"checkbox\">
														<span class=\"lbl\"></span>
													</label>
								<span>
					<a target=\"_blank\" href=\"../images/demo_ife.jpg\">
  <img src=\"../images/demo_ife.jpg\" alt=\"Identificación \" style=\"width:150px\">
</a>


								</span>
							</div>
							<div class=\"profile-info-value col-xs-6 \">
													<span>
				
													</span>
												</div>
						</div>

						<div class=\"profile-info-row\">
							
							<div class=\"profile-info-name blue \" > CURP 
							<span>

</span>
							</div>

							<div class=\"profile-info-value  col-xs-6 \">
							<label id=\"switch-d\">
														<input id=\"iswitch-d\" name=\"switch-field-1\" class=\"ace ace-switch ace-switch-6\" type=\"checkbox\">
														<span class=\"lbl\"></span>
													</label>
							
							
								
								<span>
					<a target=\"_blank\" href=\"../images/demo_curp.jpg\">
  <img src=\"../images/demo_curp.jpg\" alt=\"Identificación \" style=\"width:150px\">
</a>

								</span>
							</div>
							<div class=\"profile-info-value col-xs-6 \">
													<span>
			
													</span>
												</div>
						</div>



					</div>

					<div class=\"hr hr-8 dotted\"></div>

					<div class=\"profile-user-info\">


					</div>
				</div><!-- /.col -->
			</div><!-- /.row -->

			<div class=\"space-20\"></div>

		</div>


";

} // fin de capturaDocumentos

function capturaDomicilio(){

return "
<div id=\"home\" class=\"tab-pane active\">
			<div class=\"row\">
				<div class=\"col-xs-12 col-sm-2 center\">
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>				
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>		
		<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>										
								<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>

					<span class=\"\">

											
<i class=\"ace-icon fa fa-credit-card    big-icon\"></i>

					</span>




				</div><!-- /.col -->

				<div class=\"col-xs-12 col-sm-10\">
					<h4 class=\"blue\">
						<span class=\"middle\"> </span>

						<span class=\"label label-purple arrowed-in-right\">
							<i class=\"ace-icon fa fa-circle smaller-80 align-middle\"></i>
							CF41075 - Coordinador Paramedico en Area Normativa A
						</span>
					</h4>

					<div class=\"profile-user-info\">

						<div class=\"profile-info-row\">
												<div class=\"profile-info-name blue\"> Funcion
												
</div>

												<div class=\"profile-info-value col-xs-6 \">
													<span>
					

<label id=\"switch-p\">
<input id=\"iswitch-p\" name=\"switch-field-1\" class=\"green  ace ace-switch ace-switch-6 \" type=\"checkbox\">
<span class=\"lbl\">
<span>
					
<span class=\"label label-lg label-info arrowed arrowed-left\">3</span>

													</span>
</span>
													</label>




													</span>
												</div>
											</div>

						<div class=\"profile-info-row\">
												<div class=\"profile-info-name blue\"> Subfunción
												
</div>

												<div class=\"profile-info-value col-xs-6 \">
													<span>
					

<label id=\"switch-p\">
<input id=\"iswitch-p\" name=\"switch-field-1\" class=\"green  ace ace-switch ace-switch-6 \" type=\"checkbox\">
<span class=\"lbl\">
<span>
					
<span class=\"label label-lg label-info arrowed arrowed-left\">2</span>

													</span>
</span>
													</label>




													</span>
												</div>
											</div>



						<div class=\"profile-info-row\">
												<div class=\"profile-info-name blue\"> Grupo
												
</div>

												<div class=\"profile-info-value col-xs-6 \">
													<span>
					

<label id=\"switch-p\">
<input id=\"iswitch-p\" name=\"switch-field-1\" class=\"green  ace ace-switch ace-switch-6 \" type=\"checkbox\">
<span class=\"lbl\">
<span>
					
<span class=\"label label-lg label-info arrowed arrowed-left\">4</span>

													</span>
</span>
													</label>




													</span>
												</div>
											</div>

						<div class=\"profile-info-row\">
												<div class=\"profile-info-name blue\"> All
												
</div>

												<div class=\"profile-info-value col-xs-6 \">
													<span>
					

<label id=\"switch-p\">
<input id=\"iswitch-p\" name=\"switch-field-1\" class=\"green  ace ace-switch ace-switch-6 \" type=\"checkbox\">
<span class=\"lbl\">
<span>
					
<span class=\"label label-lg label-info arrowed arrowed-left\">001</span>

													</span>
</span>
													</label>




													</span>
												</div>
											</div>

						<div class=\"profile-info-row\">
												<div class=\"profile-info-name blue\"> PP
												
</div>

												<div class=\"profile-info-value col-xs-6 \">
													<span>
					

<label id=\"switch-p\">
<input id=\"iswitch-p\" name=\"switch-field-1\" class=\"green  ace ace-switch ace-switch-6 \" type=\"checkbox\">
<span class=\"lbl\">
<span>
					
<span class=\"label label-lg label-info arrowed arrowed-left\">I0001</span>

													</span>
</span>
													</label>




													</span>
												</div>
											</div>

						<div class=\"profile-info-row\">
												<div class=\"profile-info-name blue\"> UR
												
</div>

												<div class=\"profile-info-value col-xs-6 \">
													<span>
					

<label id=\"switch-p\">
<input id=\"iswitch-p\" name=\"switch-field-1\" class=\"green  ace ace-switch ace-switch-6 \" type=\"checkbox\">
<span class=\"lbl\">
<span>
					
<span class=\"label label-lg label-info arrowed arrowed-left\">513

													</span>
</span>
													</label>




													</span>
												</div>
											</div>

					</div>

					<div class=\"hr hr-8 dotted\"></div>

					<div class=\"profile-user-info\">


					</div>
				</div><!-- /.col -->
			</div><!-- /.row -->

			<div class=\"space-20\"></div>

		</div>

";
} // fin de function capturaDomicilio()



function capturaContacto(){

return "
<div id=\"home\" class=\"tab-pane active\">
			<div class=\"row\">
				<div class=\"col-xs-12 col-sm-2 center\">
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>
		<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>										
								<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>

					<span class=\"\">

											
<i class=\"ace-icon fa fa-at big-icon\"></i>

					</span>




				</div><!-- /.col -->

				<div class=\"col-xs-12 col-sm-10\">
					<h4 class=\"blue\">
						<span class=\"middle\"> </span>

						<span class=\"label label-purple arrowed-in-right\">
							<i class=\"ace-icon fa fa-circle smaller-80 align-middle\"></i>
							Servidor Publico
						</span>
					</h4>

					<div class=\"profile-user-info\">

						<div class=\"profile-info-row\">
												<div class=\"profile-info-name blue\"> Email
												
</div>

												<div class=\"profile-info-value col-xs-6 \">
													<span>
					

<label id=\"switch-p\">
<input id=\"iswitch-p\" name=\"switch-field-1\" class=\"green  ace ace-switch ace-switch-6 \" type=\"checkbox\">
<span class=\"lbl\">
<span>
					
<span class=\"label label-lg label-info arrowed arrowed-left\">noe.alvarez@salud.gob.mx</span>

													</span>
</span>
													</label>




													</span>
												</div>
											</div>
						<div class=\"profile-info-row\">
												<div class=\"profile-info-name blue\"> Oficina
												
</div>

												<div class=\"profile-info-value col-xs-6 \">
													<span>
					

<label id=\"switch-p\">
<input id=\"iswitch-p\" name=\"switch-field-1\" class=\"green  ace ace-switch ace-switch-6 \" type=\"checkbox\">
<span class=\"lbl\">
<span>
					
<span class=\"label label-lg label-info arrowed arrowed-left\">(55)50-60-16-00</span>

													</span>
</span>
													</label>




													</span>
												</div>
											</div>



						<div class=\"profile-info-row\">
												<div class=\"profile-info-name blue\"> Celular
												
</div>

												<div class=\"profile-info-value col-xs-6 \">
													<span>
					

<label id=\"switch-p\">
<input id=\"iswitch-p\" name=\"switch-field-1\" class=\"green  ace ace-switch ace-switch-6 \" type=\"checkbox\">
<span class=\"lbl\">
<span>
					
<span class=\"label label-lg label-info arrowed arrowed-left\">(722)22-45-131</span>

													</span>
</span>
													</label>




													</span>
												</div>
											</div>

						<div class=\"profile-info-row\">
												<div class=\"profile-info-name blue\"> Twitter
												
</div>

												<div class=\"profile-info-value col-xs-6 \">
													<span>
					

<label id=\"switch-p\">
<input id=\"iswitch-p\" name=\"switch-field-1\" class=\"green  ace ace-switch ace-switch-6 \" type=\"checkbox\">
<span class=\"lbl\">
<span>
					
<span class=\"label label-lg label-info arrowed arrowed-left\">@noealvarezs</span>

													</span>
</span>
													</label>




													</span>
												</div>
											</div>

						<div class=\"profile-info-row\">
												<div class=\"profile-info-name blue\"> Uso futuro
												
</div>

												<div class=\"profile-info-value col-xs-6 \">
													<span>
					

<label id=\"switch-p\">
<input id=\"iswitch-p\" name=\"switch-field-1\" class=\"green  ace ace-switch ace-switch-6 \" type=\"checkbox\">
<span class=\"lbl\">
<span>
					
<span class=\"label label-lg label-info arrowed arrowed-left\">@noealvarezs</span>

													</span>
</span>
													</label>




													</span>
												</div>
											</div>
					</div>

					<div class=\"hr hr-8 dotted\"></div>

					<div class=\"profile-user-info\">


					</div>
				</div><!-- /.col -->
			</div><!-- /.row -->

			<div class=\"space-20\"></div>

		</div>

";
} // fin de function capturaContacto()

function capturaPersonales(){

return "<div id=\"home\" class=\"tab-pane active\">
			<div class=\"row\">
				<div class=\"col-xs-12 col-sm-3 center\">
				<div class=\"space space-4\"></div>
				<div class=\"space space-4\"></div>
					<span class=\"profile-picture\">
						<img class=\"editable img-responsive\" alt=\"Servidor Público\" id=\"avatar2\" src=\"../css/assets/images/avatars/profile-pic.jpg\">
					</span>

					<div class=\"space space-4\"></div>

					<a href=\"#\" class=\"btn btn-sm btn-block btn-success\">
						<i class=\"ace-icon fa fa-plus-circle bigger-120\"></i>
						<span class=\"bigger-110\">Agrega Imagen o Fotografía</span>
					</a>
					<span>
					<label id=\"switch-p\">
												<input id=\"iswitch-p\" name=\"switch-field-1\" class=\"green  ace ace-switch ace-switch-6 \" type=\"checkbox\">
														<span class=\"lbl\"></span>
													</label>
													</span>

				</div><!-- /.col -->

				<div class=\"col-xs-12 col-sm-9\">
					<h4 class=\"blue\">
						<span class=\"middle\"> </span>

						<span class=\"label label-purple arrowed-in-right\">
							<i class=\"ace-icon fa fa-circle smaller-80 align-middle\"></i>
							Servidor Publico
						</span>
					</h4>

					<div class=\"profile-user-info\">
<div class=\"profile-info-row\">
												<div class=\"profile-info-name blue\"> CURP
												
</div>

												<div class=\"profile-info-value col-xs-6 \">
													<span>
					

<label id=\"switch-p\">
<input id=\"iswitch-p\" name=\"switch-field-1\" class=\"green  ace ace-switch ace-switch-6 \" type=\"checkbox\">
<span class=\"lbl\">
<span>
					
<span class=\"label label-lg label-info arrowed arrowed-left\">AASN690312HMCLLX06</span>

													</span>
</span>
													</label>




													</span>
												</div>
											</div>
<div class=\"profile-info-row\">
												<div class=\"profile-info-name blue\"> RFC
												
</div>

												<div class=\"profile-info-value col-xs-6 \">
													<span>
					

<label id=\"switch-p\">
<input id=\"iswitch-p\" name=\"switch-field-1\" class=\"green  ace ace-switch ace-switch-6 \" type=\"checkbox\">
<span class=\"lbl\">
<span>
					
<span class=\"label label-lg label-info arrowed arrowed-left\">AASN690312-S14</span>

													</span>
</span>
													</label>




													</span>
												</div>
											</div>
<div class=\"profile-info-row\">
												<div class=\"profile-info-name blue\"> Nombre
												
</div>

												<div class=\"profile-info-value col-xs-6 \">
													<span>
					

<label id=\"switch-p\">
<input id=\"iswitch-p\" name=\"switch-field-1\" class=\"green  ace ace-switch ace-switch-6 \" type=\"checkbox\">
<span class=\"lbl\">
<span>
					
<span class=\"label label-lg label-info arrowed arrowed-left\">Noe</span>

													</span>
</span>
													</label>




													</span>
												</div>
											</div>
						<div class=\"profile-info-row\">
												<div class=\"profile-info-name blue\"> Primer apellido
												
</div>

												<div class=\"profile-info-value col-xs-6 \">
													<span>
					

<label id=\"switch-p\">
<input id=\"iswitch-p\" name=\"switch-field-1\" class=\"green  ace ace-switch ace-switch-6 \" type=\"checkbox\">
<span class=\"lbl\">
<span>
					
<span class=\"label label-lg label-info arrowed arrowed-left\">Alvarez</span>

													</span>
</span>
													</label>




													</span>
												</div>
											</div>
											<div class=\"profile-info-row\">
												<div class=\"profile-info-name blue\"> Segundo apellido
												
</div>

												<div class=\"profile-info-value col-xs-6 \">
													<span>
					

<label id=\"switch-p\">
<input id=\"iswitch-p\" name=\"switch-field-1\" class=\"green  ace ace-switch ace-switch-6 \" type=\"checkbox\">
<span class=\"lbl\">
<span>
					
<span class=\"label label-lg label-info arrowed arrowed-left\">Salvador</span>

													</span>
</span>
													</label>




													</span>
												</div>
											</div>
											
											<div class=\"profile-info-row\">
												<div class=\"profile-info-name blue\"> Fecha de nacimiento
												
</div>

												<div class=\"profile-info-value col-xs-6 \">
													<span>
					

<label id=\"switch-p\">
<input id=\"iswitch-p\" name=\"switch-field-1\" class=\"green  ace ace-switch ace-switch-6 \" type=\"checkbox\">
<span class=\"lbl\">
<span>
					
<span class=\"label label-lg label-info arrowed arrowed-left\">12enero2018</span>

													</span>
</span>
													</label>




													</span>
												</div>
											</div>




					</div>
					

					<div class=\"hr hr-8 dotted\"></div>

					<div class=\"profile-user-info\">


					</div>
				</div><!-- /.col -->
			</div><!-- /.row -->

			<div class=\"space-20\"></div>

		</div>
";

}// fin de capturaPersonales

$Personales=capturaPersonales();
$Contacto= capturaContacto();
$Domicilio = capturaDomicilio();
$Documentos = capturaDocumentos();

$Aprobacion = capturaAprobacion();
echo "
          
<div class=\"wrapper wrapper-content animated fadeInRight\" id=\"main_page_2\" style=\"
    padding-top: 0px;\">
						<div class=\"row\">
							<div class=\"col-lg-12 \">
								<div class=\"ibox float-e-margins\">
									<div class=\"ibox-title\">
										<h3>4002 - Alta  APOYO ADMINISTRATIVO EN SALUD A8/ DIRECCION GENERAL DE COMUNICACION SOCIAL</h3>
									</div>

<!-- inicio formulario -->



							<div class=\"col-xs-12\">
								<!-- PAGE CONTENT BEGINS -->
								<div class=\"tabbable\">
									<ul class=\"nav nav-tabs padding-18 tab-size-bigger\" id=\"myTab\">
										<li class=\"active\">
											<a data-toggle=\"tab\" href=\"#faq-tab-1\">
												<i class=\"blue ace-icon fa fa-user bigger-220\"></i>
												Personales
											</a>
										</li>

										<li>
											<a data-toggle=\"tab\" href=\"#faq-tab-2\">
												<i class=\"blue ace-icon fa  fa-at bigger-220\"></i>
												Contácto
											</a>
										</li>
<!--
										<li>
											<a data-toggle=\"tab\" href=\"#faq-tab-3\">
												<i class=\"blue ace-icon fa fa-street-view bigger-220\"></i>
												Domicilio
											</a>
										</li>
-->

										<li>
											<a data-toggle=\"tab\" href=\"#faq-tab-4\">
												<i class=\"blue ace-icon fa fa-paperclip bigger-220\"></i>
												Documentos
											</a>
										</li>

										<li>
											<a data-toggle=\"tab\" href=\"#faq-tab-5\">
												<i class=\"blue ace-icon fa fa-credit-card bigger-220\"></i>
												Clave Pago
											</a>
										</li>



										<li>
											<a data-toggle=\"tab\" href=\"#faq-tab-6\">
												<i class=\"blue ace-icon fa fa-check bigger-220\"></i>
												Aprovación
											</a>
										</li>

<!--
										<li>
											<a data-toggle=\"tab\" href=\"#faq-tab-7\">
												<i class=\"orange ace-icon fa fa-th-list bigger-220\"></i>
												Deducciones
											</a>
										</li>



-->
									</ul>



									<div class=\"tab-content no-border padding-24\">


										<div id=\"faq-tab-1\" class=\"tab-pane fade in active\">
											<h4 class=\"blue\">
												<i class=\"ace-icon fa fa-check bigger-110\"></i>
												Datos Personales del Servidor Público
												
											</h4>

$Personales


											<div class=\"space-8\"></div>

											<div id=\"faq-list-1\" class=\"panel-group accordion-style1 accordion-style2\">

												<div class=\"panel panel-default\">

												</div>

												<div class=\"panel panel-default\">
												</div>

												<div class=\"panel panel-default\">
												</div>

												<div class=\"panel panel-default\">
												</div>
											</div>
										</div>







										<div id=\"faq-tab-2\" class=\"tab-pane fade\">
											<h4 class=\"blue\">
												<i class=\"blue  ace-icon fa fa-at bigger-110\"></i>
												Información de Contácto
											</h4>
<div class=\"space-8\"></div>

$Contacto


											<div class=\"space-8\"></div>

											<div id=\"faq-list-2\" class=\"panel-group accordion-style1 accordion-style2\">
												<div class=\"panel panel-default\">
												</div>

												<div class=\"panel panel-default\">
												</div>

												<div class=\"panel panel-default\">
												</div>

												<div class=\"panel panel-default\">
												</div>
											</div>
										</div>





										<div id=\"faq-tab-3\" class=\"tab-pane fade\">
											<h4 class=\"blue\">
												<i class=\"blue ace-icon fa fa-street-view bigger-110\"></i>
												Datos de Domicilio
											</h4>
$Domicilio


											<div class=\"space-8\"></div>

											<div id=\"faq-list-3\" class=\"panel-group accordion-style1 accordion-style2\">
												<div class=\"panel panel-default\">
												</div>

												<div class=\"panel panel-default\">
												</div>

												<div class=\"panel panel-default\">
												</div>

												<div class=\"panel panel-default\">
												</div>
											</div>
										</div>











										<div id=\"faq-tab-4\" class=\"tab-pane fade\">
											<h4 class=\"blue\">
												<i class=\"blue ace-icon fa fa-paperclip bigger-110\"></i>
												Documentos del Servidor Público
											</h4>
$Documentos

											<div class=\"space-8\"></div>

											<div id=\"faq-list-4\" class=\"panel-group accordion-style1 accordion-style2\">
												<div class=\"panel panel-default\">
												</div>

												<div class=\"panel panel-default\">
												</div>

												<div class=\"panel panel-default\">
													
												</div>

												<div class=\"panel panel-default\">
												</div>
											</div>
										</div>
<!-- fin propuesto-->
							


										<div id=\"faq-tab-5\" class=\"tab-pane fade\">
											<h4 class=\"blue\">
												<i class=\"purple ace-icon fa fa-magic bigger-110\"></i>
												Clave de Pago
											</h4>
$Domicilio

											<div class=\"space-8\"></div>

											<div id=\"faq-list-5\" class=\"panel-group accordion-style1 accordion-style2\">
												<div class=\"panel panel-default\">
												</div>

												<div class=\"panel panel-default\">
												</div>

												<div class=\"panel panel-default\">
												</div>

												<div class=\"panel panel-default\">
												</div>
											</div>
										</div>
<!-- fin 5 propuesto-->






										<div id=\"faq-tab-6\" class=\"tab-pane fade\">
											<h4 class=\"blue\">
												<i class=\"purple ace-icon fa fa-magic bigger-110\"></i>
												Aprobación de Movimiento
											</h4>
$Aprobacion 

											<div class=\"space-8\"></div>

											<div id=\"faq-list-6\" class=\"panel-group accordion-style1 accordion-style2\">
												<div class=\"panel panel-default\">
												</div>

												<div class=\"panel panel-default\">
												</div>

												<div class=\"panel panel-default\">
												</div>

											</div>
										</div>
<!-- fin 6 propuesto-->








										<div id=\"faq-tab-7\" class=\"tab-pane fade\">
											<h4 class=\"blue\">
												<i class=\"purple ace-icon fa fa-magic bigger-110\"></i>
												Conceptos de Deducción
											</h4>

											<div class=\"space-8\"></div>

											<div id=\"faq-list-7\" class=\"panel-group accordion-style1 accordion-style2\">
												<div class=\"panel panel-default\">
													<div class=\"panel-heading\">
														<a href=\"#faq-7-1\" data-parent=\"#faq-list-7\" data-toggle=\"collapse\" class=\"accordion-toggle collapsed\">
															<i class=\"ace-icon fa fa-plus\" data-icon-hide=\"ace-icon fa fa-hand-o-down\" data-icon-show=\"ace-icon fa fa-hand-o-right\"></i>
															<span class=\"label label-info arrowed-in-right arrowed\">
															Concepto 2-01-00
															</span>

														</a>
													</div>

													<div class=\"panel-collapse collapse\" id=\"faq-7-1\">
														<div class=\"panel-body\">
IMPUESTO SOBRE LA RENTA


														</div>
													</div>
												</div>

												<div class=\"panel panel-default\">
													<div class=\"panel-heading\">
														<a href=\"#faq-7-2\" data-parent=\"#faq-list-7\" data-toggle=\"collapse\" class=\"accordion-toggle collapsed\">
															<i class=\"ace-icon fa fa-plus bigger-120\" data-icon-hide=\"ace-icon fa fa-smile-o\" data-icon-show=\"ace-icon fa fa-frown-o\"></i>
															<span class=\"label label-info arrowed-in-right arrowed\"> Concepto 2-02-SI</span>

														</a>
													</div>

													<div class=\"panel-collapse collapse\" id=\"faq-7-2\">
														<div class=\"panel-body\">
SEGURO DE INVALIDEZ Y VIDA, ISSSTE


														</div>
													</div>
												</div>

												<div class=\"panel panel-default\">
													<div class=\"panel-heading\">
														<a href=\"#faq-7-3\" data-parent=\"#faq-list-7\" data-toggle=\"collapse\" class=\"accordion-toggle collapsed\">
															<i class=\"ace-icon fa fa-plus smaller-80\" data-icon-hide=\"ace-icon fa fa-minus\" data-icon-show=\"ace-icon fa fa-plus\"></i>
															<span class=\"label label-info arrowed-in-right arrowed\">Concepto 2-02-SR</span>

														</a>
													</div>

													<div class=\"panel-collapse collapse\" id=\"faq-7-3\">
														<div class=\"panel-body\">

SEGURO DE RETIRO, CESANTÍA EN EDAD AVANZADA Y VEJEZ, ISSSTE



														</div>
													</div>
												</div>

												<div class=\"panel panel-default\">
													<div class=\"panel-heading\">
														<a href=\"#faq-7-4\" data-parent=\"#faq-list-7\" data-toggle=\"collapse\" class=\"accordion-toggle collapsed\">
															<i class=\"ace-icon fa fa-plus smaller-80\" data-icon-hide=\"ace-icon fa fa-minus\" data-icon-show=\"ace-icon fa fa-plus\"></i>
															<span class=\"label label-info arrowed-in-right arrowed\">Concepto 2-02-SS</span>

														</a>
													</div>

													<div class=\"panel-collapse collapse\" id=\"faq-7-4\">
														<div class=\"panel-body\">
SERVICIOS SOCIALES Y CULTURALES, ISSSTE


														</div>
													</div>
												</div>
											</div>
										</div>
<!-- fin 7 propuesto-->




									</div>
						





<!-- fin formulario -->












									<div class=\"ibox-content\">
										<div class=\"board\">
											<div class=\"board-inner\">
												<div class=\"tabs-left\"></div>
											</div>



										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					



<script src=\"../js/bootstrapValidator.min.js\"></script>

 <!-- iCheck -->
    <script src=\"../js/plugins/iCheck/icheck.min.js\"></script>
<script>
$(document).ready(function () {

                $('#FormUser').bootstrapValidator({
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        txt_nombre: {
                            validators: {
                                notEmpty: {
                                    message: ' '
                                },
                                regexp: {
                                    regexp: /^[a-zA-Z\s\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+$/,
                                    message: ' '
                                }
                            }
                        },
                        txt_app_p: {
                            validators: {
                                notEmpty: {
                                    message: ' '
                                },
                                regexp: {
                                    regexp: /^[a-zA-Z\s\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+$/,
                                    message: ' '
                                }
                            }
                        },
                        txt_app_m: {
                            validators: {
                                notEmpty: {
                                    message: ' '
                                },
                                regexp: {
                                    regexp: /^[a-zA-Z\s\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+$/,
                                    message: ' '
                                }
                            }
                        },
                        txt_foto: {
                            validators: {
                                notEmpty: {
                                    message: ' '
                                }
                            }
                        },
                        txt_cargo: {
                            validators: {
                                notEmpty: {
                                    message: ' '
                                },
                                regexp: {
                                    regexp: /^[a-zA-Z\s\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+$/,
                                    message: ' '
                                }
                            }
                        },
                        txt_email: {
                            validators: {
                                notEmpty: {
                                    message: ' '
                                },
                                regexp: {
                                    regexp: /^[a-zA-Z0-9.-_\s]+$/,
                                    message: ' '
                                }
                            }
                        },
                        txt_psw: {
                            validators: {
                                notEmpty: {
                                    message: ' '
                                },
                                
                                different: {
                                    field: 'txt_email',
                                    message: 'La contraseña no puede ser la misma que el correo'
                                }
                            }
                        },
                        txt_conf_psw: {
                            validators: {
                                notEmpty: {
                                    message: ' '
                                },
                                identical: {
                                    field: 'txt_psw',
                                    message: 'La contraseña y su confirmación no coinciden'
                                },
                                different: {
                                    field: 'txt_email',
                                    message: 'La contraseña no puede ser lo mismo que el correo'
                                }
                            }
                        },
                        txt_organismos: {
                            validators: {
                                notEmpty: {
                                    message: ' '
                                }
                            }
                        },
                        txt_uni_respon: {
                            validators: {
                                notEmpty: {
                                    message: ' '
                                }
                            }
                        },
                        txt_pregunta_seguridad: {
                            validators: {
                                notEmpty: {
                                    message: ' '
                                }
                            }
                        },
                        txt_licencia: {
                            validators: {
                                notEmpty: {
                                    message: ' '
                                },
                                regexp: {
                                    regexp: /^[a-zA-Z0-9_\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+$/,
                                    message: 'Error en Número de Licencia '
                                }
                            }
                        },
                        txt_respuesta: {
                            validators: {
                                notEmpty: {
                                    message: ' '
                                },
                                regexp: {
                                    regexp: /^[a-zA-Z\s\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+$/,
                                    message: ' '
                                }
                            }
                        }
                    }
                });

                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
           

  });
</script>

";


?>