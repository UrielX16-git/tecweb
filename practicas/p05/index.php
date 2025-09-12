<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Práctica 5</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Determina cuál de las siguientes variables son válidas y explica por qué:</p>
    <p>$_myvar,  $_7var,  myvar,  $myvar,  $var7,  $_element1, $house*5</p>
    <?php
        //AQUI VA MI CÓDIGO PHP
        $_myvar;
        $_7var;
        //myvar;       // Inválida
        $myvar;
        $var7;
        $_element1;
        //$house*5;     // Invalida
        
        echo '<h4>Respuesta:</h4>';   
    
        echo '<ul>';
        echo '<li>$_myvar es válida porque inicia con guión bajo.</li>';
        echo '<li>$_7var es válida porque inicia con guión bajo.</li>';
        echo '<li>myvar es inválida porque no tiene el signo de dolar ($).</li>';
        echo '<li>$myvar es válida porque inicia con una letra.</li>';
        echo '<li>$var7 es válida porque inicia con una letra.</li>';
        echo '<li>$_element1 es válida porque inicia con guión bajo.</li>';
        echo '<li>$house*5 es inválida porque el símbolo * no está permitido.</li>';
        echo '</ul>';
    ?>
    <h2>Ejercicio 2</h2>
    <p>Proporcionar los valores de $a, $b, $c</p>
    <?php
        $a = "ManejadorSQL";
        $b = 'MySQL';
        $c = &$a;
        
        echo '<h4>Respuesta 1:</h4>';   
        
        echo '<ul>';
        echo "<li>El valor de \$a es: $a</li>";
        echo "<li>El valor de \$b es: $b</li>";
        echo "<li>El valor de \$c es: $c</li>";
        echo '</ul>';

        $a = "PHP server";
        $b = &$a;

        echo '<h4>Respuesta 2:</h4>';

        echo '<ul>';
        echo "<li>El valor de \$a es: $a</li>";
        echo "<li>El valor de \$b es: $b</li>";
        echo "<li>El valor de \$c es: $c</li>";
        echo '</ul>';

        echo '<p>El uso de & hace que se considere como un apuntador y por tanto si a varia, el resto también.</p>';
    ?>
    <h2>Ejercicio 3</h2>
    <p>Muestra el contenido de cada variable inmediatamente después de cada asignación, verificar la evolución del tipo de estas variables (imprime todos los componentes de los arreglos):</p>
    <?php
        $a = "PHP5";
        echo "<p>Valor de \$a: $a</p>";
        
        $z[] = &$a;
        echo '<p>Contenido del arreglo $z:</p>';
        echo '<pre>';
        print_r($z);
        echo '</pre>';
        
        $b = "5a version de PHP";
        echo "<p>Valor de \$b: $b</p>";
        
        $c = $b*10;
        echo "<p>Valor de \$c: $c</p>";
        
        $a .= $b;
        echo "<p>Valor de \$a: $a</p>";
        echo '<p>Contenido del arreglo $z (después de modificar $a):</p>';
        echo '<pre>';
        print_r($z);
        echo '</pre>';

        $b *= $c;
        echo "<p>Valor de \$b: $b</p>";
        
        $z[0] = "MySQL";
        echo '<p>Contenido del arreglo $z (después de modificar el arreglo):</p>';
        echo '<pre>';
        print_r($z);
        echo '</pre>';
        echo "<p>Valor de \$a : $a</p>";
    ?>
    <h2>Ejercicio 4</h2>
    <p>Lee y muestra los valores de las variables del ejercicio anterior, pero ahora desde la matriz $GLOBALS.</p>
    <?php
        
        echo '<ul>';
        echo '<li>Valor de $a: ' . $GLOBALS['a'] . '</li>';
        echo '<li>Valor de $b: ' . $GLOBALS['b'] . '</li>';
        echo '<li>Valor de $c: ' . $GLOBALS['c'] . '</li>';
        echo '</ul>';
        
        echo '<p>Contenido del arreglo $z:</p>';
        echo '<pre>';
        print_r($GLOBALS['z']);
        echo '</pre>';
    ?>
</body>
</html>