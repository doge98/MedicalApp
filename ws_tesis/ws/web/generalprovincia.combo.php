<?php
    require_once '../../util/Clases/web/General.clase.php';
    require_once '../../datos/Conexion.clase.php';
    require_once('../../util/Clases/Funciones.clase.php');
    session_start();
    error_reporting(0);
    $p_token = $_SESSION['token'];
    $p_codigodepartamento = $_POST['codigodepartamento'];
    if(!isset($_SESSION["token"])){
        Funciones::imprimeJSON(500,"Falta el token","");	
        exit();
    }

    try{
        require_once '../token.validar.php';
        if(validarToken($p_token)){
            $objGeneral=new General();
            $objGeneral->setP_codigodepartamento($p_codigodepartamento);
            $resultado=$objGeneral->provincia();
            echo "
            <select id='comboprovincia' class='custom-select'>
            <option selected='selected' value='0'>PROVINCIA</option>";
                for ($i=1; $i<count($resultado);$i++){
                    echo "
                    <option value=".$resultado[$i]['codigo_provincia'].">".$resultado[$i]['nombre_provincia']."</option>";
                }
            echo "</select>";
        }
    }catch(Exception $exc){
        Funciones::mensaje($exc->getMessage(), "e");
    }
?>



