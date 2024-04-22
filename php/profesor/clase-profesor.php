<?php

include 'conexion.php';

if (isset($_POST)) {
    
    



}

$sql = "SELECT cveCarrera, nombre_carrera FROM carrera";

$query = $conexion -> query($sql);

if (!$query) {
    die("Ocurrio un error: " . $conexion -> connect_error);
}

$arreglo = array();

while ($row = $query -> fetch_object()) {
    $arreglo [] = array(
        "cveCarrera" => $row -> cveCarrera,
        "nombre_carrera" => $row -> nombre_carrera
    );
}

$json = json_encode($arreglo, JSON_UNESCAPED_UNICODE); //PERMITE EL USO DE ACENTOS

print_r($json);