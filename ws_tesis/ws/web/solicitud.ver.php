<?php
require_once('../../util/Clases/Funciones.clase.php');
    session_start();
    error_reporting(0);
    $p_token = $_SESSION['token'];
    
    if(!isset($_SESSION["token"])){
        Funciones::imprimeJSON(500,"Falta el token","");	
        exit();
    }

    $codipress = $_POST["codipress"];
    $num_solicitud = $_POST["num_solicitud"]; 
    
    $json = file_get_contents('http://app20.susalud.gob.pe:8080/registro-renipress-webapp/ipress.htm?action=cargarIpress&idipress='.$codipress);
    $data = json_decode($json, true);
    try{
        require_once '../token.validar.php';
            if(validarToken($p_token)){
                if($data['mensaje'] == "ok"){
                    $datos = json_encode($data['datos']['p_crCURSOR_UPS']);
                    $jsonarray = json_decode($datos, true);
                    $valor = 0;
                    $boton = 'nada';


                    if(!empty($data['datos']['p_crCURSOR_DATOS'][0]['ESTABLECIMIENTO_NOMBRE'])){
                        $ESTABLECIMIENTO_NOMBRE = '<fieldset disabled>
                                                <input type="text" id="nombrecomercial" name="nombrecomercial" class="form-control form-control-sm" value="'.$data['datos']['p_crCURSOR_DATOS'][0]['ESTABLECIMIENTO_NOMBRE'].'">
                                                </fieldset>';
                    }else{
                        $ESTABLECIMIENTO_NOMBRE = '<div class="alert alert-danger" role="alert">
                                                <span class="badge badge-danger">!</span> El nombre del establecimiento no se encuentra registrado.
                                                </div>';
                        $valor = 1;
                    }

                    if(!empty($data['datos']['p_crCURSOR_DATOS'][0]['PROPIETARIO_RUC'])){
                        $PROPIETARIO_RUC = '<fieldset disabled>
                                                <input type="text" id="ruc" name="ruc" class="form-control form-control-sm" value="'.$data['datos']['p_crCURSOR_DATOS'][0]['PROPIETARIO_RUC'].'">
                                                </fieldset>';
                    }else{
                        $PROPIETARIO_RUC = '<div class="alert alert-danger" role="alert">
                                                <span class="badge badge-danger">!</span> El nombre del propietario no se encuentra registrado.
                                                </div>';
                        $valor = 1;
                    }

                    if(!empty($data['datos']['p_crCURSOR_DATOS'][0]['PROPIETARIO_RAZON_SOCIAL'])){
                        $PROPIETARIO_RAZON_SOCIAL = '<fieldset disabled>
                                                <input type="text" id="razonsocial" name="razonsocial" class="form-control form-control-sm" value="'.$data['datos']['p_crCURSOR_DATOS'][0]['PROPIETARIO_RAZON_SOCIAL'].'">
                                                </fieldset>';
                    }else{
                        $PROPIETARIO_RAZON_SOCIAL = '<div class="alert alert-danger" role="alert">
                                                <span class="badge badge-danger">!</span> La razón social no se encuentra registrado.
                                                </div>';
                        $valor = 1;
                    }

                    if(!empty($data['datos']['p_crCURSOR_DATOS'][0]['ESTABLECIMIENTO_DIRECCION'])){
                        $ESTABLECIMIENTO_DIRECCION = '<fieldset disabled>
                                                <input type="text" id="direccion" name="direccion" class="form-control form-control-sm" value="'.$data['datos']['p_crCURSOR_DATOS'][0]['ESTABLECIMIENTO_DIRECCION'].'">
                                                </fieldset>';
                    }else{
                        $ESTABLECIMIENTO_DIRECCION = '<div class="alert alert-danger" role="alert">
                                                <span class="badge badge-danger">!</span> La dirección no se encuentra registrada.
                                                </div>';
                        $valor = 1;
                    }

                    if(!empty($data['datos']['p_crCURSOR_UNIDAD'][0]['DE_DEPARTAMENTO'])){
                        $DE_DEPARTAMENTO = '<fieldset disabled>
                                                <input type="text" id="nombres" name="nombres" class="form-control form-control-sm" value="'.$data['datos']['p_crCURSOR_UNIDAD'][0]['DE_DEPARTAMENTO'].' - '.$data['datos']['p_crCURSOR_UNIDAD'][0]['DE_PROVINCIA'].' - '.$data['datos']['p_crCURSOR_UNIDAD'][0]['DE_DISTRITO'].'">
                                                </fieldset>';
                    }else{
                        $DE_DEPARTAMENTO = '<div class="alert alert-danger" role="alert">
                                                <span class="badge badge-danger">!</span> La localizaci&oacute;n no se encuentra registrada.
                                                </div>';
                        $valor = 1;
                    }

                    if(!empty($data['datos']['p_crCURSOR_DATOS'][0]['REPLEGAL_DATOS'])){
                        $rep_legal = $data['datos']['p_crCURSOR_DATOS'][0]['REPLEGAL_DATOS'];
                        list($nombre, $tipo, $dni) = explode("N,N", $rep_legal);
                        $REPLEGAL_DATOS =  '<div class="row">
                                            <div class="col-md-4">
                                                <p class="font-weight-light">Nombres y Apellidos del Representante Legal</p>
                                            </div>
                                            <div class="col-md-8">
                                                <fieldset disabled>
                                                    <input type="text" id="representantelegal" name="representantelegal" class="form-control form-control-sm" value="'.$nombre.'">
                                                </fieldset>
                                            </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <p class="font-weight-light">Tipo de Doc. Identidad</p>
                                                </div>
                                                <div class="col-md-8">
                                                    <fieldset disabled>
                                                        <input type="text" id="tipodocidentidad" name="tipodocidentidad" class="form-control form-control-sm" value="'.$tipo.'">
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <p class="font-weight-light">Nº Doc. Identidad</p>
                                                </div>
                                                <div class="col-md-8">
                                                    <fieldset disabled>
                                                        <input type="text" id="dni" name="dni" class="form-control form-control-sm" value="'.$dni.'">
                                                    </fieldset>
                                                </div>
                                            </div>';
                    }else{
                        $REPLEGAL_DATOS = '<div class="row">
                                            <div class="col-md-4">
                                                <p class="font-weight-light">Nombres y Apellidos del Representante Legal</p>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="alert alert-danger" role="alert">
                                                    <span class="badge badge-danger">!</span> No se ha encontrado registro del representante legal.
                                                </div>
                                            </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <p class="font-weight-light">Tipo de Doc. Identidad</p>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="alert alert-danger" role="alert">
                                                        <span class="badge badge-danger">!</span> No se ha encontrado registro del representante legal.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <p class="font-weight-light">Nº Doc. Identidad</p>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="alert alert-danger" role="alert">
                                                        <span class="badge badge-danger">!</span> No se ha encontrado registro del representante legal.
                                                    </div>
                                                </div>
                                            </div>';
                        $valor = 1;
                    }

                    if(!empty($data['datos']['p_crCURSOR_DATOS'][0]['ESTABLECIMIENTO_TELEFONO'])){
                        $ESTABLECIMIENTO_TELEFONO = '<fieldset disabled>
                                                <input type="text" id="telefono" name="telefono" class="form-control form-control-sm" value="'.$data['datos']['p_crCURSOR_DATOS'][0]['ESTABLECIMIENTO_TELEFONO'].'">
                                                </fieldset>';
                    }else{
                        $ESTABLECIMIENTO_TELEFONO = '<div class="alert alert-danger" role="alert">
                                                <span class="badge badge-danger">!</span> Se necesita el tel&eacute;fono del establecimiento.
                                                </div>';
                        $valor = 1;
                    }

                    if(!empty($data['datos']['p_crCURSOR_DATOS'][0]['ESTABLECIMIENTO_TEL_EMER'])){
                        $ESTABLECIMIENTO_TEL_EMER = '<fieldset disabled>
                                                <input type="text" id="telefonoemergencia" name="telefonoemergencia" class="form-control form-control-sm" value="'.$data['datos']['p_crCURSOR_DATOS'][0]['ESTABLECIMIENTO_TEL_EMER'].'">
                                                </fieldset>';
                    }else{
                        $ESTABLECIMIENTO_TEL_EMER = '<div class="alert alert-danger" role="alert">
                                                <span class="badge badge-danger">!</span> Se necesita el tel&eacute;fono de emergencia del establecimiento.
                                                </div>';
                        $valor = 1;
                    }

                    if(!empty($data['datos']['p_crCURSOR_DATOS'][0]['ESTABLECIMIENTO_LONGITUD'])){
                        $ESTABLECIMIENTO_LONGITUD = '<fieldset disabled>
                                                <input type="text" id="longitud" name="longitud" class="form-control form-control-sm" value="'.$data['datos']['p_crCURSOR_DATOS'][0]['ESTABLECIMIENTO_LONGITUD'].'">
                                                </fieldset>';
                    }else{
                        $ESTABLECIMIENTO_LONGITUD = '<div class="alert alert-danger" role="alert">
                                                <span class="badge badge-danger">!</span> Se necesita la longitud de localizaci&oacute;n del establecimiento.
                                                </div>';
                        $valor = 1;
                    }

                    if(!empty($data['datos']['p_crCURSOR_DATOS'][0]['ESTABLECIMIENTO_LATITUD'])){
                        $ESTABLECIMIENTO_LATITUD = '<fieldset disabled>
                                                <input type="text" id="latitud" name="latitud" class="form-control form-control-sm" value="'.$data['datos']['p_crCURSOR_DATOS'][0]['ESTABLECIMIENTO_LATITUD'].'">
                                                </fieldset>';
                    }else{
                        $ESTABLECIMIENTO_LATITUD = '<div class="alert alert-danger" role="alert">
                                                <span class="badge badge-danger">!</span> Se necesita la latitud de localizaci&oacute;n del establecimiento.
                                                </div>';
                        $valor = 1;
                    }

                    if(!empty($data['datos']['p_crCURSOR_DATOS'][0]['ESTABLECIMIENTO_CORREO'])){
                        $ESTABLECIMIENTO_CORREO = '<fieldset disabled>
                                                <input type="text" id="correo" name="correo" class="form-control form-control-sm" value="'.$data['datos']['p_crCURSOR_DATOS'][0]['ESTABLECIMIENTO_CORREO'].'">
                                                </fieldset>';
                    }else{
                        $ESTABLECIMIENTO_CORREO = '<div class="alert alert-danger" role="alert">
                                                <span class="badge badge-danger">!</span> Se necesita el correo del establecimiento.
                                                </div>';
                        $valor = 1;
                    }
                }else{
                    echo '<div class="alert alert-danger" role="alert">
                            <span class="badge badge-danger">!</span> Se necesitan datos
                        </div>';
                }
            }
    }catch(Exception $exc){
        Funciones::mensaje($exc->getMessage(), "e");
    }

?>
    <div class="row">
        <div class="col-md-4">
            <p class="font-weight-light">Nombre Comercial</p>
        </div>
        <div class="col-md-8">
            <?php echo $ESTABLECIMIENTO_NOMBRE ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <p class="font-weight-light">C&oacute;digo &Uacute;nico de IPRESS</p>
        </div>
        <div class="col-md-8">
            <fieldset disabled>
                <input type="text" id="nombres" name="nombres" class="form-control form-control-sm" value="<?php echo $codipress ?>">
            </fieldset>
        </div>
    </div>
    <br>
    <div class="bg-info text-white" style="padding:1px"></div>
    <br>
    <div class="row">
        <div class="col-md-4">
            <p class="font-weight-light">RUC</p>
        </div>
        <div class="col-md-8">
            <?php echo $PROPIETARIO_RUC ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <p class="font-weight-light">Raz&oacute;n Social</p>
        </div>
        <div class="col-md-8">
            <?php echo $PROPIETARIO_RAZON_SOCIAL ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <p class="font-weight-light">Direcci&oacute;n Completa</p>
        </div>
    <div class="col-md-8">
        <?php echo $ESTABLECIMIENTO_DIRECCION ?>
    </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <p class="font-weight-light">Departamento - Provincia - Distrito</p>
        </div>
        <div class="col-md-8">
            <?php echo $DE_DEPARTAMENTO ?>
        </div>
    </div>
    <br>
    <div class="bg-info text-white" style="padding:1px"></div>
    <br>
        <?php echo $REPLEGAL_DATOS ?>
    <br>
    <div class="bg-info text-white" style="padding:1px"></div>
    <br>
    <div class="row">
        <div class="col-md-4">
            <p class="font-weight-light">Tel&eacute;fono</p>
        </div>
        <div class="col-md-8">
            <?php echo $ESTABLECIMIENTO_TELEFONO ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <p class="font-weight-light">Tel&eacute;fono de Emergencia</p>
        </div>
        <div class="col-md-8">
            <?php echo $ESTABLECIMIENTO_TEL_EMER ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <p class="font-weight-light">Longitud</p>
        </div>
        <div class="col-md-8">
            <?php echo $ESTABLECIMIENTO_LONGITUD ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <p class="font-weight-light">Latitud</p>
        </div>
        <div class="col-md-8">
            <?php echo $ESTABLECIMIENTO_LATITUD ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <p class="font-weight-light">Correo Electr&oacute;nico del Establecimiento</p>
        </div>
    <div class="col-md-8">
        <?php echo $ESTABLECIMIENTO_CORREO ?>
    </div>
    </div>
    <br>
    <div class="bg-info text-white" style="padding:1px"></div>
    <br>
    <div class="row">
        <div class="col-md-4">
            <p class="font-weight-light">Documento de solicitud de inscripción aprobada por Susalud</p>
        </div>
    <div class="col-md-8">
        <a type="button" class="btn btn-info" href="../archivos/SolicitudesIpress/<?php echo $codipress ?>.pdf" target="_blank" >DESCARGAR DOCUMENTO</a>
    </div>
    </div>
    <br>
    <div class="bg-info text-white" style="padding:1px"></div>
    <br>
    <div class="row">
    <div class="col-md-4">
        <p class="font-weight-light">Unidades Productoras de Servicios - UPS</p>
    </div>
        <div class="col-md-8">  
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>C&oacute;digo UPS</th>
                        <th>Servicio</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        for ($i=0; $i<count($jsonarray);$i++){
                            echo '<tr>';
                                echo '<td>'.$jsonarray[$i]['CODIGO'].'</td>';
                                echo '<td>'.$jsonarray[$i]['NOMBRE'].'</td>';
                                echo '<td>'.$jsonarray[$i]['ESTADO'].'</td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <br>
    <div class="bg-info text-white" style="padding:1px"></div>
    <br>
    
    <?php 
        if($valor == 1){
                $boton = '
            <div class="row">
                <div class="col-md-12 text-center">
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-observacion">Mandar a observaci&oacute;n</button>
                </div>
            </div>';
        }else{
            $boton = '
            <div class="row">
                <div class="col-md-6 text-center">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-aceptar">Registrar IPRESS</button>
                </div>
                <div class="col-md-6 text-center">
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-observacion">Mandar a observaci&oacute;n</button>
                </div>
            </div>';
        }
        echo $boton;
        /*
        $boton = '
            <div class="row">
                <div class="col-md-6 text-center">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-aceptar">Registrar IPRESS</button>
                </div>
                <div class="col-md-6 text-center">
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-observacion">Mandar a observaci&oacute;n</button>
                </div>
            </div>';
        echo $boton;*/
    ?>
    <!-- Modal -->
    <div class="modal fade" id="modal-aceptar" tabindex="-1" role="dialog" aria-labelledby="exampleModal3Label" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModal3Label">Registro</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            ¿Est&aacute; seguro que desea registrar esta IPRESS?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <?php
              echo '<button type="button" class="btn btn-primary"  onclick="solicitudtransaccion(\''.$codipress.'\',\''.$data['datos']['p_crCURSOR_UNIDAD'][0]['DE_DEPARTAMENTO'].'\',\''.$data['datos']['p_crCURSOR_UNIDAD'][0]['DE_PROVINCIA'].'\',\''.$data['datos']['p_crCURSOR_UNIDAD'][0]['DE_DISTRITO'].'\',2,'.$num_solicitud.')" >Aceptar </button>';
            ?>
          </div>
        </div>
      </div>
    </div>
    
        <!-- Modal -->
    <div class="modal fade" id="modal-observacion" tabindex="-1" role="dialog" aria-labelledby="exampleModal3Label" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModal3Label">Observaci&oacute;n</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Ingrese la observación requerida
            <br>
            <br>
            <textarea class="form-control" rows="5" id="observacion" name="observacion" value=" "></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <?php
              echo '<button type="button" class="btn btn-primary" onclick="solicitudtransaccion(\''.$codipress.'\',null,null,null,3,'.$num_solicitud.')" >Aceptar</button>';
            ?>
          </div>
        </div>
      </div>
    </div>
    
    
    
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>





