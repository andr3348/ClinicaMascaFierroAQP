<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Log In</title>
</head>
<body>
    <div class="container">
        <div>
            <label for="correo" class="title">INICIAR SESIÓN</label><br><br>
            <form action="../../controllers/UsuarioController.php?action=login" method="POST">
                <label for="correo">Correo:</label>
                <input type="email" name="correo" id="correo" required>
                <label for="contraseña">Contraseña:</label>
                <input type="password" name="password" id="contraseña" required>
                <button type="submit">Iniciar Sesión</button>
            </form>
        </div>
        <a href="../registrar/registrar.html">Registrarse</a>
    </div>
</body>
</html>