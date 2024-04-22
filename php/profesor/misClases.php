<?php

session_start();

include '../conexion.php';

if (!empty($_SESSION["cvePersona"]) AND $_SESSION["user_profesor"]) {

    $respuesta = array();
    $anio = "";

    $sql = "SELECT cveImpa_Asig, cveCarrera, cveSemestre, cveModalidad, nombre_asignatura, fecha_inicio_semestre
            FROM asignatura
            NATURAL JOIN impartir_asignatura
            NATURAL JOIN grupo
            WHERE cvePersona = ?
            AND fecha_inicio_semestre <= CURDATE()
            AND CURDATE() <= fecha_fin_semestre";

    $query = $conexion -> prepare($sql);
    $query -> bind_param("s", $_SESSION["cvePersona"]);
    if ($query -> execute()) {
        
        $result = $query -> get_result();
        while ($dato = $result -> fetch_object()) {

            $anio = date("Y", strtotime($dato -> fecha_inicio_semestre));

            $respuesta[] = array(
                "cveImpa_Asig" => $dato -> cveImpa_Asig,
                "cveProfesor" => $_SESSION["cvePersona"],
                "cveCarrera" => $dato -> cveCarrera,
                "cveSemestre"  => $dato -> cveSemestre,
                "cveModalidad"   => $dato -> cveModalidad,
                "nombre_asignatura"   => $dato -> nombre_asignatura,
                "fecha_inicio_semestre"   => $anio
            );
        }
        $query -> close();

    } else {

        die("Ocurrio un error: " . $conexion -> connect_error);
    }

    $json = json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    print_r($json);
    
}
