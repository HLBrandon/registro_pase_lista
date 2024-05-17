<?php

if (!empty($_POST["cve"])) {

    include '../conexion.php';

    $cve = $_POST["cve"];

    $sql = "SELECT * FROM area_itsmt WHERE cveArea = $cve";

    $query = $conexion->query($sql);

    if (!$query) {
        die("Ocurrio un error: " . $conexion->connect_error);
    }

    $arreglo = array();

    while ($row = $query->fetch_object()) {
        $arreglo = array(
            "cveArea" => $row->cveArea,
            "area" => $row->area
        );
    }

    $json = json_encode($arreglo, JSON_UNESCAPED_UNICODE); //PERMITE EL USO DE ACENTOS

    print_r($json);

}