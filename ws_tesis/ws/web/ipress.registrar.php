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

    if(!isset($_POST["codigoipress"])){
        Funciones::imprimeJSON(500,"Faltan datos","");	
        exit();
    }
    $p_codigoipress = $_POST["codigoipress"];
    $p_estado = $_POST["estado"];
    $p_observacion = $_POST["observacion"];
    $p_nombrecomercial = $_POST["nombrecomercial"];
    $p_ruc = $_POST["ruc"];
    $p_razonsocial = $_POST["razonsocial"];
    $p_direccion = $_POST["direccion"];
    $p_departamento = $_POST["departamento"];
    $p_provincia = $_POST["provincia"];
    $p_distrito = $_POST["distrito"];
    $p_representantelegal = $_POST["representantelegal"];
    $p_tipodocidentidad = $_POST["tipodocidentidad"];
    $p_dni = $_POST["dni"];
    $p_telefono = $_POST["telefono"];
    $p_telefonoemergencia = $_POST["telefonoemergencia"];
    $p_latitud = $_POST["latitud"];
    $p_longitud = $_POST["longitud"];
    $p_correoipress = $_POST["correoipress"];
    $p_correo_prueba="luisvalve_1997@hotmail.com"; //PARA EJEMPLO NO LO BORRARÉ
    $p_num_solicitud = $_POST["num_solicitud"];

    try{
        require_once '../token.validar.php';
            if(validarToken($p_token)){
                $json = file_get_contents('http://app20.susalud.gob.pe:8080/registro-renipress-webapp/ipress.htm?action=cargarIpress&idipress='.$p_codigoipress);
                $data = json_decode($json, true);
                $datos = json_encode($data['datos']['p_crCURSOR_UPS']);
				
                $objSolicitud=new Solicitud();
                $objSolicitud->setP_codigoipress($p_codigoipress);
                $objSolicitud->setP_estado($p_estado);
                $objSolicitud->setP_observacion($p_observacion);                
                $objSolicitud->setP_nombrecomercial($p_nombrecomercial);
                $objSolicitud->setRuc($p_ruc);
                $objSolicitud->setP_razonsocial($p_razonsocial);
                $objSolicitud->setP_direccion($p_direccion);
                $objSolicitud->setP_departamento($p_departamento);
                $objSolicitud->setP_provincia($p_provincia);
                $objSolicitud->setP_distrito($p_distrito);
                $objSolicitud->setP_representantelegal($p_representantelegal);
                $objSolicitud->setP_tipodocidentidad($p_tipodocidentidad);
                $objSolicitud->setP_dni($p_dni);
                $objSolicitud->setP_telefono($p_telefono);
                $objSolicitud->setP_telefonoemergencia($p_telefonoemergencia);
                $objSolicitud->setP_latitud($p_latitud);
                $objSolicitud->setP_longitud($p_longitud);
                $objSolicitud->setP_correoipress($p_correoipress);
                $objSolicitud->setP_valor($datos);
                $objSolicitud->setP_num_solicitud($p_num_solicitud);
                $resultado=$objSolicitud->solicitudtransaccion();
                if($resultado['estado'] == 200){
                    if($resultado['accion'] == 'registrado'){
                        $estado =   '<div class="alert alert-success" role="alert">
                                        <strong class="alert-heading">REGISTRADO!</strong>
                                        Bienvenido a MedicalApp, Nuestro sistema de interoperabilidad
                                    </div>';
                        $observacion = '';
                        $cuenta = ' <p><strong class="tipo">Usuario:</strong> '.$p_correoipress.'</p>
                                    <p><strong class="tipo">Clave:</strong> '.$resultado["clave"].'</p>';
                        $recomendacion = '<p><strong class="tipo">Recomendaciones</strong> Debe ingresar al panel de control para tener acceso a su sistema de gesti&oacute;n</p>';
                        $titulo = 'Bienvenido a nuestro sistema MedicalApp';
                        $panel = '<p><strong class="tipo">Panel de Control:</strong><a href="http://localhost:8085/ws_tesis/Vista/Login.html"> http://localhost:8085/ws_tesis/Vista/Login.html</a></p>';
                    }else{
                        $estado =   '<div class="alert alert-warning" role="alert">
                                        <strong>EN OBSERVACI&Oacute;N!</strong> Siga las siguientes indicaciones.
                                    </div>';
                        $observacion = '
                                    <p><strong class="tipo">Observaci&oacute;n:</strong> 
                                    '.$p_observacion.'
                                    </p>';
                        $cuenta = '';
                        $recomendacion = '<p><strong class="tipo">Recomendaciones</strong> Por favor siga las recomendaciones que se le indic&oacute; en las observaciones</p>';
                        $titulo = 'Solicitud de observacion MedicalApp';
                        $panel = '';
                    }
                    $cuerpo=
                        '<!DOCTYPE html>
                        <html lang="en">
                        <head>
                            <meta charset="UTF-8">
                            <title>Correo</title>
                            <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
                            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
                            <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js"></script>
                            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
                            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
                            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"> </script>
                        </head>
                        <body>
                            <div class="container-fluid">
                                <div class="container cabecera"><strong>MedicalApp</strong></div>
                                <div class="container cuerpo">
                                    <p><strong class="tipo">N&uacute;mero de Solicitud:</strong> '.$resultado["numerosolicitud"].'</p>
                                    <p><strong class="tipo">C&oacute;digo de IPRESS:</strong> '.$p_codigoipress.'</p>
                                    <p><strong class="tipo">Estado:</strong> 
                                        '.$estado.'
                                    </p>
                                    '.$observacion.'
                                    '.$panel.'
                                    '.$cuenta.'
                                    '.$recomendacion.'
                                </div>
                            </div>
                        </body>
                            <style>
                                body{
                                    background: #ecf0f5;
                                    font-family: sans-serif;
                                }
                                .container-fluid{
                                    width: 500px;
                                }
                                .cabecera{
                                    -webkit-box-shadow: 0px 0px 32px -5px rgba(0,0,0,0.75);
                                    -moz-box-shadow: 0px 0px 32px -5px rgba(0,0,0,0.75);
                                    box-shadow: 0px 0px 32px -5px rgba(0,0,0,0.75);
                                    background: #3c8dbc;
                                    margin-top: 20px;
                                    border-radius: 10px;
                                    color: #ffffff;
                                    font: 150% sans-serif;
                                    padding: 20px;
                                    text-align: center;
                                }
                                .cuerpo{
                                    -webkit-box-shadow: 0px 5px 17px -5px rgba(0,0,0,0.75);
                                    -moz-box-shadow: 0px 5px 17px -5px rgba(0,0,0,0.75);
                                    box-shadow: 0px 5px 17px -5px rgba(0,0,0,0.75);
                                    border-radius: 10px;
                                    padding: 20px;
                                    background: #ffffff;
                                    margin-top: 10px;
                                    position: relative;
                                    word-wrap: break-word;
                                }
                                .tipo{
                                    color: #3A3939;
                                }
                            </style>
                        </html>';
                        $headers  = "MIME-Version: 1.0\r\n";
                        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                        $headers .= "From: MEDICAL APP <luisvalve34@gmail.com>\r\n";
                        $headers .= "Reply-To: luisvalve34@gmail.com\r\n";
                        if(mail($p_correo_prueba,$titulo,$cuerpo,$headers)){
                            
                        }else{
                            echo 'Error al Enviar correo';
                        }
                    }else{
                        echo 'no hola';
                    } 
                }else{
                    echo 'EL ESTADO ES 500';
                }
            echo json_encode($resultado,true);
    }catch(Exception $exc){
        Funciones::mensaje($exc->getMessage(), "e");
    }
?>