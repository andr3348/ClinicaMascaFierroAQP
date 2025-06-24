<?php 
require_once '../logica/LOdontograma.php';

class OdontogramaController {
    public function cargarOdontogramasDePaciente($idPaciente) {
        $lodontograma = new LOdontograma();
        return $lodontograma->obtenerOdontogramaPorPaciente($idPaciente);
    }

    public function subirOdontograma() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['odontograma'])) {
            $imagen = $_FILES['odontograma'];
            $id_paciente = $_POST['id_paciente'];
            $id_dentista = $_POST['id_dentista'];
            $id_cita = $_POST['id_cita'];

            if ($imagen['error'] === UPLOAD_ERR_OK) {
                $ext = pathinfo($imagen['name'], PATHINFO_EXTENSION);
                $filename = uniqid('odonto_') . '.' . $ext;
                $ruta = "uploads/odontogramas/" . $filename;

                if (move_uploaded_file($imagen['tmp_name'], $ruta)) {

                    $lodontograma = new LOdontograma();
                    $lodontograma->guardarOdontograma($filename, $id_paciente, $id_dentista, $id_cita);

                    header('Location: ?view=dentista');
                    exit();
                }
            } else {
                echo "Error al subir la imagen.";
            }
        }
    }
}

?>