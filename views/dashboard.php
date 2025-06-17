<?php 
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ./login/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Paciente Dashboard</title>
</head>
<body>
    <h1>Bienvenido, <?= htmlspecialchars($_SESSION['nombre']) ?></h1>
    <a href="logout.php">Cerrar Sesión</a>

    <div>
        <h3>Mis citas</h3>
        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Descripcion</th>
                    <th>Dentista</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>
</body>
</html>


