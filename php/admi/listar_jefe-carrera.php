<?php

include '../conexion.php';

$sql = "SELECT cveEncargar, cveCarrera, nombre_persona, apellido_pa, apellido_ma FROM encargar_carrera
        NATURAL JOIN jefe_carrera
        NATURAL JOIN personal_escolar
        NATURAL JOIN usuario";

$query = $conexion -> query($sql);

if (!$query) {
    die("Ocurrio un error: " . $conexion -> connect_error);
}

$arreglo = array();

while ($row = $query -> fetch_object()) {
    $arreglo [] = array(
        'cveEncargar' => $row -> cveEncargar,
        'cveCarrera' => $row -> cveCarrera,
        'nombre'     => $row -> nombre_persona . " " . $row -> apellido_pa . " " . $row -> apellido_ma
    );
}

$json = json_encode($arreglo, JSON_UNESCAPED_UNICODE);

print_r($json);

$query -> free_result();

$conexion -> close();


?>