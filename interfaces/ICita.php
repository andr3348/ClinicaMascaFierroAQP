<?php
require_once '../entidades/Cita.php';

interface ICita {
    public function guardarCita(Cita $cita);
    public function modificarCita(Cita $cita);
    public function eliminarCita(Cita $cita);
    public function obtenerCitas();
    public function obtenerCitaPorId($id);
    public function obtenerCitasPorPaciente($id);
}

?>