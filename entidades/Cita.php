<?php 

class Cita {
    private $id_cita;
    private $fecha;
    private $estado;
    private $descripcion;
    private $id_paciente;
    private $id_dentista;

    public function getIdCita() { return $this->id_cita; }
    public function setIdCita($id) { $this->id_cita = $id; }

    public function getFecha() { return $this->fecha; }
    public function setFecha($fecha) { $this->fecha = $fecha; }

    public function getEstado() { return $this->estado; }
    public function setEstado($estado) { $this->estado = $estado; }

    public function getDescripcion() { return $this->descripcion; }
    public function setDescripcion($descripcion) { $this->descripcion = $descripcion; }

    public function getIdPaciente() { return $this->id_paciente; }
    public function setIdPaciente($idPaciente) { $this->id_paciente = $idPaciente; }

    public function getIdDentista() { return $this->id_dentista; }
    public function setIdDentista($idDentista) { $this->id_dentista = $idDentista; }
}

?>