<?php

require_once '../../util/Clases/web/Afiliacion.clase.php';
require_once '../../datos/Conexion.clase.php';

    if(!isset($_GET["codipress"]) || !isset($_GET["datodni"]) || !isset($_GET["correoipress"])){
        echo "no hay 1";
        die();
    }

    $p_codigounicoipress = $_GET["codipress"];
    $p_dnisolicitante = $_GET["datodni"];
    $p_correosolicitante = $_GET["correoipress"];
    $p_archivo = $_FILES["file"]["name"];
    
    try{
        $p_archivo = $_FILES["file"]["name"];
        $archivo = explode(".", $p_archivo);
        $extension = end($archivo);
        $name = $p_codigounicoipress.'.'.$extension;
        $location = $_SERVER['DOCUMENT_ROOT']."/ws_tesis/archivos/SolicitudesIpress/".$name;
        
	    $objAfiliar=new Afiliacion();
	    $objAfiliar->setP_codigounicoipress($p_codigounicoipress);
	    $objAfiliar->setP_dnisolicitante($p_dnisolicitante);
	    $objAfiliar->setP_correosolicitante($p_correosolicitante);
	    $objAfiliar->setP_archivo($location);
	    $resultado=$objAfiliar->registrarSolicitud();
        $estado = json_encode($resultado[0]['estado'],true);
        if($estado == 200){
            move_uploaded_file($_FILES["file"]["tmp_name"],$location);      
        }
        echo json_encode($resultado,true);
    }catch(Exception $exc){
        Funciones::mensaje($exc->getMessage(), "e");
    }

?>