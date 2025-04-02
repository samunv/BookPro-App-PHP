<?php

class Empresa {
    private $idEmpresa;
    private $nombre_empresa;
    private $direccion;
    private $cif;
    private $telefono;
    private $correo;
    private $banner;
    private $logo1por1;
    private $color1;
    private $color2;

    public function __construct($nombre_empresa, $direccion, $cif, $telefono, $correo) {

        $this->nombre_empresa = $nombre_empresa;
        $this->direccion = $direccion;
        $this->cif = $cif;
        $this->telefono = $telefono;
        $this->correo = $correo;
    }

    // Getters
    public function getIdEmpresa() {
        return $this->idEmpresa;
    }

    public function getNombreEmpresa() {
        return $this->nombre_empresa;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getCif() {
        return $this->cif;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function getBanner() {
        return $this->banner;
    }

    public function getLogo1por1() {
        return $this->logo1por1;
    }

    public function getColor1() {
        return $this->color1;
    }

    public function getColor2() {
        return $this->color2;
    }

    // Setters
    public function setIdEmpresa($idEmpresa) {
        $this->idEmpresa = $idEmpresa;
    }

    public function setNombreEmpresa($nombre_empresa) {
        $this->nombre_empresa = $nombre_empresa;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function setCif($cif) {
        $this->cif = $cif;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }

    public function setBanner($banner) {
        $this->banner = $banner;
    }

    public function setLogo1por1($logo1por1) {
        $this->logo1por1 = $logo1por1;
    }

    public function setColor1($color1) {
        $this->color1 = $color1;
    }

    public function setColor2($color2) {
        $this->color2 = $color2;
    }
}
