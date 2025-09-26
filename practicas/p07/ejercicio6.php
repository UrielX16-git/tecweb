<?php
$parqueVehicular = [
    'ABC1234' => [
        'Auto' => ['marca' => 'Nissan', 'modelo' => 2022, 'tipo' => 'sedan'],
        'Propietario' => ['nombre' => 'Juan Pérez', 'ciudad' => 'Puebla', 'direccion' => 'Calle Falsa 123']
    ],
    'XYZ7890' => [
        'Auto' => ['marca' => 'Toyota', 'modelo' => 2020, 'tipo' => 'hatchback'],
        'Propietario' => ['nombre' => 'Ana García', 'ciudad' => 'CDMX', 'direccion' => 'Av. Siempreviva 456']
    ],
    'LMN5678' => [
        'Auto' => ['marca' => 'Honda', 'modelo' => 2023, 'tipo' => 'camioneta'],
        'Propietario' => ['nombre' => 'Carlos Sánchez', 'ciudad' => 'Guadalajara', 'direccion' => 'Blvd. de los Sueños 789']
    ],
    'PQR1122' => [
        'Auto' => ['marca' => 'Ford', 'modelo' => 2019, 'tipo' => 'sedan'],
        'Propietario' => ['nombre' => 'Laura Martínez', 'ciudad' => 'Monterrey', 'direccion' => 'Calle del Sol 101']
    ],
    'JKL3344' => [
        'Auto' => ['marca' => 'Chevrolet', 'modelo' => 2021, 'tipo' => 'hatchback'],
        'Propietario' => ['nombre' => 'Pedro Ramírez', 'ciudad' => 'Puebla', 'direccion' => 'Av. Luna 212']
    ],
    'TUV5566' => [
        'Auto' => ['marca' => 'Volkswagen', 'modelo' => 2022, 'tipo' => 'sedan'],
        'Propietario' => ['nombre' => 'Sofía Hernández', 'ciudad' => 'CDMX', 'direccion' => 'Calle Estrella 343']
    ],
    'WXY7788' => [
        'Auto' => ['marca' => 'Mazda', 'modelo' => 2024, 'tipo' => 'sedan'],
        'Propietario' => ['nombre' => 'Luis Torres', 'ciudad' => 'Guadalajara', 'direccion' => 'Paseo del Parque 454']
    ],
    'FGH9900' => [
        'Auto' => ['marca' => 'Nissan', 'modelo' => 2018, 'tipo' => 'camioneta'],
        'Propietario' => ['nombre' => 'Gabriela Flores', 'ciudad' => 'Monterrey', 'direccion' => 'Av. Principal 565']
    ],
    'MNO1212' => [
        'Auto' => ['marca' => 'Toyota', 'modelo' => 2021, 'tipo' => 'hatchback'],
        'Propietario' => ['nombre' => 'David Gómez', 'ciudad' => 'Puebla', 'direccion' => 'Calle Norte 676']
    ],
    'STU3434' => [
        'Auto' => ['marca' => 'Honda', 'modelo' => 2020, 'tipo' => 'sedan'],
        'Propietario' => ['nombre' => 'Fernanda Díaz', 'ciudad' => 'CDMX', 'direccion' => 'Calle Sur 787']
    ],
    'ZAS5656' => [
        'Auto' => ['marca' => 'Ford', 'modelo' => 2023, 'tipo' => 'camioneta'],
        'Propietario' => ['nombre' => 'Javier Ortiz', 'ciudad' => 'Guadalajara', 'direccion' => 'Av. Central 898']
    ],
    'QWE7878' => [
        'Auto' => ['marca' => 'Chevrolet', 'modelo' => 2019, 'tipo' => 'sedan'],
        'Propietario' => ['nombre' => 'Valeria Castillo', 'ciudad' => 'Monterrey', 'direccion' => 'Blvd. Ancho 909']
    ],
    'RTY9090' => [
        'Auto' => ['marca' => 'Volkswagen', 'modelo' => 2021, 'tipo' => 'hatchback'],
        'Propietario' => ['nombre' => 'Ricardo Peña', 'ciudad' => 'Puebla', 'direccion' => 'Calle Larga 121']
    ],
    'YUI1313' => [
        'Auto' => ['marca' => 'Mazda', 'modelo' => 2022, 'tipo' => 'sedan'],
        'Propietario' => ['nombre' => 'Daniela Cruz', 'ciudad' => 'CDMX', 'direccion' => 'Paseo Estrecho 232']
    ],
    'VBN3535' => [
        'Auto' => ['marca' => 'Nissan', 'modelo' => 2024, 'tipo' => 'camioneta'],
        'Propietario' => ['nombre' => 'Miguel Ángel', 'ciudad' => 'Guadalajara', 'direccion' => 'Av. de los Héroes 343']
    ]
];

$resultado = null;
if (isset($_POST['buscarMatricula'])) {
    $matriculaBuscada = strtoupper(trim($_POST['matricula']));
    if (isset($parqueVehicular[$matriculaBuscada])) {
        $resultado = [$matriculaBuscada => $parqueVehicular[$matriculaBuscada]];
    } else {
        $resultado = "No se encontró ningún vehículo con la matrícula: $matriculaBuscada";
    }
} elseif (isset($_POST['mostrarTodos'])) {
    $resultado = $parqueVehicular;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6</title>
</head>
<body>
    <h2>Ejercicio 6: Parque Vehicular</h2>
    <form action="ejercicio6.php" method="post">
        <label for="matricula">Matrícula:</label>
        <input type="text" id="matricula" name="matricula" placeholder="ABC1234">
        <br><br>
        <input type="submit" name="buscarMatricula" value="Buscar por Matrícula">
        <input type="submit" name="mostrarTodos" value="Mostrar Todos">
    </form>

    <?php
    if ($resultado !== null) {
        echo "<h3>Resultado:</h3>";
        if (is_array($resultado)) {
            echo '<pre>';
            print_r($resultado);
            echo '</pre>';
        } else {
            echo "<p>$resultado</p>";
        }
    }
    ?>
    <br>
    <a href="index.php">index.php</a>
</body>
</html>
