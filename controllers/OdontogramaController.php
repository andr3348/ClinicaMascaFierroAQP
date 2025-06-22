<?php 
require_once '../logica/LOdontograma.php';

class OdontogramaController {
    public function cargarOdontogramasDePaciente($idPaciente) {
        $lodontograma = new LOdontograma();
        return $lodontograma->obtenerOdontogramaPorPaciente($idPaciente);
    }
}

?>