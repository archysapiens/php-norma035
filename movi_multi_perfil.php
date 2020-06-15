<?php
session_start();
include "./general/generales.inc";
include "movi_multi_perfil.inc";

$Privilegios="";
if(isset($_SESSION['privilegios']))
    $Privilegios = $_SESSION['privilegios'];

$ArrPerfilesPorUsuario = explode("|", $Privilegios);

//print_r($_SESSION);


//echo "Numero perfiles >".count($ArrPerfiles)."< <br>";
$CatMovimiento="#";
$SeleccionPerfiles="";
$ArrPerfiles =array( "1"  => " Movimientos de Personal     " ,       
                     "2"  => " Recursos en Formación X" ,            
                     "3"  => " Incidencias" ,   
                     "4"  => " Servicio Social Administrativo" 
                     );

$ContadorPrivilegios=CERO;
print_r($ArrPerfilesPorUsuario );
foreach ($ArrPerfilesPorUsuario as $item) {
   
   if( $ContadorPrivilegios > CERO){
       $Aux = $ArrPerfiles[$item];
       if($item=="1"){
            $Msg= "Movimientos de Personal de Base y Estructura";
            $DataClass ="medical";
            $Ico ="corporate-researcher-icon";
            $CatMovimiento="movi/movi_escritorio.php?tipo=mp&origen=m";
			//$CatMovimiento="movi_escritorio.php?tipo=mp&origen=m";
       }     
       elseif($item=="2") {
            $Msg= "Médicos Residentes, Médicos Residentes para Trabajo Social Comunitario Itinerante (Caravanas de la Salud), Internos de Pregrado y Servicio Social Área Médica.";
               $Ico ="ico-medical-researcher-color-ssa";
            $DataClass ="company";   
            $CatMovimiento="movi/movi_escritorio.php?tipo=rf&origen=m";
			//$CatMovimiento="movi_escritorio.php?tipo=rf&origen=m";
        }
        elseif($item=="3") {
            $Msg= "El objetivo es: Incorporar los movimientos de Incidencias en el Sistema de Movimientos Vía WEB, SMVW, que sean registrados por las Unidades Responsables, a través de sus coordinadores administrativos para su aplicación a nómina.";
               $Ico ="corporate-researcher-icon";
            $DataClass ="company";   
            $CatMovimiento="movi/movi_escritorio.php?tipo=inc&origen=m";
			//$CatMovimiento="movi_escritorio.php?tipo=inc&origen=m";
        }
        elseif($item=="4") {
            $Msg= "Movimientos de Pasantes de Servicio Social Administrativo";
               $Ico ="academic-researcher-icon";
            $DataClass ="company";   
            $CatMovimiento="movi/movi_escritorio.php?tipo=ssa&origen=m";
			//$CatMovimiento="movi_escritorio.php?tipo=ssa&origen=m";
        }
        $SeleccionPerfiles .= "
        <a href=\"$CatMovimiento\" data-classification=\"$DataClass\" class=\"js-submit option $DataClass\"> 
        <div class=\"other\"> <div class=\"indent-container\"> <div class=\"indent-left\"> 
        <div class=\"icon $Ico\" style=\"    width: 75px;\"></div> </div> <div class=\"indent-right\"> 
        <div class=\"arrow-icon\"></div> </div> <div class=\"type\"> $Aux </div> 
        <div class=\"examples\"> $Msg
         </div> </div> </div> </a> 

        ";
    }// find el if( $ContadorPrivilegios > CERO)
    $ContadorPrivilegios++;    
}// fin del foreach

?>


<html lang="en" class="yui3-js-enabled grunticon grunticon js-widgetContainer" id="rgw4_58c729ac9df67">

<head> <meta charset="utf-8"> 
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">  
    <meta name="referrer" content="origin-when-cross-origin">   
    <meta name="Rg-Request-Token" id="Rg-Request-Token" content="QEUo4i9FeuLqGW6qIzrmdzTlyvMCSl6l9PuP/LCHqFyNb+yYf7emMWRF1FvxZEIxYGJqDp1x5s1wGD81bV1OU7LVCDavI+/2XVYU1R/9/XYJRMz3cR3NfjT/fvzTeJUzVQFax7Zwf6gRq7I9jKrvLF3izZfr1zje0bqX0C++UTRuFlZj16Ds//bM1xu5ZBY/BHjwbgrccy7Z/3Y11YDH+NEMAmHcL2El3UwI7TTsIxNZtfBujVANKF2/WXhG+2Kf2F7KaWrYqfN020ep7XR8tS0j1BaxjC0qqzLKBAlYuFQ="> 
    <meta http-equiv="expires" content="0">   
    <link rel="preload" as="script" href="./c5.rgstatic.net/m/335413878735665/javascript/min/lib/error_logging.js">  
    <link rel="preload" as="script" href="./c5.rgstatic.net/m/339124904452375/javascript/vendor/lscache/lscache.min.js">  
    <link rel="preload" as="script" href="./c5.rgstatic.net/m/33781146478244/javascript/min/extensions/Hogan.js">  
    <link rel="preload" as="script" href="./c5.rgstatic.net/m/3325746597897798/javascript/vendor/babel-polyfill/dist/polyfill.min.js">  
    <link rel="preload" as="script" href="./c5.rgstatic.net/m/330955462388614/javascript/lib/yui3/yui/yui-min.js">  
    <link rel="preload" as="script" href="./c5.rgstatic.net/m/34062978123254431/javascript/yuiLoaderConfig-min.js">  
    <link rel="preload" as="script" href="./c5.rgstatic.net/m/330428029752317271/javascript/bundles/common.js">  
    <link rel="preload" as="script" href="./c5.rgstatic.net/m/3143131882750385/javascript/min/core/widgetLoader.js">  
    <link rel="preload" as="script" href="./c5.rgstatic.net/m/39542259572752/javascript/vendor/svgxuse/svgxuse.min.js">  
    <link rel="preload" as="style" href="./c5.rgstatic.net/m/33145961576179397/styles/rg.css">  
    <link rel="preload" as="style" href="./c5.rgstatic.net/m/3709687045243091/styles/rg2.css">  
    <link rel="preload" as="style" href="./c5.rgstatic.net/m/33133587538190554/styles/rg-nova.css">  

    <link rel="preload" as="style" href="https://c5.rgstatic.net/m/41439027602322228/styles/icons.css">
    <link rel="preload" as="style" href="./c5.rgstatic.net/m/320191396292444/styles/pow/application/PressQuotes.css">  
    <link rel="preload" as="style" href="./c5.rgstatic.net/m/340644985037343/styles/pow/signup/SignUpResearcherClassificationDefault.css">  
    <link rel="preload" as="style" href="./c5.rgstatic.net/m/3424510818822149/styles/modules/signup.css">  
    <link rel="preload" as="font" href="./fonts/roboto-v15-latin-400.woff2" type="font/woff2" crossorigin="">  
    <link rel="preload" as="font" href="./fonts/roboto-v15-latin-700.woff2" type="font/woff2" crossorigin="">  
    <link rel="preload" as="font" href="./fonts/rosalind-serif-v1-latin-greek-400.woff2" type="font/woff2" crossorigin="">  
    <link rel="preload" as="font" href="./fonts/rosalind-serif-v1-latin-greek-700.woff2" type="font/woff2" crossorigin="">  

    <link rel="apple-touch-icon" sizes="57x57" href="./www.researchgate.net/apple-touch-icon-57x57.png"> 
    <link rel="apple-touch-icon" sizes="60x60" href="./www.researchgate.net/apple-touch-icon-60x60.png"> 
    <link rel="apple-touch-icon" sizes="72x72" href="./www.researchgate.net/apple-touch-icon-72x72.png"> 
    <link rel="apple-touch-icon" sizes="76x76" href="/www.researchgate.net/apple-touch-icon-76x76.png"> 
    <link rel="apple-touch-icon" sizes="114x114" href="./www.researchgate.net/apple-touch-icon-114x114.png"> 
    <link rel="apple-touch-icon" sizes="120x120" href="./www.researchgate.net/apple-touch-icon-120x120.png"> 
    <link rel="apple-touch-icon" sizes="144x144" href="./www.researchgate.net/apple-touch-icon-144x144.png"> 
    <link rel="apple-touch-icon" sizes="152x152" href="./www.researchgate.net/apple-touch-icon-152x152.png"> 
    <link rel="apple-touch-icon" sizes="180x180" href="./www.researchgate.net/apple-touch-icon-180x180.png"> 
    <link rel="icon" type="image/png" href="./www.researchgate.net/favicon-32x32.png" sizes="32x32"> 

    <link rel="icon" type="image/png" href="./www.researchgate.net/android-chrome-192x192.png" sizes="192x192"> 

    <link rel="icon" type="image/png" href="./www.researchgate.net/favicon-96x96.png" sizes="96x96"> 
    <link rel="icon" type="image/png" href="./www.researchgate.net/favicon-16x16.png" sizes="16x16"> 
    <link rel="shortcut icon" type="image/x-icon" href="./c5.rgstatic.net/m/3390829798215018/images/favicon.ico"> 

    <link rel="manifest" href="./www.researchgate.net/manifest.json"> 
    <meta name="msapplication-TileColor" content="#da532c"> 
    <meta name="msapplication-TileImage" content="./www.researchgate.net/mstile-144x144.png"> <meta name="theme-color" content="#444444"> 
    <link rel="search" type="application/opensearchdescription+xml" title="ResearchGate search" href="./www.researchgate.net/application.DownloadOpenSearchPlugin.html"> 
    <link rel="meta" type="application/rdf+xml" title="ICRA labels" href="./www.researchgate.net/application.DownloadLabels.html"> 
    <link rel="http://oexchange.org/spec/0.8/rel/related-target" type="application/xrd+xml" href="./www.researchgate.net/application.DownloadOExchange.html"> 
	

    <base href="http://www.movi.salud.gob.mx/"> 
<!--	
	<base href="./"> 
-->	
	
    <link rel="stylesheet" href="https://c5.rgstatic.net/c/omrlz1/styles/icons/_header-ico.svg.css" media="all">
    <link rel="stylesheet" href="./c5.rgstatic.net/c/omrlz1/styles/icons/_ico.svg.css" media="all">


    <script async="" type="text/javascript" src="https://www.googletagservices.com/tag/js/gpt.js"></script>

    <script>
    var rgConfig = {
        correlationId: "rgreq-bbd6710cccdaa3da5f6ee01501c27569",
        accountId: "0",
        module: "signup",
        action: "signup.SignUp",
        product: "signup",
        continent: "North America",
        stylesHome: "./c5.rgstatic.net/m/",
        staticHost: "https://movi.salud.gob.mx",
        longRunningRequestIdentifier: "LongRunningRequest.signup.SignUp",
        longRunningRequestFp: "fa86788142a29e5dc9aa48479a5b642cee2633a0",
        enableGraphQLWhitelist: false
    };
    window.rootUrl = "https://www.researchgate.net/";
</script> <meta property="twitter:site" content="@ResearchGate">
<meta property="twitter:creator" content="@ResearchGate">
<meta property="twitter:card" content="summary">
<meta property="og:site" content="ResearchGate">
<meta property="og:site_name" content="ResearchGate">
<meta property="og:type" content="website">
<meta property="og:title" content="Sign up - ResearchGate">
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="dns-prefetch" href="https://c5.rgstatic.net">
<link rel="dns-prefetch" href="https://i1.rgstatic.net">
<link href="https://c5.rgstatic.net/m/33145961576179397/styles/rg.css" type="text/css" rel="stylesheet">
<link href="https://c5.rgstatic.net/m/3709687045243091/styles/rg2.css" type="text/css" rel="stylesheet">
<link href="https://c5.rgstatic.net/m/33133587538190554/styles/rg-nova.css" type="text/css" rel="stylesheet">
<link href="https://c5.rgstatic.net/m/320191396292444/styles/pow/application/PressQuotes.css" type="text/css" rel="stylesheet">
<link href="https://c5.rgstatic.net/m/428352716727373/styles/pow/signup/SignUpResearcherClassificationDefault.css" type="text/css" rel="stylesheet">
<link href="https://c5.rgstatic.net/m/3424510818822149/styles/modules/signup.css" type="text/css" rel="stylesheet">
<script src="https://c5.rgstatic.net/m/335413878735665/javascript/min/lib/error_logging.js" type="text/javascript" async=""></script><noscript></noscript>
<script crossorigin="anonymous" charset="utf-8" id="yui_3_14_1_1_1489447304922_2" src="https://c5.rgstatic.net/c/30273c080ada3ad959c5e8382e9ae277/javascript/combo/lib/yui3/oop/oop-min.js&amp;lib/yui3/attribute-core/attribute-core-min.js&amp;lib/yui3/event-custom-base/event-custom-base-min.js&amp;lib/yui3/event-custom-complex/event-custom-complex-min.js&amp;lib/yui3/attribute-observable/attribute-observable-min.js&amp;lib/yui3/attribute-extras/attribute-extras-min.js&amp;lib/yui3/attribute-base/attribute-base-min.js&amp;lib/yui3/attribute-complex/attribute-complex-min.js&amp;lib/yui3/base-core/base-core-min.js&amp;lib/yui3/base-observable/base-observable-min.js&amp;lib/yui3/base-base/base-base-min.js&amp;lib/yui3/pluginhost-base/pluginhost-base-min.js&amp;lib/yui3/pluginhost-config/pluginhost-config-min.js&amp;lib/yui3/base-pluginhost/base-pluginhost-min.js&amp;lib/yui3/classnamemanager/classnamemanager-min.js&amp;lib/yui3/dom-core/dom-core-min.js&amp;lib/yui3/dom-base/dom-base-min.js&amp;lib/yui3/selector-native/selector-native-min.js&amp;lib/yui3/selector/selector-min.js&amp;lib/yui3/node-core/node-core-min.js&amp;lib/yui3/color-base/color-base-min.js" async=""></script><script crossorigin="anonymous" charset="utf-8" id="yui_3_14_1_1_1489447304922_3" src="https://c5.rgstatic.net/c/30273c080ada3ad959c5e8382e9ae277/javascript/combo/lib/yui3/dom-style/dom-style-min.js&amp;lib/yui3/node-base/node-base-min.js&amp;lib/yui3/event-base/event-base-min.js&amp;lib/yui3/event-synthetic/event-synthetic-min.js&amp;lib/yui3/event-focus/event-focus-min.js&amp;lib/yui3/node-style/node-style-min.js&amp;lib/yui3/widget-base/widget-base-min.js&amp;lib/yui3/widget-htmlparser/widget-htmlparser-min.js&amp;lib/yui3/widget-skin/widget-skin-min.js&amp;lib/yui3/event-delegate/event-delegate-min.js&amp;lib/yui3/node-event-delegate/node-event-delegate-min.js&amp;lib/yui3/widget-uievents/widget-uievents-min.js&amp;lib/yui3/base-build/base-build-min.js&amp;lib/yui3/widget-stdmod/widget-stdmod-min.js&amp;lib/yui3/dom-screen/dom-screen-min.js&amp;lib/yui3/node-screen/node-screen-min.js&amp;lib/yui3/widget-position/widget-position-min.js&amp;lib/yui3/widget-position-align/widget-position-align-min.js&amp;lib/yui3/widget-stack/widget-stack-min.js&amp;lib/yui3/widget-position-constrain/widget-position-constrain-min.js&amp;lib/yui3/overlay/overlay-min.js" async=""></script><script crossorigin="anonymous" charset="utf-8" id="yui_3_14_1_1_1489447304922_4" src="https://c5.rgstatic.net/c/30273c080ada3ad959c5e8382e9ae277/javascript/combo/lib/yui3/transition/transition-min.js&amp;lib/yui3/anim-base/anim-base-min.js&amp;lib/yui3/plugin/plugin-min.js&amp;lib/yui3/widget-anim/widget-anim-min.js&amp;lib/yui3/json-parse/json-parse-min.js&amp;lib/yui3/json-stringify/json-stringify-min.js&amp;lib/yui3/stylesheet/stylesheet-min.js&amp;lib/yui3/array-extras/array-extras-min.js&amp;lib/yui3/querystring-parse/querystring-parse-min.js&amp;lib/yui3/querystring-stringify/querystring-stringify-min.js&amp;lib/yui3/node-pluginhost/node-pluginhost-min.js" async=""></script><script crossorigin="anonymous" charset="utf-8" id="yui_3_14_1_1_1489447304922_5" src="https://c5.rgstatic.net/c/ad77207e50a51efdb3e365a9b4179477/javascript/combo/lib/yui-gallery/gallery-outside-events/gallery-outside-events-min.js&amp;lib/yui-gallery/gallery-overlay-extras/gallery-overlay-extras-min.js" async=""></script><script crossorigin="anonymous" charset="utf-8" id="yui_3_14_1_1_1489447304922_6" src="https://c5.rgstatic.net/javascript/combo/m/3229207116905/min/yui-modules/widget/tooltip.js&amp;m/32697310973919/min/yui-modules/core/form/ErrorPopoverPlugin.js&amp;m/337422620921026/min/yui-modules/utils/validation.js&amp;m/358371873711269/min/yui-modules/WidgetView.js&amp;m/311329580632313/min/yui-modules/utils/utils-url.js&amp;m/31821383719315/min/yui-modules/utils/matchhighlighter.js&amp;m/35213486758809/min/yui-modules/utils/string.js&amp;m/31360877779552/min/yui-modules/utils/utils-dom.js&amp;m/32325173148757/min/yui-modules/widget/overlay.js&amp;m/326602345338344/min/yui-modules/rg-widgetloader-renderers/rg-widgetloader-renderers.js&amp;m/321659673591740/min/yui-modules/core/util/ParameterFilter.js&amp;m/323146772168924/min/yui-modules/rg-widgetloader-pushstate/rg-widgetloader-pushstate.js&amp;m/322967167644585/min/yui-modules/core/pagespeed/Monitoring.js" async=""></script><script crossorigin="anonymous" charset="utf-8" id="yui_3_14_1_1_1489447304922_12" src="https://c5.rgstatic.net/m/311323538216475/javascript/min/vendor/lazysizes/lazysizes.min.js" async=""></script><script crossorigin="anonymous" charset="utf-8" id="yui_3_14_1_1_1489447304922_13" src="https://c5.rgstatic.net/c/30273c080ada3ad959c5e8382e9ae277/javascript/combo/lib/yui3/io-base/io-base-min.js&amp;lib/yui3/queue-promote/queue-promote-min.js&amp;lib/yui3/io-queue/io-queue-min.js&amp;lib/yui3/cookie/cookie-min.js&amp;lib/yui3/event-mousewheel/event-mousewheel-min.js&amp;lib/yui3/event-mouseenter/event-mouseenter-min.js&amp;lib/yui3/event-key/event-key-min.js&amp;lib/yui3/event-resize/event-resize-min.js&amp;lib/yui3/event-hover/event-hover-min.js&amp;lib/yui3/event-outside/event-outside-min.js&amp;lib/yui3/event-touch/event-touch-min.js&amp;lib/yui3/event-move/event-move-min.js&amp;lib/yui3/event-flick/event-flick-min.js&amp;lib/yui3/event-valuechange/event-valuechange-min.js&amp;lib/yui3/event-tap/event-tap-min.js&amp;lib/yui3/anim-color/anim-color-min.js&amp;lib/yui3/anim-xy/anim-xy-min.js&amp;lib/yui3/anim-curve/anim-curve-min.js&amp;lib/yui3/anim-easing/anim-easing-min.js&amp;lib/yui3/anim-node-plugin/anim-node-plugin-min.js&amp;lib/yui3/anim-scroll/anim-scroll-min.js" async=""></script><script crossorigin="anonymous" charset="utf-8" id="yui_3_14_1_1_1489447304922_14" src="https://c5.rgstatic.net/javascript/combo/m/317544590906297/min/yui-modules/ajax/uri.js&amp;m/340972281914647/min/yui-modules/ajax/ajax.js&amp;m/334633682264103/min/yui-modules/rg-anim/rg-anim.js&amp;m/34099910806698/min/yui-modules/rg-request-token/rg-request-token.js&amp;m/33258540756219/min/yui-modules/rg-base/rg-base.js" async=""></script><script crossorigin="anonymous" charset="utf-8" id="yui_3_14_1_1_1489447304922_28" src="https://c5.rgstatic.net/javascript/combo/m/329727995571543/min/yui-modules/core/pagespeed/Tracker.js" async=""></script><script crossorigin="anonymous" charset="utf-8" id="yui_3_14_1_1_1489447304922_33" src="https://c5.rgstatic.net/m/321552077839364/javascript/min/extensions/generalHelpers.js" async=""></script><script crossorigin="anonymous" charset="utf-8" id="yui_3_14_1_1_1489447304922_34" src="https://c5.rgstatic.net/javascript/combo/m/37647478531910/min/yui-modules/plugins/rg-page-leave.js&amp;m/322008103192264/min/yui-modules/rg-confirm/rg-confirm.js&amp;m/310470324143457/min/yui-modules/app/signup/plugins/step/SteppingNewRendering.js&amp;m/3385699342011206/min/pow/signup/views/SignUpStepView.js&amp;m/324904676312349/min/yui-modules/app/signup/plugins/ResponseValidator.js&amp;m/3294695813787/min/yui-modules/app/template/TemplateFactory.js&amp;m/31852210522518/min/yui-modules/utils/object.js&amp;m/328044108725040/min/yui-modules/form/form-serialize.js&amp;m/332922366751243/min/yui-modules/rg-signup-view/rg-signup-view.js&amp;m/310885406801760/min/yui-modules/utils/keyboard.js&amp;m/3438150899989/min/yui-modules/form/form.js&amp;m/32597579892745/min/yui-modules/utils/callback-timer.js&amp;m/339815760383247/min/yui-modules/widget/header-notify.js&amp;m/327093081471177/min/pow/signup/views/AbstractSignUpResearcherClassificationView.js&amp;m/37876526491141/min/pow/application/views/PressQuotesView.js" async=""></script><script crossorigin="anonymous" charset="utf-8" id="yui_3_14_1_1_1489447304922_35" src="https://c5.rgstatic.net/javascript/stubs/m/3985a0826fecdea944128844d9e6728cd/signup/stubs/SignUpResearcherClassification.html&amp;m/3985a0826fecdea944128844d9e6728cd/signup/stubs/SignUpResearcherClassificationDefault.html&amp;m/3985a0826fecdea944128844d9e6728cd/signup/stubs/partials/jsDisabledWarning.html&amp;m/3985a0826fecdea944128844d9e6728cd/signup/stubs/partials/signUpHeader.html&amp;m/3985a0826fecdea944128844d9e6728cd/signup/stubs/partials/signUpContentHeader.html&amp;m/3985a0826fecdea944128844d9e6728cd/signup/stubs/partials/signUpContentFooter.html&amp;m/3985a0826fecdea944128844d9e6728cd/signup/stubs/partials/signUpRightColHeader.html&amp;m/3985a0826fecdea944128844d9e6728cd/signup/stubs/partials/signUpRightColFooter.html&amp;m/3985a0826fecdea944128844d9e6728cd/signup/stubs/partials/signUpFooter.html&amp;m/3985a0826fecdea944128844d9e6728cd/signup/stubs/partials/errorMessageStart.html&amp;m/3985a0826fecdea944128844d9e6728cd/signup/stubs/partials/errorMessageEnd.html" async=""></script><script crossorigin="anonymous" charset="utf-8" id="yui_3_14_1_1_1489447304922_36" src="https://c5.rgstatic.net/javascript/stubs/m/3985a0826fecdea944128844d9e6728cd/signup/stubs/partials/signupResearcherClassification/hDefault.html&amp;m/3985a0826fecdea944128844d9e6728cd/signup/stubs/partials/signupResearcherClassification/academicCopy.html&amp;m/3985a0826fecdea944128844d9e6728cd/signup/stubs/partials/signupResearcherClassification/corporateCopy.html&amp;m/3985a0826fecdea944128844d9e6728cd/signup/stubs/partials/signupResearcherClassification/medicalCopy.html&amp;m/3985a0826fecdea944128844d9e6728cd/signup/stubs/partials/signupResearcherClassification/nonResearcherCopy.html&amp;m/3adb232121215f227fdc37a72df342bd2/application/stubs/PressQuotes.html" async=""></script><script crossorigin="anonymous" charset="utf-8" id="yui_3_14_1_1_1489447304922_37" src="https://c5.rgstatic.net/c/ad77207e50a51efdb3e365a9b4179477/javascript/combo/lib/yui-gallery/gallery-event-pasted/gallery-event-pasted-min.js" async=""></script><script crossorigin="anonymous" charset="utf-8" id="yui_3_14_1_1_1489447304922_125" src="https://c5.rgstatic.net/javascript/stubs/m/3adb232121215f227fdc37a72df342bd2/application/stubs/partials/inlineErrorTooltip.html" async=""></script><script crossorigin="anonymous" charset="utf-8" id="yui_3_14_1_1_1489447304922_191" src="https://c5.rgstatic.net/javascript/stubs/m/3adb232121215f227fdc37a72df342bd2/application/stubs/StaticHeader.html" async=""></script><script crossorigin="anonymous" charset="utf-8" id="yui_3_14_1_1_1489447304922_204" src="https://c5.rgstatic.net/javascript/stubs/m/3adb232121215f227fdc37a72df342bd2/application/stubs/IncError.html" async=""></script><script crossorigin="anonymous" charset="utf-8" id="yui_3_14_1_1_1489447304922_210" src="https://c5.rgstatic.net/javascript/combo/m/314562243302189/min/yui-modules/plugins/rg-dropdown-plugin.js&amp;m/31684645141892/min/yui-modules/plugins/rg-capslock-detector.js" async=""></script><noscript id="yui_modules_entrypoint"></noscript>
<title>Sign up - ResearchGate</title>
<meta name="description" content="ResearchGate is a network dedicated to science and research. Connect, collaborate and discover scientific publications, jobs and conferences. All for free.">
<meta name="keywords" content="scientific network, scientific platform, scientific community, research partner, research collaboration, journal articles, international collaboration, find researcher, lifescience researcher, interdisciplinary research, research collaboration">
<script src="https://securepubads.g.doubleclick.net/gpt/pubads_impl_111.js" async=""></script>
<!--
<link rel="prefetch" href="https://tpc.googlesyndication.com/safeframe/1-0-6/html/container.html">

-->

<style>

.ico-medical-researcher-color-ssa{background-image:url('data:image/svg+xml;charset%3DUS-ASCII,%3Csvg%20width%3D%2275%22%20height%3D%2280%22%20viewBox%3D%220%200%2075%2080%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cg%20fill%3D%22none%22%20fill-rule%3D%22evenodd%22%3E%3Cpath%20d%3D%22M70.308%2065.88L47.725%2056l-10.23%2010.227L27.302%2056l-22.61%209.88C2.102%2067.013%200%2070.232%200%2073.06v5.093c0%20.944.767%201.71%201.707%201.71H73.29c.942%200%201.707-.747%201.707-.003v-6.8c0-2.832-2.095-6.045-4.69-7.18z%22%20fill%3D%22%230CB%22%2F%3E%3Ccircle%20fill%3D%22%23DDD%22%20cx%3D%2223%22%20cy%3D%2271%22%20r%3D%225%22%2F%3E%3Cpath%20d%3D%22M23%2070.863V60a8%208%200%200%201%208-8h13c4.418%200%208%203.572%208%208.007v11.15%22%20stroke%3D%22%23777%22%20stroke-width%3D%222%22%2F%3E%3Cpath%20d%3D%22M27.27%2056V39.203h20.45V56L37.5%2066.18%2027.27%2056z%22%20fill%3D%22%23EAC3A2%22%2F%3E%3Cpath%20d%3D%22M56.245%2018.75v13.635c0%2010.337-8.412%2018.75-18.75%2018.75-10.337%200-18.75-8.413-18.75-18.75V18.75h37.5z%22%20fill%3D%22%23F1D9C5%22%2F%3E%3Cpath%20d%3D%22M18.746%2018.747c0-5.647%204.322-11.768%209.637-13.666L41.006.575c.885-.316%201.942.107%202.36.94l2.652%205.306c5.648%200%2010.227%204.59%2010.227%2010.226V27.27a8.522%208.522%200%200%200-8.523-8.52H27.27a8.522%208.522%200%200%200-8.524%208.52v-8.523z%22%20fill%3D%22%23C6A279%22%2F%3E%3Ccircle%20fill%3D%22%23F4F4F4%22%20cx%3D%2223%22%20cy%3D%2271%22%20r%3D%223%22%2F%3E%3Cpath%20d%3D%22M58%2079.86V77a6%206%200%201%200-12%200v2.86%22%20stroke%3D%22%23777%22%20stroke-width%3D%222%22%2F%3E%3C%2Fg%3E%3C%2Fsvg%3E');background-repeat:no-repeat;background-size:75px 80px;height:80px;width:75px;}

.ico-medical-researcher-color-big{background-image:url('data:image/svg+xml;charset%3DUS-ASCII,%3Csvg%20width%3D%2285%22%20height%3D%2290%22%20viewBox%3D%220%200%2085%2090%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cg%20fill%3D%22none%22%20fill-rule%3D%22evenodd%22%3E%3Cpath%20d%3D%22M84.883%2082.31c0-3.207-2.37-6.843-5.307-8.127L54.016%2063c-3.256%202.41-7.242%203.858-11.575%203.858-4.33%200-8.314-1.447-11.54-3.858L5.316%2074.183C2.378%2075.465%200%2079.108%200%2082.31v5.763c0%201.07.868%201.935%201.932%201.935H82.95a1.92%201.92%200%200%200%201.933-1.935V82.31z%22%20fill%3D%22%230CB%22%2F%3E%3Cellipse%20fill%3D%22%23DDD%22%20cx%3D%2226.068%22%20cy%3D%2280.47%22%20rx%3D%225.667%22%20ry%3D%225.667%22%2F%3E%3Cpath%20d%3D%22M26.068%2080.315V66.937a8%208%200%200%201%207.998-8.002h16.87a7.996%207.996%200%200%201%208%208V80.65%22%20stroke%3D%22%23777%22%20stroke-width%3D%222%22%2F%3E%3Cpath%20d%3D%22M30.906%2063.47V44.43h23.18v19.04L42.503%2075.004%2030.906%2063.47z%22%20fill%3D%22%23EAC3A2%22%2F%3E%3Cpath%20d%3D%22M63.746%2021.25v15.454c0%2011.717-9.533%2021.25-21.25%2021.25-11.716%200-21.25-9.533-21.25-21.25V21.25h42.5z%22%20fill%3D%22%23F1D9C5%22%2F%3E%3Cpath%20d%3D%22M21.247%2021.248c0-6.4%204.897-13.338%2010.922-15.49L46.47.648c1.004-.358%202.2.12%202.674%201.067l3.005%206.012c6.403%200%2011.59%205.203%2011.59%2011.59V30.91a9.66%209.66%200%200%200-9.657-9.66h-23.18a9.66%209.66%200%200%200-9.66%209.66v-9.662z%22%20fill%3D%22%23C6A279%22%2F%3E%3Cellipse%20fill%3D%22%23F4F4F4%22%20cx%3D%2226.068%22%20cy%3D%2280.47%22%20rx%3D%223.4%22%20ry%3D%223.4%22%2F%3E%3Cpath%20d%3D%22M65.736%2090.51v-3.24a6.8%206.8%200%200%200-13.6%200v3.24%22%20stroke%3D%22%23777%22%20stroke-width%3D%222%22%2F%3E%3C%2Fg%3E%3C%2Fsvg%3E');background-repeat:no-repeat;background-size:85px 90px;height:90px;width:85px;}

.ico-medical-researcher-color{background-image:url('data:image/svg+xml;charset%3DUS-ASCII,%3Csvg%20width%3D%2275%22%20height%3D%2280%22%20viewBox%3D%220%200%2075%2080%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cg%20fill%3D%22none%22%20fill-rule%3D%22evenodd%22%3E%3Cpath%20d%3D%22M70.308%2065.88L47.725%2056l-10.23%2010.227L27.302%2056l-22.61%209.88C2.102%2067.013%200%2070.232%200%2073.06v5.093c0%20.944.767%201.71%201.707%201.71H73.29c.942%200%201.707-.747%201.707-.003v-6.8c0-2.832-2.095-6.045-4.69-7.18z%22%20fill%3D%22%230CB%22%2F%3E%3Ccircle%20fill%3D%22%23DDD%22%20cx%3D%2223%22%20cy%3D%2271%22%20r%3D%225%22%2F%3E%3Cpath%20d%3D%22M23%2070.863V60a8%208%200%200%201%208-8h13c4.418%200%208%203.572%208%208.007v11.15%22%20stroke%3D%22%23777%22%20stroke-width%3D%222%22%2F%3E%3Cpath%20d%3D%22M27.27%2056V39.203h20.45V56L37.5%2066.18%2027.27%2056z%22%20fill%3D%22%23EAC3A2%22%2F%3E%3Cpath%20d%3D%22M56.245%2018.75v13.635c0%2010.337-8.412%2018.75-18.75%2018.75-10.337%200-18.75-8.413-18.75-18.75V18.75h37.5z%22%20fill%3D%22%23F1D9C5%22%2F%3E%3Cpath%20d%3D%22M18.746%2018.747c0-5.647%204.322-11.768%209.637-13.666L41.006.575c.885-.316%201.942.107%202.36.94l2.652%205.306c5.648%200%2010.227%204.59%2010.227%2010.226V27.27a8.522%208.522%200%200%200-8.523-8.52H27.27a8.522%208.522%200%200%200-8.524%208.52v-8.523z%22%20fill%3D%22%23C6A279%22%2F%3E%3Ccircle%20fill%3D%22%23F4F4F4%22%20cx%3D%2223%22%20cy%3D%2271%22%20r%3D%223%22%2F%3E%3Cpath%20d%3D%22M58%2079.86V77a6%206%200%201%200-12%200v2.86%22%20stroke%3D%22%23777%22%20stroke-width%3D%222%22%2F%3E%3C%2Fg%3E%3C%2Fsvg%3E');background-repeat:no-repeat;background-size:75px 80px;height:80px;width:75px;}

.ico-medical-researcher{background-image:url('data:image/svg+xml;charset%3DUS-ASCII,%3Csvg%20width%3D%2238%22%20height%3D%2242%22%20viewBox%3D%220%200%2038%2042%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cg%20fill%3D%22none%22%20fill-rule%3D%22evenodd%22%3E%3Cpath%20d%3D%22M6.11%209.353c1.31.235%202.678.36%204.084.36%205.73%200%2010.778-2.073%2014-5.27%201.236%203.015%203.848%205.573%207.28%207.254%22%20stroke%3D%22%23AAA%22%20stroke-width%3D%221.15%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%2F%3E%3Cpath%20d%3D%22M27.384%2024.006a13.3%2013.3%200%200%201-8.797%203.31%2013.3%2013.3%200%200%201-8.504-3.055%2019.598%2019.598%200%200%200-8.85%209.27%2025.774%2025.774%200%200%200%2017.758%207.066%2025.775%2025.775%200%200%200%2017.76-7.06%2019.59%2019.59%200%200%200-9.362-9.525z%22%20stroke%3D%22%23AAA%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%2F%3E%3Cpath%20d%3D%22M28.517%2013.54h-1.004%22%20fill%3D%22%23FFF%22%2F%3E%3Cpath%20d%3D%22M28.517%2013.54h-1.004%22%20stroke%3D%22%23AAA%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%2F%3E%3Cpath%20d%3D%22M8.656%2013.54H9.66%22%20fill%3D%22%23FFF%22%2F%3E%3Cpath%20d%3D%22M8.656%2013.54H9.66m-.12%201.382a3.815%203.815%200%201%200%207.63%200%203.815%203.815%200%200%200-7.63%200z%22%20stroke%3D%22%23AAA%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%2F%3E%3Cpath%20d%3D%22M20.41%2013.368a2.707%202.707%200%200%200-1.824-.706%202.7%202.7%200%200%200-1.77.658%22%20stroke%3D%22%23AAA%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%2F%3E%3Cpath%20d%3D%22M27.71%2014.922a3.815%203.815%200%201%201-7.63%200%203.815%203.815%200%200%201%207.63%200h-.003z%22%20stroke%3D%22%23AAA%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%2F%3E%3Cpath%20d%3D%22M31.94%2013.964c0%207.375-5.978%2013.354-13.353%2013.354-7.376%200-13.354-5.98-13.354-13.354C5.233%206.59%2011.21.61%2018.587.61c7.375%200%2013.354%205.98%2013.354%2013.354z%22%20stroke%3D%22%23AAA%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%2F%3E%3Cpath%20d%3D%22M12.104%2034.16a2.5%202.5%200%201%201-5%200%202.5%202.5%200%200%201%205%200z%22%20stroke%3D%22%23AAA%22%20stroke-width%3D%22.833%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%2F%3E%3Cpath%20d%3D%22M23.93%2040.214V33.81a3.5%203.5%200%200%201%207%200v4.026%22%20stroke%3D%22%23AAA%22%20stroke-width%3D%221.167%22%20stroke-linejoin%3D%22round%22%2F%3E%3Cpath%20d%3D%22M9.604%2024.332v8.645m17.826-8.645v5.643%22%20stroke%3D%22%23AAA%22%20stroke-linejoin%3D%22round%22%2F%3E%3Cpath%20d%3D%22M11.104%2034.16a1.5%201.5%200%201%201-3-.002%201.5%201.5%200%200%201%203%200%22%20fill%3D%22%23AAA%22%2F%3E%3C%2Fg%3E%3C%2Fsvg%3E');background-repeat:no-repeat;background-size:38px 42px;height:42px;width:38px;}


</style>

</head>
<body style="height: 110%;
    background-repeat: no-repeat;
    background-image: linear-gradient(rgb(253, 253, 253 ), rgb(155, 155, 155 ));
    background-color: #fFfFfF;" id="yui_3_14_1_1_1489447304922_76">
<div id="page-container" style=" background-repeat: no-repeat;
    background-image: linear-gradient(rgba(212,193,156,.02),rgba(135,108,71,1));
    background-color: #fFfFfF;" class="jumbotron vertical-center">
<script type="text/javascript">
var googletag=googletag||{};googletag.cmd=googletag.cmd||[];
(function(){var gads=document.createElement("script");gads.async=true;gads.type="text/javascript";gads.src="https://www.googletagservices.com/tag/js/gpt.js";var node=document.getElementsByTagName("script")[0];node.parentNode.insertBefore(gads,node);})();
</script>

<img src="http://www.movi.salud.gob.mx/images/salud_top.png" width="289" height="95" style="margin-left:100px;" />

<div style="margin-left: auto;
    margin-right: auto;
    position: relative;width: 982px;top:-60;" class="logged-out-header-support">

<div id="content" class="">
<div style="clear: both;width: 100%;border-top: 1px solid #1d1d1d;margin-bottom: 5px;height: 10.25px;"></div>
<noscript>
&lt;div class="c-box-warning full-width-element" style="text-align: center; "&gt;
    &lt;div style="margin: auto; padding:10px;" class="container"&gt;
        &lt;b&gt;For full functionality of ResearchGate it is necessary to enable JavaScript.
            Here are the &lt;a href="http://www.enable-javascript.com/" rel="nofollow" target="_blank"&gt;
                instructions how to enable JavaScript in your web browser&lt;/a&gt;.&lt;/b&gt;
    &lt;/div&gt;
&lt;/div&gt;
</noscript>

<div id="rgw1_58c729ac9df67" class="signup-researcher-classification js-widgetContainer">  <div id="rgw2_58c729ac9df67" class="su-researcher-classification js-widgetContainer"> <noscript> &lt;div class="c-box-warning full-width-element" style="text-align: center; margin: 0;"&gt; &lt;div style="margin: auto; padding:10px;" class="container"&gt; For full functionality of ResearchGate it is necessary to enable JavaScript. Here are the &lt;a href="http://www.enable-javascript.com/" rel="nofollow noreferrer noopener" target="_blank" style="color: #444; text-decoration: underline;"&gt; instructions how to enable JavaScript in your web browser&lt;/a&gt;. &lt;/div&gt; &lt;/div&gt; </noscript> <div class="signup-wrapper"> <div class="c-col-content"> <div class="c-content js-step-rendering"> 

   <div class="headline">  
    <h1 class="counts"> 
        <span class="headline-part">SISTEMA INTEGRAL DE ADMINISTRACIÓN DE PERSONAL </span> 
        <span class="headline-part">VIA WEB</span> </h1>  

    </div> 

    <div class="c-signup-content classification-new-design"> 
        <form class="form-big clearfix js-form" method="POST" action="signup.SignUpResearcherClassification.html?dbw=true"> <input type="hidden" name="request_token" value="4WdMWWF0QPQzw6sFAKw/43+UW1ViFvdKB1NTccX0yIiK+MPnjiNnVnlSFVedfNf7yqU257C6NeiobikhBO77Hft65mrrdhRN2xZl/okiSeA0P5AhWk0KUJ7PDVmYessL0s5NO3fmI3ypAWnzyQq6WpKADjdDssb8qNamdlbut0CaDKMuJhs6rz2YKf3pFmj7vIULpMO0F3g12jHAfYj9JPhocVvVjfxTjG2tzZaPJnSIdwVwsri2tn1IemGqQwMCXcJ3SfznpRg4NHYViJeA27GlX7ohM5OtvxH1KUyRbxU="> 



<?php 
echo $SeleccionPerfiles

?>




  

</form> <div id="footerEPN" style="clear:both; margin-top: 12px;">
            <div style="clear: both; width: 100%; border-top: 1px solid #dedede; margin-bottom: 1px;"></div>
            <div style="border-top: 1px solid #dedede; border-bottom: 1px solid #dedede; font-family: 'Times New Roman', serif; font-size: 14px; color: #666666; text-align: center; padding: 14px 0px;">SECRETAR&Iacute;A DE SALUD <a href="http://portal.salud.gob.mx/contenidos/inicio/politicas.html" style="text-decoration: none; color: #808080;">POL&Iacute;TICAS DE PRIVACIDAD</a></div>
            <div style="clear: both; width: 100%; border-top: 1px solid #dedede; margin-top: 1px;"></div>
            
            <div style="clear:both; width: 100%;" class="card-container">
                
            </div>
            
            <div style="margin: 32px auto 42px auto; text-align: center; font-family: 'Times New Roman', serif; font-weight: lighter; font-size: 13px;">
                <p style="color: #808080; line-height: 5px;">Reforma No. 156, 7° Piso, Col. Juárez Deleg. Cuauhtémoc D.F. C.P. 06600 - Tel. (55) 50-62-16-00 y (55) 50-62-17-00 </p> 
                <p style="color: #808080; line-height: 5px;">Distrito Federal CP. 06600 </p>
            </div>
            <div style="clear: both; width: 100%;"></div>
        </div>
        
</div></div> 
<div id="rgw8_58c729ac9df67" class="react-container"><div class="header-logged-out" data-reactroot="" data-reactid="1" data-react-checksum="-593664118" id="yui_3_14_1_1_1489447304922_75"><div class="header-logged-out-content header-new search-header" data-reactid="2" id="yui_3_14_1_1_1489447304922_74"><!-- react-empty: 3 --><div aling="left" style="position: absolute;
    top: -50;
    
    width: 100%;
    height: 62px;"  id="yui_3_14_1_1_1489447304922_73"><div class="header-loggedout centered" data-reactid="5" id="yui_3_14_1_1_1489447304922_72"><div class="header-content" data-reactid="6" id="yui_3_14_1_1_1489447304922_71">
<div class="logos lf" data-reactid="7">

   </div>
   <div class="header-login-wrapper js-header-login" data-reactid="27" id="yui_3_14_1_1_1489447304922_41"><div class="header-login-item dropdown" data-reactid="30" id="yui_3_14_1_1_1489447304922_70"><div class="dropdown-menu" data-reactid="34" id="yui_3_14_1_1_1489447304922_69"><div class="header-login-form-wrapper" data-reactid="35" id="yui_3_14_1_1_1489447304922_68"><form method="post" action="https://www.researchgate.net/login" class="form-big header-login-form js-login-form" name="loginForm" id="headerLoginForm" data-reactid="36"><input type="hidden" name="request_token" value="YX/l9O/FdHoUnyicsU1bqj4OpXofR6stednsM7EKA2tnkPNGEZGxbAYOROEKgHRj6Bsza7oezc6kmt0HUCmClq5mgMMjSZ5Ult7khxZWJqvSJ8obWcqVRv3hSBCBN9k/PwAP0gipA2P6zSYnQs72MpiJxl31/ejxvJK+VFm41K07byW6gSeHJUY4MKQ1daLd9Tv951f35P0n9oXOZLkOAA+6RKIlLEmHI3cGhY15N7EeRShyAdNj7kNxrrqATNvdydvPkUbg7ui7ITjuO6MZbmOrbT+eLSYQzxsvaGHUbQY=" data-reactid="37"><input type="hidden" name="urlAfterLogin" value="signup.SignUp.html?ev=su_chnl_index&amp;amp;hdrsu=1&amp;amp;_sg=MMKeWJ8DOcnLFT7gaLsqmSXTa312JFEA70N9GRArOsmF09cZwpMO0NjX6T9yujxq" data-reactid="38"><input type="hidden" name="invalidPasswordCount" value="0" data-reactid="39"><input type="hidden" name="headerLogin" value="yes" data-reactid="40"><label for="input-header-login" data-reactid="41">Email</label><div class="login-input" data-reactid="42" id="yui_3_14_1_1_1489447304922_67"><div class="info-tip-wrapper" data-reactid="43" id="yui_3_14_1_1_1489447304922_66"><span class="ico-info js-info" data-reactid="44"></span></div><input type="email" name="login" class="login js-login-input text" required="" autocomplete="email" id="input-header-login" tabindex="1" data-reactid="45"></div><div class="clear" data-reactid="46"></div><label class="lf" for="input-header-password" data-reactid="47">Password</label><a class="rf forgot-password js-forgot-password" href="application.LostPassword.html" data-reactid="48">Forgot password?</a><div class="clear" data-reactid="49"></div><input type="password" name="password" class="password js-password-input text" required="" autocomplete="current-password" id="input-header-password" tabindex="2" data-reactid="50"><div class="clear" data-reactid="51"></div><label class="remember-me" for="headerLoginCookie" data-reactid="52"><input type="checkbox" value="yes" name="setLoginCookie" class="lf checkbox" id="headerLoginCookie" tabindex="3" data-reactid="53" checked=""><!-- react-text: 54 -->Keep me logged in<!-- /react-text --></label><div class="clear" data-reactid="55"></div><input type="submit" value="Log in" name="loginSubmit" class="btn btn-promote btn-fullwidth btn-large allow-leave js-submit-button" tabindex="4" data-reactid="56"></form><div class="connectors" data-reactid="57"><div class="text" data-reactid="58">or log in with</div><div class="connector-actions" data-reactid="59"><a href="connector/linkedin" class="li-connect js-li-connect" data-redirect-url="c2lnbnVwLlNpZ25VcC5odG1sP2V2PXN1X2NobmxfaW5kZXgmaGRyc3U9MSZfc2c9TU1LZVdKOERPY25MRlQ3Z2FMc3FtU1hUYTMxMkpGRUE3ME45R1JBck9zbUYwOWNad3BNTzBOalg2VDl5dWp4cQ%3D%3D" data-reactid="60"><span class="icon ico-linkedin-round-grey" data-reactid="61"></span><span class="icon ico-linkedin-round" data-reactid="62"></span></a><a href="connector/facebook" class="fb-connect middle js-fb-connect" data-redirect-url="c2lnbnVwLlNpZ25VcC5odG1sP2V2PXN1X2NobmxfaW5kZXgmaGRyc3U9MSZfc2c9TU1LZVdKOERPY25MRlQ3Z2FMc3FtU1hUYTMxMkpGRUE3ME45R1JBck9zbUYwOWNad3BNTzBOalg2VDl5dWp4cQ%3D%3D" data-reactid="63"><span class="icon ico-facebook-round-grey" data-reactid="64"></span><span class="icon ico-facebook-round" data-reactid="65"></span></a><a href="connector/google" class="g-connect js-g-connect" data-redirect-url="c2lnbnVwLlNpZ25VcC5odG1sP2V2PXN1X2NobmxfaW5kZXgmaGRyc3U9MSZfc2c9TU1LZVdKOERPY25MRlQ3Z2FMc3FtU1hUYTMxMkpGRUE3ME45R1JBck9zbUYwOWNad3BNTzBOalg2VDl5dWp4cQ%3D%3D" data-reactid="66"><span class="icon ico-google-round-grey" data-reactid="67"></span><span class="icon ico-google-round" data-reactid="68"></span></a></div></div></div></div></div></div></div></div><div data-reactid="69">

 <script type="application/ld+json" data-reactid="70">{"@context":"http://schema.org","@type":"Organization","name":"ResearchGate","mainEntityOfPage":{"@type":"WebPage","@id":"https://www.researchgate.net/about"},"url":"https://www.researchgate.net","logo":"https://c5.rgstatic.net/m/32868743212969/images/template/rg_logo_square_brand.png","sameAs":["https://www.facebook.com/ResearchGate","https://twitter.com/ResearchGate","https://plus.google.com/+researchgate","https://www.linkedin.com/company/researchgate"]}
</script></div></div></div></div></div><div class="c-inc-errors" style="display:none"> <p class="error bold">An error occurred while rendering template.</p> <p></p> <p>rgreq-bbd6710cccdaa3da5f6ee01501c27569</p> <p>false</p>    </div></div>
<script>
rgConfig.backendTime = 150;
</script>
<script src="https://c5.rgstatic.net/m/339124904452375/javascript/vendor/lscache/lscache.min.js" type="text/javascript"></script>
        <script src="./c5.rgstatic.net/m/33781146478244/javascript/min/extensions/Hogan.js" type="text/javascript"></script>
        <script src="./c5.rgstatic.net/m/3325746597897798/javascript/vendor/babel-polyfill/dist/polyfill.min.js" type="text/javascript"></script>
        <script src="./c5.rgstatic.net/m/330955462388614/javascript/lib/yui3/yui/yui-min.js" type="text/javascript"></script><div id="yui3-css-stamp" style="position: absolute !important; visibility: hidden !important" class=""></div>
        <script src="./c5.rgstatic.net/m/34062978123254431/javascript/yuiLoaderConfig-min.js" type="text/javascript"></script>
        <script src="./c5.rgstatic.net/m/330428029752317271/javascript/bundles/common.js" type="text/javascript"></script>
        <script src="./c5.rgstatic.net/m/3143131882750385/javascript/min/core/widgetLoader.js" type="text/javascript"></script>
        <script src="./c5.rgstatic.net/m/39542259572752/javascript/vendor/svgxuse/svgxuse.min.js" type="text/javascript"></script>
 <script>(function(i,s,o,g,r,a,m){i["GoogleAnalyticsObject"]=r;i[r]=i[r]||function(){ (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) })(window,document,"script","https://www.google-analytics.com/analytics.js","ga");
 ga("create","UA-58591210-1");ga("set","anonymizeIp",true);ga('set', 'dimension3', 'Logged out');ga("send","pageview");</script><script>
(function (){
if (typeof YRG === "undefined") {
var xmlHttpRequest = new XMLHttpRequest();
xmlHttpRequest.open("post", "go.Error.html");
xmlHttpRequest.setRequestHeader("Content-Type", "application/json");
xmlHttpRequest.setRequestHeader("Accept", "application/json"); var loadedScripts = "";
if (window.performance && window.performance.getEntriesByType) {
    var result = [];
    var resources = performance.getEntriesByType("resource");
    for (var i in resources) {
        if (resources.hasOwnProperty(i)) {
            result.push({
                name: resources[i].name,
                duration: resources[i].duration
            });
        }
    }
    loadedScripts += "&loadedScripts=" + encodeURIComponent(JSON.stringify(result));
}
if (typeof YUI === "undefined") {
    loadedScripts += "&yuiLoaded=false";
} else {
    loadedScripts += "&yuiLoaded=true";
}
xmlHttpRequest.send("Type=InformationException&message=" + encodeURIComponent("Error loading YUI") + loadedScripts);
}
})();
</script>
<script>if (typeof YRG !== 'undefined') { YRG.use('rg-base',function(Y){Y.applyConfig({ignore: ["css-rg","css-rg2","css-rg-nova","css-pow-application-PressQuotes","css-pow-signup-SignUpResearcherClassificationDefault","css-modules-signup"]});Y.use(["rg.core.pagespeed.Tracker","rg.core.pagespeed.Monitoring"],function(Y){(function(){(function(){var suTracker = Y.rg.core.pagespeed.Tracker.getInstance('signup', {"ep":"https:\/\/glassmoni.researchgate.net"});})();})();
(function(){widgetLoader.createInitialWidget({"data":{"requestTokenTag":"<noscript><\/noscript><input type=\"hidden\" name=\"request_token\" value=\"BtcZa0B7SS7C\/sQcLKqHKTJFXRgOo\/WVjV6oPe3vb5qNFFpBZXXgcOSFFjWN7QhlLSeHoQm+kfl4RP3hexNoHmV\/N\/bHp2Y+bcsgghWjYXuQYsor9V0bCurxRf0HEw4jca6ZOVYBBfKNQU4ZRmt3WWygkmd7i66im4pXdERQG3gCHKn+xg6S5oojomuUbRTO1hRRiakhRBPy1S3kJvyHXTzCA\/\/q1HHGoZMw52WwKxZUig99ZUXjFpmobF+RWrHjKfotS3N+px\/cnOvQPECEEl2rnWGWEecJxuY4zXsAd0g=\">","mainWidget":{"data":{"requestTokenTag":"<noscript><\/noscript><input type=\"hidden\" name=\"request_token\" value=\"4WdMWWF0QPQzw6sFAKw\/43+UW1ViFvdKB1NTccX0yIiK+MPnjiNnVnlSFVedfNf7yqU257C6NeiobikhBO77Hft65mrrdhRN2xZl\/okiSeA0P5AhWk0KUJ7PDVmYessL0s5NO3fmI3ypAWnzyQq6WpKADjdDssb8qNamdlbut0CaDKMuJhs6rz2YKf3pFmj7vIULpMO0F3g12jHAfYj9JPhocVvVjfxTjG2tzZaPJnSIdwVwsri2tn1IemGqQwMCXcJ3SfznpRg4NHYViJeA27GlX7ohM5OtvxH1KUyRbxU=\">","additionalContainerStyleClasses":null,"signUpHeaderSteps":null,"signUpProfilePreview":null,"logFlowName":"default","logStepName":"SignUpResearcherClassificationDefault","signUpBase":{"account":{"firstName":""}},"classificationTypeInstitution":"institution","classificationTypeCompany":"company","rgUserCount":"12+ million","rgNobelLaureateTotalCount":"56","classificationTypeMedical":"medical","classificationTypeNonResearcher":"nonResearcher","academicClassificationTitle":"Academic (including students)","pressQuotes":{"data":{"quotes":[{"title":"ResearchGate is changing how scientists share and advance research.","logo":"logo10"},{"title":"Links researchers from around the world.","logo":"logo02"},{"title":"Transforming the world through collaboration.","logo":"logo11"},{"title":"Revolutionizing how research is conducted and disseminated in the digital age.","logo":"logo08"},{"title":"ResearchGate allows researchers around the world to collaborate more easily.","logo":"logo09"},{"title":"For a common purpose of advancing scientific research.","logo":"logo01"},{"title":"Cracking Open the Scientific Process.","logo":"logo01"},{"title":"Ushering Open Science from a concept to a manifest reality.","logo":"logo11"},{"title":"Pioneers","logo":"logo06"}],"widgetId":"rgw3_58c729ac9df67"},"id":"rgw3_58c729ac9df67","partials":[],"templateName":"application\/stubs\/PressQuotes.html","templateExtensions":[],"attrs":{"delay":7000},"widgetUrl":"https:\/\/www.researchgate.net\/application.PressQuotes.html","viewClass":"views.application.PressQuotesView","yuiModules":["rg.views.application.PressQuotesView","css-pow-application-PressQuotes"],"stylesheets":["pow\/application\/PressQuotes.css"],"_isYUI":true},"newExamples":false,"isDisplayCountsHeadline":true,"widgetId":"rgw2_58c729ac9df67"},"id":"rgw2_58c729ac9df67","partials":{"jsDisabledWarning":"signup\/stubs\/partials\/jsDisabledWarning.html","signUpHeader":"signup\/stubs\/partials\/signUpHeader.html","signUpContentHeader":"signup\/stubs\/partials\/signUpContentHeader.html","signUpContentFooter":"signup\/stubs\/partials\/signUpContentFooter.html","signUpRightColHeader":"signup\/stubs\/partials\/signUpRightColHeader.html","signUpRightColFooter":"signup\/stubs\/partials\/signUpRightColFooter.html","signUpFooter":"signup\/stubs\/partials\/signUpFooter.html","errorTooltipStart":"signup\/stubs\/partials\/errorMessageStart.html","errorTooltipEnd":"signup\/stubs\/partials\/errorMessageEnd.html","headline":"signup\/stubs\/partials\/signupResearcherClassification\/hDefault.html","institution":"signup\/stubs\/partials\/signupResearcherClassification\/academicCopy.html","company":"signup\/stubs\/partials\/signupResearcherClassification\/corporateCopy.html","medical":"signup\/stubs\/partials\/signupResearcherClassification\/medicalCopy.html","nonResearcher":"signup\/stubs\/partials\/signupResearcherClassification\/nonResearcherCopy.html"},"templateName":"signup\/stubs\/SignUpResearcherClassificationDefault.html","templateExtensions":["generalHelpers"],"attrs":{"useValidateResponsePlugin":true},"widgetUrl":"https:\/\/www.researchgate.net\/signup.SignUpResearcherClassificationDefault.html?academicClassificationTitle=Academic%20%28including%20students%29","viewClass":"views.signup.AbstractSignUpResearcherClassificationView","yuiModules":["rg.views.signup.AbstractSignUpResearcherClassificationView","css-pow-signup-SignUpResearcherClassificationDefault","css-modules-signup"],"stylesheets":["pow\/signup\/SignUpResearcherClassificationDefault.css","modules\/signup.css"],"_isYUI":true},"widgetId":"rgw1_58c729ac9df67"},"id":"rgw1_58c729ac9df67","partials":[],"templateName":"signup\/stubs\/SignUpResearcherClassification.html","templateExtensions":[],"attrs":{"isFirstStep":true,"isLoginStep":false,"workflow":"default","stepName":"researcherClassification","trackingEnabled":true,"isSignUpFinish":false,"useChangeUrl":false,"preLoadSteps":[],"previousStepAction":null,"backAllowed":false,"useNewRendererPlugin":false},"widgetUrl":"https:\/\/www.researchgate.net\/signup.SignUpResearcherClassification.html?dbw=true","viewClass":"views.signup.SignUpStepView","yuiModules":["rg.views.signup.SignUpStepView","css-modules-signup"],"stylesheets":["modules\/signup.css"],"_isYUI":true,"initState":{"experimentsRunningExperiments":{"experiments":{"Default ResearcherClassification":{"Default ResearcherClassification":{"name":"Default ResearcherClassification","viewId":"Default ResearcherClassification","variant":"default (19)"}}}}}});})();
(function(){widgetLoader.createInitialWidget({"data":{"uaClass":"","headPrefix":[],"rootUrl":"http:\/\/localhost\/sextot\/","requestToken":"QEUo4i9FeuLqGW6qIzrmdzTlyvMCSl6l9PuP\/LCHqFyNb+yYf7emMWRF1FvxZEIxYGJqDp1x5s1wGD81bV1OU7LVCDavI+\/2XVYU1R\/9\/XYJRMz3cR3NfjT\/fvzTeJUzVQFax7Zwf6gRq7I9jKrvLF3izZfr1zje0bqX0C++UTRuFlZj16Ds\/\/bM1xu5ZBY\/BHjwbgrccy7Z\/3Y11YDH+NEMAmHcL2El3UwI7TTsIxNZtfBujVANKF2\/WXhG+2Kf2F7KaWrYqfN020ep7XR8tS0j1BaxjC0qqzLKBAlYuFQ=","cacheableRequest":false,"faviconCdnUrl":"https:\/\/c5.rgstatic.net\/m\/3390829798215018\/images\/favicon.ico","headerOutput":"<noscript><\/noscript><meta property=\"twitter:site\" content=\"@ResearchGate\" \/>\n<meta property=\"twitter:creator\" content=\"@ResearchGate\" \/>\n<meta property=\"twitter:card\" content=\"summary\" \/>\n<meta property=\"og:site\" content=\"ResearchGate\" \/>\n<meta property=\"og:site_name\" content=\"ResearchGate\" \/>\n<meta property=\"og:type\" content=\"website\" \/>\n<meta property=\"og:title\" content=\"Sign up - ResearchGate\" \/>\n<meta name=\"viewport\" content=\"width=device-width,initial-scale=1\" \/>\n<link rel=\"dns-prefetch\" href=\"https:\/\/c5.rgstatic.net\" \/>\n<link rel=\"dns-prefetch\" href=\"https:\/\/i1.rgstatic.net\" \/>\n<link href=\"https:\/\/c5.rgstatic.net\/m\/33145961576179397\/styles\/rg.css\" type=\"text\/css\" rel=\"stylesheet\"\/>\n<link href=\"https:\/\/c5.rgstatic.net\/m\/3709687045243091\/styles\/rg2.css\" type=\"text\/css\" rel=\"stylesheet\"\/>\n<link href=\"https:\/\/c5.rgstatic.net\/m\/33133587538190554\/styles\/rg-nova.css\" type=\"text\/css\" rel=\"stylesheet\"\/>\n<link href=\"https:\/\/c5.rgstatic.net\/m\/320191396292444\/styles\/pow\/application\/PressQuotes.css\" type=\"text\/css\" rel=\"stylesheet\"\/>\n<link href=\"https:\/\/c5.rgstatic.net\/m\/340644985037343\/styles\/pow\/signup\/SignUpResearcherClassificationDefault.css\" type=\"text\/css\" rel=\"stylesheet\"\/>\n<link href=\"https:\/\/c5.rgstatic.net\/m\/3424510818822149\/styles\/modules\/signup.css\" type=\"text\/css\" rel=\"stylesheet\"\/>\n<script src=\"https:\/\/c5.rgstatic.net\/m\/335413878735665\/javascript\/min\/lib\/error_logging.js\" type=\"text\/javascript\" async><\/script>\n","correlationId":"rgreq-bbd6710cccdaa3da5f6ee01501c27569","accountId":0,"module":"signup","action":"signup.SignUp","product":"signup","backendTime":119,"continent":"North America","stylesHome":"https:\/\/c5.rgstatic.net\/m\/","staticHost":"https:\/\/c5.rgstatic.net","useEarlyFlush":false,"preloads":[{"href":"https:\/\/c5.rgstatic.net\/m\/335413878735665\/javascript\/min\/lib\/error_logging.js","as":"script","type":false,"crossOrigin":false},{"href":"https:\/\/c5.rgstatic.net\/m\/339124904452375\/javascript\/vendor\/lscache\/lscache.min.js","as":"script","type":false,"crossOrigin":false},

    {"href":".\/c5.rgstatic.net\/m\/33781146478244\/javascript\/min\/extensions\/Hogan.js","as":"script","type":false,"crossOrigin":false},

    {"href":".\/c5.rgstatic.net\/m\/3325746597897798\/javascript\/vendor\/babel-polyfill\/dist\/polyfill.min.js","as":"script","type":false,"crossOrigin":false},
    {"href":".\/c5.rgstatic.net\/m\/330955462388614\/javascript\/lib\/yui3\/yui\/yui-min.js","as":"script","type":false,"crossOrigin":false},
    {"href":".\/c5.rgstatic.net\/m\/34062978123254431\/javascript\/yuiLoaderConfig-min.js","as":"script","type":false,"crossOrigin":false},
    {"href":".\/c5.rgstatic.net\/m\/330428029752317271\/javascript\/bundles\/common.js","as":"script","type":false,"crossOrigin":false},
    {"href":".\/c5.rgstatic.net\/m\/3143131882750385\/javascript\/min\/core\/widgetLoader.js","as":"script","type":false,"crossOrigin":false},
    {"href":".\/c5.rgstatic.net\/m\/39542259572752\/javascript\/vendor\/svgxuse\/svgxuse.min.js","as":"script","type":false,"crossOrigin":false},
    {"href":".\/c5.rgstatic.net\/m\/33145961576179397\/styles\/rg.css","as":"style","type":false,"crossOrigin":false},
    {"href":".\/c5.rgstatic.net\/m\/3709687045243091\/styles\/rg2.css","as":"style","type":false,"crossOrigin":false},
    {"href":".\/c5.rgstatic.net\/m\/33133587538190554\/styles\/rg-nova.css","as":"style","type":false,"crossOrigin":false},
    {"href":".\/c5.rgstatic.net\/m\/320191396292444\/styles\/pow\/application\/PressQuotes.css","as":"style","type":false,"crossOrigin":false},
    {"href":".\/c5.rgstatic.net\/m\/340644985037343\/styles\/pow\/signup\/SignUpResearcherClassificationDefault.css","as":"style","type":false,"crossOrigin":false},{"href":"https:\/\/c5.rgstatic.net\/m\/3424510818822149\/styles\/modules\/signup.css","as":"style","type":false,"crossOrigin":false},
    {"href":".\/c5.rgstatic.net\/m\/3377210183614584\/styles\/fonts\/roboto-v15-latin-400.woff2","as":"font","type":"font\/woff2","crossOrigin":"anonymous"},
    {"href":".\/c5.rgstatic.net\/m\/3263650741714552\/styles\/fonts\/roboto-v15-latin-700.woff2","as":"font","type":"font\/woff2","crossOrigin":"anonymous"},{"href":"https:\/\/c5.rgstatic.net\/m\/3150875099422472\/styles\/fonts\/rosalind-serif-v1-latin-greek-400.woff2","as":"font","type":"font\/woff2","crossOrigin":"anonymous"},
    {"href":".\/c5.rgstatic.net\/m\/3164119608522420\/styles\/fonts\/rosalind-serif-v1-latin-greek-700.woff2","as":"font","type":"font\/woff2","crossOrigin":"anonymous"}],"longRunningRequestIdentifier":"LongRunningRequest.signup.SignUp","longRunningRequestFp":"fa86788142a29e5dc9aa48479a5b642cee2633a0","supportsReferrerOriginWhenCrossOrigin":true,"enableGraphQLWhitelist":false,"widgetId":"rgw4_58c729ac9df67"},"id":"rgw4_58c729ac9df67","partials":[],"templateName":"application\/stubs\/StaticHeader.html","templateExtensions":[],"attrs":[],"widgetUrl":"http:\/\/localhost\/application.StaticHeader.html","viewClass":null,"yuiModules":[],"stylesheets":[],"_isYUI":true,"initState":{}});})();
(function(){widgetLoader.createInitialWidget({"data":{"enableYUIForwarding":false},"templateName":"application_AlertStack","id":"rgw5_58c729ac9df67","widgetId":"rgw5_58c729ac9df67",
    "widgetUrl":"https:\/\/www.researchgate.net\/application.AlertStack.html","stylesheets":[],"_isReact":true,"initState":{}});})();
(function(){widgetLoader.createInitialWidget({"data":[],"templateName":"application_ModalRoot","id":"rgw6_58c729ac9df67","widgetId":"rgw6_58c729ac9df67","widgetUrl":"http:\/\/localhost\/application.ModalRoot.html","stylesheets":[],"_isReact":true,"initState":{}});})();
(function(){
            Y.rg.core.pagespeed.Monitoring.monitorPage("https:\/\/glassmoni.researchgate.net", "signup.SignUp.run.html.loggedOut.get.default", "0f65e695ea1a22922a571d253beb739b8b6a6036", "rgreq-bbd6710cccdaa3da5f6ee01501c27569", "8320b19ee96416978173dd1ccc4877e07ade2108");
        })();
(function(){widgetLoader.createInitialWidget({"data":{"year":"2017","inlinePromo":null,"contactUrl":"https:\/\/www.researchgate.net\/contact","aboutUsUrl":"https:\/\/www.researchgate.net\/about","utmMedium":"community-loggedout"},"templateName":"application_DefaultFooter","id":"rgw7_58c729ac9df67","widgetId":"rgw7_58c729ac9df67","widgetUrl":"https:\/\/www.researchgate.net\/application.DefaultFooter.html","stylesheets":[],"_isReact":true,"initState":{}});})();
(function(){widgetLoader.createInitialWidget({"data":{"content":{"data":{"headerLogin":{"data":{"urlAfterLogin":"signup.SignUp.html?ev=su_chnl_index&amp;hdrsu=1&amp;_sg=MMKeWJ8DOcnLFT7gaLsqmSXTa312JFEA70N9GRArOsmF09cZwpMO0NjX6T9yujxq","recruiterLogin":false,"recruiterSignupCallToAction":"Recruit researchers","recruiterSignupUrl":"https:\/\/solutions.researchgate.net\/recruiting\/?utm_source=researchgate&utm_medium=community-loggedout&utm_campaign=indextop","requestToken":"YX\/l9O\/FdHoUnyicsU1bqj4OpXofR6stednsM7EKA2tnkPNGEZGxbAYOROEKgHRj6Bsza7oezc6kmt0HUCmClq5mgMMjSZ5Ult7khxZWJqvSJ8obWcqVRv3hSBCBN9k\/PwAP0gipA2P6zSYnQs72MpiJxl31\/ejxvJK+VFm41K07byW6gSeHJUY4MKQ1daLd9Tv951f35P0n9oXOZLkOAA+6RKIlLEmHI3cGhY15N7EeRShyAdNj7kNxrrqATNvdydvPkUbg7ui7ITjuO6MZbmOrbT+eLSYQzxsvaGHUbQY=","loginUrl":"https:\/\/www.researchgate.net\/login","signupUrl":"https:\/\/www.researchgate.net\/signup.SignUp.html?ev=su_chnl_index&hdrsu=1&_sg=L1PThBTF3Zmllu13HROK6LxoUEF-pO-alQrzsUZ1boSKpsdCgj9x6q_iT4LOFfAa","encodedUrlAfterLogin":"c2lnbnVwLlNpZ25VcC5odG1sP2V2PXN1X2NobmxfaW5kZXgmaGRyc3U9MSZfc2c9TU1LZVdKOERPY25MRlQ3Z2FMc3FtU1hUYTMxMkpGRUE3ME45R1JBck9zbUYwOWNad3BNTzBOalg2VDl5dWp4cQ%3D%3D","signupCallToAction":"Join for free","goal":"milestoneHeaderLoginSeen","canShowSignup":true},"templateName":"application_HeaderLogin","id":"rgw10_58c729ac9df67","widgetId":"rgw10_58c729ac9df67","widgetUrl":"https:\/\/www.researchgate.net\/application.HeaderLogin.html","stylesheets":[],"_isReact":true},"cookieConsent":null,"logoSvgSrc":"https:\/\/c5.rgstatic.net\/m\/324271709065819\/images\/template\/brand-header-logo.svg","logoFallbackSrc":"https:\/\/c5.rgstatic.net\/m\/333656684592444\/images\/template\/brand-header-logo.png","searchHeader":false,"searchUrl":"search","rootUrl":"http:\/\/localhost\/sextot\/","browseUrl":"search","context":"publicSearchHeader","browseClickMilestone":"jiB_dbDUUXbt2UEHD00Ewwh4rNN85EeOASDTIp3wopeyHCtyun1CdF2Pxh-kUdzd"},"templateName":"application_HeaderLoggedOutContent","id":"rgw9_58c729ac9df67","widgetId":"rgw9_58c729ac9df67","widgetUrl":"https:\/\/www.researchgate.net\/application.HeaderLoggedOutContent.html","stylesheets":[],"_isReact":true}},"templateName":"application_HeaderLoggedOut","id":"rgw8_58c729ac9df67","widgetId":"rgw8_58c729ac9df67","widgetUrl":"https:\/\/www.researchgate.net\/application.HeaderLoggedOut.html","stylesheets":[],"_isReact":true,"initState":{"experimentsRunningExperiments":{"experiments":{"Header With Search":{"Header With Search":{"name":"Header With Search","viewId":"Header With Search","variant":"__control"}},"Header Login":{"Header Login":{"name":"Header Login","viewId":"Header Login","variant":"default (6)"}}}}}});})();
(function(){widgetLoader.createInitialWidget({"data":{"exceptionClass":false,"exceptionCode":"","stacktrace":false,"exceptionMessage":false,"correlationId":"rgreq-bbd6710cccdaa3da5f6ee01501c27569","widgetId":"rgw11_58c729ac9df67"},"id":"rgw11_58c729ac9df67","partials":[],"templateName":"application\/stubs\/IncError.html","templateExtensions":[],"attrs":[],"widgetUrl":"https:\/\/www.researchgate.net\/application.IncError.html","viewClass":null,"yuiModules":[],"stylesheets":[],"_isYUI":true,"initState":{}});})();
(function(){Y.rg.core.util.ParameterFilter.filter(["ev","cp","ch","ref","dbw","pli","loginT","uid","claimChannel","enrichId","enrichSource","utm_source","utm_medium","utm_campaign","utm_term","utm_content","el","ci"]);})();
});}); } else { throw 'YRG was not loaded when attaching widgets'; }</script> <noscript>&lt;iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MKVKH7" height="0" width="0" style="display:none;visibility:hidden"&gt;&lt;/iframe&gt;</noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-MKVKH7');</script><script>(function(e){function t(t,n,r,o){"use strict";function a(){for(var e,n=0;u.length>n;n++)u[n].href&&u[n].href.indexOf(t)>-1&&(e=!0);e?i.media=r||"all":setTimeout(a)}var i=e.document.createElement("link"),c=n||e.document.getElementsByTagName("script")[0],u=e.document.styleSheets;return i.rel="stylesheet",i.href=t,i.media="only x",i.onload=o||function(){},c.parentNode.insertBefore(i,c),a(),i}var n=function(r,o){"use strict";if(r&&3===r.length){var a=e.navigator,i=e.Image,c=!(!document.createElementNS||!document.createElementNS("http://www.w3.org/2000/svg","svg").createSVGRect||!document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#Image","1.1")||e.opera&&-1===a.userAgent.indexOf("Chrome")||-1!==a.userAgent.indexOf("Series40")),u=new i;u.onerror=function(){n.method="png",t(r[2])},u.onload=function(){var e=1===u.width&&1===u.height,a=r[e&&c?0:e?1:2];n.method=e&&c?"svg":e?"datapng":"png",n.href=a,t(a,null,null,o)},u.src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==",document.documentElement.className+=" grunticon"}};n.loadCSS=t,e.grunticon=n})(this);(function(e,t){"use strict";var n=t.document,r="grunticon:",o=function(e){if(n.attachEvent?"complete"===n.readyState:"loading"!==n.readyState)e();else{var t=!1;n.addEventListener("readystatechange",function(){t||(t=!0,e())},!1)}},a=function(e){for(var t,o,a,i,c,u,s={},l=n.styleSheets,d=0;l.length>d;d++)if(l[d].href&&l[d].href.indexOf(e)>-1){t=l[d];break}if(!t)return s;for(o=t.cssRules?t.cssRules:t.rules,d=0;o.length>d;d++)a=o[d].cssText,i=r+o[d].selectorText,c=a.split(");")[0].match(/US\-ASCII\,([^"']+)/),c&&c[1]&&(u=decodeURIComponent(c[1]),s[i]=u);return s},i=function(e){var t,o,a;o="data-grunticon-embed";for(var i in e)if(a=i.slice(r.length),t=n.querySelectorAll(a+"["+o+"]"),t.length)for(var c=0;t.length>c;c++)t[c].innerHTML=e[i],t[c].style.backgroundImage="none",t[c].removeAttribute(o);return t},c=function(){o(function(){i(a(e.href))})};e.embedIcons=i,e.getIcons=a,e.ready=o,e.svgLoadedCallback=c})(grunticon,this);

grunticon(["https://c5.rgstatic.net/c/omrlz1/styles/icons/_header-ico.svg.css", 
    "./c5.rgstatic.net/c/omrlz1/styles/icons/_header-ico.png.css", 
    "https://c5.rgstatic.net/c/omrlz1/styles/icons/_header-ico.fallback.scss"]);

grunticon(["https://c5.rgstatic.net/c/omrlz1/styles/icons/_ico.svg.css", 
    "./c5.rgstatic.net/c/omrlz1/styles/icons/_ico.png.css", 
    "https://c5.rgstatic.net/c/omrlz1/styles/icons/_ico.fallback.scss"]);
</script>

<div><div data-reactroot="" class="AlertStack"><div class="nova-c-alert-stack"></div></div></div></body>
</html>