<?php
    $dni = $_POST["dni"];
    $fechaNac = $_POST["fechaNac"];
    $sexo = $_POST["sexo"];
    $json = file_get_contents('http://app20.susalud.gob.pe:8080/registro-renipress-webapp/login.htm?action=buscarPersona&dat_fechaNacimiento='.$fechaNac.'&cmb_sexo='.$sexo.'&cmb_tipoDocumentoIdentidad=1&txt_numeroDocumentoIdentidad='.$dni.'');
    $data = json_decode($json, true);
    echo json_encode($data);
?>