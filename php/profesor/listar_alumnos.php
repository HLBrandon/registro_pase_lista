<?php

include '../conexion.php';

if (isset($_POST)) {

    $id = $_POST["cveAsignatura"];

    $sql = "SELECT es.matricula, nombre_persona, apellido_pa, apellido_ma FROM usuario us
            JOIN estudiante es ON us.cvePersona = es.cvePersona
            JOIN asignatura_alumnos aa ON es.matricula = aa.matricula
            JOIN impartir_asignatura ia ON aa.cveImpa_Asig = ia.cveImpa_Asig
            WHERE ia.cveImpa_Asig = $id";

    $query = $conexion->query($sql);

    if (!$query) {
        die("Ocurrio un error: " . $conexion->connect_error);
    }

    $arreglo = array();

    while ($row = $query->fetch_object()) {

        $arreglo[] = array(
            "matricula" => $row->matricula,
            "nombre_alumno" => $row->nombre_persona . " " . $row->apellido_pa . " " . $row->apellido_ma
        );

    }

    $json = json_encode($arreglo, JSON_UNESCAPED_UNICODE); //PERMITE EL USO DE ACENTOS

    print_r($json);
}
