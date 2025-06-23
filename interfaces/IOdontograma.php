<?php
require_once '../entidades/Odontograma.php';

interface IOdontograma  {
    public function guardarOdontograma($imagen, $id_paciente, $id_dentista, $id_cita);
    public function modificarOdontograma(Odontograma $odontograma);
    public function eliminarOdontograma(Odontograma $odontograma);
    public function obtenerOdontogramas();
    public function obtenerOdontogramaPorId($id);
    public function obtenerOdontogramaPorPaciente($idPaciente);
}

?>