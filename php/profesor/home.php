<?php

session_start();

include '../conexion.php';

if (!empty($_SESSION["cvePersona"])) {
    $sql = "SELECT cvePersona, nombre_persona, apellido_pa, apellido_ma, correo FROM profesor
            NATURAL JOIN personal_escolar
            NATURAL JOIN usuario
            WHERE cvePersona = ?";
    $query = $conexion -> prepare($sql);
    $query -> bind_param("s", $_SESSION["cvePersona"]);
    if ($query -> execute()) {
        $result = $query -> get_result();
        if ($dato = $result -> fetch_object()) {
            $respuesta = array(
                "cvePersona" => $dato -> cvePersona,
                "nombre_persona" => $dato -> nombre_persona,
                "apellido_ma"  => $dato -> apellido_ma,
                "apellido_pa"   => $dato -> apellido_pa,
                "correo"   => $dato -> correo,
            );
        }
    } else {
        die("Ocurrio un error: " . $conexion -> connect_error);
    }
    $json = json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    print_r($json);
}
