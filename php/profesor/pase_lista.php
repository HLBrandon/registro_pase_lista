<?php
include '../../config/global.php';

if (isset($_POST)) {

    include '../conexion.php';

    if (!empty($_SESSION["pase_lista"])) {

        if (!empty($_POST["cvePersona"]) AND !empty($_POST["cveImpa_Asig"])) {
            
            $cvePersona = $_POST["cvePersona"];
            $cveImpa_Asig = $_POST["cveImpa_Asig"];

            $conexion -> autocommit(FALSE);

            $sql = "INSERT INTO asistencia (cvePersona, cveImpa_Asig, fecha_asistencia, hora_asistencia)
                    VALUES (?,?,NOW(),NOW())";
            $stmt = $conexion -> prepare($sql);
            $stmt -> bind_param("ss", $cvePersona, $cveImpa_Asig);

            if ($stmt -> execute()) {
                $cveAsistencia = $conexion -> insert_id;

                foreach ($_SESSION["pase_lista"] as $key => $value) {
                    $sql = "INSERT INTO detalle_asistencia (cveAsistencia, matricula, cvePresente)
                            VALUES (?,?,?)";
                    $stmt = $conexion -> prepare($sql);
                    $stmt -> bind_param("sss", $cveAsistencia, $value["matricula"], $value["asistencia"]);
                    if (!$stmt -> execute()) {
                        $conexion -> rollback();
                    }
                }
                $conexion -> commit();
                unset($_SESSION["pase_lista"]);

                $respuesta = array(
                    "status" => true,
                    "titulo" => "EXITO!!",
                    "texto" => "LISTA GUARDADA",
                    "tipo" => "success",
                    "icono" => $ruta_raiz . "plugins/toasts/icons/icon_success.png",
                );

            } else {
                $respuesta = array(
                    "status" => false,
                    "titulo" => "ADVERTENCIA!!",
                    "texto" => "DATOS VACIOS",
                    "tipo" => "error",
                    "icono" => $ruta_raiz . "plugins/toasts/icons/icon_error.png",
                );
            }

        } else {
            $respuesta = array(
                "status" => false,
                "titulo" => "ADVERTENCIA!!",
                "texto" => "DATOS VACIOS",
                "tipo" => "error",
                "icono" => $ruta_raiz . "plugins/toasts/icons/icon_error.png",
            );
        }
        
    } else {
        $respuesta = array(
            "status" => false,
            "titulo" => "ADVERTENCIA!!",
            "texto" => "Debe completar el pase de lista",
            "tipo" => "warning",
            "icono" => $ruta_raiz . "plugins/toasts/icons/icon_warning.png",
        );
    }

    $json = json_encode($respuesta, JSON_UNESCAPED_UNICODE); //PERMITE EL USO DE ACENTOS
    print_r($json);
}