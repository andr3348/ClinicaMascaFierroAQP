<?php
require_once '../entidades/Odontograma.php';

interface IOdontograma  {
    public function guardarOdontograma(Odontograma $odontograma);
    public function modificarOdontograma(Odontograma $odontograma);
    public function eliminarOdontograma(Odontograma $odontograma);
    public function obtenerOdontogramas();
    public function obtenerOdontogramaPorId($id);
    public function obtenerOdontogramaPorPaciente($idPaciente);
}

?>