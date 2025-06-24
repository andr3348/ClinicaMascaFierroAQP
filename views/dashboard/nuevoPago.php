<?php 
session_start();
if (!isset($_SESSION['id_usuario']) || !is_numeric($_SESSION['id_usuario'])) {
    header("Location: ../../public/index.php?view=login");
    exit();
}

$id_paciente = $_SESSION['id_usuario'];

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
    <title>Regitrar pago</title>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">
    <a href="?view=dashboard" class="absolute top-6 left-6 text-blue-600 hover:text-blue-800 font-medium hover:underline transition duration-200">Atrás</a>
    <div class="bg-white w-full max-w-md shadow-lg rounded-lg p-6 space-y-6">
        <h3 class="text-xl font-bold text-gray-800 text-center">Registrar un Nuevo Pago</h3>
        <form action="?action=registrarPago" class="space-y-4" method="POST">
            <div>
                <label for="monto" class="block text-sm font-medium text-gray-700 mb-1">Monto (S/):</label>
                <input type="number" name="monto" max="9999" min="5" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500" placeholder="Ingrese monto.">
            </div>
            
            <input type="hidden" name="id_paciente" value="<?=htmlspecialchars($id_paciente)?>">

            <div>
                <label for="id_cita" class="block text-sm font-medium text-gray-700 mb-1"></label>
                <?php if (empty($citas)): ?>
                <p class="text-red-500 text-sm">No hay citas disponibles o confirmadas</p>
                <?php else: ?>
                    <select name="id_cita" id="id_cita" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
                        <option value="">Sleccione una cita</option>
                <?php foreach($citas as $cita): ?>
                    <option value="<?=htmlspecialchars($cita['id_cita'])?>">
                        <?=htmlspecialchars($cita['descripcion'])?> (ID Dentista: <?=htmlspecialchars($cita['id_dentista'])?>)
                    </option>
                <?php endforeach; ?>
                    </select>
            <?php endif; ?>
            </div>
            
            <div class="text-center">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-md shadow transition duration-200">
                    Registrar
                </button>
            </div>
        </form>
    </div>
</body>
</html>