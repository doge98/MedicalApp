<?php

require_once('../../util/Clases/movil/Medico.clase.php');
require_once('../../datos/Conexion.clase.php');
require_once('../../util/Clases/Funciones.clase.php');
    
    //$p_token = $_SESSION['token'];
    $p_upsmedicoipress = $_POST["p_upsmedicoipress"];
    /*if(!isset($_SESSION["token"])){
        Funciones::imprimeJSON(500,"Falta el token","");
        exit();
    }*/

    try{
        //require_once '../token.validar.php';
            //if(validarToken($p_token)){
                $objMedico=new Medico();
                $objMedico->setP_upsmedicoipress($p_upsmedicoipress);
	            $resultado=$objMedico->medicoupshorariolistar();
                Funciones::imprimeJSON(200, "Éxito", Funciones::imprimeJSON(200, "Éxito", $resultado));
            //}
    }catch(Exception $exc){
        Funciones::mensaje($exc->getMessage(), "e");
    }
?>