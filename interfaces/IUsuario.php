<?php 
require_once "../entidades/Usuario.php";
interface IUsuario {
    public function guardarUsuario(Usuario $usuario);
    public function modificarUsuario(Usuario $usuario);
    public function eliminarUsuario(Usuario $usuario);
    public function obtenerUsuarios();
    public function obtenerUsuarioPorId($id);

}

?>