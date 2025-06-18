<?php 

class FichaAtencion {
    private $id_ficha;
    private $fecha;
    private $descripcion;
    private $id_paciente;
    private $id_dentista;

    public function getIdFicha() { return $this->id_ficha; }
    public function setIdFicha($id) { $this->id_ficha = $id; }

    public function getFecha() { return $this->fecha; }
    public function setFecha($fecha) { $this->fecha = $fecha; }

    public function getDescripcion() { return $this->descripcion; }
    public function setDescripcion($descripcion) { $this->descripcion = $descripcion; }

    public function getIdPaciente() { return $this->id_paciente; }

    public function setIdPaciente($idPaciente) { $this->id_paciente = $idPaciente; }

    public function getIdDentista() { return $this->id_dentista; }

    public function setIdDentista($idDentista) { $this->id_dentista = $idDentista; }


}

?>