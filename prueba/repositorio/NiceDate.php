<?php
date_default_timezone_set('America/Mexico_City');
//Function definition

function timeAgo($time_ago)
{
    $time_ago = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );
    // Seconds
    if($seconds <= 60){
        return "Justo ahora";
    }
    //Minutes
    else if($minutes <=60){
        if($minutes==1){
            return "Hace un min.";
        }
        else{
            return "Hace $minutes minutos";
        }
    }
    //Hours
    else if($hours <=24){
        if($hours==1){
            return "Hace una hora";
        }else{
            return "Hace $hours horas";
        }
    }
    //Days
    else if($days <= 7){
        if($days==1){
            return "Ayer";
        }else{
            return "Hace $days días";
        }
    }
    //Weeks
    else if($weeks <= 4.3){
        if($weeks==1){
            return "Hace una semana";
        }else{
            return "Hace $weeks semanas";
        }
    }
    //Months
    else if($months <=12){
        if($months==1){
            return "Hace un mes";
        }else{
            return "Hace $months meses";
        }
    }
    //Years
    else{
        if($years==1){
            return "Hace un año";
        }else{
            return "Hace $years años";
        }
    }
}