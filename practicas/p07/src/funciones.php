<?php
function esMultiplo5y7($numero) {
    if ($numero % 5 == 0 && $numero % 7 == 0) {
        return '<h3>R= El número '.$numero.' SÍ es múltiplo de 5 y 7.</h3>';
    } else {
        return '<h3>R= El número '.$numero.' NO es múltiplo de 5 y 7.</h3>';
    }
}
function generarSecuenciaImparParImpar() {
    $matriz = [];
    do {
        $fila = [rand(1, 1000), rand(1, 1000), rand(1, 1000)];
        $matriz[] = $fila;
    } while ($fila[0] % 2 == 0 || $fila[1] % 2 != 0 || $fila[2] % 2 == 0);

    $html = "<table border='1'>";
    $html .= "<tr><th>#</th><th>1</th><th>2</th><th>3</th></tr>";
    foreach ($matriz as $index => $fila) {
        $html .= "<tr>";
        $html .= "<td>".($index+1)."</td>";
        $html .= "<td>".$fila[0]."</td>";
        $html .= "<td>".$fila[1]."</td>";
        $html .= "<td>".$fila[2]."</td>";
        $html .= "</tr>";
    }
    $html .= "</table>";
    $html .= "<p>Secuencia encontrada en ".count($matriz)." iteraciones.</p>";
    $html .= "<p>Total de números generados: ".count($matriz) * 3 ."</p>";

    return $html;
}
function encontrarMultiploWhile($numero2) {
    $intentos = 0;
    while (true) {
        $intentos++;
        $aleatorio = rand(1, 1000);
        if ($aleatorio % $numero2 == 0) {
            return "<p>(while) El primer múltiplo de $numero2 encontrado fue <b>$aleatorio</b> (en $intentos intentos).</p>";
        }
    }
}

function encontrarMultiploDoWhile($numero2) {
    $intentos = 0;
    do {
        $intentos++;
        $aleatorio = rand(1, 1000);
    } while ($aleatorio % $numero2 != 0);
    return "<p>(do-while) El primer múltiplo de $numero2 encontrado fue <b>$aleatorio</b> (en $intentos intentos).</p>";
}

function generarTablaAscii() {
    $letras = [];
    for ($i = 97; $i <= 122; $i++) {
        $letras[$i] = chr($i);
    }

    $html = '<table border="1">';
    $html .= '<tr><th>Código ASCII</th><th>Letra</th></tr>';
    foreach ($letras as $codigo => $letra) {
        $html .= "<tr><td>$codigo</td><td>$letra</td></tr>";
    }
    $html .= '</table>';

    return $html;
}

?>