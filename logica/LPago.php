<?php 
require_once '../interfaces/IPago.php';
require_once '../entidades/Pago.php';
require_once '../datos/database.php';

class LPago implements IPago {
    private $pdo;

    public function __construct() {
        $db = new DB();
        $this->pdo = $db->conectar();
    }

    public function obtenerPagos() {
        try {
            $sql = "SELECT id_pago, monto, fecha, id_paciente, id_cita
                    FROM pago";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            $pagos[] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $pagos;
        } catch (PDOException $e) {
            throw new Exception("Error al conseguir los pagos: ".$e->getMessage());
        }
    }

    public function obtenerPagoPorId($id) {
        try {
            $sql = "SELECT id_pago, monto, fecha, id_paciente, id_cita
                    FROM pago WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":id",$id, PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $pago = new Pago();
                $pago->setIdPago($row['id_pago']);
                $pago->setMonto($row['monto']);
                $pago->setFecha($row['fecha']);
                $pago->setIdPaciente($row['id_paciente']);
                $pago->setIdCita($row['id_cita']);
                return $pago;
            }
            return null;
        } catch (PDOException $e) {
            throw new Exception("Error al conseguir el pago: ".$e->getMessage());
        }
    }

    public function eliminarPago(Pago $pago) {
        try {
            $sql = "DELETE FROM pago WHERE id_pago = :id";
            $stmt = $this->pdo->prepare($sql);
            $id_pago = $pago->getIdPago();
            $stmt->bindParam(":id",$id_pago,PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error al intentar eliminar el pago: ".$e->getMessage());
        }
    }

    public function guardarPago(Pago $pago) {
        try {
            $sql = "INSERT INTO pago (monto,id_paciente,id_cita)
                    VALUES (:monto, :id_paciente, :id_cita)";
            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([
                ":monto" => $pago->getMonto(),
                ":id_paciente" => $pago->getIdPaciente(),
                ":id_cita" => $pago->getIdCita()
            ]);
        } catch (PDOException $e) {
            throw new Exception("Error al guardar un nuevo pago: ".$e->getMessage());
        }
    }

    public function modificarPago(Pago $pago) {
        try {
            $sql = "UPDATE pago SET monto=:monto WHERE id_pago=:id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":monto" => $pago->getMonto(),
                ":id" => $pago->getIdPago()
            ]);
            $rows = $stmt->rowCount();
            echo $rows===0 ? "No se modificó el pago" :
                "Filas afectadas: $rows\n";
        } catch (PDOException $e) {
            throw new Exception("Error al modificar el pago: ".$e->getMessage());
        }
    }
}

?>