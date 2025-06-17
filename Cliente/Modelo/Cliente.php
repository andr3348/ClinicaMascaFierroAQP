<?php

class Cliente {
    public $id;
    public $nombre;
    public $correo;
    public $clave;

    public function __construct($id, $nombre, $correo, $clave) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->clave = $clave;
    }
}
