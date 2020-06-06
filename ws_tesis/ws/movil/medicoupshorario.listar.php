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
    $dias_ES = array("Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado", "Domingo");
    function dias($dia){
        $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
        $nombredia = str_replace($dias_ES,$dias_EN, $dia);

        if(date("D") == "Mon"){
            $posicion_real = 0;
        }
        if(date("D") == "Tue"){
            $posicion_real = 1;
        }
        if(date("D") == "Wed"){
            $posicion_real = 2;
        }
        if(date("D") == "Thu"){
            $posicion_real = 3;
        }
        if(date("D") == "Fri"){
            $posicion_real = 4;
        }
        if(date("D") == "Sat"){
            $posicion_real = 5;
        }
        if(date("D") == "Sun"){
            $posicion_real = 6;
        }
        $dias = '[{"dia":"Lunes"},{"dia":"Martes"},{"dia":"Miercoles"},{"dia":"Jueves"},{"dia":"Viernes"},{"dia":"Sabado"},{"dia":"Domingo"}]';
        
        
        $json = json_decode($dias, true);
        $id = 1;
        for($i = $posicion_real; $i < 7 ; $i++){
            if($json[$i]["dia"] == $dia){
                return $id;
            }
            $id++;
        }
        for($j = 0; $j < $posicion_real; $j++){
            if($json[$j]["dia"] == $dia){
                return $id;
            }
            $id++;
        }
    }

    try{
        //require_once '../token.validar.php';
            //if(validarToken($p_token)){
                $objMedico=new Medico();
                $objMedico->setP_upsmedicoipress($p_upsmedicoipress);
                $resultado=$objMedico->medicoupshorariolistar();
                $total = count($resultado);

                
                $arrayobjeto=array();
                
                $d=0;
                foreach($dias_ES as $id){
                    $arrayHorario=array();
                    $j=0;
                    $arrayobjeto[$d]["id"]= dias($id);

                    foreach ($resultado as $value) {
                        if($id == $value["diatrabajo"]){
                            //$arrayHorario=$value;
                            $arrayHorario[$j]=$value;
                            $j++; 
                        }
                    }

                    $arrayobjeto[$d]["data"] = $arrayHorario;
                    $d++;
                }
                Funciones::imprimeJSON(200, "Éxito", $arrayobjeto);
            //}
    }catch(Exception $exc){
        Funciones::mensaje($exc->getMessage(), "e");
    }
?>