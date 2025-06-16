<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registrar nuevo usuario</title>
</head>
<body>
    <div class="container">
        <div>
            <label for="correo" class="title">REGISTRARSE</label><br><br>
            <form action="../../controllers/UsuarioController.php?action=signin" method="POST">
                <label for="nombre">Nombre(s):</label>
                <input type="text" name="nombre" id="nombre" required>
                <label for="correo">Correo:</label>
                <input type="email" name="correo" id="correo" required>
                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" required>
                <label for="dni">DNI:</label>
                <input type="number" name="dni" id="dni" required>
                <button type="submit">Registrarse</button>
            </form>
        </div>
        <a href="../login/login.php">Iniciar Sesión</a>
</body>
</html>