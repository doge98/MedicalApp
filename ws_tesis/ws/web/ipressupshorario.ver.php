<?php

require_once '../../util/Clases/web/Ipress.clase.php';
require_once '../../datos/Conexion.clase.php';
require_once('../../util/Clases/Funciones.clase.php');
    
    session_start();
    error_reporting(0);
    $p_token = $_SESSION['token'];
	$ups_medico_ipress = $_POST["upsmedicoipress"];
	$id_afiliacion = $_POST["idafiliacion"];
    $ups = $_POST["ups"];

    if(!isset($_SESSION["token"])){
        Funciones::imprimeJSON(500,"Falta el token","");	
        exit();
    }
    try{
		require_once '../token.validar.php';
            if(validarToken($p_token)){
				echo '
				<div class="alert alert-secondary" role="alert">
				<div class="d-flex justify-content-center">
					  <div class="p-2">
						<strong>'.$ups.'</strong>
					  </div>
				</div>
				</div>
				<div class="dias">
						<div class="row" id="divcheck">';
						
					for ($i=0; $i<7;$i++){
						switch($i){
							case 0: $diatrabajo = "Lunes";
								break;
							case 1: $diatrabajo = "Martes";
								break;
							case 2: $diatrabajo = "Miercoles";	
								break;
							case 3: $diatrabajo = "Jueves";	
								break;
							case 4: $diatrabajo = "Viernes";	
								break;
							case 5: $diatrabajo = "Sabado";	
								break;
							case 6: $diatrabajo = "Domingo";
								break;
						}
						echo '<div class="card card-dia">
								<h3 class="card-header btnday active" value="'.$diatrabajo.'" id="dia">
                                    <div class="d-flex justify-content-center">
                                    	<div class="p-2">'.$diatrabajo.'</div>
                                    </div>
                                </h3>
								<div class="card-body">';
								$objIpress=new Ipress();
								$objIpress->setUps_medico_ipress($ups_medico_ipress);
								$objIpress->setId_afiliacion($id_afiliacion);
								$objIpress->setDiatrabajo($diatrabajo);
								$resultado=$objIpress->ipressupshorariover();
								for($j=0;$j<count($resultado);$j++){
									if($resultado[$j]["estado"] == 1){//usando la ups
										$checked = "checked"; //usando
									}else{
										$checked = ""; //no usando
									}
									if($resultado[$j]["estado_hora"] == ""){ //ocupado por otro ups
										$disable = '
										<input type="checkbox" class="custom-control-input" name="type" id="'.$resultado[$j]["trabajo_hora_medico"].'" value="'.$resultado[$j]["trabajo_hora_medico"].'" '.$checked.'>
										<label class="custom-control-label" for="'.$resultado[$j]["trabajo_hora_medico"].'">'.$resultado[$j]["hora_entrada"].' - '.$resultado[$j]["hora_salida"].'</label>
										';
									}else{
										$disable = '<input type="checkbox" class="custom-control-input" name="type" id= "'.$resultado[$j]["trabajo_hora_medico"].'"value="'.$resultado[$j]["trabajo_hora_medico"].'" '.$checked.' disabled="disabled">
										<label class="custom-control-label" for="'.$resultado[$j]["trabajo_hora_medico"].'">Ocupado</label>';
										
									}
								echo '<div class="custom-control custom-checkbox">
										'.$disable.'
									</div>';
								}
						echo '	</div>
							</div>';
					}
				
				echo '	</div>
					  </div>';
			}
    }catch(Exception $exc){
        Funciones::mensaje($exc->getMessage(), "e");
    }
?>