<?php

/*********************************************************************
 * 
 * Funcion : fncBuildJS
 * Objetivo: Footer
 *
 **********************************************************************/

function fncBuildJS()
{

return "
   <!-- Mainly scripts -->
    <script src=\"js/jquery-2.1.1.js\"></script>
    <script src=\"js/bootstrap.min.js\"></script>
    <script src=\"js/bootstrapValidator.min.js\"></script>
    <script src=\"js/plugins/metisMenu/jquery.metisMenu.js\"></script>
    <script src=\"js/plugins/slimscroll/jquery.slimscroll.min.js\"></script>

    <!-- Flot -->
    <script src=\"js/plugins/flot/jquery.flot.js\"></script>
    <script src=\"js/plugins/flot/jquery.flot.tooltip.min.js\"></script>
    <script src=\"js/plugins/flot/jquery.flot.spline.js\"></script>
    <script src=\"js/plugins/flot/jquery.flot.resize.js\"></script>
    <script src=\"js/plugins/flot/jquery.flot.pie.js\"></script>

    <!-- Peity  -->
    <script src=\"js/plugins/peity/jquery.peity.min.js\"></script>
    <script src=\"js/demo/peity-demo.js\"></script>

    <!-- Custom and plugin javascript  -->
    <script src=\"js/inspinia.js\"></script>
    <script src=\"js/plugins/pace/pace.min.js\"></script>

    <!-- GITTER -->
    <script src=\"js/plugins/gritter/jquery.gritter.min.js\"></script>


    <!-- Toastr -->
    <script src=\"js/plugins/toastr/toastr.min.js\"></script>

	 
	 </html>

	";

} // fin de fncBuildJS


function fncBuildHead()
{
return " 	
<!DOCTYPE html>
<html>
	<head>
		<meta charset=\"utf-8\">
		<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">

		<title>Secretaria de Salud</title>

		<link href=\"css/bootstrap.min.css\" rel=\"stylesheet\">
		<link href=\"font-awesome/css/font-awesome.css\" rel=\"stylesheet\">

		<!-- Toastr style -->
		<link href=\"css/plugins/toastr/toastr.min.css\" rel=\"stylesheet\">

		<!-- Gritter -->
		<link href=\"js/plugins/gritter/jquery.gritter.css\" rel=\"stylesheet\">

		<!-- Data picker -->
		<link href=\"css/plugins/datapicker/datepicker3.css\" rel=\"stylesheet\">
		<link href=\"css/plugins/iCheck/custom.css\" rel=\"stylesheet\">
		
		<link href=\"css/plugins/select2/select2.min.css\" rel=\"stylesheet\">
		
		<link href=\"css/input-foto.css\" rel=\"stylesheet\">
		<link href=\"css/animate.css\" rel=\"stylesheet\">
		<link href=\"css/style.css\" rel=\"stylesheet\">            

	</head>
	<style>
	
	{ .profile_view {
    display: inline-block;
    width: 100%;
        -webkit-box-shadow: 0 2px 2px 0 rgba(0,0,0,0.2),0 6px 10px 0 rgba(0,0,0,0.3);
    box-shadow: 0 2px 2px 0 rgba(0,0,0,0.2),0 6px 10px 0 rgba(0,0,0,0.3);
	} }
	.profile_view:hover {
		-webkit-box-shadow: 0 8px 6px 0 rgba(0,0,0,0.17),0 12px 32px 0 rgba(0,0,0,0.3);
		box-shadow: 0 8px 6px 0 rgba(0,0,0,0.17),0 12px 32px 0 rgba(0,0,0,0.3);    
	}
	{ .well.profile_view {
		padding: 10px 0 0;
	}

	.well.profile_view {
		background: #fff;
	}
		.form-signin {
		max-width: 330px;
		padding: 15px;
		margin: 0 auto;
		padding-top: 5px;
	} }

		.title {
			font-size: 23px;
			color: #262626;
			margin: 0 0 15px;
			font-weight: normal;
		}
		.accountchooser ol {
			width: 100%;
			margin: 0;
			list-style: none;
			padding: 0;
		}
		.accountchooser ol li {
			height: 76px;
			border-top: 1px solid #d5d5d5;
		}
		.accountchooser ol li button {
			display: block;
			width: 100%;
			height: 100%;
			outline: none;
			border: 0;
			cursor: pointer;
			text-align: left;
			background: url(//ssl.gstatic.com/accounts/ui/arrow_right_1x.png) right center no-repeat;
			background-size: 23px 23px;
		}
		.accountchooser ol li button:hover {
			background: url(http://www.clker.com/cliparts/3/W/W/N/T/e/right-black-arrow-md.png) right center no-repeat;
			background-size: 23px 23px;
		}
		.accountchooser ol li button img {
			float: left;
			margin-top: -8px;
			-moz-border-radius: 50%;
			-webkit-border-radius: 50%;
			border-radius: 50%;
			height: 55px;
			width: 55px;
		}
		.accountchooser ol li button span.account-name {
			font-size: 18px;
			padding-top: 0px;
			padding-left: 16px;
			color: #1ab394;
		}
		.accountchooser ol li button span.account-email {
			padding-left: 21px;
		}
		.accountchooser ol li button span {
			display: block;
			margin-left: 58px;
			padding-right: 20px;
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
		}
		.action {
			padding: 5px;
		}
		.action ul {
			width: 100%;
			margin: 0;
			list-style: none;
			padding: 0;
		}
		.action ul li:first-child {
			border-right: 1px solid #d5d5d5;
		}
		.action ul li {
			width: 49%;
			display: inline-block;
		}
		.action ul li a {
			color: #427fed;
			cursor: pointer;
			text-decoration: none;
			-moz-box-sizing: border-box;
			-webkit-box-sizing: border-box;
			box-sizing: border-box;
			width: 100%;
			display: inline-block;
			background: none;
			text-align: center;
			padding: 12px 0;
			outline: none;
			text-decoration: none;
			border: 0;
		}              
	</style>
	
	";
} // fin de fncBuildHead


function fncBuildBody($array)
{ 

// este arreglo es temporal

$ArrPerfiles =array( "10"  => " Productos Nómina     " ,       
			         "20"  => " Articulo 74 Frac.   I" ,            
			         "30"  => " Articulo 74 Frac.  II" ,   
			         "40"  => " Articulo 74 Frac. III" ,
			         "100" => " Sexto Transitorio");


$Aux = "";

	echo "
			<body class=\"gray-bg\">
			<table align=\"center\" height=\"60\" style=\"width: 100%\">
				<tbody><tr>
				<td width=\"40%\" align=\"left\"><img src=\"images/logoSALUD_hoz.png\" width=\"289\" height=\"95\"></td>
					<td width=\"60%\" align=\"right\">
					<div class=\"col-lg-11\">
						<h2> Dirección General de Recursos Humanos
						</h2>
					</div>
					</td>    
				</tr>
				</tbody>
			</table>
					<div class=\"container bootstrap snippet animated bounceIn\">
						<div class=\"row\">
							<div class=\"col-sm-6 col-md-5 col-md-offset-3\">
								<div class=\"ibox float-e-margins\">
									<div class=\"ibox-title\">
										<div class=\"account-wall accountchooser\">
											<h1 class=\"title text-center\">Elegir una cuenta</h1><br>
											<ol class=\"accounts animated fadeInUp\" data-wow-duration=\"1000ms\" data-wow-delay=\"600ms\">";

												foreach ($array as $item) {
													$Aux = $ArrPerfiles[$item];
												echo"<li class=\"well profile_view\">
							<a  href=\"../ptfma_ruteo.php?inputPrivilegio=$item\"  class=\"btn btn-w-m btn-outline btn-info\" >
															
															 <i id=\"icoinfo-10334-chcn01c\" class=\"fa fa-user-md fa-2x\"></i>

															<span class=\"account-name\">$Aux</span> 
															</span>
														</a>
													</li>";
												} // fin de foreach

										echo"</ol>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</body>";

} // fin de fncBuildBody




?>