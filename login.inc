<?php

function fncBuildCSS()
{

return "
/*
 * Specific styles of signin component
 */
/*
 * General styles
 */
body, html {
    height: 100%;
    background-repeat: no-repeat;
      background-image: linear-gradient(rgb(253, 253, 253    ), rgb(195, 195, 195  )); */
     background-color:#f5f5f5; 
    background-color:#fFfFfF;
}

.card-container.card {
    width: 350px;
    padding: 40px 40px;
}

.btn {
    font-weight: 700;
    height: 36px;
    -moz-user-select: none;
    -webkit-user-select: none;
    user-select: none;
    cursor: default;
}

/*
 * Card component
 */
.card {
    background-color: #F7F7F7;
    /* just in case there no content*/
    padding: 20px 25px 30px;
    margin: 0 auto 25px;
    margin-top: 50px;
    /* shadows and rounded borders */
    -moz-border-radius: 3px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}

.profile-img-card {
    width: 96px;
    height: 96px;
    margin: 0 auto 10px;
    display: block;
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    border-radius: 50%;
}

/*
 * Form styles
 */
.profile-name-card {
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    margin: 10px 0 0;
    min-height: 1em;
}

.reauth-email {
    display: block;
    color: #404040;
    line-height: 2;
    margin-bottom: 10px;
    font-size: 14px;
    text-align: center;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signin #inputEmail,
.form-signin #inputPassword {
    direction: ltr;
    height: 44px;
    font-size: 16px;
}

.form-signin input[type=email],
.form-signin input[type=password],
.form-signin input[type=text],
.form-signin button {
    width: 100%;
    display: block;
    margin-bottom: 10px;
    z-index: 1;
    position: relative;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signin .form-control:focus {
    border-color: rgb(104, 145, 162);
    outline: 0;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
}

.btn-signin {
    /*background-color: #4d90fe; */
    background-color: rgb(104, 145, 162);
    /* background-color: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));*/
    padding: 0px;
    font-weight: 700;
    font-size: 14px;
    height: 36px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    border: none;
    -o-transition: all 0.218s;
    -moz-transition: all 0.218s;
    -webkit-transition: all 0.218s;
    transition: all 0.218s;
}

.btn-signin:hover,
.btn-signin:active,
.btn-signin:focus {
    background-color: rgb(12, 97, 33);
}

.forgot-password {
    color: rgb(104, 145, 162);
}

.forgot-password:hover,
.forgot-password:active,
.forgot-password:focus{
    color: rgb(12, 97, 33);
}


";

} // fin de fncBuildCSS



function fncDefJS($Parametro)
{

return " 
		$( document ).ready(function() {
		    loadProfile();
		});




		/**
		 * Function that gets the data of the profile in case
		 * thar it has already saved in localstorage. Only the
		 * UI will be update in case that all data is available
		 *
		 * A not existing key in localstorage return null
		 *
		 */
		function getLocalProfile(callback){
		    var profileImgSrc      = localStorage.getItem(\"PROFILE_IMG_SRC\");
		    var profileName        = localStorage.getItem(\"PROFILE_NAME\");
		    var profileReAuthEmail = localStorage.getItem(\"PROFILE_REAUTH_EMAIL\");

		    if(profileName !== null
		            && profileReAuthEmail !== null
		            && profileImgSrc !== null) {
		        callback(profileImgSrc, profileName, profileReAuthEmail);
		    }
		}

		/**
		 * Main function that load the profile if exists
		 * in localstorage
		 */
		function loadProfile() {
		    if(!supportsHTML5Storage()) { return false; }
		    // we have to provide to the callback the basic
		    // information to set the profile
		    getLocalProfile(function(profileImgSrc, profileName, profileReAuthEmail) {
		        //changes in the UI
		        $(\"#profile-img\").attr(\"src\",profileImgSrc);
		        $(\"#profile-name\").html(profileName);
		        $(\"#reauth-email\").html(profileReAuthEmail);
		        $(\"#inputEmail\").hide();
		        $(\"#remember\").hide();
		    });
		}

		/**
		 * function that checks if the browser supports HTML5
		 * local storage
		 *
		 * @returns {boolean}
		 */
		function supportsHTML5Storage() {
		    try {
		        return 'localStorage' in window && window['localStorage'] !== null;
		    } catch (e) {
		        return false;
		    }
		}

		/**
		 * Test data. This data will be safe by the web app
		 * in the first successful login of a auth user.
		 * To Test the scripts, delete the localstorage data
		 * and comment this call.
		 *
		 * @returns {boolean}
		 */
		function testLocalStorageData() {
		    if(!supportsHTML5Storage()) { return false; }
		    localStorage.setItem(\"PROFILE_IMG_SRC\", \"//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo2.jpg?sz=120\" );
		    localStorage.setItem(\"PROFILE_NAME\", \"César Izquierdo Tello\");
		    localStorage.setItem(\"PROFILE_REAUTH_EMAIL\", \"oneaccount@gmail.com\");
		}
			";

} // fin fncDefJS


function fncBuildHead($JS, $CSS, $Lib, $Title, $ParamBody)
{

	return "
			<!DOCTYPE html>
			<html lang=\"en\">
			<head>
			    <meta charset=\"utf-8\">
			    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
			    <title>Google style login extended (with HTML5 LocalStorage) - Bootsnipp.com</title>
			        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
			    <link href=\"http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css\" rel=\"stylesheet\">

			    <script src=\"http://code.jquery.com/jquery-1.11.1.min.js\"></script>
    			<script src=\"http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js\"></script>


			    <style type=\"text/css\">
			    	$CSS
			    </style>

			    <script  type=\"text/javascript\">
			    	$JS
				</script>
			    <body  >

                <table align=\"center\" height=\"60\">
  <tr>
     <td width=\"25%\" align=\"left\"><img src=\"images/logoSALUD_hoz.png\" width=\"289\" height=\"95\" /></td>
     <!--<td width=\"420\" align=\"left\">
     <img src=\"images/70Salud.jpg\" width=\"375\" height=\"91\" /></td>-->
     <!--<td width=\"683\" align=\"right\">
     <div id=\"dominio\">Recepción Art. 74</div>

     
     </td>  -->  
     <td width=\"75%\" align=\"right\">
             <div class=\"col-lg-12\">
<!--                    
             <img src=\"images/personal1.jpg\" width=\"300\" height=\"110\" />       

             --!>
        </div>
     </td>    
  </tr>
</table> 	
<div style=\"clear: both;width: 100%;border-top: 1px solid #1d1d1d;margin-bottom: 5px;height: 10.25px;\"></div>
";


} // fncBuildHead


function fncBuildBody($Param)

{
	return " 
	<div class=\"container\">
        <div class=\"card card-container\">
            <img id=\"profile-img\" class=\"profile-img-card\" 
            		src=\"images/avatar_2x.png\" />
            <p id=\"profile-name\" class=\"profile-name-card\"></p>
            <form class=\"form-signin\" method=\"post\" action=\"movi_ruteo.php\">
                <span id=\"reauth-email\" class=\"reauth-email\"></span>
                <input type=\"email\" id=\"inputUsuario\" name=\"inputUsuario\" class=\"form-control\" placeholder=\"Usuario Autorizado\" required autofocus>
                <input type=\"password\" id=\"inputPassword\" name=\"inputPassword\" class=\"form-control\" placeholder=\"Password\" required>
                <div id=\"remember\" class=\"checkbox\">
                    <label>
                        <input type=\"checkbox\" value=\"remember-me\"> Recordar
                    </label>
                </div>
                <button id=\"btnEnviar\" 
                	class=\"btn btn-lg btn-primary btn-block btn-signin\" 
                		type=\"submit\">Ingresar</button>
            </form><!-- /form -->
            <a href=\"trns_recuperar_pwd.php\" class=\"forgot-password\">
                ¿Olvido su Password?
            </a>
<div>
$Param
</div>
        </div><!-- /card-container -->
    </div><!-- /container -->

<script>

		$('#btnEnviar').click(function(){
			    		//alert('Pulsado por Submit');

			    		var txtUsuario = $('#inputUsuario').val();
			    		var txtPwd = $('#inputPassword').val();
			    		//alert('Valores usuario: '+ txtUsuario + ' Password : ' + txtPwd);

			    }
		);

</script>

    ";
} // fin de fncBuildBody

function fncBuidTail($JS, $LIB)
{

return "

  <div id=\"footerEPN\" style=\"clear:both; margin-top: 12px;\">
            <div style=\"clear: both; width: 100%; border-top: 1px solid #dedede; margin-bottom: 1px;\"></div>
            <div style=\"border-top: 1px solid #dedede; border-bottom: 1px solid #dedede; font-family: 'Times New Roman', serif; font-size: 14px; color: #666666; text-align: center; padding: 14px 0px;\">SECRETAR&Iacute;A DE SALUD <a href=\"http://portal.salud.gob.mx/contenidos/inicio/politicas.html\" style=\"text-decoration: none; color: #808080;\">POL&Iacute;TICAS DE PRIVACIDAD</a></div>
            <div style=\"clear: both; width: 100%; border-top: 1px solid #dedede; margin-top: 1px;\"></div>
            
            <div style=\"clear:both; width: 100%;\" class=\"card-container\">
                
            </div>
            
            <div style=\"margin: 32px auto 42px auto; text-align: center; font-family: 'Times New Roman', serif; font-weight: lighter; font-size: 13px;\">
                <p style=\"color: #808080; line-height: 5px;\">Reforma No. 156, 7° Piso, Col. Juárez Deleg. Cuauhtémoc D.F. C.P. 06600 - Tel. (55) 50-62-16-00 y (55) 50-62-17-00 </p> 
                <p style=\"color: #808080; line-height: 5px;\">Distrito Federal CP. 06600 </p>
            </div>
            <div style=\"clear: both; width: 100%;\"></div>
        </div>
</div>

<!--
<div id=\"pie\">
        <p>
            Reforma No. 156, 7° Piso, Col. Juárez Deleg. Cuauhtémoc D.F. C.P. 06600 - Tel. (55) 50-62-16-00 y (55) 50-62-17-00 
        </p>    
        <div id=\"pie_b\">
            &nbsp;
        </div>
        <p>
            DIRECCIÓN GENERAL DE RECURSOS HUMANOS, MÉXICO  2012 - <a href=\"http://portal.salud.gob.mx/contenidos/temas_interes/politica_privacidad.html\">POL&Iacute;TICAS DE PRIVACIDAD</a>
        </p>
        <div id=\"pie_d\">
                &nbsp;
        </div>
</div>
-->             
    </div>



</body>
</html>
";

} // fin de fncBuidTail


?>