<?php 
session_start();
if (!isset($_SESSION['id_usuario']) || !is_numeric($_SESSION['id_usuario'])) {
    header("Location: ?view=login");
    exit();
}
if ($_SESSION['tipo'] != 'dentista') {
    require_once '../controllers/UsuarioController.php';
    $logout = new UsuarioController();
    $logout->logOut();
}
require_once '../controllers/CitaController.php';
$citaController = new CitaController();
$citas = $citaController->cargarCitasConfirmadas();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Dentista Dashboard</title>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-start py-10">
    <div class="w-full max-w-4xl flex justify-start mb-4">
        <a href="?view=home"
            class="flex items-center gap-2 text-blue-600 hover:text-blue-800 hover:underline transition duration-200">
            Home
        </a>
    </div>

    
    <div class="w-full max-w-5xl bg-white shadow-md rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">
                Bienvenido, <?= htmlspecialchars($_SESSION['nombre']) ?>
            </h1>
            <a href="?action=logout" class="text-red-600 hover:underline">Cerrar Sesión</a>
        </div>
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Citas</h3>

        <div class="overflow-x-auto max-h-96 overflow-y-auto border rounded">
            <table class="min-w-full border-collapse">
                <thead class="bg-blue-600 text-white sticky top-0">
                    <tr>
                        <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Fecha</th>
                        <th class="py-2 px-4 border-b">Descripción</th>
                        <th class="py-2 px-4 border-b">Paciente</th>
                        <th class="py-2 px-4 border-b">Odontograma</th>
                    </tr>
                </thead>
                <tbody class="text-center text-gray-700">
                    <?php if (empty($citas)): ?>
                        <tr>
                            <td colspan="5" class="py-3 text-gray-500">No hay citas en curso.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($citas as $cita): ?>
                            <tr class="hover:bg-gray-100 transition">
                                <td class="py-2 px-4 border-b"><?=htmlspecialchars($cita['id_cita'])?></td>
                                <td class="py-2 px-4 border-b"><?=htmlspecialchars($cita['fecha'])?></td>
                                <td class="py-2 px-4 border-b"><?=htmlspecialchars($cita['descripcion'])?></td>
                                <td class="py-2 px-4 border-b"><?=htmlspecialchars($cita['nombre_paciente'])?></td>
                                <td class="py-2 px-4 border-b">
                                    <?php if (is_null($cita['imagen'])): ?>
                                    <a href="?dentista=subirOdontograma&id_cita=<?=htmlspecialchars($cita['id_cita'])?>&id_paciente=<?=htmlspecialchars($cita['id_paciente'])?>&id_dentista=<?=htmlspecialchars($cita['id_dentista'])?>" class="text-blue-600 hover:underline">Agregar Odontograma</a>
                                    <?php else: ?>
                                        <img src="/uploads/odontogramas/<?=htmlspecialchars($cita['imagen'])?>" class="w-16 h-16 object-cover rounded shadow">
                                    <?php endif; ?>
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