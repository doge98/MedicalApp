<?php
require_once '../../datos/Conexion.clase.php';

class Medico extends Conexion{
    private $p_codigounicoipress;
    private $p_ipressupscodigo;
    private $p_upsmedicoipress;

    function getP_codigounicoipress() {
        return $this->p_codigounicoipress;
    }

    function setP_codigounicoipress($p_codigounicoipress) {
        $this->p_codigounicoipress = $p_codigounicoipress;
    }

    function getP_ipressupscodigo() {
        return $this->p_ipressupscodigo;
    }

    function setP_ipressupscodigo($p_ipressupscodigo) {
        $this->p_ipressupscodigo = $p_ipressupscodigo;
    }

    function getP_upsmedicoipress() {
        return $this->p_upsmedicoipress;
    }

    function setP_upsmedicoipress($p_upsmedicoipress) {
        $this->p_upsmedicoipress = $p_upsmedicoipress;
    }

    public function medicoupslistar(){
        try { 
            $sql="select pe.*,awp.codigo_cmp_medico,miu.ups_medico_ipress from medico_ipress_ups miu
            inner join cuenta_web_afiliacion cwa on miu.id_afiliacion=cwa.id_afiliacion
            inner join afiliacion_web_persona awp on awp.codigo_cuenta=cwa.codigo_cuenta
            inner join persona pe on pe.documento_persona=awp.documento_persona
            where cwa.codigo_unico_ipress=:p_codigounicoipress and ipress_ups_codigo=:p_ipressupscodigo";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia -> bindParam(":p_codigounicoipress", $this->getP_codigounicoipress());
            $sentencia -> bindParam(":p_ipressupscodigo", $this->getP_ipressupscodigo());
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;    
        } catch (Exception $exc) {
            throw  $ex;
        }
    }
    public function medicoupshorariolistar(){
        try { 
            $sql="select diatrabajo,hora_entrada,hora_salida from trabajo_medico_hora tmh
            inner join horario_trabajo ht on tmh.horatrabajo=ht.horatrabajo
            where tmh.ups_medico_ipress=:p_upsmedicoipress and estado=1
            order by diatrabajo,hora_entrada";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia -> bindParam(":p_upsmedicoipress", $this->getP_upsmedicoipress());
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;    
        } catch (Exception $exc) {
            throw  $ex;
        }
    }
}
?>