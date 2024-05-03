<?php

if (!empty($_POST["cvePersona"])) {

    include '../conexion.php';

    $cvePersona = $_POST["cvePersona"];

    $stmt = $conexion -> prepare("UPDATE personal_escolar SET status = 1 WHERE cvePersona = ?");
    $stmt -> bind_param("s", $cvePersona);

    if ($stmt -> execute()) {
        $arreglo = array(
            "icono" => "success",
            "titulo" => "EXITO!!",
            "texto" => "Usuario actualizado",
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

    $stmt -> close();
    $conexion -> close(); 
}