<h2>Iniciar Sesión</h2>
<form method="post" action="index.php?vista=login">
    <label for="correo">Correo:</label>
    <input type="email" name="correo" required><br>

    <label for="clave">Contraseña:</label>
    <input type="password" name="clave" required><br>

    <button type="submit">Ingresar</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../controlador/ClienteControlador.php';
    $correo = $_POST['correo'];
    $clave = $_POST['clave'];

    if (ClienteControlador::loginCliente($correo, $clave)) {
        header('Location: index.php?vista=cuenta');
        exit();
    } else {
        echo "<p style='color:red;'>Correo o contraseña incorrectos.</p>";
    }
}
?>
