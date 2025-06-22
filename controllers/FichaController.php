<?php 
require_once '../logica/LFichaAtencion.php';

class FichaController {
    public function cargarFichasDePaciente($idPaciente) {
        $lficha = new LFichaAtencion();
        return $lficha->obtenerFichasPorPaciente($idPaciente);
    }
}

?>