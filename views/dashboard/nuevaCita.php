<?php 
session_start();
if (!isset($_SESSION['id_usuario']) || !is_numeric($_SESSION['id_usuario'])) {
    header("Location: ../../public/index.php?view=login");
    exit();
}

$id_paciente = $_SESSION['id_usuario'];

require_once '../controllers/UsuarioController.php';
$usuarioController = new UsuarioController();
$dentistas = $usuarioController->cargarDentistas();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Nueva cita</title>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">
    <a href="?view=dashboard" class="absolute top-6 left-6 text-blue-600 hover:text-blue-800 font-medium hover:underline transition duration-200">Atrás</a>
    <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-md space-y-6">
        <h3 class="text-xl font-semibold text-center text-gray-800">Registrar nueva cita</h3>
        <form action="?action=crearCita" method="POST" class="space-y-4">
            <div>
                <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción / Motivo de cita:</label>
                <input type="text" name="descripcion" id="descripcion" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500" required>
            </div>

            <div>
                <input type="hidden" name="id_paciente" id="id_usuario" value="<?=htmlspecialchars($id_paciente)?>">
                <label for="dentista" class="block text-sm font-medium text-gray-700 mb-1">Dentista:</label>
                <?php if (empty($dentistas)): ?>
                    <p class="text-red-500 text-sm">No hay dentistas registrados.</p>
                <?php else: ?>
                <select name="id_dentista" id="dentista" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
                    <option value="">Seleccione un dentista</option>
                <?php foreach ($dentistas as $dentista): ?>
                    <option value="<?=htmlspecialchars($dentista['id_usuario'])?>"><?=htmlspecialchars($dentista['nombre'])?></option>
                <?php endforeach; ?>
                </select>
            <?php endif; ?>
            </div>

            <div class="text-center">
                <button type="submit" class="bg-blue-600 text-white font-semibold px-4 py-2 rounded hover:bg-blue-700 transition">Registrar cita
                </button>
            </div>
        </form>
    </div>
</body>
</html>