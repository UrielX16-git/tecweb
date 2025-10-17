<?php
    include_once __DIR__.'/database.php';

    header('Content-Type: application/json');

    $response = array('status' => 'error', 'message' => 'Ocurrió un error.');
    $json_data = file_get_contents('php://input');
    $product = json_decode($json_data);

    if ($product && !empty($product->nombre) && !empty($product->marca) && !empty($product->modelo) && isset($product->precio) && isset($product->unidades)) {
        
        $check_query = "SELECT * FROM productos WHERE nombre = ? AND eliminado = 0";
        $stmt_check = $conexion->prepare($check_query);
        $stmt_check->bind_param("s", $product->nombre);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            $response['message'] = 'Ya existe un producto con el mismo nombre.';
        } else {
            $imagen = !empty($product->imagen) ? $product->imagen : '../img/default.png';

            $insert_query = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt_insert = $conexion->prepare($insert_query);
            $stmt_insert->bind_param("sssdsis", $product->nombre, $product->marca, $product->modelo, $product->precio, $product->detalles, $product->unidades, $imagen);
            
            if ($stmt_insert->execute()) {
                $response['status'] = 'success';
                $response['message'] = 'Producto agregado exitosamente.';
            } else {
                $response['message'] = 'Error al insertar el producto: ' . $stmt_insert->error;
            }
            $stmt_insert->close();
        }
        $stmt_check->close();
    } else {
        $response['message'] = 'Datos incompletos. Por favor, complete todos los campos requeridos.';
    }

    $conexion->close();
    echo json_encode($response, JSON_PRETTY_PRINT);
?>