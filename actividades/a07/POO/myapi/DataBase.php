<?php

namespace MyApi\Backend;

abstract class DataBase
{
    protected \mysqli $conexion;

    public function __construct(string $db, string $user, string $pass)
    {
        $this->conexion = new \mysqli('localhost', $user, $pass, $db);

        if ($this->conexion->connect_error) {
            die('Error de Conexión (' . $this->conexion->connect_errno . ') ' . $this->conexion->connect_error);
        }
    }
}
