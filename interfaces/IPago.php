<?php 
require_once '../entidades/Pago.php';

interface IPago {
    public function guardarPago($monto,$idPaciente,$idCita);
    public function modificarPago(Pago $pago);
    public function eliminarPago(Pago $pago);
    public function obtenerPagos();
    public function obtenerPagoPorId($id);
    public function obtenerPagosPorPaciente($idPaciente);
}


?>