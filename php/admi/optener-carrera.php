<?php

if (!empty($_POST["cve"])) {

    include '../conexion.php';

    $cve = $_POST["cve"];

    $sql = "SELECT cveCarrera, nombre_carrera FROM carrera WHERE cveCarrera = '$cve'";

    $query = $conexion->query($sql);

    if (!$query) {
        die("Ocurrio un error: " . $conexion->connect_error);
    }

    $arreglo = array();

    while ($row = $query->fetch_object()) {
        $arreglo = array(
            "cve_Carrera" => $row->cveCarrera,
            "nombre_carrera" => $row->nombre_carrera
        );
    }

    $json = json_encode($arreglo, JSON_UNESCAPED_UNICODE); //PERMITE EL USO DE ACENTOS

    print_r($json);

}