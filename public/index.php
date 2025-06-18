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