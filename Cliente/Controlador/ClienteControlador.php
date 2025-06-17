<?php
require_once __DIR__ . '/../modelo/ClienteModelo.php';

class ClienteControlador {

    public static function registrarCliente($nombre, $correo, $clave) {
        $resultado = ClienteModelo::insertarCliente($nombre, $correo, $clave);
        return $resultado;
    }

    public static function loginCliente($correo, $clave) {
        $cliente = ClienteModelo::obtenerClientePorCorreo($correo);
        if ($cliente && password_verify($clave, $cliente['clave'])) {
            session_start();
            $_SESSION['cliente'] = $cliente;
            return true;
        }
        return false;
    }

    public static function cerrarSesion() {
        session_start();
        session_destroy();
    }

    public static function obtenerClienteActual() {
        session_start();
        return $_SESSION['cliente'] ?? null;
    }

    public static function procesarRegistro($conn, $postData) {
    $nombre = $postData['nombre'];
    $correo = $postData['correo'];
    $contrasena = password_hash($postData['contrasena'], PASSWORD_DEFAULT);
    $dni = $postData['dni'];
    $telefono = $postData['telefono'];
    $direccion = $postData['direccion'];
    $fecha_nacimiento = $postData['fecha_nacimiento'];
    $genero = $postData['genero'];
    $tipo_sangre = $postData['tipo_sangre'];
    $alergias = $postData['alergias'];
    $enfermedades_cronicas = $postData['enfermedades_cronicas'];

    $sqlUsuario = "INSERT INTO usuarios (nombre, correo, contrasena, rol_id) VALUES (?, ?, ?, 1)";
    $stmtUsuario = $conn->prepare($sqlUsuario);
    $stmtUsuario->bind_param("sss", $nombre, $correo, $contrasena);

    if ($stmtUsuario->execute()) {
        $usuario_id = $conn->insert_id;

        $sqlPaciente = "INSERT INTO pacientes (usuario_id, dni, telefono, direccion, fecha_nacimiento, genero, tipo_sangre, alergias, enfermedades_cronicas) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmtPaciente = $conn->prepare($sqlPaciente);
        $stmtPaciente->bind_param("issssssss", $usuario_id, $dni, $telefono, $direccion, $fecha_nacimiento, $genero, $tipo_sangre, $alergias, $enfermedades_cronicas);
        $stmtPaciente->execute();

        return "Registro exitoso. Ya puedes iniciar sesión.";
    } else {
        return "Error al registrar: " . $stmtUsuario->error;
    }
}

}

