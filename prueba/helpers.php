<?php

function view($plantilla, $variables= array()){
    extract($variables);
    require('views/'.$plantilla.'.tpl.php');
}

function controller($nombre){
    if(empty($nombre))
        $nombre='inicio';

    $archivo= "controllers/$nombre.php";
    $ajax= "repositorio/$nombre.php";

    if(file_exists($archivo))
         require($archivo);
     else if (file_exists($ajax))
         require($ajax);
     else
          echo $nombre;
}


// function controller($nombre){
    // if(empty($nombre))
        // base64_encode ($nombre='inicio');

    // $archivo= "controllers/$nombre.php";
    // $ajax= "repositorio/$nombre.php";

    // if(file_exists($archivo))
         // require($archivo);
     // else if (file_exists($ajax))
         // require($ajax);
     // else
          // echo"<script>location.href = './'</script>";
// }