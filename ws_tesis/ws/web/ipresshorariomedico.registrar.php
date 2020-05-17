<?php

require_once '../../util/Clases/web/Ipress.clase.php';
require_once '../../datos/Conexion.clase.php';
require_once('../../util/Clases/Funciones.clase.php');
    
    session_start();
    error_reporting(0);
    $p_token = $_SESSION['token'];
    $arraycheck = $_POST['arraycheck'];

    if(!isset($_SESSION["token"])){
        Funciones::imprimeJSON(500,"Falta el token","");	
        exit();
    }
    
    try{
        require_once '../token.validar.php';
            if(validarToken($p_token)){
                $objIpress = new Ipress();
				$objIpress->setP_arrayupsmedico(json_encode($arraycheck));
                $resultado=$objIpress->ipresshorariomedioregistrar();
				echo json_encode($resultado);
            }
    }catch(Exception $exc){
        Funciones::mensaje($exc->getMessage(), "e");
    }














