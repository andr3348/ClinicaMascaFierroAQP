<?php
require_once '../logica/LCita.php';
require_once '../entidades/Cita.php';

class CitaController {
    public function cargarCitasDePaciente($idPaciente) {
        $lcita = new LCita();
        return $lcita->obtenerCitasPorPaciente($idPaciente);
    }

    public function cargarCitasConfirmadasPaciente() {
        $idPaciente = $_SESSION['id_usuario'];
        $lcita = new LCita();
        return $lcita->obtenerCitasConfirmadasPaciente( $idPaciente);
    }

    // DENTISTA ---------------------
    public function cargarCitasConfirmadas() {
        $idDentista = $_SESSION['id_usuario'];
        $lcita = new LCita();
        return $lcita->obtenerCitasConfirmadas($idDentista);
    }

    // SECRETARIA -----------------------------
    public function cargarCitasPendientes() {
        $lcita = new LCita();
        return $lcita->obtenerCitasPendientes();
    }

    public function cargarCitaPorId() {
        $lcita = new LCita();
        return $lcita->obtenerCitaPorId($_GET['id_cita']);
    }

    public function crearCita() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $estado = 'pendiente'; // ESTADO POR DEFECTO
            $descripcion = $_POST['descripcion'];
            $id_paciente = $_POST['id_paciente'];
            $id_dentista = $_POST['id_dentista'];

            if (empty($id_paciente) || empty($id_dentista) || empty($descripcion)) {
                $_SESSION['error'] = "Añada una descripción y seleccione un dentista.";
                header("Location: ?paciente=nuevaCita");
                exit();
            }

            $lcita = new LCita();
            $lcita->guardarCita($estado, $descripcion, $id_paciente, $id_dentista);

            header('Location: ?view=dashboard');
            exit();
        }
    }

    public function confirmarCita() {
        $estado = 'confirmada';
        $id_cita = $_GET['id'];

        $lcita = new LCita();
        $lcita->confirmarEstadoCita($estado,$id_cita);

        header('Location: ?view=secretaria');
        exit();
    }

    public function eliminarCita() {
        $id_cita = $_GET['id'];
        
        $cita = new Cita();
        $cita->setIdCita($id_cita);

        $lcita = new LCita();
        $lcita->eliminarCita($cita); // <-- pide una variable de tipo Cita

        header('Location: ?view=secretaria');
        exit();
    }
}
?>