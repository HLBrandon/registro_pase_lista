<?php

if (!empty($_POST["id_admin"])) {

    include '../conexion.php';

    $id_admin = $_POST["id_admin"];

    $sql = "SELECT cvePersona, nombre_persona, apellido_pa, apellido_ma, correo, telefono, rfc FROM user_admin
            NATURAL JOIN personal_escolar
            NATURAL JOIN usuario WHERE cvePersona = $id_admin";

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
