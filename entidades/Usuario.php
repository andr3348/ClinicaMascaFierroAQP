<?php

class Usuario {
    private $idusuario;
    private $nombre;
    private $correo;
    private $password;
    private $dni;
    private $tipousuario;

    public function getIdusuario() {
        return $this->idusuario;
    }

    public function setIdusuario($idusuario) {
        $this->idusuario = $idusuario;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getDni() {
        return $this->dni;
    }

    public function setDni($dni) {
        $this->dni = $dni;
    }

    public function getTipousuario() {
        return $this->tipousuario;
    }

    public function setTipousuario($tipousuario) {
        $this->tipousuario = $tipousuario;
    }

}
?>