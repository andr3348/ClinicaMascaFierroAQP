<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Registrar nuevo usuario</title>
</head>

<body class="min-h-screen flex flex-col items-center justify-center bg-gray-100 px-4">
    <a href="?view=home" class="mb-6 inline-block text-blue-600 font-semibold hover:underline hover:text-blue-800 transition">Home</a>
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Registrarse</h2>

        <form action="?action=signin" method="POST" class="space-y-4">
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre(s):</label>
                <input type="text" name="nombre" id="nombre" required
                    class="mt-1 w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <div>
                <label for="correo" class="block text-sm font-medium text-gray-700">Correo:</label>
                <input type="email" name="correo" id="correo" required
                    class="mt-1 w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña:</label>
                <input type="password" name="password" id="password" minlength="3" required
                    class="mt-1 w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <div>
                <label for="dni" class="block text-sm font-medium text-gray-700">DNI:</label>
                <input type="text" name="dni" id="dni" pattern="\d{8}" maxlength="8" required
                    title="DNI debe tener 8 números"
                    class="mt-1 w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">
                Registrarse
            </button>
        </form>

        <div class="mt-4 text-center">
            <a href="?view=login">¿Ya tienes cuenta? Inicia sesión</a>
        </div>
    </div>
</body>

</html>