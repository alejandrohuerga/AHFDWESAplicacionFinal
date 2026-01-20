<?php

class Pokemon
{
    private $nombre;
    private $modelo3D;
    private $forma;

    public function __construct($nombre, $modelo3D, $forma)
    {
        $this->nombre = $nombre;
        $this->modelo3D = $modelo3D;
        $this->forma = $forma;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getModelo3D()
    {
        return $this->modelo3D;
    }

    public function getForma()
    {
        return $this->forma;
    }

}