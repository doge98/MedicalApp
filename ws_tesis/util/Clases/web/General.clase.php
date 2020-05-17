<?php
require_once '../../datos/Conexion.clase.php';

class General extends Conexion{
    
    private $p_codigodepartamento;
    private $p_codigoprovincia;
    
    function getP_codigodepartamento() {
        return $this->p_codigodepartamento;
    }

    function setP_codigodepartamento($p_codigodepartamento) {
        $this->p_codigodepartamento = $p_codigodepartamento;
    }
    
    function getP_codigoprovincia() {
        return $this->p_codigoprovincia;
    }

    function setP_codigoprovincia($p_codigoprovincia) {
        $this->p_codigoprovincia = $p_codigoprovincia;
    }
    
    public function departamento(){
        try {
            $sql = "select * from departamento";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll();
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    public function provincia(){
        try {
            $sql = "select * from provincia where codigo_departamento=:p_codigodepartamento";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindValue(":p_codigodepartamento",$this->getP_codigodepartamento());
            $sentencia->execute();
            $resultado = $sentencia->fetchAll();
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    public function distrito(){
        try {
            $sql = "select * from distrito where codigo_departamento=:p_codigodepartamento and codigo_provincia=:p_codigoprovincia";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindValue(":p_codigodepartamento",$this->getP_codigodepartamento());
            $sentencia->bindValue(":p_codigoprovincia",$this->getP_codigoprovincia());
            $sentencia->execute();
            $resultado = $sentencia->fetchAll();
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
}