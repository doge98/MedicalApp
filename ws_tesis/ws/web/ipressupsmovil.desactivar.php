<?php

require_once '../../util/Clases/web/Ipress.clase.php';
require_once '../../datos/Conexion.clase.php';
require_once('../../util/Clases/Funciones.clase.php');
    
    session_start();
    error_reporting(0);
    $p_token = $_SESSION['token'];
    $p_upsipress = $_POST["upsipress"];
    
    if(!isset($_SESSION["token"])){
        Funciones::imprimeJSON(500,"Falta el token","");	
        exit();
    }
    
    try{
        require_once '../token.validar.php';
            if(validarToken($p_token)){
                $objIpress=new Ipress();
                $objIpress->setP_upsipress($p_upsipress);
	            $resultado=$objIpress->ipressupsmovildesactivar();
            }
    }catch(Exception $exc){
        Funciones::mensaje($exc->getMessage(), "e");
    }
?>