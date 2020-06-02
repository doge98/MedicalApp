<?php

require_once('../../util/Clases/movil/Medico.clase.php');
require_once('../../datos/Conexion.clase.php');
require_once('../../util/Clases/Funciones.clase.php');
    
    //$p_token = $_SESSION['token'];
    $p_codigounicoipress = $_POST["p_codigounicoipress"];
    $p_ipressupscodigo = $_POST["p_ipressupscodigo"];
    /*if(!isset($_SESSION["token"])){
        Funciones::imprimeJSON(500,"Falta el token","");
        exit();
    }*/

    try{
        //require_once '../token.validar.php';
            //if(validarToken($p_token)){
                $objMedico=new Medico();
                $objMedico->setP_codigounicoipress($p_codigounicoipress);
                $objMedico->setP_ipressupscodigo($p_ipressupscodigo);
	            $resultado=$objMedico->medicoupslistar();
                Funciones::imprimeJSON(200, "Éxito", $resultado);
            //}
    }catch(Exception $exc){
        Funciones::mensaje($exc->getMessage(), "e");
    }
?>