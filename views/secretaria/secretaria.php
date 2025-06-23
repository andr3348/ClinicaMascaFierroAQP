<?php 
session_start();
if (!isset($_SESSION['id_usuario']) || !is_numeric($_SESSION['id_usuario'])) {
    header("Location: ?view=login");
    exit();
}
if ($_SESSION['tipo'] != 'secretaria') {
    require_once '../controllers/UsuarioController.php';
    $logout = new UsuarioController();
    $logout->logOut();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Secretaria Dashboard</title>
</head>
<body>
    
</body>
</html>