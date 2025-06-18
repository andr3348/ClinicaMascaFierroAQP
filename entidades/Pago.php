<?php 

class Pago {
    private $id_pago;
    private $monto;
    private $fecha;
    private $id_paciente;
    private $id_cita;
    
    public function getIdPago() { return $this->id_pago; }
    public function setIdPago($id) { $this->id_pago = $id; }

    public function getMonto() { return $this->monto; }
    public function setMonto($monto) { $this->monto = $monto; }

    public function getFecha() { return $this->fecha; }
    public function setFecha($fecha) { $this->fecha= $fecha; }

    public function getIdPaciente() { return $this->id_paciente; }
    public function setIdPaciente($idPaciente) { $this->id_paciente = $idPaciente; }

    public function getIdCita() { return $this->id_cita; }
    public function setIdCita($idCita) { $this->id_cita = $idCita; }
}

?>