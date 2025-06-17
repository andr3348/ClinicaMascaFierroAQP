<?php 
$view = $_GET['view'] ?? 'login';

// DIRECCION A LAS VISTAS
$viewPath = "../views/$view/$view.php";

if (file_exists($viewPath)) {
    $viewFile = $viewPath;
    $title = ucfirst($view); // TITULO DINAMICO

    require '../views/layout.php';
} else {
    echo "Vista '$view' no encontrada.";
}
?>