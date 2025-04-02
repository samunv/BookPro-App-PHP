<?php

class Profesional
{
    // Propiedades privadas
    private $idProfesional;
    private $idUsuario;

    // Constructor
    public function __construct($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    // Getter para idProfesional
    public function getIdProfesional()
    {
        return $this->idProfesional;
    }

    // Setter para idProfesional
    public function setIdProfesional($idProfesional)
    {
        $this->idProfesional = $idProfesional;
    }

    // Getter para nombre
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    // Setter para nombre
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }
}
