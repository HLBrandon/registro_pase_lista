<?php

include '../conexion.php';
include '../validaciones.php';

if (isset($_POST)) {

    if (!empty($_POST["nombre_area"])) {

        $nombre_area = trim($_POST["nombre_area"]);

        $sql = "INSERT INTO area_itsmt (area) values (?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $nombre_area);

        if ($stmt->execute()) {
            $arreglo = array(
                "status" => true,
                "icono" => "success",
                "titulo" => "COMPLETADO!!",
                "texto" => "Área Registrada",
            );
        } else {
            $arreglo = array(
                "status" => false,
                "icono" => "error",
                "titulo" => "ERROR FATAL!!",
                "texto" => "ERROR EXECUTE LINE 16",
            );
        }
    } else {
        $arreglo = array(
            "status" => false,
            "icono" => "warning",
            "titulo" => "ADVERTENCIA!!",
            "texto" => "Existen campos vacios",
        );
    }

    $json = json_encode($arreglo, JSON_UNESCAPED_UNICODE); //PERMITE EL USO DE ACENTOS
    print_r($json);
}