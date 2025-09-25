<?php
function esMultiplo5y7($numero) {
    if ($numero % 5 == 0 && $numero % 7 == 0) {
        return '<h3>R= El número '.$numero.' SÍ es múltiplo de 5 y 7.</h3>';
    } else {
        return '<h3>R= El número '.$numero.' NO es múltiplo de 5 y 7.</h3>';
    }
}
?>