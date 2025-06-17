<h2>Registro de Cliente</h2>
<form action="index.php?vista=register" method="POST">
    <label for="nombre">Nombre completo:</label>
    <input type="text" name="nombre" required>

    <label for="correo">Correo electrónico:</label>
    <input type="email" name="correo" required>

    <label for="contrasena">Contraseña:</label>
    <input type="password" name="contrasena" required>

    <label for="dni">DNI:</label>
    <input type="text" name="dni" required>

    <label for="telefono">Teléfono:</label>
    <input type="text" name="telefono">

    <label for="direccion">Dirección:</label>
    <input type="text" name="direccion">

    <label for="fecha_nacimiento">Fecha de nacimiento:</label>
    <input type="date" name="fecha_nacimiento">

    <label for="genero">Género:</label>
    <select name="genero">
        <option value="M">Masculino</option>
        <option value="F">Femenino</option>
        <option value="Otro">Otro</option>
    </select>

    <label for="tipo_sangre">Tipo de sangre:</label>
    <input type="text" name="tipo_sangre">

    <label for="alergias">Alergias:</label>
    <textarea name="alergias"></textarea>

    <label for="enfermedades_cronicas">Enfermedades crónicas:</label>
    <textarea name="enfermedades_cronicas"></textarea>

    <button type="submit" name="registrar">Registrarse</button>
</form>
