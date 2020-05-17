<?php

require_once '../../util/Clases/web/Ipress.clase.php';
require_once '../../datos/Conexion.clase.php';
require_once('../../util/Clases/Funciones.clase.php');
    
    session_start();
    error_reporting(0);
    $p_token = $_SESSION['token'];
    $p_codigounicoipress = $_SESSION["codigo_ipress"];

    if(!isset($_SESSION["token"])){
        Funciones::imprimeJSON(500,"Falta el token","");	
        exit();
    }
    try{
        require_once '../token.validar.php';
            if(validarToken($p_token)){
                $objIpress=new Ipress();
                $objIpress->setP_codigounicoipress($p_codigounicoipress);
                $objIpress->setP_estadomovil('1');
	            $resultado=$objIpress->ipressupslistarmovil();
            }
    }catch(Exception $exc){
        Funciones::mensaje($exc->getMessage(), "e");
    }
?>

<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>C&Oacute;DIGO</th>
            <th>UPS GENERAL</th>
            <th>DESCRIPCI&Oacute;N</th>
            <th>DESACTIVAR</th>
        </tr>
    </thead>
    <tbody>
    <?php
        for ($i=0; $i<count($resultado);$i++){
            echo '<tr>';
                echo '<td>'.$resultado[$i]['codigo_upss_especialidad'].'</td>';
                echo '<td>'.$resultado[$i]['upssgeneral'].'</td>';
                echo '<td>'.$resultado[$i]['descripcion'].'</td>';
                echo '<td style="text-align:center"><button type="button" class="btn btn-info" onclick="ipressupsmovildesactivar('.$resultado[$i]['ipress_ups_codigo'].')">-</button></td>';
            echo '</tr>';
        }
    ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>