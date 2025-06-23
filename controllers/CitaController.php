<?php
require_once '../logica/LCita.php';
require_once '../entidades/Cita.php';

class CitaController {
    public function cargarCitasDePaciente($idPaciente) {
        $lcita = new LCita();
        return $lcita->obtenerCitasPorPaciente($idPaciente);
    }

    // DENTISTA ---------------------
    public function cargarCitasConfirmadas() {
        $lcita = new LCita();
        return $lcita->obtenerCitasConfirmadas();
    }

    public function cargarCitaPorId() {
        $lcita = new LCita();
        return $lcita->obtenerCitaPorId($_GET['id_cita']);
    }
}

?>