<?php

include '../conexion.php';
include '../validaciones.php';

if (isset($_POST)) {

    if (!empty($_POST["cveCarrera"]) and !empty($_POST["nombre_carrera"])) {

        $cveCarrera = trim($_POST["cveCarrera"]);
        $nombre_carrera = trim($_POST["nombre_carrera"]);

        $sql = "INSERT INTO carrera (cveCarrera, nombre_carrera) values (?,?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ss", $cveCarrera, $nombre_carrera);

        if ($stmt->execute()) {
            $cvePersona = $_POST["select-jefe"];
            $sql = "INSERT INTO encargar_carrera (cveCarrera, cvePersona) values (?,?)";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("ss", $cveCarrera, $cvePersona);
            $stmt->execute();
            
            $arreglo = array(
                "status" => true,
                "icono" => "success",
                "titulo" => "COMPLETADO!!",
                "texto" => "Ingenieria Registrada",
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
