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
require_once '../controllers/CitaController.php';
$citaController = new CitaController();
$citas = $citaController->cargarCitasPendientes();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Secretaria Dashboard</title>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">
    <a href="?view=home" class="absolute top-6 left-6 text-blue-600 hover:text-blue-800 hover:underline font-medium transition duration-200">Home</a>
    <div class="w-full max-w-6xl bg-white shadow-lg rounded-lg p-6">
        <h3 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Citas por confirmar</h3>
        <div class="overflow-x-auto border rounded">
            <table class="min-w-full table-auto border-collapse">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-4 py-2 border-b">ID</th>
                        <th class="px-4 py-2 border-b">Fecha</th>
                        <th class="px-4 py-2 border-b">Descripción</th>
                        <th class="px-4 py-2 border-b">Estado</th>
                        <th class="px-4 py-2 border-b">Paciente</th>
                        <th class="px-4 py-2 border-b">Dentista</th>
                        <th class="px-4 py-2 border-b">Acción</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-center">
                    <?php if (empty($citas)): ?>
                        <tr>
                            <td colspan="5" class="py-3 text-gray-500">No hay citas pendientes.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($citas as $cita): ?>
                            <tr class="hover:bg-gray-100 transition">
                                <td class="px-4 py-2 border-b"><?=htmlspecialchars($cita['id_cita'])?></td>
                                <td class="px-4 py-2 border-b"><?=htmlspecialchars($cita['fecha'])?></td>
                                <td class="px-4 py-2 border-b"> <?=htmlspecialchars($cita['descripcion'])?></td>
                                <td class="px-4 py-2 border-b"><?=htmlspecialchars($cita['estado'])?></td>
                                <td class="px-4 py-2 border-b"><?=htmlspecialchars($cita['nombre_paciente'])?></td>
                                <td class="px-4 py-2 border-b"><?=htmlspecialchars($cita['nombre_dentista'])?></td>
                                <td class="px-4 py-2 border-b space-x-2">
                                    <a href="?action=confirmarCita&id=<?=htmlspecialchars($cita['id_cita'])?>" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition">Confirmar</a>
                                    <a href="?action=eliminarCita&id=<?=htmlspecialchars($cita['id_cita'])?>" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">Rechazar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>