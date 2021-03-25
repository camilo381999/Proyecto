<?php

class RecuperacionPassword
{

    private $id;
    private $idUsuario;
    private $url;
    private $fecha;

    public function __construct($id, $idUsuario, $url, $fecha)
    {
        $this->id = $id;
        $this->idUsuario = $idUsuario;
        $this->url = $url;
        $this->fecha = $fecha;
    }
}
?>