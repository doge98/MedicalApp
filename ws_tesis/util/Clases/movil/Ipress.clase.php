<?php
require_once '../../datos/Conexion.clase.php';

class Ipress extends Conexion{
	
	public function ipresslistar(){
        try {
            $sql = "select * from ipress";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll();
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
}





















