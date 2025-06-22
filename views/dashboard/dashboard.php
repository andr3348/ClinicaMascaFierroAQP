<?php
session_start();
if (!isset($_SESSION['id_usuario']) || !is_numeric($_SESSION['id_usuario'])) {
    header("Location: ../../public/index.php?view=login");
    exit();
}
// TOMAR EN CUENTA QUE ESTE PHP SE EJECUTA EN public/index.php
// y por eso la ruta diferente en require:
require_once '../controllers/CitaController.php';
require_once '../controllers/PagoController.php';
require_once '../controllers/FichaController.php';
require_once '../controllers/OdontogramaController.php';

$citaController = new CitaController();
$citas = $citaController->cargarCitasDePaciente($_SESSION['id_usuario']);

$pagoController = new PagoController();
$pagos = $pagoController->cargarPagosDePaciente($_SESSION['id_usuario']);

$fichaController = new FichaController();
$fichas = $fichaController->cargarFichasDePaciente($_SESSION['id_usuario']);

$odontogramaController = new OdontogramaController();
$odontogramas = $odontogramaController->cargarOdontogramasDePaciente($_SESSION['id_usuario']);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Paciente Dashboard</title>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-start py-10">

    <div class="w-full max-w-4xl flex justify-start mb-4">
        <a href="?view=home"
            class="flex items-center gap-2 text-blue-600 hover:text-blue-800 hover:underline transition duration-200">
            Home
        </a>
    </div>
    <main class="w-full max-w-4xl bg-white shadow-md rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">
                Bienvenido, <?= htmlspecialchars($_SESSION['nombre']) ?>
            </h1>
            <a href="?action=logout" class="text-red-600 hover:underline">Cerrar Sesión</a>
        </div>

        <!-- TABLA CITAS -->
        <div>
            <h3 class="text-lg font-medium text-gray-700 mb-4">Mis citas</h3>
            <div class="overflow-x-auto max-h-96 overflow-y-auto border rounded">
                <table class="min-w-full border-collapse">
                    <thead class="bg-blue-500 text-white sticky top-0">
                        <tr>
                            <th class="py-2 px-4 border-b">Fecha</th>
                            <th class="py-2 px-4 border-b">Estado</th>
                            <th class="py-2 px-4 border-b">Descripción</th>
                            <th class="py-2 px-4 border-b">Dentista</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($citas)): ?>
                            <tr colspan="5" class="py-3 text-gray-500">
                                <td>No hay citas registradas.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($citas as $cita): ?>
                                <tr>
                                    <td><?= htmlspecialchars($cita['fecha']) ?></td>
                                    <td><?= htmlspecialchars($cita['estado']) ?></td>
                                    <td><?= htmlspecialchars($cita['descripcion']) ?></td>
                                    <td><?= htmlspecialchars($cita['nombre_dentista']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- TABLA PAGOS -->
        <div class="mt-10">
            <h3 class="text-lg font-medium text-gray-700 mb-4">
                Pagos realizados
            </h3>
            <div class="overflow-x-auto max-h-96 overflow-y-auto border rounded">
                <table class="min-w-full border-collapse">
                    <thead class="bg-green-500 text-white sticky top-0">
                        <tr>
                            <th class="py-2 px-4 border-b">ID</th>
                            <th class="py-2 px-4 border-b">Monto</th>
                            <th class="py-2 px-4 border-b">Fecha</th>
                            <th class="py-2 px-4 border-b">Dentista</th>
                            <th class="py-2 px-4 border-b">Cita (desc.)</th>
                        </tr>
                    </thead>
                    <tbody class="text-center text-gray-700">
                        <?php if (empty($pagos)): ?>
                            <tr>
                                <td colspan="5" class="py-3 text-gray-500">No hay citas registradas.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($pagos as $pago): ?>
                                <tr class="hover:bg-gray-100 transition">
                                    <td class="py-2 px-4 border-b"><?= htmlspecialchars($pago['id_pago']) ?></td>
                                    <td class="py-2 px-4 border-b"><?= htmlspecialchars($pago['monto']) ?></td>
                                    <td class="py-2 px-4 border-b"><?= htmlspecialchars($pago['fecha']) ?></td>
                                    <td class="py-2 px-4 border-b"><?= htmlspecialchars($pago['nombre_dentista']) ?></td>
                                    <td class="py-2 px-4 border-b"><?= htmlspecialchars($pago['descripcion']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- TABLA FICHAS DE ATENCION -->
        <div class="mt-10">
            <h3 class="text-lg font-medium text-gray-700 mb-4">Fichas de Atención</h3>
            <div class="overflow-x-auto max-h-96 overflow-y-auto border rounded">
                <table class="min-w-full border-collapse">
                    <thead class="bg-purple-500 text-white sticky top-0">
                        <tr>
                            <th class="py-2 px-4 border-b">ID</th>
                            <th class="py-2 px-4 border-b">Fecha</th>
                            <th class="py-2 px-4 border-b">Descripción</th>
                            <th class="py-2 px-4 border-b">Dentista</th>
                        </tr>
                    </thead>
                    <tbody class="text-center text-gray-700">
                        <?php if (empty($fichas)): ?>
                            <tr>
                                <td colspan="4" class="py-3 text-gray-500">No hay fichas de atención registradas.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($fichas as $ficha): ?>
                                <tr class="hover:bg-gray-100 transition">
                                    <td class="py-2 px-4 border-b"><?= htmlspecialchars($cita['id_ficha']) ?></td>
                                    <td class="py-2 px-4 border-b"><?= htmlspecialchars($ficha['fecha']) ?></td>
                                    <td class="py-2 px-4 border-b"><?= htmlspecialchars($ficha['descripcion']) ?></td>
                                    <td class="py-2 px-4 border-b"><?= htmlspecialchars($ficha['nombre_dentista']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- TABLA ODONTOGRAMAS -->
        <div class="mt-10">
            <h3 class="text-lg font-medium text-gray-700 mb-4">Odontogramas</h3>
            <div class="overflow-x-auto max-h-96 overflow-y-auto border rounded">
                <table class="min-w-full border-collapse">
                    <thead class="bg-indigo-500 text-white sticky top-0">
                        <tr>
                            <th class="py-2 px-4 border-b">Imagen</th>
                            <th class="py-2 px-4 border-b">Fecha</th>
                            <th class="py-2 px-4 border-b">Dentista</th>
                            <th class="py-2 px-4 border-b">Cita (desc.)</th>
                        </tr>
                    </thead>
                    <tbody class="text-center text-gray-700">
                        <?php if (empty($odontogramas)): ?>
                            <tr>
                                <td colspan="4" class="py-3 text-gray-500">No hay odontograma registrados.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($odontogramas as $odontograma): ?>
                                <tr class="hover:bg-gray-100 transition">
                                    <td>
                                        <img src="../uploads/odontogramas/<?= htmlspecialchars($odontograma['imagen']) ?>" alt="../uploads/odontogramas/img-not-found.png" class="w-16 h-auto mx-auto">
                                    </td>
                                    <td class="py-2 px-4 border-b"><?= htmlspecialchars($odontograma['fecha']) ?></td>
                                    <td class="py-2 px-4 border-b"><?= htmlspecialchars($odontograma['nombre_dentista']) ?></td>
                                    <td class="py-2 px-4 border-b"><?= htmlspecialchars($odontograma['descripcion']) ?></td>
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