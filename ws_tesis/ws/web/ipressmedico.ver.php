<?php
require 'simple_html_dom.php';
    session_start();
    error_reporting(0);
    $p_token = $_SESSION['token'];
    $p_cmpmedico = $_POST['cmpmedico'];
    if(!isset($_SESSION["token"])){
        Funciones::imprimeJSON(500,"Falta el token","");	
        exit();
    }
    try{
        require_once '../token.validar.php';
            if(validarToken($p_token)){
                $html = file_get_contents('https://200.48.13.39/cmp/php/detallexmedico.php?id='.$p_cmpmedico);

                $tags = explode('<',$html);

                foreach ($tags as $tag){
                  if (strpos($tag,'script') !== FALSE) continue;
                  $text = strip_tags('<'.$tag);
                  if (trim($text) != '') $texts[] = $text;
                }
                echo '{"nombres":"'.$texts[7].'",
                "apellido":"'.$texts[6].'",
                "consejo":"'.$texts[11].'"}';
                //echo $texts[7].'  -  '.$texts[6].'  -  '.$texts[11];
            }
    }catch(Exception $exc){
        Funciones::mensaje($exc->getMessage(), "e");
    }





