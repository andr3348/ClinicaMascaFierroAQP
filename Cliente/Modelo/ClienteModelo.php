<?php
require_once __DIR__ . '/../../recursos/conexion.php';
require_once 'Cliente.php';

class ClienteModelo {

    public static function insertarCliente($nombre, $correo, $clave) {
        $db = Conexion::conectar();
        $sql = "INSERT INTO clientes (nombre, correo, clave) VALUES (?, ?, ?)";
        $stmt = $db->prepare($sql);

        $claveHasheada = password_hash($clave, PASSWORD_DEFAULT);
        return $stmt->execute([$nombre, $correo, $claveHasheada]);
    }

    public static function obtenerClientePorCorreo($correo) {
        $db = Conexion::conectar();
        $sql = "SELECT * FROM clientes WHERE correo = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$correo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
