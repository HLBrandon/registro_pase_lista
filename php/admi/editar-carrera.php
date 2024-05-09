<?php

if (isset($_POST)) {

    include '../conexion.php';
    include '../validaciones.php';

    if (!empty($_POST["cveCarrera"]) and !empty($_POST["nombre_carrera"])) {

        $cveCarrera = trim($_POST["cveCarrera"]);
        $nombre_carrera = trim($_POST["nombre_carrera"]);

        $sql = "UPDATE carrera SET nombre_carrera = ? WHERE cveCarrera = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ss", $nombre_carrera, $cveCarrera);

        if ($stmt->execute()) {

            $arreglo = array(
                "status" => true,
                "icono" => "success",
                "titulo" => "COMPLETADO!!",
                "texto" => "Ingenieria Registrada",
            );

            $stmt->close();
            $conexion->close();
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
