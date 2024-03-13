<?php

include 'conexion.php';

$sql = "SELECT cveSemestre FROM semestre";

$query = $conexion -> query($sql);

if (!$query) {
    die("Ocurrio un error: " . $conexion -> connect_error);
}

$arreglo = array();

while ($row = $query -> fetch_object()) {
    $arreglo [] = array(
        "cveSemestre" => $row -> cveSemestre
    );
}

$json = json_encode($arreglo);

print_r($json);