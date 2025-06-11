<?php 
require_once '../model/Usuario.php';

class UsuarioController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD']==='POST') {
            $correo = $_POST['correo'];
            $password = $_POST['password'];

            if (empty($correo) || empty($password)) {
                echo "Completa todos los campos.";
                return;
            }

            $usuarioModel = new Usuario();
            $usuario = $usuarioModel->login($correo,$password);

            if ($usuario) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                
                $_SESSION['usuario'] = $usuario;
                header('Location: ../views/paciente/main.html');
            } else {
                echo "Credenciales incorrectas";
            }
        } else {
            require '../views/login.php';
        }
    }
}

$controller = new UsuarioController();
$controller->login();
?>