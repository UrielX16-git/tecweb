<?php
    include_once __DIR__.'/database.php';

    $search = isset($_POST['search']) ? $_POST['search'] : '';
    $products = array();

    $query = "SELECT * FROM productos WHERE (nombre LIKE '%$search%' OR marca LIKE '%$search%' OR detalles LIKE '%$search%') AND eliminado = 0";

    if ($result = $conexion->query($query)) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $product = array();
            foreach ($row as $key => $value) {
                $product[$key] = utf8_encode($value);
            }
            $products[] = $product;
        }
        $result->free();
    } else {
        die('Query Error: '.mysqli_error($conexion));
    }

    $conexion->close();

    echo json_encode($products, JSON_PRETTY_PRINT);
?>