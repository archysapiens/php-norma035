<?php
session_start();
if(isset($_SESSION['sesionUsuario']) & @$_COOKIE['id']!=''){
	require('../../bd/bd.php');
	require('../../clases/Login.php');
  
		if (isset($_POST['unlock'])) {
            switch($_POST['unlock']) {
				case "resetTime":
				
					$login = new Login();
					$requestUnlock = $login->unlock($_SESSION['sesionUsuario'],$_POST['inputPassword']);
					// if($requestUnlock == 1){ $_SESSION['inicio'] = time(); header('location: ../'.$_SESSION['pageAnterior'].''); }
					if($requestUnlock == 1){ $_SESSION['inicio'] = time(); echo @$sufijoMenu.$_SESSION['pageAnterior']; }
					else{ echo"error"; }
					
				BREAK;
            }
        }else if(isset($_REQUEST['lock'])) {  
			$login = new Login();
			$requestlock = $login->lock();				
        }
}
else{
     session_unset();
    echo"<script>location.href = '../../index.php'</script>";
}
?>