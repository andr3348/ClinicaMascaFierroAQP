<?php 
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../../public/index.php?view=login");
    exit();
}
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
        <a href="?view=home" class="flex items-center gap-2 text-blue-600 hover:text-blue-800 hover:underline transition duration-200">
            Home
        </a>
    </div>
    <div class="w-full max-w-4xl bg-white shadow-md rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">
                Bienvenido, <?= htmlspecialchars($_SESSION['nombre']) ?>
            </h1>
            <a href="?action=logout" class="text-red-600 hover:underline">Cerrar Sesión</a>
        </div>

        <div>
            <h3 class="text-lg font-medium text-gray-700 mb-4">Mis citas</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-300 rounded">
                    <thead class="bg-blue-500 text-white">
                        <tr>
                            <th class="py-2 px-4 border-b">Fecha</th>
                            <th class="py-2 px-4 border-b">Estado</th>
                            <th class="py-2 px-4 border-b">Descripción</th>
                            <th class="py-2 px-4 border-b">Dentista</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Aquí puedes llenar dinámicamente con PHP -->
                        <tr class="text-gray-700 text-center">
                            <td class="py-2 px-4 border-b">2025-06-20</td>
                            <td class="py-2 px-4 border-b">Confirmada</td>
                            <td class="py-2 px-4 border-b">Limpieza dental</td>
                            <td class="py-2 px-4 border-b">Dr. López</td>
                        </tr>
                        <!-- Más filas... -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>


