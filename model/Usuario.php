<?php
require_once '../database/DB.php';

class Usuario {
    private $db;

    public function __construct() {
        $this->db = Conexion::getConnection();

    }

    public function getAllUsers() {
        $stmt = $this->db->prepare(
            "SELECT id_usuario, nombre, correo, passw, dni, tipo_usuario 
            FROM usuario");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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