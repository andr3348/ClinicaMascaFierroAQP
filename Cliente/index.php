<?php
require_once '../recursos/conexion.php';
require_once 'controlador/ClienteControlador.php';
$conn = obtenerConexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['registrar'])) {
        $mensaje = ClienteControlador::procesarRegistro($conn, $_POST);
        echo "<p style='color: green;'>$mensaje</p>";
    }
}

$vista = $_GET['vista'] ?? 'inicio';

include 'vista/header.php';

switch ($vista) {
    case 'inicio':
        include 'vista/inicio.php';
        break;
    case 'servicios':
        include 'vista/servicios.php';
        break;
    case 'reservar':
        include 'vista/reservar.php';
        break;
    case 'login':
        include 'vista/login.php';
        break;
    case 'register':
        include 'vista/register.php';
        break;
    case 'cuenta':
        include 'vista/cuenta.php';
        break;
    case 'logout':
        ClienteControlador::cerrarSesion();
        header('Location: index.php?vista=inicio');
        exit();
    default:
        include 'vista/inicio.php';
}
?>
</main>
</body>
</html>
