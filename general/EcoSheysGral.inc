<?php

/********************************************************
 * Nombre 	:fncRetFch                                  *
 * Objtvo	:Generar una fecha con                      *
 * 			 el formato:			                    *
 * 			 dd de mon del yyyy                         *
 *                                                      *
 * Autor   	: Noe ALvarez Salvador                      *
 * Fecha   	: 05 de Mayo de 2004                         *
 ********************************************************/

function fncRetFch(){

$ArrMonth = array(1 => "Enero","Febrero","Marzo", "Abril",
					"Mayo", "Junio", "Julio", "Agosto",
				  	"Septiembre", "Octubre", "Noviembre", "Diciembre");
	$FchHoy = getdate();
	$Fecha= "$FchHoy[mon]/$FchHoy[mday]/$FchHoy[year] ";
	$Aux = "$FchHoy[mon]";
	$Fecha = "$FchHoy[mday] de $ArrMonth[$Aux] del $FchHoy[year]";
	return $Fecha;
}/* fin fncRetFch */




/*******************************************************
 *                                                     *
 *      Nombre  : fncGralHdr                           *
 *      Objtvo  : Header de caracter general           *
 *      Autor   : Noe ALvarez Salvador                 *
 *      Fecha   : 14-Mayo de 2004                      *
 *                                                     *
 *******************************************************/


function fncGralHdr($Title, $Nombre,$ProdServ,$Java,$ParmBody ,$Fondo){
global $HeaderIaitsa, $NomLig, $IdTmp;

$Fecha    = fncRetFch();

$LSNomTmp = "";


$Aux    = STR_REPLACE("_"," ",strtolower($Nombre));

	echo "	<!DOCTYPE html>
				<html lang=\"en\">

				<head>

				    <meta charset=\"utf-8\">
				    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
				    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
				    <meta name=\"description\" content=\"\">
				    <meta name=\"author\" content=\"\">

				    <title>$Title</title>

				        <!-- jQuery -->
    <script src=\"../../scripts/platilla1/bower_components/jquery/dist/jquery.min.js\"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src=\"../../scripts/platilla1/bower_components/bootstrap/dist/js/bootstrap.min.js\"></script>


				    <!-- Bootstrap Core CSS -->
				    <link href=\"../../scripts/platilla1/bower_components/bootstrap/dist/css/bootstrap.min.css\" rel=\"stylesheet\">

				    <!-- MetisMenu CSS -->
				    <link href=\"../../scripts/platilla1/bower_components/metisMenu/dist/metisMenu.min.css\" rel=\"stylesheet\">

				    <!-- Timeline CSS -->
				    <link href=\"../../scripts/platilla1/dist/css/timeline.css\" rel=\"stylesheet\">

				    <!-- Custom CSS -->
				    <link href=\"../../scripts/platilla1/dist/css/sb-admin-2.css\" rel=\"stylesheet\">

				    <!-- Morris Charts CSS -->
				    <link href=\"../../scripts/platilla1/bower_components/morrisjs/morris.css\" rel=\"stylesheet\">

				    <!-- Custom Fonts -->
				    <link href=\"../../scripts/platilla1/bower_components/font-awesome/css/font-awesome.min.css\" rel=\"stylesheet\" type=\"text/css\">

				    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
				    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
				    <!--[if lt IE 9]>
				        <script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\"></script>
				        <script 
				        src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\"></script>
				    <![endif]-->



				$Java


				</head>
				<body $ParmBody>
				 <div id=\"wrapper\">

		 ";
} /* fin fncGralHdr **/




/*******************************************************
 *                                                     *
 *      Nombre  : fncTailGral                          *
 *      Objtvo  : Funcion que arma el tail             *
 *                general de la aplicacion             *
 *      Autor   : Noe ALvarez Salvador                 *
 *      Fecha   : 14-Mayo de 2004                      *
 *                                                     *
 *******************************************************/


function fncTailGral($Contador){
	echo "
 </div>
    <!-- /#wrapper -->


    <!-- Metis Menu Plugin JavaScript -->
    <script src=\"../../scripts/platilla1/bower_components/metisMenu/dist/metisMenu.min.js\"></script>

    <!-- Morris Charts JavaScript -->
    <script src=\"../../scripts/platilla1/bower_components/raphael/raphael-min.js\"></script>
    <script src=\"../../scripts/platilla1/bower_components/morrisjs/morris.min.js\"></script>
    <script src=\"../../scripts/platilla1/js/morris-data.js\"></script>

    <!-- Custom Theme JavaScript -->
    <script src=\"../../scripts/platilla1/dist/js/sb-admin-2.js\"></script>

   

	</body>


	!--FUNCION PARA EL CALENDARIO CALENDARIO-->
        <script>
            jQuery(function($)
            {           
                    $.datepicker.regional['es'] = {
                            closeText: 'Cerrar',
                            prevText: '&#x3c;Ant',
                            nextText: 'Sig&#x3e;',
                            currentText: 'Hoy',
                            monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
                            'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                            monthNamesShort: ['01','02','03','04','05','06',
                            '07','08','09','10','11','12'],
                            dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
                            dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
                            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
                            weekHeader: 'Sm',
                            dateFormat: 'dd-M-yy',
                            firstDay: 1,
                            isRTL: false,
                            showMonthAfterYear: false,
                            yearSuffix: ''};
                    $.datepicker.setDefaults($.datepicker.regional['es']);
            });
        </script>
    <!--FIN FUNCION PARA EL CAL
	</html>


		";
} /* fin fncTailGral */







/*******************************************************
 *                                                     *
 *      Nombre  : fncContSeccion                       *
 *      Objtvo  : Funcion que contabiliza las visitas  *
 *                a las secciones                      *
 *      Autor   : Noe ALvarez Salvador                 *
 *      Fecha   : 14-Septiembre de 2004                *
 *                                                     *
 *******************************************************/

function fncContSeccion($IdSec, $Vstte){
$QryExec = "Insert into visitas values
			(	now(),
				$IdSec,
				'$Vstte'
			)";

    $RespQry = fncExeQry($QryExec);

$QryExec = "update secciones
			set contador = contador+1
			where id_seccion = $IdSec";

    $RespQry = fncExeQry($QryExec);

	$QryExec = "select *
			from secciones
			where id_seccion = $IdSec";

    $RespQry = fncExeQry($QryExec);
	$Reg = mysql_fetch_object($RespQry);
	return $Reg;
}/* fin de fncContAnuncio */


/*******************************************************
 *                                                     *
 *      Nombre  : fncIdentVis                          *
 *      Objtvo  : Funcion que Identifica al visitante  *
 *      Autor   : Noe ALvarez Salvador                 *
 *      Fecha   : 14-Septiembre de 2004                *
 *                                                     *
 *******************************************************/

function fncIdentVis($Vtnte){

$QryExec = "Select Count(*) existe
			from visitantes
			where rfc_visitante ='$Vtnte'";

    $RespQry = fncExeQry($QryExec);

	$Reg = mysql_fetch_object($RespQry);

	if($Reg->existe < 0){
		$QryExec = "insert into visitantes values(
		'$Vtnte',
		'$Vtnte',
		'$Vtnte',
		'$Vtnte',
		'$Vtnte',
		'$Vtnte',
		'$Vtnte',
		'$Vtnte',
		'$Vtnte',
		'12345'
		'$Vtnte',
		'$Vtnte',
		'$Vtnte',
		'$Vtnte',
		now(),
		now(),
		'V',
		'$Vtnte'
		)
		";
		$RespQry = fncExeQry($QryExec);

	}/* fin del if */
	return $Vtnte;
}/* fin de fncIdentVis */

/*******************************************************************
 *   Programa : fncShowMsg          	                           *
 *   Objetivo : Muestra  el Mensaje                                *
 *   Autor    : Noe Alvarez Salvador                               *
 *   Fecha    : 05 de Marzo del 2005                               *
 *   email    : noealvarez@archysoft.com                           *
 *******************************************************************/


function fncShowMsg($Msg){

$Msg = "
<BR><BR>
<table width=\"650\" border=\"0\">
    <tr>
      <td width=\"500\"><table width=\"500\" border=\"0\">
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>

          <td><table width=\"400\" border=\"4\" align=\"center\">
              <tr>
                <td><div align=\"center\"><font color=\"#003399\" size=\"3\" face=\"Arial, Helvetica, sans-serif\"><strong>$Msg</strong></font></div></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      <td>&nbsp;</td>
    </tr>
  </table>
			";

return $Msg;
}/** fin de fncShowMsg  **/


/*******************************************************************
 *   Programa : fncFrmFchaIns          	                           *
 *   Objetivo : Da Formato a la fecha YYYY-mm-dd                   *
 *   Autor    : Noe Alvarez Salvador                               *
 *   Fecha    : 01 de Septiembre del 2005                          *
 *   email    : noealvarez@archysoft.com                           *
 *******************************************************************/
function fncFrmFchIns($Fecha){
$FrmFch="";
if($Fecha !=""){
	$Dia  = substr($Fecha,0,2 );
	$Mes  = substr($Fecha,3,2 ) ;
	$Year = substr($Fecha,6,4 );
	$FrmFch = "$Year-$Mes-$Dia";
}
return $FrmFch;
}/** fin de fncFrmFchaIns **/


/*******************************************************************
 *   Programa : fncFrmFchaShow          	                       *
 *   Objetivo : Da Formato a la fecha dd/mm/YYYY                   *
 *   Autor    : Noe Alvarez Salvador                               *
 *   Fecha    : 01 de Septiembre del 2005                          *
 *   email    : noealvarez@archysoft.com                           *
 *******************************************************************/
function fncFrmFchShow($Fecha){
$FrmFch="";
if($Fecha !=""){
	$Year = substr($Fecha,0,4 );
	$Mes  = substr($Fecha,5,2 ) ;
	$Dia  = substr($Fecha,8,2 );
	$FrmFch = "$Dia/$Mes/$Year";
}
return $FrmFch;
}/** fin de fncFrmFchaIns **/



/*******************************************************************
 *   Programa : fncFrmFcha          	                           *
 *   Objetivo : Da Formato a la fecha dd de mes del year           *
 *   Autor    : Noe Alvarez Salvador                               *
 *   Fecha    : 11 de Junio del 2005                               *
 *   email    : noealvarez@archysoft.com                           *
 *******************************************************************/
function fncFrmFch($Fecha){
$FrmFch="";
$ArrMonth = array(1 => "Enero","Febrero","Marzo", "Abril",
					"Mayo", "Junio", "Julio", "Agosto",
				  	"Septiembre", "Octubre", "Noviembre", "Diciembre");
if($Fecha !=""){
	$Year = substr($Fecha,0,4 );
	$Mes  = intval(substr($Fecha,5,2 )) ;
	$Dia  = substr($Fecha,8,2 );
	$FrmFch = "$Dia de $ArrMonth[$Mes] del $Year";
}
return $FrmFch;
}/** fin de fncFrmFcha **/

/*******************************************************************
 *   Programa : fncFrmFcha          	                           *
 *   Objetivo : Da Formato a la fecha dd de mes del year           *
 *   Autor    : Noe Alvarez Salvador                               *
 *   Fecha    : 11 de Junio del 2005                               *
 *   email    : noealvarez@archysoft.com                           *
 *******************************************************************/
function fncFrmFchLat($Fecha){
$FrmFch="";
$ArrMonth = array(1 => "Enero","Febrero","Marzo", "Abril",
					"Mayo", "Junio", "Julio", "Agosto",
				  	"Septiembre", "Octubre", "Noviembre", "Diciembre");
if($Fecha !=""){
	$Dia = substr($Fecha,0,2 );
	$Mes  = substr($Fecha,3,2 ) +0;
	$Year  = substr($Fecha,6,4 );
	$FrmFch = "$Dia de $ArrMonth[$Mes] del $Year";
}
return $FrmFch;
}/** fin de fncFrmFcha **/





/*******************************************************************
 *   Programa : fncFrmFchaRpt          	                           *
 *   Objetivo : Da Formato a la fecha dd de mes del year           *
 *   Autor    : Noe Alvarez Salvador                               *
 *   Fecha    : 11 de Junio del 2005                               *
 *   email    : noealvarez@archysoft.com                           *
 *******************************************************************/
function fncFrmFchRpt($Fecha){
$FrmFch="";
$ArrMonth = array(1 => "Ene","Feb","Mar", "Abr",
					"May", "Jun", "Julio", "Ago",
				  	"Sep", "Oct", "Nov", "Dic");
if($Fecha !=""){
	$Year = substr($Fecha,0,4 );
	$Mes  = substr($Fecha,5,2 ) +0;
	$Dia  = substr($Fecha,8,2 );
	if($Mes <= 0)
		$Mes = 1;


	$FrmFch = "$Dia-$ArrMonth[$Mes]-$Year";
}
return $FrmFch;
}/** fin de fncFrmFcha **/



/*******************************************************************
 *   Programa : fncOpenPdf          	                           *
 *   Objetivo : Funcion que crea un documento PFD                  *
 *               0 Vertical 1 Horizontal                           *
 *   Autor    : Noe Alvarez Salvador                               *
 *   Fecha    : 30 de Junio del 2005                               *
 *   email    : noealvarez@archysoft.com                           *
 *******************************************************************/
function fncOpenPdf($Liga, $HorVer, $PTam){

$p = PDF_new();
PDF_set_parameter($p, "license", "X600605-009100-495E9B-FC9F27");

if (PDF_open_file($p, "") == 0) {
    die("Error: " . PDF_get_errmsg($p));
}   /**     fin del if   **/

/* This line is required to avoid problems on Japanese systems */

PDF_set_parameter($p, "hypertextencoding", "winansi");

PDF_set_info($p, "Creator", "Archysoft");
PDF_set_info($p, "Author" , "Noe Alvarez");
PDF_set_info($p, "Title"  , "SISTEMA DE ADMINISTRACION DEPORTIVA FUTBOLINT");
pdf_set_info($p, "Subject", $Liga);
pdf_set_info($p, "Keywords", "Reporte de Estadisticas ");
pdf_set_info($p, "CustomField", "Reporte de Estadisticas");

$LAlto =792;
$LAncho=612;
if($PTam == "A4"){
	$LAlto =841;
	$LAncho=595;
}

if($HorVer == 0)
	PDF_begin_page($p, $LAncho, $LAlto);		/* Vertical   */
else
	PDF_begin_page($p, $LAlto, $LAncho); 		/* Horizontal */
return 	$p;
} /* fin de	fncOpenPdf **/


/*******************************************************************
 *   Programa : fncSetFont          	                           *
 *   Objetivo : Funcion que establece la fuente y tamaño           *
 *   Autor    : Noe Alvarez Salvador                               *
 *   Fecha    : 30 de Junio del 2005                               *
 *   email    : noealvarez@archysoft.com                           *
 *******************************************************************/
function fncSetFontPdf($Pdf,$Font, $FontSIze){
	$HdrFont = PDF_load_font($Pdf, $Font, "winansi", "");
	PDF_setfont($Pdf, $HdrFont, $FontSIze);
}/**  fncSetFont   **/



/*******************************************************************
 *   Programa : fncClosePdf          	                           *
 *   Objetivo : Funcion que cierra el archivo PDF                  *
 *   Autor    : Noe Alvarez Salvador                               *
 *   Fecha    : 30 de Junio del 2005                               *
 *   email    : noealvarez@archysoft.com                           *
 *******************************************************************/
function fncClosePdf($HdlPdf,$PdfName){

	PDF_end_page($HdlPdf);			/* close page		*/
	PDF_close($HdlPdf);				/* close PDF document	*/

	$buf = PDF_get_buffer($HdlPdf);
	$len = strlen($buf);

	header("Content-type: application/pdf");
	header("Content-Length: $len");
	header("Content-Disposition: inline; filename=$PdfName");
	print $buf;
	PDF_delete($HdlPdf);				/* delete the PDFlib object */

} /** fncClosePdf  **/


/*******************************************************************
 *   Programa : fncWrtMgsPdf          	                           *
 *   Objetivo : Funcion que Escribe en el documento                *
 *   Autor    : Noe Alvarez Salvador                               *
 *   Fecha    : 30 de Junio del 2005                               *
 *   email    : noealvarez@archysoft.com                           *
 *******************************************************************/
function fncWrtMgsPdf($PdfHdr,$Msg, $PosX, $PosY){

	PDF_set_text_pos($PdfHdr, $PosX, $PosY);
	PDF_show($PdfHdr, $Msg);

}/** fin de fncWrtMgsPdf  **/






/*******************************************************************
 *   Programa : fncWrtMgsFPdf          	                           *
 *   Objetivo : Funcion que Escribe en el documento Pdf clase      *
 *   Autor    : Noe Alvarez Salvador                               *
 *   Fecha    : 29 de Agosto del 2005                              *
 *   email    : noealvarez@archysoft.com                           *
 *******************************************************************/
function fncWrtMgsFPdf($Msg, $PosX, $PosY){
global $PdfFile;

		$PdfFile->SetXY($PosX, $PosY);
		$PdfFile->Write(5,$Msg);

}/** fin de fncWrtMgsPdf  **/




/*******************************************************************
 *   Programa : fncBldSqr          	                               *
 *   Objetivo : Funcion que construye un marco                     *
 *   Autor    : Noe Alvarez Salvador                               *
 *   Fecha    : 30 de Junio del 2005                               *
 *   email    : noealvarez@archysoft.com                           *
 *******************************************************************/
function fncBldSqrPdf($PdfHdr, $WdtLin, $PosX, $PosY, $WdtX, $WdtY){
	PDF_setlinewidth($PdfHdr, $WdtLin);
	pdf_rect ( $PdfHdr, $PosX, $PosY, $WdtX, $WdtY);
	PDF_stroke($PdfHdr);
}/* fin de fncBldSqr **/

/*******************************************************************
 *   Programa : fncLodImg          	                               *
 *   Objetivo : Funcion carga la imagen AL DOCUMENTO               *
 *   Autor    : Noe Alvarez Salvador                               *
 *   Fecha    : 30 de Junio del 2005                               *
 *   email    : noealvarez@archysoft.com                           *
 *******************************************************************/
function fncLodImgPdf($PdfHdr, $Img, $PosX, $PosY, $Scl){

	$Scla ="scale $Scl";
	$HdrIma = PDF_load_image($PdfHdr, "auto", $Img, "");
	if (!$HdrIma)
	    die("Error: " . PDF_get_errmsg($PdfHdr));

	PDF_fit_image($PdfHdr, $HdrIma, $PosX, $PosY, $Scla);
	PDF_close_image($PdfHdr, $HdrIma);

} /*  fin de fncLodImg **/


/***************************************************************
 *   Programa : fncBuscNomFza   	                           *
 *   Objetivo : Busca el nombre de la fuerza en base a su id   *
 *                                                             *
 *   Autor    : Noe Alvarez Salvador                           *
 *   Fecha    : 12 de Agosto del 2005                          *
 *   email    : noealvarez@archysoft.com                       *
 *                                                             *
 *  Parametros de entrada                                      *
 *  nombre ---------------- descirpccion                       *
 *  $PIdFza                 Id de la Fuerza                    *
 *                                                             *
 * Parametros de salida                                        *
 *  Nombre  -----------------descripcion                       *
 *  $LNomFza                Nombre de la Fuerza                *
 ***************************************************************/
function fncBuscNomFza($PIdFza){
$LNomFza = "";
$QryExec = "select nombre from ftblint_fuerzas where id_fuerza='$PIdFza'";
    $RespQry = fncExeQry($QryExec);

	$LResQry = mysql_fetch_object($RespQry);
	$LNomFza = $LResQry->nombre;
	return ($LNomFza);
}/* fin de fncBuscNomFza **/

/***************************************************************
 *   Programa : fncDrwLinPdf   	                               *
 *   Objetivo : Dibuja una linea                               *
 *                                                             *
 *   Autor    : Noe Alvarez Salvador                           *
 *   Fecha    : 12 de Agosto del 2005                          *
 *   email    : noealvarez@archysoft.com                       *
 *                                                             *
 *  Parametros de entrada                                      *
 *  nombre ---------------- descirpccion                       *
 *  $PPdfHdr                Manejador del doc                  *
 *  $PPosX_1                Posicion X1                        *
 *  $PPosY_1                Posicion Y1                        *
 *  $PPosX_2                Posicion X2                        *
 *  $PPosY_3                Posicion Y2                        *
 *                                                             *
 * Parametros de salida                                        *
 *  Nombre  -----------------descripcion                       *
 *  No aplica               No aplica                          *
 ***************************************************************/

function  fncDrwLinPdf($PPdfHdr, $PPosX_1, $PPosY_1, $PPosX_2, $PPosY_2){
			    PDF_moveto($PPdfHdr, $PPosX_1 ,$PPosY_1 );
    			PDF_lineto($PPdfHdr, $PPosX_2 ,$PPosY_2 );
    			PDF_stroke($PPdfHdr);

}/* fin de fncDrwLinPdf **/

/***************************************************************
 *   Programa : fncObtDatCmpo  	                               *
 *   Objetivo : Obtiene los datos del campo de Juego           *
 *                                                             *
 *   Autor    : Noe Alvarez Salvador                           *
 *   Fecha    : 14 de Agosto del 2005                          *
 *   email    : noealvarez@archysoft.com                       *
 *                                                             *
 *  Parametros de entrada                                      *
 *  nombre ---------------- descirpccion                       *
 *  $PIdCmpo                Id del campo                       *
 *  $PIdLiga                Id de la Liga                      *
 *                                                             *
 * Parametros de salida                                        *
 *  Nombre  -----------------descripcion                       *
 *  $LObtDatCmpo             Regresalos datos del campo        *
 ***************************************************************/
function fncObtDatCmpo($PIdCmpo, $PIdLiga){

$QryExec = "SELECT * FROM FTBLINT_CAMPOS
			WHERE ID_CAMPO=$PIdCmpo
			AND ID_LIGA=$PIdLiga";

	$RespQry = fncExeQry($QryExec);

	$LObtDatCmpo = mysql_fetch_object($RespQry);

return $LObtDatCmpo;
}/* fin de fncObtDatCmpo($Reg->id_campo, $IdLiga) **/


/***************************************************************
 *   Programa : fncVerSign  	                               *
 *   Objetivo : Establece3 la firma del sistema                *
 *                                                             *
 *   Autor    : Noe Alvarez Salvador                           *
 *   Fecha    : 17 de Agosto del 2005                          *
 *   email    : noealvarez@archysoft.com                       *
 *                                                             *
 *  Parametros de entrada                                      *
 *  nombre ---------------- descirpccion                       *
 *  $PIdCmpo                Id del campo                       *
 *  $PIdLiga                Id de la Liga                      *
 *                                                             *
 * Parametros de salida                                        *
 *  Nombre  -----------------descripcion                       *
 *  $LObtDatCmpo             Regresalos datos del campo        *
 ***************************************************************/

function fncVerSign($PPos_X,$PPos_Y){
global $PdfFile;
$LMgs_1 = "Sistema de Administración  de Ligas Deportivas  FUTBOLINT";



	$PdfFile->SetFont('helvetica','I',9);
	$PdfFile->SetXY($PPos_X, $PPos_Y);
	$PdfFile->Write(5,$LMgs_1);



}/* fin de fncVerSign(10,800) **/

/***************************************************************
 *   Programa : fncPrintStr  	                               *
 *   Objetivo : Funcion que imprime una cadena desde la        }
 *              Izquierda                                      *
 *                                                             *
 *   Autor    : Noe Alvarez Salvador                           *
 *   Fecha    : 08 de Septiembre del 2005                      *
 *   email    : noealvarez@archysoft.com                       *
 *                                                             *
 *  Parametros de entrada                                      *
 *  nombre ---------------- descirpccion                       *
 *  $PString                Id del campo                       *
 *  $PPos_X                Posicion en X                       *
 *  $PPos_Y                Posicion en Y                       *
 *  $PTamFte               Tama;o de la fuente                 *
 * Parametros de salida                                        *
 *  Nombre  -----------------descripcion                       *
 *  No aplica             No aplica                            *
 ***************************************************************/
function fncPrintStr($PString,$PPos_X, $PPos_Y, $PTamFte){

$LTamSTr = strlen($PString);
$LPos_X = $PPos_X;

for($LInd=0; $LInd <=$LTamSTr; $LInd++){
	$LAuxCar = substr($PString,$LTamSTr-$LInd, 1 );
	if($LAuxCar =='I' or $LAuxCar =='i')
		$LPos_X = $LPos_X-$PTamFte+3;
	elseif($LAuxCar ==" ")
		$LPos_X = $LPos_X-$PTamFte/4;
	else
		$LPos_X = $LPos_X-$PTamFte+2 ;

	fncWrtMgsFPdf($LAuxCar, $LPos_X, $PPos_Y);
}/* fin del for **/

}/** fin de fncPrintStr **/






 /**************************************************************
 *   Programa : fncGetDatosTmp             	                   *
 *   Objetivo : Funcion Que Obtiene los datos de la temporada  *
 *   Autor    : Noe Alvarez Salvador                           *
 *   Fecha    : 04 de Noviembre del 2005                       *
 *   email    : noealvarez@archysoft.com                       *
 *   Parmetros de entrada                                      *
 *  Nombre  --------------Descripcion                          *
 *  $PIdTmp               Temporada a buscar                   *
 *  Parametros de salida                                       *
 *  Nombre  --------------Descripcion                          *
 *  $LGetDatosTmp         Datos de la temporada obtenidos      *
 ***************************************************************/

function fncGetDatosTmpG($PIdTmp){
global $IdLiga;
$LGetDatosTmp = "";
$LQryExec = "select * from ftblint_temporadas
			where id_temporada=$PIdTmp
			and id_liga=$IdLiga";

	$RespQry = fncExeQry($LQryExec);

	while ($Reg = mysql_fetch_object($RespQry))
		$LGetDatosTmp = $Reg;
	 /** fin del while **/

return $LGetDatosTmp ;
}  /** fin de fncGetDatosTmp   **/


?>
