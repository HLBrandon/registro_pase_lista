<?php

session_start();

include '../conexion.php';

if (!empty($_SESSION["cvePersona"])) {
    $sql = "SELECT profesor.cvePersona, nombre_persona, apellido_pa, apellido_ma, correo FROM profesor
            INNER JOIN personal_escolar ON profesor.cvePersona = personal_escolar.cvePersona
            INNER JOIN info_personal ON info_personal.cveInfoPersonal = personal_escolar.cveInfoPersonal
            INNER JOIN usuario ON usuario.cvePersona = personal_escolar.cvePersona WHERE profesor.cvePersona = ?";
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
