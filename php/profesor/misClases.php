<?php

session_start();

include '../conexion.php';

if (!empty($_SESSION["cvePersona"]) AND $_SESSION["user_profesor"]) {

    $sql = "SELECT cveAsignatura, cveCarrera, cveSemestre, cveModalidad, nombre_asignatura, fecha_inicio_semestre FROM asignatura
            NATURAL JOIN impartir_asignatura
            NATURAL JOIN grupo
            WHERE cvePersona = ?";
    $query = $conexion -> prepare($sql);
    $query -> bind_param("s", $_SESSION["cvePersona"]);
    if ($query -> execute()) {
        $result = $query -> get_result();
        if ($dato = $result -> fetch_object()) {
            $respuesta = array(
                "cveAsignatura" => $dato -> cveAsignatura,
                "cveCarrera" => $dato -> cveCarrera,
                "cveSemestre"  => $dato -> cveSemestre,
                "cveModalidad"   => $dato -> cveModalidad,
                "nombre_asignatura"   => $dato -> nombre_asignatura,
                "fecha_inicio_semestre"   => $dato -> fecha_inicio_semestre
            );
        }
    } else {
        die("Ocurrio un error: " . $conexion -> connect_error);
    }
    $json = json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    print_r($json);
    
}
