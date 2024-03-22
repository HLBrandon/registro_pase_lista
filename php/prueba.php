<?php

include 'validaciones.php';

$pe = 'ISCS';

if (validarCarrera($pe)) {
    echo "Es valido";
} else {
    echo "No es valido";
}

?>