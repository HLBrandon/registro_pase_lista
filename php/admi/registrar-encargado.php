<?php

include '../conexion.php';
include '../validaciones.php';

if (isset($_POST)) {

    if (!empty($_POST["cveCarrera"]) and !empty($_POST["cvePersona"])) {

        $cveCarrera = trim($_POST["cveCarrera"]);
        $cvePersona = trim($_POST["cvePersona"]);

        $sql = "SELECT * FROM encargar_carrera WHERE cveCarrera = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $cveCarrera);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt -> num_rows == 0) {
            $sql = "INSERT INTO encargar_carrera (cveCarrera, cvePersona) values (?,?)";
            $stmt = $conexion -> prepare($sql);
            $stmt -> bind_param("ss", $cveCarrera, $cvePersona);
            $stmt -> execute();

            $stmt -> close();
            $conexion -> close();

            $arreglo = array(
                "status" => true,
                "icono" => "success",
                "titulo" => "EXITO!!",
                "texto" => "Jefe de carrera asignado con exito",
            );

        } else {
            $arreglo = array(
                "status" => false,
                "icono" => "warning",
                "titulo" => "ADVERTENCIA!!",
                "texto" => $cveCarrera . " tiene un Jefe de Carrera",
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