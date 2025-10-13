<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id = isset($_POST['id']) ? trim($_POST['id']) : null;

if (empty($id)) {
    $error = "Error: No se ha proporcionado un ID de producto para eliminar.";
} else {
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '161202';
    $db_name = 'marketzone';

    @$link = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if ($link->connect_errno) {
        $error = "Falló la conexión a la base de datos: " . $link->connect_error;
    } else {
        $query = "UPDATE productos SET eliminado = 1 WHERE id = ?";
        $stmt = $link->prepare($query);
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            $success_message = "Producto con ID " . htmlspecialchars($id) . " marcado como eliminado exitosamente.";
        } else {
            $error = "Error al eliminar el producto: " . $stmt->error;
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
    <title>Resultado de la Eliminación</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <h2>Error al Eliminar</h2>
                <p><?= htmlspecialchars($error) ?></p>
                <a href="get_productos_vigentes_v2.php" class="btn btn-danger">Volver a la lista</a>
            </div>
        <?php elseif (isset($success_message)): ?>
            <div class="alert alert-success" role="alert">
                <h2>¡Producto Eliminado!</h2>
                <p><?= htmlspecialchars($success_message) ?></p>
                <a href="get_productos_vigentes_v2.php" class="btn btn-success">Volver a la lista</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
