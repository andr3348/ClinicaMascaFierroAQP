<?php 

class DB {
    private $host = "localhost";
    private $user = "root";
    private $password = "1234";
    private $database = "MascaFierroAQP";

    public function conectar() {
        try {
            $cn = new mysqli($this->host,
            $this->user,
            $this->password,
            $this->database);
            return $cn;
        } catch (Exception $e) {
            die("Error al conectarse a la base de datos: ".$e->getMessage());
        }
    }
}

?>