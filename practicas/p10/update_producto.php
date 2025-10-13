<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function get_post_data($field) {
    return isset($_POST[$field]) ? trim($_POST[$field]) : null;
}

// Recibir datos del formulario de edición
$id = get_post_data('id');
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

if (empty($id) || empty($nombre) || empty($marca) || empty($modelo) || $precio === null || $unidades === null) {
    $error = "Por favor, complete todos los campos requeridos.";
} else {
    // Conexión a la base de datos
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '161202';
    $db_name = 'marketzone';

    @$link = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if ($link->connect_errno) {
        $error = "Falló la conexión a la base de datos: " . $link->connect_error;
    } else {
        $query = "UPDATE productos SET nombre = ?, marca = ?, modelo = ?, precio = ?, detalles = ?, unidades = ?, imagen = ? WHERE id = ?";
        $stmt = $link->prepare($query);
        $stmt->bind_param("sssdsisi", $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen, $id);
        
        if ($stmt->execute()) {
            $success_message = "Producto con ID " . htmlspecialchars($id) . " actualizado exitosamente.";
        } else {
            $error = "Error al actualizar el producto: " . $stmt->error;
        }
        $stmt->close();
        $link->close();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado de la Actualización</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <h2>Error al Actualizar</h2>
                <p><?= htmlspecialchars($error) ?></p>
                <a href="get_productos_vigentes_v2.php" class="btn btn-danger">Volver a la lista</a>
            </div>
        <?php elseif (isset($success_message)): ?>
            <div class="alert alert-success" role="alert">
                <h2>¡Producto Actualizado!</h2>
                <p><?= htmlspecialchars($success_message) ?></p>
                <a href="get_productos_vigentes_v2.php" class="btn btn-success">Volver a la lista</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
