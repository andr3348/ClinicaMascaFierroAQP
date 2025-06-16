<?php 
require_once '../logica/LUsuario.php';
require_once '../entidades/Usuario.php';

class UsuarioController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD']==='POST') {
            $correo = $_POST['correo'];
            $password = $_POST['password'];

            $logic = new LUsuario();
            $usuario = $logic->verificarCredenciales($correo, $password);

            if ($usuario) {
                session_start();
                $_SESSION['id_usuario'] = $usuario->getIdusuario();
                $_SESSION['nombre'] = $usuario->getNombre();
                $_SESSION['tipo'] = $usuario->getTipousuario();
                $_SESSION['dni'] = $usuario->getDni();
                $_SESSION['correo'] = $usuario->getCorreo();

                if ($_SESSION['tipo'] === 'admin') {
                    header("Location: ../views/admin/admin_dashboard.php");
                } elseif ($_SESSION['tipo'] === 'secretaria') {
                    header("Location: ../views/secretaria/secretaria_dashboard.php");
                } elseif ($_SESSION['tipo'] === 'dentista') {
                    header("Location: ../views/dentista/dentista_dashboard.php");
                } else {
                    header("Location: ../views/dashboard.php");
                }
                exit();
            } else {
                header("Location: ../views/login/login.php?error=1");
                exit();
            }
        }
    }

    public function signIn() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'] ?? '';
            $correo = $_POST['correo'] ?? '';
            $passw = $_POST['password'] ?? '';
            $dni = $_POST['dni'] ?? '';
            $tipo = 'paciente'; // TIPO DE USUARIO POR DEFECTO

            if (!preg_match('/^\d{8}$/', $dni)) {
                echo "Dni no válido";
                return;
            }
            $campos = array($nombre, $correo, $passw, $dni);
            foreach ($campos as $campo) {
                if (empty($campo)) {
                    echo "Completa todos los campos.";
                    return;
                }
            }

            $usuario = new Usuario();
            $usuario->setNombre($nombre);
            $usuario->setCorreo($correo);
            $usuario->setPassword($passw);
            $usuario->setDni($dni);
            $usuario->setTipousuario($tipo);

            $lusuario = new LUsuario;
            $lusuario->guardarUsuario($usuario);

            $this->login();
        }
    }
}

// ENRUTADOR
if (isset($_GET['action']) && $_GET['action'] === 'login') {
    $controller = new UsuarioController();
    $controller->login();
}

if (isset($_GET['action']) && $_GET['action'] === 'signin') {
    $controller = new UsuarioController();
    $controller->signIn();
}
?>