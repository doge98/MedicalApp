<?php

require_once '../../util/Clases/web/Ipress.clase.php';
require_once '../../datos/Conexion.clase.php';
require_once('../../util/Clases/Funciones.clase.php');
    
    session_start();
    error_reporting(0);
    $p_token = $_SESSION['token'];
    $p_idafiliacion = $_POST["id_afiliacion"];

    if(!isset($_SESSION["token"])){
        Funciones::imprimeJSON(500,"Falta el token","");	
        exit();
    }
    try{
        require_once '../token.validar.php';
            if(validarToken($p_token)){
                $objIpress=new Ipress();
                $objIpress->setId_afiliacion($p_idafiliacion);
	            $resultado=$objIpress->ipressupsmedicolistar();
            }
    }catch(Exception $exc){
        Funciones::mensaje($exc->getMessage(), "e");
    }
?>

<table class="table table-bordered" style="width:100%">
    <thead class="thead-light">
        <tr>
            <th>C&Oacute;DIGO</th>
            <th>UPS GENERAL</th>
            <th>VER HORARIO</th>
        </tr>
    </thead>
    <tbody>
    <?php
        for ($i=0; $i<count($resultado);$i++){
            echo '<tr>';
                echo '<td>'.$resultado[$i]['ups_medico_ipress'].'</td>';
                echo '<td>'.$resultado[$i]['descripcion'].'</td>';
                echo '<td style="text-align:center"><button type="button" class="btn btn-info" onclick="ipressupshorario('.$resultado[$i]['ups_medico_ipress'].',\''.$resultado[$i]['descripcion'].'\','.$p_idafiliacion.')">O</button></td>';
            echo '</tr>';
        }
    ?>
    </tbody>
</table>