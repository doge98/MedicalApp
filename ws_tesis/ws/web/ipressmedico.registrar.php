<?php

require_once '../../util/Clases/web/Ipress.clase.php';
require_once '../../datos/Conexion.clase.php';
require_once('../../util/Clases/Funciones.clase.php');
    
    session_start();
    error_reporting(0);
    $p_token = $_SESSION['token'];

	$p_codigounicoipress = $_SESSION["codigo_ipress"];
    $p_documentopersona = $_POST['documento_persona'];
    $p_nombrepersona = $_POST['nombre_persona'];
    $p_paternopersona = $_POST['paterno_persona'];
    $p_maternopersona = $_POST['materno_persona'];
    $p_telefonopersona = $_POST['telefono_persona'];
    $p_sexopersona = $_POST['sexo_persona'];
    $p_civilpersona = $_POST['civil_persona'];
    $p_fecnacpersona = $_POST['fecnac_persona'];
    $p_codigodepartamento = $_POST['codigo_departamento'];
    $p_codigoprovincia = $_POST['codigo_provincia'];
    $p_codigodistrito = $_POST['codigo_distrito'];
    $p_direccionpersona = $_POST['direccion_persona'];
    $p_referenciapersona = $_POST['referencia_persona'];

    $p_correocuenta = $_POST['correo_cuenta'];
	$p_correocuenta_prueba = 'luisvalve_1997@hotmail.com';
    $p_codigocmpmedico = $_POST['codigo_cmp_medico'];
    $p_consejoregional_medico = $_POST['consejo_regional_medico'];
    $p_arrayupsmedico = $_POST['arrayupsmedico'];

    if(!isset($_SESSION["token"])){
        Funciones::imprimeJSON(500,"Falta el token","");	
        exit();
    }
    
    try{
        require_once '../token.validar.php';
            if(validarToken($p_token)){
                echo $p_codigounicoipress . '<br>' .
                $p_documentopersona . '<br>' .
                $p_nombrepersona . '<br>' .
                $p_paternopersona . '<br>' .
                $p_maternopersona . '<br>' .
                $p_telefonopersona . '<br>' .
                $p_sexopersona . '<br>' .
                $p_civilpersona . '<br>' .
                $p_fecnacpersona . '<br>' .
                $p_codigodepartamento . '<br>' .
                $p_codigoprovincia . '<br>' .
                $p_codigodistrito . '<br>' .
                $p_direccionpersona . '<br>' .
                $p_referenciapersona . '<br>' .
            
                $p_correocuenta . '<br>' .
                $p_correocuenta_prueba . '<br>' .              
                $p_codigocmpmedico . '<br>' .
                $p_consejoregional_medico . '<br>' .
                json_encode($p_arrayupsmedico);
                $objIpress = new Ipress();
                $objIpress->setP_codigounicoipress($p_codigounicoipress);
                $objIpress->setP_documentopersona($p_documentopersona);
                $objIpress->setP_nombrepersona($p_nombrepersona);
                $objIpress->setP_paternopersona($p_paternopersona);
                $objIpress->setP_maternopersona($p_maternopersona);
                $objIpress->setP_telefonopersona($p_telefonopersona);
                $objIpress->setP_sexopersona($p_sexopersona);
                $objIpress->setP_civilpersona($p_civilpersona);
                $objIpress->setP_fecnacpersona($p_fecnacpersona);
                $objIpress->setP_codigodepartamento($p_codigodepartamento);
                $objIpress->setP_codigoprovincia($p_codigoprovincia);
                $objIpress->setP_codigodistrito($p_codigodistrito);
                $objIpress->setP_direccionpersona($p_direccionpersona);
                $objIpress->setP_referenciapersona($p_referenciapersona);
                $objIpress->setP_correocuenta($p_correocuenta);
                $objIpress->setP_codigocmpmedico($p_codigocmpmedico);
                $objIpress->setP_consejoregional_medico($p_consejoregional_medico);
                $objIpress->setP_arrayupsmedico(json_encode($p_arrayupsmedico));
                $resultado=$objIpress->medicoregistrar();
				if($resultado["estado"] == 200){
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
                                    <p><strong class="tipo">C&oacute;digo de IPRESS:</strong> '.$p_codigounicoipress.'</p>
                                    <p><strong class="tipo">Estado:</strong> REGISTRADO</p>
                                    <p><strong class="tipo">Usuario:</strong> '.$p_correocuenta.'</p>
                                    <p><strong class="tipo">Clave:</strong> '.$resultado["clave"].'</p>
                                    <p><strong class="tipo">Panel de Control:</strong> www.login.com</p>
									<p><strong class="tipo">Categorias de productos a ofrecer:</strong></p>';
                                   	for($i=0;$i<count($p_arrayupsmedico);$i++){
                                        $cuerpo .= '<p>'.($i+1).'. '.$p_arrayupsmedico[$i]["descripcion"].'</p>';
                                    }
                        $cuerpo.='</div>
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
                    if(mail($p_correocuenta_prueba,"Registro Medico",$cuerpo,$headers)){
                            echo json_encode($resultado,true);
                    }else{
                        echo 'Error al Enviar correo';
                    }
				}
            }
    }catch(Exception $exc){
        Funciones::mensaje($exc->getMessage(), "e");
    }














