<?php

include 'conexion.php';

$sql = "SELECT * FROM modalidad";

$query = $conexion -> query($sql);

if (!$query) {
    die("Ocurrio un error: " . $conexion -> connect_error);
}

$arreglo = array();

while ($row = $query -> fetch_object()) {
    $arreglo [] = array(
        "cveModalidad" => $row -> cveModalidad,
        "modalidad" => $row -> modalidad
    );
}

$json = json_encode($arreglo);

print_r($json);