<?php 
require_once '../interfaces/ICita.php';
require_once '../entidades/Cita.php';
require_once '../datos/database.php';

class LCita implements ICita {
    private $pdo;

    public function __construct() {
        $db = new DB();
        $this->pdo = $db->conectar();
    }

    public function obtenerCitas() {
        try {
            $sql = "SELECT id_cita, fecha, estado, descripcion, id_paciente, id_dentista
                    FROM cita";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            $citas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $citas;
        } catch (PDOException $e) {
            throw new Exception("Error al conseguir las citas: ".$e->getMessage());
        }
    }

    public function obtenerCitasConfirmadas() {
        try {
            $sql = "SELECT c.id_cita, c.fecha, c.descripcion, 
            p.nombre AS nombre_paciente,
            o.id_odontograma, c.id_paciente, c.id_dentista,
            o.imagen
                    FROM cita c
                    JOIN usuario p ON c.id_paciente = p.id_usuario
                    LEFT JOIN odontograma o ON c.id_cita=o.id_cita
                    WHERE c.estado = 'confirmada'
                    ";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            $citas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $citas;
        } catch (PDOException $e) {
            throw new Exception("Error al conseguir las citas confirmadas: ".$e->getMessage());
        }
    }

    public function obtenerCitaPorId($id) {
        try {
            $sql = "SELECT id_cita, fecha, estado, descripcion, id_paciente, id_dentista
                    FROM cita WHERE id_cita = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":id",$id, PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $cita = new Cita();
                $cita->setIdCita($row['id_cita']);
                $cita->setFecha($row['fecha']);
                $cita->setEstado($row['estado']);
                $cita->setDescripcion($row['descripcion']);
                $cita->setIdPaciente($row['id_paciente']);
                $cita->setIdDentista($row['id_dentista']);
                return $cita;
            }
            return null;
        } catch (PDOException $e) {
            throw new Exception("Error al conseguir la cita: ".$e->getMessage());
        }
    }

    public function obtenerCitasPorPaciente($idPaciente) {
        try {
            $sql = "SELECT c.id_cita, c.fecha, c.estado, c.descripcion, 
            p.nombre AS nombre_paciente, 
            d.nombre AS nombre_dentista FROM cita c
            JOIN usuario p ON c.id_paciente = p.id_usuario
            JOIN usuario d ON c.id_dentista = d.id_usuario
            WHERE c.id_paciente = :id
            ORDER BY c.fecha DESC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => $idPaciente]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al obtener citas del paciente: ".$e->getMessage());
        }
    }

    public function eliminarCita(Cita $cita) {
        try {
            $sql = "DELETE FROM cita WHERE id_cita = :id";
            $stmt = $this->pdo->prepare($sql);
            $id_cita = $cita->getIdCita();
            $stmt->bindParam(":id",$id_cita,PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error al intentar eliminar la cita: ".$e->getMessage());
        }
    }

    public function guardarCita(Cita $cita) {
        try {
            $sql = "INSERT INTO cita (estado, descripcion, id_paciente, id_dentista)
                    VALUES (:estado, :descripcion, :id_paciente, :id_dentista)";
            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([
                ":estado" => $cita->getEstado(),
                ":descripcion" => $cita->getDescripcion(),
                ":id_paciente" => $cita->getIdPaciente(),
                ":id_dentista" => $cita->getIdDentista()
            ]);
        } catch (PDOException $e) {
            throw new Exception("Error al guardar una nueva cita: ".$e->getMessage());
        }
    }

    public function modificarCita(Cita $cita) {
        try {
            $sql = "UPDATE cita SET estado=:estado, descripcion=:descripcion WHERE id_cita=:id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":estado" => $cita->getEstado(),
                ":descripcion" => $cita->getDescripcion(),
                ":id" => $cita->getIdCita()
            ]);
            $rows = $stmt->rowCount();
            echo $rows===0 ? "No se modificó cita" :
                "Filas afectadas: $rows\n";
        } catch (PDOException $e) {
            throw new Exception("Error al modificar la cita: ".$e->getMessage());
        }
    }
}

?>