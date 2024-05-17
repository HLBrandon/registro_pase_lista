<?php

if (!empty($_POST["cvearea"])) {

    include '../conexion.php';

    $cvearea = $_POST["cvearea"];

    $stmt = $conexion -> prepare("UPDATE area_itsmt SET status = 1 WHERE cveArea = ?");
    $stmt -> bind_param("s", $cvearea);

    if ($stmt -> execute()) {
        $arreglo = array(
            "icono" => "success",
            "titulo" => "EXITO!!",
            "texto" => "Área actualizado",
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