<?php

session_start();

if (isset($_POST)) {
    if (!empty($_POST["matricula"]) and !empty($_POST["asistencia"])) {

        $matricula = trim($_POST["matricula"]);
        $asistencia = $_POST["asistencia"];

        if (empty($_SESSION["pase_lista"])) {
            $_SESSION["pase_lista"] = array();
        }

        $indiceMatricula = buscarAlumno($matricula);

        if ($indiceMatricula != -1) {
            $_SESSION["pase_lista"][$indiceMatricula]["asistencia"] = $asistencia;
        } else {
            $lista = array(
                "matricula" => $matricula,
                "asistencia" => $asistencia
            );
            $_SESSION["pase_lista"][] = $lista;
        }

        $arreglo = array(
            "status" => true,
            "icono" => "success",
            "titulo" => "EXITO!!",
            "texto" => "Registro actualizado",
        );
    } else {
        $arreglo = array(
            "status" => false,
            "icono" => "error",
            "titulo" => "EXITO!!",
            "texto" => "Registro actualizado",
        );
    }
}

function buscarAlumno ($matricula) {
    foreach ($_SESSION["pase_lista"] as $indice => $alumno) {
        if ($alumno["matricula"] === $matricula) {
            return $indice;
        }
    }
    return -1;//retorna -1 si la matricula no esta dentro de la lista
}
