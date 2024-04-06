<?php

include 'conexion.php';

$sql = "SELECT * FROM semestre";

$query = $conexion -> query($sql);

if (!$query) {
    die("Ocurrio un error: " . $conexion -> connect_error);
}

$arreglo = array();

while ($row = $query -> fetch_object()) {
    $arreglo [] = array(
        "cveSemestre" => $row -> cveSemestre,
        "num_semestre"=>$row->num_semestre
    );
}

$json = json_encode($arreglo, JSON_UNESCAPED_UNICODE);

print_r($json);