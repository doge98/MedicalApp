<?php
require_once '../../datos/Conexion.clase.php';

class Sesion extends Conexion{
    private $correo;
    private $clave;

    
    function getCorreo() {
        return $this->correo;
    }

    function getClave() {
        return $this->clave;
    }

    function setCorreo($correo) {
        $this->correo = $correo;
    }

    function setClave($clave) {
        $this->clave = $clave;
    }
    
    public function loginmovil(){
        try {
            $sql="select * from f_login_app(:p_correo,:p_clave)";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_correo",$this->getCorreo());
            $sentencia->bindParam(":p_clave",$this->getClave());
            $sentencia->execute();
            return $sentencia->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    public function loginweb(){
        try {
            $sql = "select * from f_login_web(:p_correo,:p_clave)";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindValue(":p_correo",$this->getCorreo());
            $sentencia->bindValue(":p_clave",$this->getClave());
            $sentencia->execute();
            return $sentencia->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $exc) {
            throw $exc;
        }
    }
}
