<?php

include '../conexion.php';

$sql = "SELECT * FROM area_itsmt";

$query = $conexion -> query($sql);

if (!$query) {
    die("Ocurrio un error: " . $conexion -> connect_error);
}

$arreglo = array();

while ($row = $query -> fetch_object()) {
    $arreglo [] = array(
        'cveArea'     => $row -> cveArea,
        'area' => $row -> area,
        'status'         => $row -> status
    );
}

$json = json_encode($arreglo, JSON_UNESCAPED_UNICODE);

print_r($json);

$query -> free_result();

$conexion -> close();


?>