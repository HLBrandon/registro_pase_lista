<?php

if (!empty($_POST["cveCarrera"])) {

    include '../conexion.php';

    $cveCarrera = $_POST["cveCarrera"];

    $stmt = $conexion -> prepare("UPDATE carrera SET status = 1 WHERE cveCarrera = ?");
    $stmt -> bind_param("s", $cveCarrera);

    if ($stmt -> execute()) {
        $arreglo = array(
            "icono" => "success",
            "titulo" => "EXITO!!",
            "texto" => "Carrera actualizada",
        );
    } else {
        $arreglo = array(
            "icono" => "error",
            "titulo" => "ERROR!!",
            "texto" => "ERROR-EXECUTE-LN12",
        );
    }
    
    $json = json_encode($arreglo, JSON_UNESCAPED_UNICODE); //PERMITE EL USO DE ACENTOS

    print_r($json);
}