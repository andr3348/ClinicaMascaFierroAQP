<h2>Mi Cuenta</h2>
<?php
require_once __DIR__ . '/../controlador/ClienteControlador.php';
session_start();
$cliente = ClienteControlador::obtenerClienteActual();

if ($cliente) {
    echo "<p>Bienvenido, <strong>" . htmlspecialchars($cliente['nombre']) . "</strong></p>";
    echo "<p>Correo: " . htmlspecialchars($cliente['correo']) . "</p>";
    echo "<a href='index.php?vista=logout'>Cerrar sesión</a>";
} else {
    echo "<p>No has iniciado sesión.</p>";
}
?>
