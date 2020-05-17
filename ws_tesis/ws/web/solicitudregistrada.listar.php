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
                $objListar=new Solicitud();
	            $resultado=$objListar->listarsolicitudregistrado();
            }
    }catch(Exception $exc){
        Funciones::mensaje($exc->getMessage(), "e");
    }
?>


<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>C&oacute;digo Lista</th>
            <th>C&oacute;digo &Uacute;nico</th>
            <th>Fecha y Hora</th>
            <th>Estado</th>
            <th>Observaci&oacute;n</th>
            <th>Ver</th>
        </tr>
    </thead>
    <tbody>
    <?php
        for ($i=0; $i<count($resultado);$i++){
            $estado = $resultado[$i]['estado'];
            
            if($estado  == 3){
                $estado_ver="<td><div class='alert alert-warning' role='alert'><strong>Observaci&oacute;n</strong></div></td>";
                $boton = '<td><button type="button" class="btn btn-success" onclick = "paneladminsolicitudesver(\''.$resultado[$i]['codigo_unico_ipress'].'\','.$resultado[$i]['solicitud_vista'].')">VER</button></td>';
            }
            if($estado  == 2){
                $estado_ver="<td><div class='alert alert-success' role='alert'><strong>Registrado</strong></div></td>";
                $boton = '<td></td>';
            }
            if($estado  == 4){
                $estado_ver="<td><div class='alert alert-info' role='alert'><strong>Respondido</strong></div></td>";
                $boton = '<td></td>';
            }
            echo '<tr>';
                echo '<td>'.$resultado[$i]['solicitud_vista'].'</td>';
                echo '<td>'.$resultado[$i]['codigo_unico_ipress'].'</td>';
                echo '<td>'.$resultado[$i]['fecha'].' - '.$resultado[$i]['hora'].'</td>';
                echo $estado_ver;
                echo '<td>'.$resultado[$i]['observacion'].'</td>';
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