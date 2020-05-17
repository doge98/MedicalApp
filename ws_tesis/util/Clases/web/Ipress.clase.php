<?php
require_once '../../datos/Conexion.clase.php';

class Ipress extends Conexion{
    
    private $p_codigounicoipress;
    private $p_estadomovil;
    private $p_upsipress;
    
    private $p_documentopersona;
    private $p_nombrepersona;
    private $p_paternopersona;
    private $p_maternopersona;
    private $p_telefonopersona;
    private $p_sexopersona;
    private $p_civilpersona;
    private $p_fecnacpersona;
    private $p_codigodepartamento;
    private $p_codigoprovincia;
    private $p_codigodistrito;
    private $p_direccionpersona;
    private $p_referenciapersona;
    private $p_correocuenta;
    private $p_codigocmpmedico;
    private $p_consejoregional_medico;
    private $p_arrayupsmedico;
	
    private $id_afiliacion;
	
    private $ups_medico_ipress;
	
    function getP_codigounicoipress() {
        return $this->p_codigounicoipress;
    }

    function setP_codigounicoipress($p_codigounicoipress) {
        $this->p_codigounicoipress = $p_codigounicoipress;
    }
    
    function getP_estadomovil() {
        return $this->p_estadomovil;
    }

    function setP_estadomovil($p_estadomovil) {
        $this->p_estadomovil = $p_estadomovil;
    }
    
    function getP_upsipress() {
        return $this->p_upsipress;
    }

    function setP_upsipress($p_upsipress) {
        $this->p_upsipress = $p_upsipress;
    }
    
	function getP_documentopersona() {
        return $this->p_documentopersona;
    }

    function getP_nombrepersona() {
        return $this->p_nombrepersona;
    }

    function getP_paternopersona() {
        return $this->p_paternopersona;
    }

    function getP_maternopersona() {
        return $this->p_maternopersona;
    }

    function getP_telefonopersona() {
        return $this->p_telefonopersona;
    }

    function getP_sexopersona() {
        return $this->p_sexopersona;
    }

    function getP_civilpersona() {
        return $this->p_civilpersona;
    }

    function getP_fecnacpersona() {
        return $this->p_fecnacpersona;
    }

    function getP_codigodepartamento() {
        return $this->p_codigodepartamento;
    }

    function getP_codigoprovincia() {
        return $this->p_codigoprovincia;
    }

    function getP_codigodistrito() {
        return $this->p_codigodistrito;
    }

    function getP_direccionpersona() {
        return $this->p_direccionpersona;
    }

    function getP_referenciapersona() {
        return $this->p_referenciapersona;
    }

    function getP_correocuenta() {
        return $this->p_correocuenta;
    }

    function getP_codigocmpmedico() {
        return $this->p_codigocmpmedico;
    }

    function getP_consejoregional_medico() {
        return $this->p_consejoregional_medico;
    }

    function getP_arrayupsmedico() {
        return $this->p_arrayupsmedico;
    }

    function setP_documentopersona($p_documentopersona) {
        $this->p_documentopersona = $p_documentopersona;
    }

    function setP_nombrepersona($p_nombrepersona) {
        $this->p_nombrepersona = $p_nombrepersona;
    }

    function setP_paternopersona($p_paternopersona) {
        $this->p_paternopersona = $p_paternopersona;
    }

    function setP_maternopersona($p_maternopersona) {
        $this->p_maternopersona = $p_maternopersona;
    }

    function setP_telefonopersona($p_telefonopersona) {
        $this->p_telefonopersona = $p_telefonopersona;
    }

    function setP_sexopersona($p_sexopersona) {
        $this->p_sexopersona = $p_sexopersona;
    }

    function setP_civilpersona($p_civilpersona) {
        $this->p_civilpersona = $p_civilpersona;
    }

    function setP_fecnacpersona($p_fecnacpersona) {
        $this->p_fecnacpersona = $p_fecnacpersona;
    }

    function setP_codigodepartamento($p_codigodepartamento) {
        $this->p_codigodepartamento = $p_codigodepartamento;
    }

    function setP_codigoprovincia($p_codigoprovincia) {
        $this->p_codigoprovincia = $p_codigoprovincia;
    }

    function setP_codigodistrito($p_codigodistrito) {
        $this->p_codigodistrito = $p_codigodistrito;
    }

    function setP_direccionpersona($p_direccionpersona) {
        $this->p_direccionpersona = $p_direccionpersona;
    }

    function setP_referenciapersona($p_referenciapersona) {
        $this->p_referenciapersona = $p_referenciapersona;
    }

    function setP_correocuenta($p_correocuenta) {
        $this->p_correocuenta = $p_correocuenta;
    }

    function setP_codigocmpmedico($p_codigocmpmedico) {
        $this->p_codigocmpmedico = $p_codigocmpmedico;
    }

    function setP_consejoregional_medico($p_consejoregional_medico) {
        $this->p_consejoregional_medico = $p_consejoregional_medico;
    }

    function setP_arrayupsmedico($p_arrayupsmedico) {
        $this->p_arrayupsmedico = $p_arrayupsmedico;
    }
	
	function getId_afiliacion() {
        return $this->id_afiliacion;
    }

    function setId_afiliacion($id_afiliacion) {
        $this->id_afiliacion = $id_afiliacion;
    }
	
	function getUps_medico_ipress() {
        return $this->ups_medico_ipress;
    }

    function setUps_medico_ipress($ups_medico_ipress) {
        $this->ups_medico_ipress = $ups_medico_ipress;
    }
	
	function getDiatrabajo() {
        return $this->diatrabajo;
    }

    function setDiatrabajo($diatrabajo) {
        $this->diatrabajo = $diatrabajo;
    }
	
    public function ipressver(){
        try {
            $sql = "select * from ipress where codigo_unico_ipress = :p_codigounicoipress";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindValue(":p_codigounicoipress",$this->getP_codigounicoipress());
            $sentencia->execute();
            return $sentencia->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    public function ipressupslistar(){
        try {
            $sql = "select ue.*,ug.descripcion as upssgeneral,iu.ipress_ups_codigo from ipress i 
            inner join ipress_ups iu on i.codigo_unico_ipress=iu.codigo_unico_ipress
            inner join ups_especialidad ue on iu.codigo_upss_especialidad=ue.codigo_upss_especialidad
            inner join ups_general ug on ug.codigo_upss_general=ue.codigo_upss_general
            where i.codigo_unico_ipress = :p_codigounicoipress";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindValue(":p_codigounicoipress",$this->getP_codigounicoipress());
            $sentencia->execute();
            $resultado = $sentencia->fetchAll();
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    public function ipressupslistarmovil(){
        try {
            $sql = "select ue.*,ug.descripcion as upssgeneral,iu.ipress_ups_codigo from ipress i 
            inner join ipress_ups iu on i.codigo_unico_ipress=iu.codigo_unico_ipress
            inner join ups_especialidad ue on iu.codigo_upss_especialidad=ue.codigo_upss_especialidad
            inner join ups_general ug on ug.codigo_upss_general=ue.codigo_upss_general
            where i.codigo_unico_ipress = :p_codigounicoipress and iu.estado_movil=:p_estado_movil";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindValue(":p_codigounicoipress",$this->getP_codigounicoipress());
            $sentencia->bindValue(":p_estado_movil",$this->getP_estadomovil());
            $sentencia->execute();
            $resultado = $sentencia->fetchAll();
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
	
    public function ipressupsmovil(){
        try {
            $sql = "select * from ipress_upsmovil_estado(:p_estado_movil,:p_upsipress)";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindValue(":p_estado_movil",$this->getP_estadomovil());
            $sentencia->bindValue(":p_upsipress",$this->getP_upsipress());
            $sentencia->execute();
            return $sentencia->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    public function ipressupsmovildesactivar(){
		try {
			$sql = "update ipress_ups set estado_movil='0' where ipress_ups_codigo = :p_upsipress";
			$sentencia = $this->dblink->prepare($sql);
			$sentencia->bindValue(":p_upsipress",$this->getP_upsipress());
			$sentencia->execute();
			return $sentencia->fetch(PDO::FETCH_ASSOC);
		} catch (Exception $exc) {
            throw $exc;
        }
    }
	
	public function medicoregistrar(){
        try {
            $sql = "select * from ipress_medico_registrar(:p_codigounicoipress,:p_documentopersona,:p_nombrepersona,:p_paternopersona,:p_maternopersona,:p_telefonopersona,:p_sexopersona,:p_civilpersona,:p_fecnacpersona,:p_codigodepartamento,:p_codigoprovincia,:p_codigodistrito,:p_direccionpersona,:p_referenciapersona,:p_correocuenta,:p_codigocmpmedico,:p_consejoregional_medico,:p_arrayupsmedico)";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindValue(":p_codigounicoipress",$this->getP_codigounicoipress());
            $sentencia->bindValue(":p_documentopersona",$this->getP_documentopersona());
            $sentencia->bindValue(":p_nombrepersona",$this->getP_nombrepersona());
            $sentencia->bindValue(":p_paternopersona",$this->getP_paternopersona());
            $sentencia->bindValue(":p_maternopersona",$this->getP_maternopersona());
            $sentencia->bindValue(":p_telefonopersona",$this->getP_telefonopersona());
            $sentencia->bindValue(":p_sexopersona",$this->getP_sexopersona());
            $sentencia->bindValue(":p_civilpersona",$this->getP_civilpersona());
            $sentencia->bindValue(":p_fecnacpersona",$this->getP_fecnacpersona());
            $sentencia->bindValue(":p_codigodepartamento",$this->getP_codigodepartamento());
            $sentencia->bindValue(":p_codigoprovincia",$this->getP_codigoprovincia());
            $sentencia->bindValue(":p_codigodistrito",$this->getP_codigodistrito());
            $sentencia->bindValue(":p_direccionpersona",$this->getP_direccionpersona());
            $sentencia->bindValue(":p_referenciapersona",$this->getP_referenciapersona());
            $sentencia->bindValue(":p_correocuenta",$this->getP_correocuenta());
            $sentencia->bindValue(":p_codigocmpmedico",$this->getP_codigocmpmedico());
            $sentencia->bindValue(":p_consejoregional_medico",$this->getP_consejoregional_medico());
            $sentencia->bindValue(":p_arrayupsmedico",$this->getP_arrayupsmedico());
            $sentencia->execute();
            return $sentencia->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $exc) {
            throw $exc;
        }
    }
	
	public function ipressmedicocombo(){
        try {
            $sql = "select cwa.id_afiliacion,nombre_persona || ' ' || paterno_persona || ' ' || materno_persona as medico
			from cuenta_web_afiliacion cwa
			inner join afiliacion_web_persona awp on awp.codigo_cuenta=cwa.codigo_cuenta 
			inner join persona p on p.documento_persona=awp.documento_persona
			where codigo_unico_ipress=:p_codigounicoipress";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindValue(":p_codigounicoipress",$this->getP_codigounicoipress());
            $sentencia->execute();
            $resultado = $sentencia->fetchAll();
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
	
	public function ipressupsmedicolistar(){
        try {
            $sql = "select miu.ups_medico_ipress,descripcion from medico_ipress_ups miu
			inner join ipress_ups iu on iu.ipress_ups_codigo=miu.ipress_ups_codigo
			inner join ups_especialidad ue on ue.codigo_upss_especialidad=iu.codigo_upss_especialidad
			where id_afiliacion = :id_afiliacion";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindValue(":id_afiliacion",$this->getId_afiliacion());
            $sentencia->execute();
            $resultado = $sentencia->fetchAll();
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
	
	public function ipressupshorariover(){
        try {
            $sql = "select tmh.trabajo_hora_medico,tmh.diatrabajo,ht.hora_entrada,ht.hora_salida,tmh.estado,
            (
            select trabajo_hora_medico from trabajo_medico_hora tm
            inner join medico_ipress_ups miu on miu.ups_medico_ipress=tm.ups_medico_ipress
			inner join horario_trabajo ht on ht.horatrabajo=tm.horatrabajo
            where diatrabajo=:diatrabajo and estado = '1' and ht.horatrabajo=tmh.horatrabajo and miu.id_afiliacion = :id_afiliacion
            ) as estado_hora
			from trabajo_medico_hora tmh
			inner join medico_ipress_ups mip on mip.ups_medico_ipress=tmh.ups_medico_ipress
			inner join horario_trabajo ht on ht.horatrabajo = tmh.horatrabajo
			where tmh.ups_medico_ipress = :ups_medico_ipress
			and diatrabajo=:diatrabajo order by trabajo_hora_medico";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindValue(":ups_medico_ipress",$this->getUps_medico_ipress());
            $sentencia->bindValue(":id_afiliacion",$this->getId_afiliacion());
            $sentencia->bindValue(":diatrabajo",$this->getDiatrabajo());
            $sentencia->execute();
            $resultado = $sentencia->fetchAll();
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
	
	public function ipresshorariomedioregistrar(){
        try {
            $sql = "select * from ipress_upshorario_registrar(:p_arrayupsmedico)";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindValue(":p_arrayupsmedico",$this->getP_arrayupsmedico());
            $sentencia->execute();
            return $sentencia->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $exc) {
            throw $exc;
        }
    }
}





















