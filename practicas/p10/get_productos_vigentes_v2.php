<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Productos Vigentes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <h3>PRODUCTOS VIGENTES</h3>
    <br/>
    <?php
    $productos = [];
    $error_message = null;

    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '161202';
    $db_name = 'marketzone';

    @$link = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if ($link->connect_errno) {
        $error_message = 'Falló la conexión a la base de datos: '.$link->connect_error;
    } else {
        $query = "SELECT * FROM productos WHERE eliminado = 0";
        $result = $link->query($query);

        if ($result) {
            $productos = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
        }
        $link->close();
    }
    ?>

    <?php if ($error_message): ?>
        <div class="alert alert-danger" role="alert">
            <?= htmlspecialchars($error_message) ?>
        </div>
    <?php elseif (empty($productos)): ?>
        <div class="alert alert-warning" role="alert">
            No se encontraron productos vigentes.
        </div>
    <?php elseif (!empty($productos)): ?>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Modelo</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Unidades</th>
                    <th scope="col">Detalles</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Editar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($productos as $producto): ?>
                    <tr>
                        <th scope="row"><?= htmlspecialchars($producto['id']) ?></th>
                        <td><?= htmlspecialchars($producto['nombre']) ?></td>
                        <td><?= htmlspecialchars($producto['marca']) ?></td>
                        <td><?= htmlspecialchars($producto['modelo']) ?></td>
                        <td><?= htmlspecialchars($producto['precio']) ?></td>
                        <td><?= htmlspecialchars($producto['unidades']) ?></td>
                        <td><?= htmlspecialchars($producto['detalles']) ?></td>
                        <td><img src="<?= htmlspecialchars($producto['imagen']) ?>" width="100px" /></td>
                        <td>
                            <form action="formulario_productos_v2.php" method="post">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($producto['id']) ?>">
                                <input type="hidden" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>">
                                <input type="hidden" name="marca" value="<?= htmlspecialchars($producto['marca']) ?>">
                                <input type="hidden" name="modelo" value="<?= htmlspecialchars($producto['modelo']) ?>">
                                <input type="hidden" name="precio" value="<?= htmlspecialchars($producto['precio']) ?>">
                                <input type="hidden" name="detalles" value="<?= htmlspecialchars($producto['detalles']) ?>">
                                <input type="hidden" name="unidades" value="<?= htmlspecialchars($producto['unidades']) ?>">
                                <input type="hidden" name="imagen" value="<?= htmlspecialchars($producto['imagen']) ?>">
                                <button type="submit" class="btn btn-primary">Editar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</body>
</html>
