<?php 
// ENRUTADORES -----------------------
if (isset($_GET['action']) && $_GET['action'] === 'login') {
    require_once '../controllers/UsuarioController.php';
    $controller = new UsuarioController();
    $controller->login();
    return;
}
if (isset($_GET['action']) && $_GET['action'] === 'signin') {
    require_once '../controllers/UsuarioController.php';
    $controller = new UsuarioController();
    $controller->signIn();
    return;
}
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    require_once '../controllers/UsuarioController.php';
    $controller = new UsuarioController();
    $controller->logOut();
    return;
}
if (isset($_GET['action']) && $_GET['action'] === 'deleteUser' 
    && isset($_GET['id']) && is_numeric($_GET['id'])) {
    require_once '../controllers/UsuarioController.php';
    $controller = new UsuarioController();
    $controller->eliminarUsuario(intval($_GET['id']));
    return;
}
if (isset($_GET['admin']) && $_GET['admin'] === 'update'
    && isset($_GET['id']) && is_numeric($_GET['id'])) {
    require_once '../views/admin/adminUpdate.php';
    return;
}
if (isset($_GET['action']) && $_GET['action'] === 'updateUser' && 
        $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../controllers/UsuarioController.php';
    $usuarioController =  new UsuarioController();
    $usuarioController->actualizarUsuario();
    return;
}
if (isset($_GET['dentista']) && $_GET['dentista'] === 'subirOdontograma'
    && isset($_GET['id_cita']) && is_numeric($_GET['id_cita'])
    && isset($_GET['id_paciente']) && is_numeric($_GET['id_paciente'])
    && isset($_GET['id_dentista']) && is_numeric($_GET['id_dentista'])) {
    require_once '../views/dentista/subirOdontograma.php';
    return;
}
if (isset($_GET['action']) && $_GET['action'] === 'subirOdontograma'
    && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../controllers/OdontogramaController.php';
    $odontogramaController = new OdontogramaController();
    $odontogramaController->subirOdontograma();
    return;
}

if (isset($_GET['paciente']) && $_GET['paciente'] === 'nuevaCita') {
    require_once '../views/dashboard/nuevaCita.php';
    return;
}
if (isset($_GET['action']) && $_GET['action'] === 'crearCita'
    && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../controllers/CitaController.php';
    $citaController = new CitaController();
    $citaController->crearCita();
    return;
}

if (isset($_GET['paciente']) && $_GET['paciente'] === 'nuevoPago') {
    require_once '../views/dashboard/nuevoPago.php';
    return;
}
if (isset($_GET['action']) && $_GET['action'] === 'registrarPago'
    && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../controllers/PagoController.php';
    $pagoController = new PagoController();
    $pagoController->crearPago();
    return;
}

if (isset($_GET['action']) && $_GET['action'] === 'confirmarCita'
    && isset($_GET['id']) && is_numeric($_GET['id'])) {
    require_once '../controllers/CitaController.php';
    $citaController = new CitaController();
    $citaController->confirmarCita();
    return;
}
if (isset($_GET['action']) && $_GET['action'] === 'eliminarCita'
    && isset($_GET['id']) && is_numeric($_GET['id'])) {
    require_once '../controllers/CitaController.php';
    $citaController = new CitaController();
    $citaController->eliminarCita();
    return;
}

if (isset($_GET['user']) && $_GET['user'] === 'registrar') {
    require_once '../views/registrar/registrar.php';
    return;
}


// CARGA DE VISTAS --------------------
$view = $_GET['view'] ?? 'home';

// DIRECCION A LAS VISTAS
$viewPath = "../views/$view/$view.php";

if (file_exists($viewPath)) {
    require $viewPath;
} else {
    echo "Vista '$view' no encontrada.";
}


?>