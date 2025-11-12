<?php

namespace MyApi\Backend;

require_once __DIR__ . '/myapi/Products.php';

/*
    include_once __DIR__.'/database.php';

    $data = array(
        'status'  => 'error',
        'message' => 'Ya existe un producto con ese nombre'
    );

    if (isset($_GET['nombre'])) {
        $nombre = $_GET['nombre'];
        $sql = "SELECT * FROM productos WHERE nombre = '{$nombre}' AND eliminado = 0";
        $result = $conexion->query($sql);
        
        if ($result->num_rows == 0) {
            $data['status'] =  "success";
            $data['message'] =  "Nombre de producto disponible";
        }

        $result->free();
        $conexion->close();
    }

    echo json_encode($data, JSON_PRETTY_PRINT);
*/

$products = new Products('nombre_de_tu_bd', 'usuario_bd', 'password_bd'); // Replace with actual DB credentials
if (isset($_GET['nombre'])) {
    $nombre = $_GET['nombre'];
    $products->singleByName($nombre);
    echo $products->getData();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Product name not provided']);
}

?>