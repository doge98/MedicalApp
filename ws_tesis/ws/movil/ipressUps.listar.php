<?php

require_once('../../util/Clases/movil/Ipress.clase.php');
require_once('../../datos/Conexion.clase.php');
require_once('../../util/Clases/Funciones.clase.php');
    
    //$p_token = $_SESSION['token'];
    $p_codigounicoipress = $_POST["p_codigounicoipress"];

    /*if(!isset($_SESSION["token"])){
        Funciones::imprimeJSON(500,"Falta el token","");
        exit();
    }*/
    
    try{
        //require_once '../token.validar.php';
            //if(validarToken($p_token)){
                $objIpress=new Ipress();
                $objIpress->setP_codigounicoipress($p_codigounicoipress);
	            $resultado=$objIpress->ipressupslistar();
                //Funciones::imprimeJSON(200, "Éxito", json_encode($resultado));
                Funciones::imprimeJSON(200, "Éxito", $resultado);
            //}
    }catch(Exception $exc){
        Funciones::mensaje($exc->getMessage(), "e");
    }
?>