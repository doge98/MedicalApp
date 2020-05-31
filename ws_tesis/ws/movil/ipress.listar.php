<?php

require_once '../../util/Clases/movil/Ipress.clase.php';
require_once '../../datos/Conexion.clase.php';
require_once('../../util/Clases/Funciones.clase.php');
    
    try{
        $objIpress=new Ipress();
        $resultado=$objIpress->ipresslistar();
        echo json_encode($resultado);
    }catch(Exception $exc){
        Funciones::mensaje($exc->getMessage(), "e");
    }
?>