<?php 
require_once '../entidades/Pago.php';

interface IPago {
    public function guardarPago(Pago $pago);
    public function modificarPago(Pago $pago);
    public function eliminarPago(Pago $pago);
    public function obtenerPagos();
    public function obtenerPagoPorId($id);
}


?>