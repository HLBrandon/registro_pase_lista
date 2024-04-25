<?php

include '../conexion.php';

if (isset($_POST)) {

    $id = $_POST["cveAsignatura"];

    $sql = "SELECT cveImpa_Asig, cveCarrera, cveSemestre, cveModalidad, cveAsignatura, fecha_inicio_semestre
            FROM asignatura
            NATURAL JOIN impartir_asignatura
            NATURAL JOIN grupo
            WHERE cveImpa_Asig = $id
            AND fecha_inicio_semestre <= CURDATE()
            AND CURDATE() <= fecha_fin_semestre";

    $query = $conexion->query($sql);

    if (!$query) {
        die("Ocurrio un error: " . $conexion->connect_error);
    }

    $arreglo = array();

    while ($row = $query->fetch_object()) {

        $anio = date("Y", strtotime($row -> fecha_inicio_semestre));

        $arreglo[] = array(
            "cveImpa_Asig" => $row->cveImpa_Asig,
            "nombre_asignatura" => $row->cveCarrera . "-" . $row->cveSemestre . $row->cveModalidad."-" . $row->cveAsignatura."-".$anio
        );
    }

    $json = json_encode($arreglo, JSON_UNESCAPED_UNICODE); //PERMITE EL USO DE ACENTOS

    print_r($json);
}
