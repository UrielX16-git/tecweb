<?php
namespace TecWeb\MyApi\Read;

use TecWeb\MyApi\DataBase;

class Read extends DataBase
{

    private $data = array();

    public function __construct($db, $user = 'root', $pass = '161202', $host = 'localhost')
    {
        parent::__construct($db, $user, $pass, $host);
    }

    public function list()
    {
        if ($result = $this->conexion->query("SELECT * FROM productos WHERE eliminado = 0")) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            if (!is_null($rows)) {
                foreach ($rows as $num => $row) {
                    foreach ($row as $key => $value) {
                        $this->data[$num][$key] = \utf8_encode($value);
                    }
                }
            }
            $result->free();
        } else {
            die('Query Error: ' . \mysqli_error($this->conexion));
        }
        $this->conexion->close();
        return \json_encode($this->data, JSON_PRETTY_PRINT);
    }

    public function search($search)
    {
        if (!empty($search)) {
            $sql = "SELECT * FROM productos WHERE (id = '{$search}' OR nombre LIKE '%{$search}%' OR marca LIKE '%{$search}%' OR detalles LIKE '%{$search}%') AND eliminado = 0";
            if ($result = $this->conexion->query($sql)) {
                $rows = $result->fetch_all(MYSQLI_ASSOC);
                if (!\is_null($rows)) {
                    foreach ($rows as $num => $row) {
                        foreach ($row as $key => $value) {
                            $this->data[$num][$key] = \utf8_encode($value);
                        }
                    }
                }
                $result->free();
            } else {
                die('Query Error: ' . \mysqli_error($this->conexion));
            }
            $this->conexion->close();
            return \json_encode($this->data, JSON_PRETTY_PRINT);
        }
    }

    public function single($id)
    {
        if (!empty($id)) {
            $sql = "SELECT * FROM productos WHERE id = '{$id}' AND eliminado = 0";
            if ($result = $this->conexion->query($sql)) {
                $row = $result->fetch_array(MYSQLI_ASSOC);
                if (!\is_null($row)) {
                    foreach ($row as $key => $value) {
                        $this->data[$key] = \utf8_encode($value);
                    }
                }
                $result->free();
            } else {
                die('Query Error: ' . \mysqli_error($this->conexion));
            }
            $this->conexion->close();
            return \json_encode($this->data, JSON_PRETTY_PRINT);
        }
    }

    public function checkName($nombre)
    {
        $data = array(
            'status' => 'error',
            'message' => 'Ya existe un producto con ese nombre'
        );
        if (!empty($nombre)) {
            $sql = "SELECT * FROM productos WHERE nombre = '{$nombre}' AND eliminado = 0";
            $result = $this->conexion->query($sql);

            if ($result->num_rows == 0) {
                $data['status'] = "success";
                $data['message'] = "Nombre de producto disponible";
            }
            $result->free();
        }
        $this->conexion->close();
        return \json_encode($data, JSON_PRETTY_PRINT);
    }
}
