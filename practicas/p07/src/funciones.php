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
function encontrarMultiploWhile($numero_dado) {
    $intentos = 0;
    while (true) {
        $intentos++;
        $aleatorio = rand(1, 1000);
        if ($aleatorio % $numero_dado == 0) {
            return "<p>(while) El primer múltiplo de $numero_dado encontrado fue <b>$aleatorio</b> (en $intentos intentos).</p>";
        }
    }
}

function encontrarMultiploDoWhile($numero_dado) {
    $intentos = 0;
    do {
        $intentos++;
        $aleatorio = rand(1, 1000);
    } while ($aleatorio % $numero_dado != 0);
    return "<p>(do-while) El primer múltiplo de $numero_dado encontrado fue <b>$aleatorio</b> (en $intentos intentos).</p>";
}

?>