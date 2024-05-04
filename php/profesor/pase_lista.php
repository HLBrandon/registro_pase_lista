<?php
include '../../config/global.php';

if (isset($_POST)) {

    include '../conexion.php';

    if (!empty($_SESSION["pase_lista"])) {

        if (!empty($_POST["cvePersona"]) and !empty($_POST["cveImpa_Asig"])) {

            $cvePersona = $_POST["cvePersona"];
            $cveImpa_Asig = $_POST["cveImpa_Asig"];

            $num_pase = count($_SESSION["pase_lista"]);

            $sql = "SELECT COUNT(*) AS 'total' FROM asignatura_alumnos WHERE cveImpa_Asig = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("s", $cveImpa_Asig);

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($dato = $result->fetch_object()) {
                    $total_alumnos = $dato->total;
                    if ($total_alumnos == $num_pase) {
                        $sql = "INSERT INTO asistencia (cvePersona, cveImpa_Asig, fecha_asistencia, hora_asistencia)
                    VALUES (?,?,NOW(),NOW())";
                        $stmt = $conexion->prepare($sql);
                        $stmt->bind_param("ss", $cvePersona, $cveImpa_Asig);

                        if ($stmt->execute()) {
                            $cveAsistencia = $conexion->insert_id;

                            foreach ($_SESSION["pase_lista"] as $key => $value) {
                                $sql = "INSERT INTO detalle_asistencia (cveAsistencia, matricula, cvePresente)
                            VALUES (?,?,?)";
                                $stmt = $conexion->prepare($sql);
                                $stmt->bind_param("sss", $cveAsistencia, $value["matricula"], $value["asistencia"]);
                                $stmt->execute();
                            }
                            $conexion->commit();
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
                                "texto" => "ERROR FATAL",
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
                }
            } else {
                $respuesta = array(
                    "status" => false,
                    "titulo" => "ADVERTENCIA!!",
                    "texto" => "ERROR FATAL",
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
