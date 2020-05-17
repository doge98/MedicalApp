<?php
require_once '../../datos/Conexion.clase.php';

class Solicitud extends Conexion{
    private $p_codigoipress;
    private $p_estado;
    private $p_observacion;
    
    private $p_nombrecomercial;
    private $ruc;
    private $p_razonsocial;
    private $p_direccion;
    private $p_departamento;
    private $p_provincia;
    private $p_distrito;
    private $p_representantelegal;
    private $p_tipodocidentidad;
    private $p_dni;
    private $p_telefono;
    private $p_telefonoemergencia;
    private $p_latitud;
    private $p_longitud;
    private $p_correoipress;
    private $p_valor;
    private $p_num_solicitud;
    
    function getP_codigoipress() {
        return $this->p_codigoipress;
    }

    function getP_estado() {
        return $this->p_estado;
    }

    function getP_observacion() {
        return $this->p_observacion;
    }
    
    function setP_codigoipress($p_codigoipress) {
        $this->p_codigoipress = $p_codigoipress;
    }

    function setP_estado($p_estado) {
        $this->p_estado = $p_estado;
    }

    function setP_observacion($p_observacion) {
        $this->p_observacion = $p_observacion;
    }
    
    
    function getP_nombrecomercial() {
        return $this->p_nombrecomercial;
    }

    function getRuc() {
        return $this->ruc;
    }

    function getP_razonsocial() {
        return $this->p_razonsocial;
    }

    function getP_direccion() {
        return $this->p_direccion;
    }

    function getP_departamento() {
        return $this->p_departamento;
    }

    function getP_provincia() {
        return $this->p_provincia;
    }

    function getP_distrito() {
        return $this->p_distrito;
    }

    function getP_representantelegal() {
        return $this->p_representantelegal;
    }

    function getP_tipodocidentidad() {
        return $this->p_tipodocidentidad;
    }

    function getP_dni() {
        return $this->p_dni;
    }

    function getP_telefono() {
        return $this->p_telefono;
    }

    function getP_telefonoemergencia() {
        return $this->p_telefonoemergencia;
    }

    function getP_latitud() {
        return $this->p_latitud;
    }

    function getP_longitud() {
        return $this->p_longitud;
    }

    function getP_correoipress() {
        return $this->p_correoipress;
    }

    function getP_valor() {
        return $this->p_valor;
    }
        
    function getP_num_solicitud() {
        return $this->p_num_solicitud;
    }

    function setP_nombrecomercial($p_nombrecomercial) {
        $this->p_nombrecomercial = $p_nombrecomercial;
    }

    function setRuc($ruc) {
        $this->ruc = $ruc;
    }

    function setP_razonsocial($p_razonsocial) {
        $this->p_razonsocial = $p_razonsocial;
    }

    function setP_direccion($p_direccion) {
        $this->p_direccion = $p_direccion;
    }

    function setP_departamento($p_departamento) {
        $this->p_departamento = $p_departamento;
    }

    function setP_provincia($p_provincia) {
        $this->p_provincia = $p_provincia;
    }

    function setP_distrito($p_distrito) {
        $this->p_distrito = $p_distrito;
    }

    function setP_representantelegal($p_representantelegal) {
        $this->p_representantelegal = $p_representantelegal;
    }

    function setP_tipodocidentidad($p_tipodocidentidad) {
        $this->p_tipodocidentidad = $p_tipodocidentidad;
    }

    function setP_dni($p_dni) {
        $this->p_dni = $p_dni;
    }

    function setP_telefono($p_telefono) {
        $this->p_telefono = $p_telefono;
    }

    function setP_telefonoemergencia($p_telefonoemergencia) {
        $this->p_telefonoemergencia = $p_telefonoemergencia;
    }

    function setP_latitud($p_latitud) {
        $this->p_latitud = $p_latitud;
    }

    function setP_longitud($p_longitud) {
        $this->p_longitud = $p_longitud;
    }

    function setP_correoipress($p_correoipress) {
        $this->p_correoipress = $p_correoipress;
    }

    function setP_valor($p_valor) {
        $this->p_valor = $p_valor;
    }
    
    function setP_num_solicitud($p_num_solicitud) {
        $this->p_num_solicitud = $p_num_solicitud;
    }
        
    public function listarsolicitud(){
        try {
            $sql = "select codigo_unico_ipress,dni_solicitante,correo_solicitante,archivo,estado,fecha,to_char(hora :: time, 'HH12:MI AM') AS hora from IPRESS_SOLICITUD where estado = 1 or estado = 0 order by estado asc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll();
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    public function solicitudtransaccion(){
        try {
            $sql = "select * from solicitud_transaccion(:p_codigoipress,:p_estado,:p_observacion,:p_nombrecomercial,:ruc,:p_razonsocial,:p_direccion,:p_departamento,:p_provincia,:p_distrito,:p_representantelegal,:p_tipodocidentidad,:p_dni,:p_telefono,:p_telefonoemergencia,:p_latitud,:p_longitud,:p_correoipress,:p_valor,:p_num_solicitud)";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindValue(":p_codigoipress",$this->getP_codigoipress());
            $sentencia->bindValue(":p_estado",$this->getP_estado());
            $sentencia->bindValue(":p_observacion",$this->getP_observacion());
            $sentencia->bindValue(":p_nombrecomercial",$this->getP_nombrecomercial());
            $sentencia->bindValue(":ruc",$this->getRuc());
            $sentencia->bindValue(":p_razonsocial",$this->getP_razonsocial());
            $sentencia->bindValue(":p_direccion",$this->getP_direccion());
            $sentencia->bindValue(":p_departamento",$this->getP_departamento());
            $sentencia->bindValue(":p_provincia",$this->getP_provincia());
            $sentencia->bindValue(":p_distrito",$this->getP_distrito());
            $sentencia->bindValue(":p_representantelegal",$this->getP_representantelegal());
            $sentencia->bindValue(":p_tipodocidentidad",$this->getP_tipodocidentidad());
            $sentencia->bindValue(":p_dni",$this->getP_dni());
            $sentencia->bindValue(":p_telefono",$this->getP_telefono());
            $sentencia->bindValue(":p_telefonoemergencia",$this->getP_telefonoemergencia());
            $sentencia->bindValue(":p_latitud",$this->getP_latitud());
            $sentencia->bindValue(":p_longitud",$this->getP_longitud());
            $sentencia->bindValue(":p_correoipress",$this->getP_correoipress());
            $sentencia->bindValue(":p_valor",$this->getP_valor());
            $sentencia->bindValue(":p_num_solicitud",$this->getP_num_solicitud());
            $sentencia->execute();
            return $sentencia->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    public function listarsolicitudregistrado(){
        try {
            $sql = "select solicitud_vista,codigo_unico_ipress,fecha,to_char(hora :: time, 'HH12:MI AM') AS hora,estado,observacion from SOLICITUD_VISTA order by estado asc,fecha desc,hora desc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll();
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
}