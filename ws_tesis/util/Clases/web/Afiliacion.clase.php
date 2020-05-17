<?php
require_once '../../datos/Conexion.clase.php';

class Afiliacion extends Conexion{
    
    private $p_codigounicoipress;
    private $p_dnisolicitante;
    private $p_correosolicitante;
    private $p_archivo;
    
    function getP_codigounicoipress() {
        return $this->p_codigounicoipress;
    }

    function getP_dnisolicitante() {
        return $this->p_dnisolicitante;
    }

    function getP_correosolicitante() {
        return $this->p_correosolicitante;
    }

    function getP_archivo() {
        return $this->p_archivo;
    }

    function setP_codigounicoipress($p_codigounicoipress) {
        $this->p_codigounicoipress = $p_codigounicoipress;
    }

    function setP_dnisolicitante($p_dnisolicitante) {
        $this->p_dnisolicitante = $p_dnisolicitante;
    }

    function setP_correosolicitante($p_correosolicitante) {
        $this->p_correosolicitante = $p_correosolicitante;
    }

    function setP_archivo($p_archivo) {
        $this->p_archivo = $p_archivo;
    }
    
    public function registrarSolicitud(){
        try {
            $sql = "select * from solicitud_ipress_registro(:p_codigounicoipress,:p_dnisolicitante,:p_correosolicitante,:p_archivo)";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindValue(":p_codigounicoipress",$this->getP_codigounicoipress());
            $sentencia->bindValue(":p_dnisolicitante",$this->getP_dnisolicitante());
            $sentencia->bindValue(":p_correosolicitante",$this->getP_correosolicitante());
            $sentencia->bindValue(":p_archivo",$this->getP_archivo());
            $sentencia->execute();
            $resultado = $sentencia->fetchAll();
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
}