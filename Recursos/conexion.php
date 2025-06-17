<?php
function obtenerConexion() {
    $host = "localhost";
    $user = "root";
    $pass = "root";
    $db = "clinica";

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Error de conexion: " . $conn->connect_error);
    }

    return $conn;
}
