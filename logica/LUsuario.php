<?php 
require_once "../entidades/Usuario.php";
require_once "../interfaces/IUsuario.php";
require_once "../datos/database.php"; // Make sure this path is correct and the Usuario class exists

class LUsuario implements IUsuario {
    private $cn;
    
    public function __construct() {
        $db = new DB();
        $this->cn = $db->conectar();
    }

    public function obtenerUsuarios() {
        try {
            $sql = "SELECT id_usuario, nombre, correo, passw, dni, tipo_usuario
                    FROM usuario";
            $stmt = $this->cn->prepare($sql);
            $stmt->execute();
            $usuarios = [];
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $usuarios[] = $row;
            }

            return $usuarios;
        } catch (Exception $e) {
            die("Error al obtener usuarios: ".$e->getMessage());
        }
    }

    public function obtenerUsuarioPorId($id) {
    try {
        $query = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = $this->cn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc(); // OBJECTO []
    } catch (Exception $e) {
        die("Error al obtener usuario: ".$e->getMessage());
    }
}

    public function eliminarUsuario(Usuario $usuario) {
        try {
            $sql = "DELETE FROM usuario WHERE id_usuario = ?";
            $stmt = $this->cn->prepare($sql);
            $id_usuario = $usuario->getIdusuario();
            $stmt->bind_param("i", $id_usuario);
            $stmt->execute();
        } catch (Exception $e) {
            die("Error al eliminar el usuario: ".$e->getMessage());
        }
        
    }

    public function guardarUsuario(Usuario $usuario) {
        try {
            $sql = "INSERT INTO usuario (nombre, correo, passw, dni, tipo_usuario)
                VALUES (?, ?, ?, ?, ?)";

            $nombre = $usuario->getNombre();
            $correo = $usuario->getCorreo();
            $password = $usuario->getPassword();
            $dni = $usuario->getDni();
            $tipo_usuario = $usuario->getTipousuario();      

            $stmt = $this->cn->prepare($sql);
            $stmt->bind_param("sssss", $nombre,$correo, 
            $password, $dni, $tipo_usuario);
            $stmt->execute();
        } catch (Exception $e) {
            die("Error al crear el nuevo usuario: ".$e->getMessage());
        }
        
    }

    public function modificarUsuario(Usuario $usuario) {
        try {
            $sql = "UPDATE usuario SET nombre=?, correo=?, passw=?, dni=?, tipo_usuario=? WHERE id_usuario=?";
            $stmt = $this->cn->prepare($sql);

            $nombre = $usuario->getNombre();
            $correo = $usuario->getCorreo();
            $password = $usuario->getPassword();
            $dni = $usuario->getDni();
            $tipo_usuario = $usuario->getTipousuario();
            $id_usuario = $usuario->getIdusuario();

            $stmt->bind_param("sssssi", $nombre, $correo, $password, $dni, $tipo_usuario, $id_usuario);
            $stmt->execute();
        } catch (Exception $e) {
            die("Error al modificar el usuario: ".$e->getMessage());
        }
        
    }

    
}
?>