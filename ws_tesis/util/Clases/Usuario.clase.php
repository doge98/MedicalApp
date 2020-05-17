<?php
require_once '../datos/Conexion.clase.php';
class Usuario extends Conexion{
    private $usuario_cuenta;
    private $clave_cuenta;
    private $tipo_usuario;
    private $activacion_usuario;
    private $f_tipo;
    
    function getUsuario_cuenta() {
        return $this->usuario_cuenta;
    }

    function getClave_cuenta() {
        return $this->clave_cuenta;
    }
    
    function getTipo_usuario() {
        return $this->tipo_usuario;
    }

    function getActivacion_usuario() {
        return $this->activacion_usuario;
    }
    
    function getF_tipo() {
        return $this->f_tipo;
    }

    function setUsuario_cuenta($usuario_cuenta) {
        $this->usuario_cuenta = $usuario_cuenta;
    }

    function setClave_cuenta($clave_cuenta) {
        $this->clave_cuenta = $clave_cuenta;
    }
    
    function setTipo_usuario($tipo_usuario) {
        $this->tipo_usuario = $tipo_usuario;
    }

    function setActivacion_usuario($activacion_usuario) {
        $this->activacion_usuario = $activacion_usuario;
    }
    
    function setF_tipo($f_tipo) {
        $this->f_tipo = $f_tipo;
    }
    
    public function verificar_correo(){
	try{
            $sql="select * from f_validar_correo(:f_tipo,:usuario_cuenta,:clave_cuenta,:tipo_usuario,:activacion_usuario)";
		$sentencia=$this->dblink->prepare($sql);
		$sentencia->bindParam(":usuario_cuenta",$this->getUsuario_cuenta());
                $sentencia->bindParam(":clave_cuenta",$this->getClave_cuenta());
                $sentencia->bindParam(":tipo_usuario",$this->getTipo_usuario());
                $sentencia->bindParam(":activacion_usuario",$this->getActivacion_usuario());
                $sentencia->bindParam(":f_tipo",$this->getF_tipo());
		$sentencia->execute();
                return $sentencia->fetch(PDO::FETCH_ASSOC);
	}catch(Exception $exc){
		throw $exc;
	}
    }
}
