<?php
require_once '../entidades/FichaAtencion.php';

interface IFichaAtencion {
    public function guardarFicha(FichaAtencion $ficha);
    public function modificarFicha(FichaAtencion $ficha);
    public function eliminarFicha(FichaAtencion $ficha);
    public function obtenerFichas();
    public function obtenerFichaPorId($id);
}

?>