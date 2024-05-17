<?php

if (isset($_POST)) {

    include '../conexion.php';
    include '../validaciones.php';

    if (!empty($_POST["cvearea"]) and !empty($_POST["nombre_area"])) {

        $cvearea = trim($_POST["cvearea"]);
        $nombre_area = trim($_POST["nombre_area"]);

        $sql = "UPDATE area_itsmt SET area = ? WHERE cveArea = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ss", $nombre_area, $cvearea);

        if ($stmt->execute()) {

            $arreglo = array(
                "status" => true,
                "icono" => "success",
                "titulo" => "COMPLETADO!!",
                "texto" => "Área modificada",
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