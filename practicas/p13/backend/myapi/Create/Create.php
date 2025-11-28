<?php
namespace TecWeb\MyApi\Create;

use TecWeb\MyApi\DataBase;

class Create extends DataBase
{

    public function __construct($db, $user = 'root', $pass = '161202', $host = 'localhost')
    {
        parent::__construct($db, $user, $pass, $host);
    }

    public function add($productoJson)
    {
        $data = array(
            'status' => 'error',
            'message' => 'Ya existe un producto con ese nombre'
        );
        if (!empty($productoJson)) {
            $jsonOBJ = \json_decode($productoJson);
            $sql = "SELECT * FROM productos WHERE nombre = '{$jsonOBJ->nombre}' AND eliminado = 0";
            $result = $this->conexion->query($sql);

            if ($result->num_rows == 0) {
                $this->conexion->set_charset("utf8");
                $sql = "INSERT INTO productos VALUES (null, '{$jsonOBJ->nombre}', '{$jsonOBJ->marca}', '{$jsonOBJ->modelo}', {$jsonOBJ->precio}, '{$jsonOBJ->detalles}', {$jsonOBJ->unidades}, '{$jsonOBJ->imagen}', 0)";
                if ($this->conexion->query($sql)) {
                    $data['status'] = "success";
                    $data['message'] = "Producto agregado";
                } else {
                    $data['message'] = "ERROR: No se ejecuto $sql. " . \mysqli_error($this->conexion);
                }
            }
            $result->free();
        }
        $this->conexion->close();
        return \json_encode($data, JSON_PRETTY_PRINT);
    }
}
