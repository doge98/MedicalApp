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
				echo "
					<select id='comboups' class='custom-select'>
					<option selected='selected' value='0'>Ups Movil</option>";
					for ($i=0; $i<count($resultado);$i++){
						echo "<option value=".$resultado[$i]['ipress_ups_codigo'].">".$resultado[$i]['descripcion']."</option>";
					}
				echo "</select>";
            }
    }catch(Exception $exc){
        Funciones::mensaje($exc->getMessage(), "e");
    }
?>