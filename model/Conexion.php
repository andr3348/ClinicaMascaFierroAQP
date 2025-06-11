<?php
class Conexion
{
    public static function getConnection() {
        $user = 'postgres';
        $password = '123';

        $host = 'localhost';
        $port = '5432';
        $dbname = 'MascaFierroAQP';

        try {
            return new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
        } catch (PDOException $e) {
            echo "Error de conexión a la base de datos: " . $e->getMessage();
            die();
        }
    }
}