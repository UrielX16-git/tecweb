<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function get_post_data($field) {
    return isset($_POST[$field]) ? trim($_POST[$field]) : null;
}

$nombre = get_post_data('nombre');
$marca = get_post_data('marca');
$modelo = get_post_data('modelo');
$precio = isset($_POST['precio']) ? (float)$_POST['precio'] : null;
$detalles = get_post_data('detalles');
$unidades = isset($_POST['unidades']) ? (int)$_POST['unidades'] : null;
$imagen = get_post_data('imagen');
if (empty($imagen)) {
    $imagen = 'img/cat.png';
}

if (empty($nombre) || empty($marca) || empty($modelo) || $precio === null || $unidades === null) {
    $error = "Por favor, complete todos los campos requeridos.";
} else {
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '161202';
    $db_name = 'marketzone';

    @$link = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if ($link->connect_errno) {
        $error = "Falló la conexión a la base de datos: " . $link->connect_error;
    } else {
        $query_check = "SELECT * FROM productos WHERE nombre = ? AND marca = ? AND modelo = ?";
        $stmt_check = $link->prepare($query_check);
        $stmt_check->bind_param("sss", $nombre, $marca, $modelo);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            $error = "Ya existe un producto con el mismo nombre, marca y modelo.";
        } else {
            $query_insert = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt_insert = $link->prepare($query_insert);
            $stmt_insert->bind_param("sssdsis", $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen);
            
            if ($stmt_insert->execute()) {
                $success_message = "Producto '" . htmlspecialchars($nombre) . "' agregado exitosamente.";
                $inserted_id = $link->insert_id;
            } else {
                $error = "Error al insertar el producto: " . $stmt_insert->error;
            }
            $stmt_insert->close();
        }
        $stmt_check->close();
        $link->close();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado de Inserción</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <h2>Error</h2>
                <p><?= htmlspecialchars($error) ?></p>
                <a href="formulario_productos.html" class="btn btn-danger">Volver al formulario</a>
            </div>
        <?php elseif (isset($success_message)): ?>
            <div class="alert alert-success" role="alert">
                <h2>¡Producto Agregado!</h2>
                <p><?= htmlspecialchars($success_message) ?></p>
            </div>
            <div class="card">
                <div class="card-header">Resumen del Producto Insertado (ID: <?= $inserted_id ?>)</div>
                <div class="card-body">
                    <p><strong>Nombre:</strong> <?= htmlspecialchars($nombre) ?></p>
                    <p><strong>Marca:</strong> <?= htmlspecialchars($marca) ?></p>
                    <p><strong>Modelo:</strong> <?= htmlspecialchars($modelo) ?></p>
                    <p><strong>Precio:</strong> $<?= htmlspecialchars(number_format($precio, 2)) ?></p>
                    <p><strong>Detalles:</strong> <?= htmlspecialchars($detalles) ?></p>
                    <p><strong>Unidades:</strong> <?= htmlspecialchars($unidades) ?></p>
                    <p><strong>Imagen:</strong> <?= htmlspecialchars($imagen) ?></p>
                </div>
            </div>
            <a href="formulario_productos.html" class="btn btn-primary mt-3">Agregar otro producto</a>
        <?php endif; ?>
    </div>
</body>
</html>
