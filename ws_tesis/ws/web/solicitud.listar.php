<?php

require_once '../../util/Clases/web/Solicitud.clase.php';
require_once '../../datos/Conexion.clase.php';
require_once('../../util/Clases/Funciones.clase.php');

    session_start();
    error_reporting(0);
    $p_token = $_SESSION['token'];
    
    if(!isset($_SESSION["token"])){
        Funciones::imprimeJSON(500,"Falta el token","");	
        exit();
    }

    try{
        require_once '../token.validar.php';
            if(validarToken($p_token)){
                $objSolicitud=new Solicitud();
	            $resultado=$objSolicitud->listarsolicitud();
            }
    }catch(Exception $exc){
        Funciones::mensaje($exc->getMessage(), "e");
    }
?>

<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>ESTADO</th>
            <th>C&Oacute;DIGO &Uacute;NICO</th>
            <th>DNI SOLICITANTE</th>
            <th>CORREO</th>
            <th>FECHA - HORA</th>
            <th>VISUALIZAR</th>
        </tr>
    </thead>
    <tbody>
    <?php
        for ($i=0; $i<count($resultado);$i++){
            $estado = $resultado[$i]['estado'];
            
            if($estado  == 0){
                $estado_ver="<td><div class='alert alert-secondary' role='alert'><strong>No visto</strong></div></td>";
                $boton = '<td><button type="button" class="btn btn-success" onclick = "paneladminsolicitudesver(\''.$resultado[$i]['codigo_unico_ipress'].'\',0)">VER</button></td>';
            }
            if($estado  == 1){
                $estado_ver="<td><div class='alert alert-success' role='alert'><strong>Visto</strong></div></td>";
                $boton = '<td></td>';
            }
            echo '<tr>';
                echo $estado_ver;
                echo '<td>'.$resultado[$i]['codigo_unico_ipress'].'</td>';
                echo '<td>'.$resultado[$i]['dni_solicitante'].'</td>';
                echo '<td>'.$resultado[$i]['correo_solicitante'].'</td>';
                echo '<td>'.$resultado[$i]['fecha'].' - '.$resultado[$i]['hora'].'</td>';
                echo $boton;
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