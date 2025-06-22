<?php 

class Odontograma {
    private $id_odontograma;
    private $imagen;
    private $fecha;
    private $id_paciente;
    private $id_dentista;
    private $id_cita;

    public function getIdOdontograma() { return $this->id_odontograma; }
    public function setIdOdontograma($id) { $this->id_odontograma = $id; }

    public function getImagen() { return $this->imagen; }
    public function setImagen($imagen) { $this->imagen = $imagen; }

    public function getFecha() { return $this->fecha; }
    public function setFecha($fecha) { return $this->fecha = $fecha; }

    public function getIdPaciente() { return $this->id_paciente; }
    public function setIdPaciente($idPaciente) { $this->id_paciente = $idPaciente; }

    public function getIdDentista() { return $this->id_dentista; }
    public function setIdDentista($idDentista) { $this->id_dentista = $idDentista; }

    public function getIdCita() { return $this->id_cita; }
    public function setIdCita($idCita) { $this->id_cita = $idCita; }

}

?>