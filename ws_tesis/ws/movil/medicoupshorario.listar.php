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
                $total = count($resultado);
                $i = 1;
                foreach ($resultado as $value) {
                    $response["numero_dia"]	= "holi";
                    $response["data"] = $value;
                    if($i == 1){
                        $array = json_encode($response);
                    }
                    $array = json_encode($response).','.$array;
                    
                    $i++;
                 }
                 //echo $array;
                 echo date("D");
                 
                 
                 //$response["data"]	= $array;
                 //echo json_encode($response);
                 //Funciones::imprimeJSON(200, "Éxito", $dato);
                
                //}
    }catch(Exception $exc){
        Funciones::mensaje($exc->getMessage(), "e");
    }
?>