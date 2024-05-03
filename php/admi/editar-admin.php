<?php

include '../conexion.php';
include '../validaciones.php';

if (isset($_POST)) {

    $arreglo = array();

    if (
        // ESTOS NOMBRES VIENEN DESDE LA DATA DEL AJAX
        !empty($_POST["cve"]) and
        !empty($_POST["nombre_usuario"]) and
        !empty($_POST["apellido_pa"]) and
        !empty($_POST["apellido_ma"]) and
        !empty($_POST["telefono"]) and
        !empty($_POST["rfc"]) and
        !empty($_POST["correo"])
    ) {

        if (
            validarNombre($_POST["nombre_usuario"]) and
            validarApellido($_POST["apellido_pa"]) and
            validarApellido($_POST["apellido_ma"]) and
            validarTelefono($_POST["telefono"]) and
            validarCorreo($_POST["correo"])
        ) {
            $id            = $_POST["cve"];
            $nombre        = $_POST["nombre_usuario"];
            $pa            = $_POST["apellido_pa"];
            $ma            = $_POST["apellido_ma"];
            $tel           = $_POST["telefono"];
            $rfc           = $_POST["rfc"];
            $correo        = $_POST["correo"];

            if (empty($_POST["clave"])) {
                $sql = "UPDATE personal_escolar SET RFC = ?, correo = ? WHERE cvePersona = ?";
                $stmt = $conexion->prepare($sql);
                $stmt->bind_param("sss", $rfc, $correo, $id);
                $stmt->execute();

                $sql = "UPDATE usuario SET nombre_persona = ?, apellido_pa = ?, apellido_ma = ?, telefono = ? WHERE cvePersona = ?";
                $stmt = $conexion->prepare($sql);
                $stmt->bind_param("sssss", $nombre, $pa, $ma, $tel, $id);
                $stmt->execute();

                $arreglo = array(
                    "status" => true,
                    "icono" => "success",
                    "titulo" => "EXITO!!",
                    "texto" => "Registro actualizado",
                );
            } else {
                if (validarCorreo($_POST["correo"])) {
                    $clave = password_hash($_POST["clave"], PASSWORD_DEFAULT);
                    $sql = "UPDATE personal_escolar SET RFC = ?, correo = ?, contra = ? WHERE cvePersona = ?";
                    $stmt = $conexion->prepare($sql);
                    $stmt->bind_param("ssss", $rfc, $correo, $clave, $id);
                    $stmt->execute();

                    $sql = "UPDATE usuario SET nombre_persona = ?, apellido_pa = ?, apellido_ma = ?, telefono = ? WHERE cvePersona = ?";
                    $stmt = $conexion->prepare($sql);
                    $stmt->bind_param("sssss", $nombre, $pa, $ma, $tel, $id);
                    $stmt->execute();

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
                        "titulo" => "ADVERTENCIA!!",
                        "texto" => "Valores no validos",
                    );
                }
            }
        } else {
            $arreglo = array(
                "status" => false,
                "icono" => "error",
                "titulo" => "ADVERTENCIA!!",
                "texto" => "Valores no validos",
            );
        }
    } else {
        $arreglo = array(
            "status" => false,
            "icono" => "warning",
            "titulo" => "ADVERTENCIA!!",
            "texto" => "Existen campos vacios",
        );
    }

    $json = json_encode($arreglo, JSON_UNESCAPED_UNICODE); //PERMITE EL USO DE ACENTOS

    print_r($json);

    $stmt -> close();
    $conexion -> close();
}