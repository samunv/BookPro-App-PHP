<?php
class Trabajo
{
    private $idTrabajo;
    private $titulo;
    private $descripcion;
    private $imagen;
    private $idProfesional;
    private $idServicio;


    public function __construct($titulo, $descripcion, $imagen, $idProfesional, $idServicio)
    {
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->imagen = $imagen;
        $this->idProfesional = $idProfesional;
        $this->idServicio = $idServicio;
    }


    public function getIdTrabajo()
    {
        return $this->idTrabajo;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function getIdProfesional()
    {
        return $this->idProfesional;
    }

    public function getIdServicio()
    {
        return $this->idServicio;
    }


    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    public function setIdProfesional($idProfesional)
    {
        $this->idProfesional = $idProfesional;
    }

    public function setIdServicio($idServicio)
    {
        $this->idServicio = $idServicio;
    }
}
