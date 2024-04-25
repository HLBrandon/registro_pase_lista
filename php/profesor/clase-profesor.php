<?php

include '../conexion.php';

if (isset($_POST)) {

    $id = $_POST["cveProfesor"];

    $sql = "SELECT cvePersona, nombre_persona, apellido_pa, apellido_ma FROM profesor
            NATURAL JOIN personal_escolar
            NATURAL JOIN usuario
            WHERE cvePersona = $id";

    $query = $conexion->query($sql);

    if (!$query) {
        die("Ocurrio un error: " . $conexion->connect_error);
    }

    $arreglo = array();

    while ($row = $query->fetch_object()) {
        $arreglo[] = array(
            "cvePersona" => $row->cvePersona,
            "nombre" => $row->nombre_persona . " " . $row->apellido_pa . " " . $row->apellido_ma
        );
    }

    $json = json_encode($arreglo, JSON_UNESCAPED_UNICODE); //PERMITE EL USO DE ACENTOS

    print_r($json);

}
