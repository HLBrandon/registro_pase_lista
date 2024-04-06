<?php

include 'conexion.php';

$sql = "SELECT cveGrupo, num_semestre, modalidad FROM semestre NATURAL JOIN grupo NATURAL JOIN modalidad";

$query = $conexion -> query($sql);

if (!$query) {
    die("Ocurrio un error: " . $conexion -> connect_error);
}

$arreglo = array();

while ($row = $query -> fetch_object()) {
    $arreglo [] = array(
        'cveGrupo'     => $row -> cveGrupo,
        'num_semestre' => $row -> num_semestre,
        'modalidad'    => $row -> modalidad
    );
}

$json = json_encode($arreglo, JSON_UNESCAPED_UNICODE);

print_r($json);


?>