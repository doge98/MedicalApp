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
  
    function dias($dia){
        $dias_ES = array("Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado", "Domingo");
        $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
        $nombredia = str_replace($dias_ES,$dias_EN, $dia);

        if($dia == "Lunes"){
            $posicion_real = 0;
        }
        if($dia == "Martes"){
            $posicion_real = 1;
        }
        if($dia == "Miercoles"){
            $posicion_real = 2;
        }
        if($dia == "Jueves"){
            $posicion_real = 3;
        }
        if($dia == "Viernes"){
            $posicion_real = 4;
        }
        if($dia == "Sabado"){
            $posicion_real = 5;
        }
        if($dia == "Domingo"){
            $posicion_real = 6;
        }
        /*if(substr($nombredia, 0, 3) == date("D")){
            echo "es hoy";
        }else{
            echo "no es hoy";
        }*/
        
        $dias = '[{"Lunes":"0"},{"Martes":"0"},{"Miercoles":"0"},{"Jueves":"0"},{"Viernes":"0"},{"Sabado":"0"},{"Domingo":"0"}]';
        $json = json_decode($dias, true);
        $contador = count($json);
        $regulador = 0;
        //echo json_decode($json[1]["Martes"]);

        /*for ($i = $posicion_real; $i<$contador; $i++){
            echo ($i+1);
        }
        for ($j = 0; $j<$posicion_real; $j++){
            echo ($j+1);
        }*/
        
        /*if(substr($nombredia, 0, 3) == date("D")){
            echo date("D");
        }*/
        
    }

    //dias('Viernes');
    echo  date_default_timezone_set("America/Bogota");;
?>