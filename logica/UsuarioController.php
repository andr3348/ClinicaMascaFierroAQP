<?php 
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

    public function index() {
        require_once "models/UsuarioModel.php";
        $usuarios = new UsuarioModel();
        $data["titulo"] = "usuarios";
        $data["usuarios"] = $usuarios->getUsers();

        require_once "views/paciente/paciente.php";
    }
}

$controller = new UsuarioController();
$controller->login();
?>