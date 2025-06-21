<?php 
require_once '../interfaces/IOdontograma.php';
require_once '../entidades/Odontograma.php';
require_once '../datos/database.php';

class LOdontograma implements IOdontograma {
    private $pdo;

    public function __construct() {
        $db = new DB();
        $this->pdo = $db->conectar();
    }

    public function obtenerOdontogramas() {
        try {
            $sql = "SELECT id_odontograma, imagen, id_paciente, id_dentista
                    FROM odontograma";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            $odontogramas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $odontogramas;
        } catch (PDOException $e) {
            throw new Exception("Error al conseguir los odontogramas: ".$e->getMessage());
        }
    }

    public function obtenerOdontogramaPorId($id) {
        try {
            $sql = "SELECT id_odontograma, imagen, id_paciente, id_dentista
                    FROM odontograma WHERE id_odontograma = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":id",$id, PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $odontograma = new Odontograma();
                $odontograma->setIdOdontograma($row['id_odontograma']);
                $odontograma->setImagen($row['imagen']);
                $odontograma->setIdPaciente($row['id_paciente']);
                $odontograma->setIdDentista($row['id_dentista']);
                return $odontograma;
            }
            return null;
        } catch (PDOException $e) {
            throw new Exception("Error al conseguir el odontograma: ".$e->getMessage());
        }
    }

    public function eliminarOdontograma(Odontograma $odontograma) {
        try {
            $sql = "DELETE FROM odontograma WHERE id_odontograma = :id";
            $stmt = $this->pdo->prepare($sql);
            $id_odontograma = $odontograma->getIdOdontograma();
            $stmt->bindParam(":id",$id_odontograma,PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error al intentar eliminar el odontograma: ".$e->getMessage());
        }
    }

    public function guardarOdontograma(Odontograma $odontograma) {
        try {
            $sql = "INSERT INTO odontograma (imagen,id_paciente,id_dentista)
                    VALUES (:imagen, :id_paciente, :id_dentista)";
            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([
                ":imagen" => $odontograma->getImagen(),
                ":id_paciente" => $odontograma->getIdPaciente(),
                ":id_dentista" => $odontograma->getIdDentista()
            ]);
        } catch (PDOException $e) {
            throw new Exception("Error al guardar un nuevo odontograma: ".$e->getMessage());
        }
    }

    public function modificarOdontograma(Odontograma $odontograma) {
        try {
            $sql = "UPDATE odontograma SET imagen=:imagen WHERE id_odontograma=:id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":imagen" => $odontograma->getImagen(),
                ":id" => $odontograma->getIdOdontograma()
            ]);
            $rows = $stmt->rowCount();
            echo $rows===0 ? "No se modificó el odontograma" :
                "Filas afectadas: $rows\n";
        } catch (PDOException $e) {
            throw new Exception("Error al modificar el odontograma: ".$e->getMessage());
        }
    }
}

?>