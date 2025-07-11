<?php session_start(); ?>
<!-- /views/layout.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>MascaFierro | Home</title>
</head>
<body class="bg-gray-100 min-h-screen font-sans relative overflow-hidden">

    <img src="uploads/clinica.jpg" alt="" class="absolute inset-0 w-full h-full object-cover opacity-30 -z-10 pointer-events-none">

    <nav class="bg-white shadow-md py-4 px-6 flex justify-between items-center">
        <p class="text-xl font-bold text-blue-600">MascaFierro</p>
        <div class="space-x-4">
            <?php if (!isset($_SESSION['id_usuario'])): ?>
                <a href="?view=login" class="text-blue-500 hover:text-blue-700 font-medium">Iniciar Sesión</a>
                <a href="?user=registrar" class="text-green-500 hover:text-green-700 font-medium">Registrarse</a>
            <?php else: ?>
                <span class="text-green-700">Bienvenido, <?= htmlspecialchars($_SESSION['nombre']) ?></span>
                <?php if ($_SESSION['tipo'] == 'admin'): ?>
                    <a href="?view=admin">Dashboard</a>
                <?php elseif ($_SESSION['tipo'] == 'secretaria'): ?>
                    <a href="?view=secretaria">Dashboard</a>
                <?php elseif ($_SESSION['tipo'] == 'dentista'): ?>
                    <a href="?view=dentista">Dashboard</a>
                <?php else: ?>
                    <a href="?view=dashboard">Dashboard</a>
                <?php endif; ?>
                <a href="?action=logout" class="text-red-600 hover:underline">Cerrar Sesión</a>
            <?php endif ?>
        </div>
    </nav>

    <main class="flex items-center justify-center mt-20">
        <div class="text-center">
            <h1 class="text-3xl font-bold mb-4">Bienvenido a MascaFierro</h1>
            <p class="text-gray-700 mb-6">Tu clínica dental de confianza</p>
            <?php if (!isset($_SESSION['id_usuario'])): ?>
                <a href="?view=login" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 transition">Comenzar</a>
            <?php else: ?>
                <a href="?view=dashboard" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 transition">Comenzar</a>
            <?php endif ?>
        </div>
    </main>
</body>
</html>