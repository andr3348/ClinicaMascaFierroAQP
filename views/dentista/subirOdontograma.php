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
$cita = $citaController->cargarCitaPorId();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Subir Nuevo Odontograma</title>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">
    <a href="?view=dentista" class="absolute top-6 left-6 text-blue-600 hover:text-blue-800 font-medium hover:underline transition duration-200">Atrás</a>
    <div class="bg-white w-full max-w-md shadow-lg rounded-lg p-6 space-y-6">
        <h2 class="text-xl font-bold text-gray-800 text-center">Subir un nuevo odontograma</h2>
        <form action="?action=subirOdontograma" method="POST" enctype="multipart/form-data" class="space-y-4">
            <div>
                <input type="hidden" name="id_paciente" value="<?=htmlspecialchars($cita->getIdPaciente())?>">
                <input type="hidden" name="id_dentista" value="<?=htmlspecialchars($cita->getIdDentista())?>">
                <input type="hidden" name="id_cita" value="<?=htmlspecialchars($cita->getIdCita())?>">

                <label for="odontograma" class="block text-sm font-medium text-gray-700 mb-1">Seleccionar imagen:</label>
                <input type="file" name="odontograma" id="odontograma" accept="image/*" required class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg shadow-sm 
                           focus:ring-blue-500 focus:border-blue-500 p-2 bg-gray-50 file:mr-4 file:py-2 
                           file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold 
                           file:bg-blue-600 file:text-white hover:file:bg-blue-700 transition">
            </div>

            <div class="text-center">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md 
                           shadow transition duration-200">Subir imagen</button>
            </div>
            
        </form>
    </div>
</body>
</html>