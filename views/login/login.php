<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Iniciar Sesión</title>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-sm">
        <h1 class="text-2xl font-bold mb-6 text-center">Iniciar Sesión</h1>

        <form action="?action=login" method="POST" class="space-y-4">
            <div>
                <label for="correo" class="block text-sm font-medium text-gray-700">Correo:</label>
                <input type="email" name="correo" id="correo" required
                    class="w-full mt-1 px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-500">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña:</label>
                <input type="password" name="password" id="password" required
                    class="w-full mt-1 px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-500">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">Iniciar Sesión</button>
        </form>

        <div class="mt-4 text-center">
            <a href="?view=registrar" class="text-blue-500 hover:underline text-sm">¿No tienes cuenta? Registrarse</a>
        </div>

        <?php if (isset($_GET['error']) && $_GET['error'] === '1'): ?>
            <p class="mt-4 text-red-500 text-sm text-center">Usuario no encontrado</p>
        <?php endif; ?>
    </div>
</body>
</html>