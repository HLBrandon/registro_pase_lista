<?php

include '../conexion.php';

if (isset($_POST)) {

    if (!empty($_POST["select-clase"]) and !empty($_POST["select-fecha"])) {
        $respuesta = array();

        $sql = "SELECT asis.cveAsistencia, asis.cveImpa_Asig, es.matricula, nombre_persona, apellido_pa, apellido_ma, presente FROM asistencia asis
                INNER JOIN detalle_asistencia da
                ON asis.cveAsistencia = da.cveAsistencia
                INNER JOIN asis_presente asp
                ON da.cvePresente = asp.cvePresente
                INNER JOIN estudiante es
                ON da.matricula = es.matricula
                INNER JOIN usuario us
                ON es.cvePersona = us.cvePersona
                WHERE asis.cveImpa_Asig = ? AND asis.fecha_asistencia = ?";

        $query = $conexion->prepare($sql);
        $query->bind_param("ss", $_POST["select-clase"], $_POST["select-fecha"]);
        if ($query->execute()) {

            $result = $query->get_result();
            while ($dato = $result->fetch_object()) {

                $respuesta[] = array(
                    "status" => true,
                    "cveAsistencia" => $dato->cveAsistencia,
                    "cveImpa_Asig" => $dato->cveImpa_Asig,
                    "matricula" => $dato->matricula,
                    "nombre_estudiante"  => $dato->nombre_persona . " " . $dato->apellido_pa . " " . $dato->apellido_ma,
                    "presente"   => $dato->presente
                );

            }
            $result -> free_result();
            $query->close();
            $conexion -> close();
        } else {
            die("Ocurrio un error: " . $conexion->connect_error);
        }
    } else {
        $respuesta[] = array(
            "status" => false,
            "icono" => "warning",
            "titulo" => "CAMPOS VACIOS!!",
            "texto" => "Debes completar los filtros",
        );
    }

    $json = json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    print_r($json);
}
