<?php

class UsuarioModel {
    private $db;
    private $usuarios;

    public function __construct() {
        $this->db = Conectar::conexion();
        $this->usuarios = array();

    }

    public function getUsers() {
        $resultado = $this->db->query(
            "SELECT id_usuario, nombre, correo, passw, dni, tipo_usuario 
            FROM usuario");

        while ($row = $resultado->FETCH_ASSOC()) {
            $this->usuarios[] = $row;
        }

        return $this->usuarios;
    }

    public function deleteById($id) {
        $stmt = $this->db->prepare("
            DELETE FROM usuario WHERE id_usuario = :id");
            $stmt->execute([':id'=>$id]);
    }

    public function login($correo, $password) {
        $stmt = $this->db->prepare("
            SELECT id_usuario, nombre, correo, passw, dni, tipo_usuario
            FROM usuario
            WHERE correo = :correo AND password = :password");
        $stmt->bindParam(':correo',$correo);
        $stmt->bindParam(':password',$password);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>