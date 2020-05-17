<?php
    require_once '../../util/Clases/web/General.clase.php';
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
            $objGeneral=new General();
            $resultado=$objGeneral->departamento();
            echo "
            <select id='combodepartamento' class='custom-select'>
                <option selected='selected' value='0'>DEPARTAMENTO</option>";
                for ($i=1; $i<count($resultado);$i++){
                    echo "
                    <option value=".$resultado[$i]['codigo_departamento'].">".$resultado[$i]['nombre_departamento']."</option>";
                }
            echo "</select>";
        }
    }catch(Exception $exc){
        Funciones::mensaje($exc->getMessage(), "e");
    }
?>



