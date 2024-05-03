<?php

include '../conexion.php';

$sql = "SELECT * FROM carrera";

$query = $conexion -> query($sql);

if (!$query) {
    die("Ocurrio un error: " . $conexion -> connect_error);
}

$arreglo = array();

while ($row = $query -> fetch_object()) {
    $arreglo [] = array(
        'cveCarrera'     => $row -> cveCarrera,
        'nombre_carrera' => $row -> nombre_carrera,
        'status'         => $row -> status
    );
}

$json = json_encode($arreglo, JSON_UNESCAPED_UNICODE);

print_r($json);

$query -> free_result();

$conexion -> close();


?>