<?php
$mensaje = '';
if (isset($_POST['edad']) && isset($_POST['sexo'])) {
    $edad = (int)$_POST['edad'];
    $sexo = $_POST['sexo'];

    if (strtolower($sexo) == 'femenino' && $edad >= 18 && $edad <= 35) {
        $mensaje = '<p style="color: green;">Bienvenida, usted está en el rango de edad permitido.</p>';
    } else {
        $mensaje = '<p style="color: red;">Lo sentimos, no cumple con los requisitos.</p>';
    }
} else {
    $mensaje = '<p style="color: orange;">No se recibieron datos.</p>';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5 - Respuesta</title>
</head>
<body>
    <h2>Ejercicio 5: Resultado de la Validación</h2>
    <?php
    echo $mensaje;
    ?>
    <br>
    <a href="ejercicio5_form.html">Formulario</a>
    <br>
    <a href="index.php">index.php</a>
</body>
</html>
