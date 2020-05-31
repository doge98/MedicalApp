<?php
require_once '../../datos/Conexion.clase.php';

class Ipress extends Conexion{
    
    private $p_codigounicoipress;
    
    function getP_codigounicoipress() {
        return $this->p_codigounicoipress;
    }

    function setP_codigounicoipress($p_codigounicoipress) {
        $this->p_codigounicoipress = $p_codigounicoipress;
    }

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

    public function ipressupslistar(){
        try { 
            $sql="select iu.ipress_ups_codigo,ue.descripcion as descripcion_especialidad ,ug.descripcion as descripcion_general
            from ipress_ups iu 
            inner join ups_especialidad ue on ue.codigo_upss_especialidad = iu.codigo_upss_especialidad
            inner join ups_general ug on ug.codigo_upss_general=ue.codigo_upss_general
            where iu.estado_movil='1' and iu.estado='1' and iu.codigo_unico_ipress=:p_codigounicoipress
            order by ug.descripcion";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia -> bindParam(":p_codigounicoipress", $this->getP_codigounicoipress());
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;    
        } catch (Exception $exc) {
            throw  $ex;
        }
    }
}





















