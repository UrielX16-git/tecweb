<?php
// Obtener los datos del producto de la solicitud POST
$id = isset($_POST['id']) ? htmlspecialchars($_POST['id']) : '';
$nombre = isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : '';
$marca = isset($_POST['marca']) ? htmlspecialchars($_POST['marca']) : '';
$modelo = isset($_POST['modelo']) ? htmlspecialchars($_POST['modelo']) : '';
$precio = isset($_POST['precio']) ? htmlspecialchars($_POST['precio']) : '';
$detalles = isset($_POST['detalles']) ? htmlspecialchars($_POST['detalles']) : '';
$unidades = isset($_POST['unidades']) ? htmlspecialchars($_POST['unidades']) : '';
$imagen = isset($_POST['imagen']) ? htmlspecialchars($_POST['imagen']) : '';

// Si no se recibe un ID, es un error.
if (empty($id)) {
    die("Error: No se ha proporcionado un ID de producto para editar.");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="src/validate.js"></script>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Editar Producto</h1>
        <form action="update_producto.php" method="post" class="mt-4" onsubmit="return validateForm()">
            <input type="hidden" name="id" value="<?= $id ?>">
            
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $nombre ?>" required>
            </div>
            
            <div class="form-group">
                <label for="marca">Marca:</label>
                <select class="form-control" id="marca" name="marca" required>
                    <option value="">-- Seleccione una marca --</option>
                    <option value="Nvidia" <?= ($marca === 'Nvidia') ? 'selected' : '' ?>>Nvidia</option>
                    <option value="AMD" <?= ($marca === 'AMD') ? 'selected' : '' ?>>AMD</option>
                    <option value="Intel" <?= ($marca === 'Intel') ? 'selected' : '' ?>>Intel</option>
                    <option value="Corsair" <?= ($marca === 'Corsair') ? 'selected' : '' ?>>Corsair</option>
                    <option value="Razer" <?= ($marca === 'Razer') ? 'selected' : '' ?>>Razer</option>
                    <option value="Logitech" <?= ($marca === 'Logitech') ? 'selected' : '' ?>>Logitech</option>
                    <option value="HyperX" <?= ($marca === 'HyperX') ? 'selected' : '' ?>>HyperX</option>
                    <option value="Asus" <?= ($marca === 'Asus') ? 'selected' : '' ?>>Asus</option>
                    <option value="Gigabyte" <?= ($marca === 'Gigabyte') ? 'selected' : '' ?>>Gigabyte</option>
                    <option value="MSI" <?= ($marca === 'MSI') ? 'selected' : '' ?>>MSI</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="modelo">Modelo:</label>
                <input type="text" class="form-control" id="modelo" name="modelo" value="<?= $modelo ?>" required>
            </div>
            
            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" class="form-control" id="precio" name="precio" value="<?= $precio ?>" step="0.01" required>
            </div>
            
            <div class="form-group">
                <label for="detalles">Detalles:</label>
                <textarea class="form-control" id="detalles" name="detalles" rows="3"><?= $detalles ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="unidades">Unidades: <output name="unidadesOutput" id="unidadesOutput"><?= $unidades ?></output></label>
                <input type="range" class="custom-range" id="unidades" name="unidades" min="0" max="250" value="<?= $unidades ?>">
            </div>
            
            <div class="form-group">
                <label for="imagen">Imagen:</label>
                <select class="form-control" id="imagen" name="imagen"></select>
                <input type="hidden" id="imagen_actual" value="<?= $imagen ?>">
            </div>

            <button type="submit" class="btn btn-success">Actualizar Producto</button>
            <button type="submit" class="btn btn-danger ml-2" formaction="delete_producto.php">Borrar Producto</button>
        </form>
    </div>

    <script>
        // Script para el slider de unidades
        const unidadesInput = document.getElementById('unidades');
        const unidadesOutput = document.getElementById('unidadesOutput');
        unidadesInput.addEventListener('input', () => {
            unidadesOutput.textContent = unidadesInput.value;
        });

        // Script para poblar el selector de imágenes y seleccionar la actual
        document.addEventListener('DOMContentLoaded', function() {
            const imagenSelect = document.getElementById('imagen');
            const imagenActual = document.getElementById('imagen_actual').value;

            fetch('get_images.php')
                .then(response => response.json())
                .then(images => {
                    const defaultOption = document.createElement('option');
                    defaultOption.value = "";
                    defaultOption.textContent = "-- Seleccione una imagen --";
                    imagenSelect.appendChild(defaultOption);

                    if (images.length > 0) {
                        images.forEach(imagePath => {
                            const option = document.createElement('option');
                            option.value = imagePath;
                            option.textContent = imagePath.split('/').pop();
                            if (imagePath === imagenActual) {
                                option.selected = true;
                            }
                            imagenSelect.appendChild(option);
                        });
                    }
                })
                .catch(error => {
                    console.error('Error al cargar las imágenes:', error);
                });
        });
    </script>
</body>
</html>
