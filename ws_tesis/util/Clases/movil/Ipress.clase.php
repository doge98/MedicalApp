<?php
require_once '../../datos/Conexion.clase.php';

class Ipress extends Conexion{
	
	public function ipresslistar(){
        try {
            $sql = "select * from ipress";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            return $sentencia->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $exc) {
            throw $exc;
        }
    }
}





















