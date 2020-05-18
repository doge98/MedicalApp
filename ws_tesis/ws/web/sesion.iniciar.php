<?php
require_once("../../logica/Sesion.clase.php");
require_once('../../util/Clases/Funciones.clase.php');

    if(!isset($_POST["p_usuario"]) || !isset($_POST["p_clave"])){
        Funciones::imprimeJSON(500,"Faltan datos requeridos","");
        exit();
    }
    $usuario=$_POST["p_usuario"];
    $clave=$_POST["p_clave"];
    
    try{
        $objSesion=new Sesion();
        $objSesion->setCorreo($usuario);
        $objSesion->setClave($clave);
        $resultado=$objSesion->loginweb();
        session_start();
        if($resultado["estado"]==200){
            require_once '../token.generar.php';
            $token= generarToken(null,900000);
            $resultado["token"]=$token;
			
            if($resultado["tipo"] == 0){
                $_SESSION['p_correocuenta'] = $usuario;
                $_SESSION['p_clavecuenta'] = $clave;
                $_SESSION['token'] = $token;
                $_SESSION['tipo'] = "0";
                header("location: ../../Vista/PanelAdminSolicitudes.php");
            }
            if($resultado["tipo"] == 1){
                $_SESSION['p_correocuenta'] = $usuario;
                $_SESSION['p_clavecuenta'] = $clave;
                $_SESSION['token'] = $token;
                $_SESSION['codigo_ipress'] = $resultado["codigo_ipress"];
                $_SESSION['tipo'] = "1";
                header("location: ../../Vista/PanelIpress.php");
            }
        }else{
            header("location: ../../Vista/Login.html");
        }
        
    }catch(Exception $exc){
        Funciones::imprimeJSON(500,$exc->getMessage(),"");
    }
?>
