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
                    header("Location: ?view=admin");
                } elseif ($_SESSION['tipo'] === 'secretaria') {
                    header("Location: ?view=secretaria");
                } elseif ($_SESSION['tipo'] === 'dentista') {
                    header("Location: ?view=dentista");
                } else {
                    header("Location: ?view=dashboard");
                }
                exit();
            } else {
                header("Location: ?view=login&error=1");
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
    
    public function logOut() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // borra las variables de sesión
        $_SESSION = [];

        // borra la cookie de la sesión existente
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params['path'], $params['domain'],
                $params['secure'], $params['httponly']
            );
        }

        session_destroy();

        header("Location: ?view=home");
        exit();
    }

    // ADMIN ----------------------------
    public function cargarUsuarios() {
        $lusuario = new LUsuario();
        return $lusuario->obtenerUsuarios();
    }

    public function cargarUsuario($idUsuario) {
        $lusuario = new LUsuario();
        return $lusuario->obtenerUsuarioPorId($idUsuario);
    }

    public function eliminarUsuario($idUsuario) {
        $lusuario = new LUsuario();
        $lusuario->eliminarUsuario($idUsuario);
        header('Location: ?view=admin');
    }

    public function actualizarUsuario(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario();
            $usuario->setIdusuario($_POST['id_usuario']);
            $usuario->setNombre($_POST['nombre']);
            $usuario->setCorreo($_POST['correo']);
            $usuario->setPassword($_POST['passw']);
            $usuario->setDni($_POST['dni']);
            $usuario->setTipousuario($_POST['tipo_usuario']);

            $lusuario = new LUsuario();
            $lusuario->modificarUsuario($usuario);

            header('Location: ?view=admin');
            exit();
        }
    }


    // PACIENTE -------------------------------------
    public function cargarDentistas() {
        $lusuario = new LUsuario();
        return $lusuario->obtenerDentistas();
    }
}
?>