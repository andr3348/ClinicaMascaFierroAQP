<div class="flex justify-center">
    <div>
        <label for="correo" class="">INICIAR SESIÓN</label><br><br>
        <form action="../../controllers/UsuarioController.php?action=login" method="POST">
            <label for="correo">Correo:</label>
            <input type="email" name="correo" id="correo" required>
            <label for="contraseña">Contraseña:</label>
            <input type="password" name="password" id="contraseña" required>
            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>
    <a href="../registrar/registrar.html">Registrarse</a>
    <?php
    if (isset($_GET['error']) && $_GET['error'] === '1') {
        echo '<br><br><p style="color: red;">Usuario no encontrado<p>';
    }
    ?>
</div>