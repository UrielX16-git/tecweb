<?php
namespace TecWeb\MyApi\Update;

use TecWeb\MyApi\DataBase;

class Update extends DataBase
{

    public function __construct($db, $user = 'root', $pass = '161202', $host = 'localhost')
    {
        parent::__construct($db, $user, $pass, $host);
    }

    public function edit($productoJson)
    {
        $data = array(
            'status' => 'error',
            'message' => 'Error al actualizar el producto'
        );
        if (!empty($productoJson)) {
            $jsonOBJ = \json_decode($productoJson);
            $sql = "UPDATE productos SET nombre = '{$jsonOBJ->nombre}', marca = '{$jsonOBJ->marca}', modelo = '{$jsonOBJ->modelo}', precio = {$jsonOBJ->precio}, detalles = '{$jsonOBJ->detalles}', unidades = {$jsonOBJ->unidades}, imagen = '{$jsonOBJ->imagen}' WHERE id = {$jsonOBJ->id}";
            $this->conexion->set_charset("utf8");
            if ($this->conexion->query($sql)) {
                $data['status'] = "success";
                $data['message'] = "Producto actualizado";
            } else {
                $data['message'] = "ERROR: No se ejecuto $sql. " . \mysqli_error($this->conexion);
            }
        }
        $this->conexion->close();
        return \json_encode($data, JSON_PRETTY_PRINT);
    }
}
