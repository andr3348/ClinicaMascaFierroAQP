<?php 
require_once "../entidades/Usuario.php";
require_once "../interfaces/IUsuario.php";
require_once "../datos/database.php";

class LUsuario implements IUsuario {
    private $pdo;
    
    public function __construct() {
        $db = new DB();
        $this->pdo = $db->conectar();
    }

    public function obtenerUsuarios() {
        try {
            $sql = "SELECT id_usuario, nombre, correo, passw, dni, tipo_usuario
                    FROM usuario";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            
            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $usuarios;
        } catch (PDOException $e) {
            die("Error al obtener usuarios: ".$e->getMessage());
        }
    }

    public function obtenerUsuarioPorId($id) {
        try {
            $sql = "SELECT id_usuario, nombre, correo, passw, dni, tipo_usuario
                    FROM usuario WHERE id_usuario = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $usuario = new Usuario();
                $usuario->setIdusuario($row['id_usuario']);
                $usuario->setNombre($row['nombre']);
                $usuario->setCorreo($row['correo']);
                $usuario->setPassword($row['passw']);
                $usuario->setDni($row['dni']);
                $usuario->setTipousuario($row['tipo_usuario']);
                return $usuario; // retorna un objecto de tipo Usuario
            }
            return null;
        } catch (Exception $e) {
            die("Error al obtener usuario: ".$e->getMessage());
        }
    }

    public function obtenerDentistas() {
        try {
            $sql = "SELECT id_usuario, nombre, correo, passw, dni, tipo_usuario
                    FROM usuario WHERE tipo_usuario = 'dentista'";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            
            $dentistas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $dentistas;
        } catch (PDOException $e) {
            die("Error al obtener los dentistas: ".$e->getMessage());
        }
    }

    public function eliminarUsuario($id) {
        try {
            $sql = "DELETE FROM usuario WHERE id_usuario = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Error al eliminar el usuario: ".$e->getMessage());
        }
        
    }

    public function guardarUsuario(Usuario $usuario) {
        try {
            $sql = "INSERT INTO usuario (nombre, correo, passw, dni, tipo_usuario)
                VALUES (:nom, :correo, :passw, :dni, :tipo)";

            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([
                ':nom' => $usuario->getNombre(),
                ':correo' => $usuario->getCorreo(),
                ':passw' => $usuario->getPassword(),
                ':dni' => $usuario->getDni(),
                ':tipo' => $usuario->getTipousuario()
            ]); 
        } catch (PDOException $e) {
            die("Error al crear el nuevo usuario: ".$e->getMessage());
        }
        
    }

    public function modificarUsuario(Usuario $usuario) {
        try {
            $sql = "UPDATE usuario SET nombre=:nom, correo=:correo,
            passw=:passw, dni=:dni, tipo_usuario=:tipo WHERE id_usuario=:id";
            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([
                ':nom' => $usuario->getNombre(),
                ':correo' => $usuario->getCorreo(),
                ':passw' => $usuario->getPassword(),
                ':dni' => $usuario->getDni(),
                ':tipo' => $usuario->getTipousuario(),
                ':id' => $usuario->getIdusuario()
            ]);
            $rows = $stmt->rowCount();
            echo $rows === 0 ? "No se modificó el usuario\n" : 
                "Filas afectadas: $rows\n" ;

        } catch (PDOException $e) {
            die("Error al modificar el usuario: ".$e->getMessage());
        }
        
    }

    public function verificarCredenciales($correo, $password) {
        try {
            $sql = "SELECT id_usuario, nombre, correo, passw, dni, tipo_usuario
                    FROM usuario WHERE correo = :correo AND passw = :passw";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':correo' => $correo,
                ':passw' => $password
            ]);

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $usuario = new Usuario();
                $usuario->setIdusuario($row['id_usuario']);
                $usuario->setNombre($row['nombre']);
                $usuario->setCorreo($row['correo']);
                $usuario->setPassword($row['passw']);
                $usuario->setDni($row['dni']);
                $usuario->setTipousuario($row['tipo_usuario']);
                return $usuario;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            die("Error en el login: ".$e->getMessage());
        }
    }

    public function correoExiste($correo) {
        $sql = "SELECT COUNT(*) FROM usuario WHERE correo = :correo";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":correo" => $correo]);
        $count = $stmt->fetchColumn();

        return $count > 0;
    }
    
}
?>