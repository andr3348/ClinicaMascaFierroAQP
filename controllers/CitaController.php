<?php
require_once '../logica/LCita.php';
require_once '../entidades/Cita.php';

class CitaController {
    public function cargarCitasDePaciente($idPaciente) {
        $lcita = new LCita();
        return $lcita->obtenerCitasPorPaciente($idPaciente);
    }
}

?>