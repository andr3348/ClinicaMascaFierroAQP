<?php 
require_once '../logica/LPago.php';
require_once '../entidades/Pago.php';

class PagoController {
    public function cargarPagosDePaciente($idPaciente) {
        $lpago = new LPago();
        return $lpago->obtenerPagosPorPaciente($idPaciente);
    }
}

?>