<?php 
session_start();
if (!isset($_SESSION['id_usuario']) || !is_numeric($_SESSION['id_usuario'])) {
    header("Location: ?view=login");
    exit();
}
if ($_SESSION['tipo'] != 'admin') {
    require_once '../controllers/UsuarioController.php';
    $logout = new UsuarioController();
    $logout->logOut();
}

require_once '../controllers/UsuarioController.php';
$usuarioController = new UsuarioController();
$usuario = $usuarioController->cargarUsuario(intval($_GET['id']));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Admin | Update User</title>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">

        <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Modificar Usuario</h2>
            <form action="?action=updateUser" method="POST" class="space-y-4">
                <input type="hidden" name="id_usuario" value="<?=$usuario->getIdusuario()?>">
                <input type="hidden" name="passw" value="<?=$usuario->getPassword()?>">
                <input type="hidden" name="dni" value="<?=$usuario->getDni()?>">

                <div>
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre" value="<?=$usuario->getNombre()?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <div>
                    <label for="correo" class="block text-sm font-medium text-gray-700">Correo electrónico:</label>
                    <input type="email" name="correo" id="correo" placeholder="Correo" value="<?=$usuario->getCorreo()?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <div>
                    <label for="tipo" class="block text-sm font-medium text-gray-700">Tipo de usuario:</label>
                    <select name="tipo_usuario" id="tipo"  class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="admin" <?=$usuario->getTipousuario()=='admin'?'selected':null ?>>Admin</option>
                        <option value="secretaria" <?=$usuario->getTipousuario()=='secretaria'?'selected':null ?>>Secretaria</option>
                        <option value="dentista" <?=$usuario->getTipousuario()=='dentista'?'selected':null ?>>Dentista</option>
                        <option value="paciente" <?=$usuario->getTipousuario()=='paciente'?'selected':null ?>>Paciente</option>
                    </select>
                </div>
                
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">Modificar</button>
                </div>
                
            </form>
        </div>
</body>
</html>