<?php

require_once '../../util/Clases/web/Ipress.clase.php';
require_once '../../datos/Conexion.clase.php';
require_once('../../util/Clases/Funciones.clase.php');
    
    session_start();
    error_reporting(0);
    $p_token = $_SESSION['token'];
    $p_arrayupss = $_POST["arrayupss"];
    
    if(!isset($_SESSION["token"])){
        Funciones::imprimeJSON(500,"Falta el token","");	
        exit();
    }
    
    try{
        require_once '../token.validar.php';
            if(validarToken($p_token)){
                $objIpress=new Ipress();
                $objIpress->setP_estadomovil('1');
                $objIpress->setP_upsipress(json_encode($p_arrayupss));
	            $resultado=$objIpress->ipressupsmovil();
                echo json_encode($resultado);
            }
    }catch(Exception $exc){
        Funciones::mensaje($exc->getMessage(), "e");
    }
?>