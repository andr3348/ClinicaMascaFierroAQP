<?php 
require_once '../interfaces/IFichaAtencion.php';
require_once '../entidades/FichaAtencion.php';
require_once '../datos/database.php';

class LFichaAtencion implements IFichaAtencion {
    private $pdo;

    public function __construct() {
        $db = new DB();
        $this->pdo = $db->conectar();
    }

    public function obtenerFichas() {
        try {
            $sql = "SELECT id_ficha, fecha, descripcion, id_paciente, id_dentista
                    FROM ficha_atencion";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            $fichas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $fichas;
        } catch (PDOException $e) {
            throw new Exception("Error al conseguir las fichas de atencion: ".$e->getMessage());
        }
    }

    public function obtenerFichaPorId($id) {
        try {
            $sql = "SELECT id_ficha, fecha, descripcion, id_paciente, id_dentista
                    FROM ficha_atencion WHERE id_ficha = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":id",$id, PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $ficha = new FichaAtencion();
                $ficha->setIdFicha($row['id_ficha']);
                $ficha->setFecha($row['fecha']);
                $ficha->setDescripcion($row['descripcion']);
                $ficha->setIdPaciente($row['id_paciente']);
                $ficha->setIdDentista($row['id_dentista']);
                return $ficha;
            }
            return null;
        } catch (PDOException $e) {
            throw new Exception("Error al conseguir la ficha de atención: ".$e->getMessage());
        }
    }

    public function obtenerFichasPorPaciente($idPaciente) {
        try {
            $sql = "SELECT f.id_ficha, f.fecha, f.descripcion, f.id_paciente, d.nombre AS nombre_dentista 
            FROM ficha_atencion f
            JOIN usuario d ON f.id_dentista = d.id_usuario
            WHERE f.id_paciente = :id
            ORDER BY f.fecha DESC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => $idPaciente]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al obtener registro de fichas de atencion del paciente: ".$e->getMessage());
        }
    }

    public function eliminarFicha(FichaAtencion $ficha) {
        try {
            $sql = "DELETE FROM ficha_atencion WHERE id_ficha = :id";
            $stmt = $this->pdo->prepare($sql);
            $id_ficha = $ficha->getIdFicha();
            $stmt->bindParam(":id",$id_ficha,PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error al intentar eliminar la ficha de atencion: ".$e->getMessage());
        }
    }

    public function guardarFicha(FichaAtencion $ficha) {
        try {
            $sql = "INSERT INTO ficha_atencion (descripcion, id_paciente, id_dentista)
                    VALUES (:descripcion, :id_paciente, :id_dentista)";
            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([
                ":descripcion" => $ficha->getDescripcion(),
                ":id_paciente" => $ficha->getIdPaciente(),
                ":id_dentista" => $ficha->getIdDentista()
            ]);
        } catch (PDOException $e) {
            throw new Exception("Error al guardar una ficha de atención: ".$e->getMessage());
        }
    }

    public function modificarFicha(FichaAtencion $ficha) {
        try {
            $sql = "UPDATE ficha_atencion SET descripcion=:descripcion WHERE id_ficha=:id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":descripcion" => $ficha->getDescripcion(),
                ":id" => $ficha->getIdFicha()
            ]);
            $rows = $stmt->rowCount();
            echo $rows===0 ? "No se modificó la ficha de atención" :
                "Filas afectadas: $rows\n";
        } catch (PDOException $e) {
            throw new Exception("Error al modificar la ficha de atención: ".$e->getMessage());
        }
    }
}

?>