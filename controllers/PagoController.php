<?php 
require_once '../logica/LPago.php';
require_once '../entidades/Pago.php';

class PagoController {
    public function cargarPagosDePaciente($idPaciente) {
        $lpago = new LPago();
        return $lpago->obtenerPagosPorPaciente($idPaciente);
    }

    public function crearPago() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $monto = $_POST['monto'];
            $id_paciente = $_POST['id_paciente'];
            $id_cita = $_POST['id_cita'];

            $lpago = new LPago();
            $lpago->guardarPago($monto,$id_paciente,$id_cita);

            header('Location: ?view=dashboard');
            exit();
        }
        
    }
}

?>