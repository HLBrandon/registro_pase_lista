<?php

if (!empty($_POST["id_profesor"])) {

    include '../conexion.php';

    $id_profesor = $_POST["id_profesor"];

    $sql = "SELECT cvePersona, nombre_persona, apellido_pa, apellido_ma, correo, telefono, rfc FROM profesor
            NATURAL JOIN personal_escolar
            NATURAL JOIN usuario WHERE cvePersona = $id_profesor";

    $query = $conexion->query($sql);

    if (!$query) {
        die("Ocurrio un error: " . $conexion->connect_error);
    }

    $arreglo = array();

    while ($row = $query->fetch_object()) {
        $arreglo = array(
            "cvePersona" => $row->cvePersona,
            "nombre_persona" => $row->nombre_persona,
            "apellido_pa" => $row->apellido_pa,
            "apellido_ma" => $row->apellido_ma,
            "correo" => $row->correo,
            "telefono" => $row->telefono,
            "rfc" => $row->rfc,
        );
    }

    $json = json_encode($arreglo, JSON_UNESCAPED_UNICODE); //PERMITE EL USO DE ACENTOS

    print_r($json);

}
