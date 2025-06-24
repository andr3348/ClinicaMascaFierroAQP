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
$usuarios = $usuarioController->cargarUsuarios();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>MascaFierro AQP | Admin Dashboard</title>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-start py-10">
    <div class="w-full max-w-4xl flex justify-start mb-4">
        <a href="?view=home"
            class="flex items-center gap-2 text-blue-600 hover:text-blue-800 hover:underline transition duration-200">
            Home
        </a>
    </div>
    <main class = "w-full max-w-4xl bg-white shadow-md rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">
                Bienvenido, <?= htmlspecialchars($_SESSION['nombre']) ?>
            </h1>
            <a href="?action=logout" class="text-red-600 hover:underline">Cerrar Sesión</a>
        </div>
        <div>
            <h3 class="text-xl font-semibold text-gray-700 mb-4">Usuarios</h3>
            <div class="overflow-x-auto max-h-96 overflow-y-auto border rounded">
                <table class="min-w-full table-auto border-collapse">
                    <thead class="bg-blue-600 text-white sticky top-0">
                        <tr>
                            <th class="py-2 px-4 border-b">ID</th>
                            <th class="py-2 px-4 border-b">Nombre</th>
                            <th class="py-2 px-4 border-b">Correo</th>
                            <th class="py-2 px-4 border-b">DNI</th>
                            <th class="py-2 px-4 border-b">Tipo de usuario</th>
                            <th class="py-2 px-4 border-b">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-center">
                        <?php if (empty($usuarios)): ?>
                            <tr>
                                <td colspan="6" class="py-4 text-gray-500">No hay usuarios registrados.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($usuarios as $usuario): ?>
                                <tr class="hover:bg-gray-100 transition">
                                    <td class="py-2 px-4 border-b"><?= htmlspecialchars($usuario['id_usuario']) ?></td>
                                    <td class="py-2 px-4 border-b">
                                        <?= htmlspecialchars($usuario['nombre']) ?>
                                        <?php if (htmlspecialchars($usuario['nombre']) == $_SESSION['nombre']):?>
                                            (Usted)
                                        <?php endif; ?>
                                    </td>
                                    <td class="py-2 px-4 border-b"><?= htmlspecialchars($usuario['correo']) ?></td>
                                    <td class="py-2 px-4 border-b"><?= htmlspecialchars($usuario['dni']) ?></td>
                                    <td class="py-2 px-4 border-b"><?= htmlspecialchars($usuario['tipo_usuario']) ?></td>
                                    <td class="py-2 px-4 border-b space-x-2">
                                        <a href="?action=deleteUser&id=<?= htmlspecialchars($usuario['id_usuario']) ?>" class="text-red-600 hover:underline text-sm">Eliminar</a>
                                        <a href="?admin=update&id=<?= htmlspecialchars($usuario['id_usuario']) ?>" class="text-blue-600 hover:underline text-sm">Modificar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>