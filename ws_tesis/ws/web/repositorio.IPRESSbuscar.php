<?php

    $codigoipress = $_POST["codigoipress"];
    $json = file_get_contents('http://app20.susalud.gob.pe:8080/registro-renipress-webapp/ipress.htm?action=cargarIpress&idipress='.$codigoipress);
    $data = json_decode($json, true);

    if($data['mensaje'] == "ok"){
        $datos = json_encode($data['datos']['p_crCURSOR_DATOS']);
        $jsonarray = json_decode($datos, true); 
        echo json_encode($jsonarray);
    }else{
        echo "1";
    }

?>