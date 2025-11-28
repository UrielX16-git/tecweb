<?php
namespace TecWeb\MyApi;

abstract class DataBase
{

    protected $conexion;

    public function __construct($db, $user, $pass, $host = 'localhost')
    {
        $this->conexion = @\mysqli_connect(
            $host,
            $user,
            $pass,
            $db
        );

        if (!$this->conexion) {
            die('¡Base de datos NO conectada!');
        }
    }
}