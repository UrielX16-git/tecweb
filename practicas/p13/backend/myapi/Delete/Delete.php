<?php
namespace TecWeb\MyApi\Delete;

use TecWeb\MyApi\DataBase;

class Delete extends DataBase
{

    public function __construct($db, $user = 'root', $pass = '161202', $host = 'localhost')
    {
        parent::__construct($db, $user, $pass, $host);
    }

    public function delete($id)
    {
        $data = array(
            'status' => 'error',
            'message' => 'La consulta falló'
        );
        if (!empty($id)) {
            $sql = "UPDATE productos SET eliminado=1 WHERE id = {$id}";
            if ($this->conexion->query($sql)) {
                $data['status'] = "success";
                $data['message'] = "Producto eliminado";
            } else {
                $data['message'] = "ERROR: No se ejecuto $sql. " . \mysqli_error($this->conexion);
            }
        }
        $this->conexion->close();
        return \json_encode($data, JSON_PRETTY_PRINT);
    }
}
