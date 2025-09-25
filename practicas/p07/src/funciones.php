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
    $iteraciones = 0;
    do {
        $iteraciones++;
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
?>