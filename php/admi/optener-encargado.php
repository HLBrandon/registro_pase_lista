<?php

if (!empty($_POST["cveEncargar"])) {

    include '../conexion.php';

    $cveEncargar = $_POST["cveEncargar"];

    $sql = "SELECT cveEncargar, cvePersona, cveCarrera, nombre_persona, apellido_pa, apellido_ma FROM encargar_carrera
            NATURAL JOIN jefe_carrera
            NATURAL JOIN personal_escolar
            NATURAL JOIN usuario WHERE cveEncargar = $cveEncargar";

    $query = $conexion->query($sql);

    if (!$query) {
        die("Ocurrio un error: " . $conexion->connect_error);
    }

    $arreglo = array();

    while ($row = $query->fetch_object()) {
        $arreglo = array(
            "cveEncargar" => $row->cveEncargar,
            "cveCarrera" => $row->cveCarrera,
            "cvePersona" => $row->cvePersona,
            "nombre" => $row->nombre_persona . " " . $row->apellido_pa . " " . $row->apellido_ma
        );
    }

    $json = json_encode($arreglo, JSON_UNESCAPED_UNICODE); //PERMITE EL USO DE ACENTOS

    print_r($json);

}