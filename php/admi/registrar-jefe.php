<?php

include '../conexion.php';
include '../validaciones.php';

if (isset($_POST)) {

    if (
        // ESTOS NOMBRES VIENEN DESDE LA DATA DEL AJAX
        !empty($_POST["nombre_usuario"]) AND 
        !empty($_POST["apellido_pa"]) AND
        !empty($_POST["apellido_ma"]) AND
        !empty($_POST["telefono"]) AND
        !empty($_POST["rfc"]) AND
        !empty($_POST["correo"]) AND
        !empty($_POST["clave"])
    ) {

        if (
            validarNombre($_POST["nombre_usuario"]) AND
            validarApellido($_POST["apellido_pa"]) AND
            validarApellido($_POST["apellido_ma"]) AND
            validarTelefono($_POST["telefono"]) AND
            validarCorreo($_POST["correo"]) AND
            validarPassword($_POST["clave"])
        ) {
            $nombre        = $_POST["nombre_usuario"];
            $pa            = $_POST["apellido_pa"];
            $ma            = $_POST["apellido_ma"];
            $tel           = $_POST["telefono"];
            $rfc           = $_POST["rfc"];
            $correo        = $_POST["correo"];
            $clave         = password_hash($_POST["clave"], PASSWORD_DEFAULT);

            // VALIDAR SI LA MATRICULA YA ESTA REGISTRADA CON UN USUARIO
            $stmt = $conexion -> prepare("SELECT correo FROM personal_escolar WHERE correo = ?");
            $stmt -> bind_param("s", $correo);
            $stmt -> execute();
            $stmt -> store_result();

            if ($stmt -> num_rows == 0) { //No hay columnas, el profesor no existe
                
                //Procede a registrar un alumno
                $stmt = $conexion -> prepare("CALL registrar_jefeCarrera (?, ?, ?, ?, ?, ?, ?)");
                $stmt -> bind_param("sssssss", $correo, $clave, $nombre, $pa, $ma, $tel, $rfc);
                
                if ($stmt -> execute()) {
                    $arreglo = array(
                        "status" => true,
                        "icono" => "success",
                        "titulo" => "CORRECTO!",
                        "texto" => "Jefe de Carrera creado",
                    );
                } else {
                    $arreglo = array(
                        "status" => false,
                        "icono" => "error",
                        "titulo" => "FATAL ERROR",
                        "texto" => "Error Execute Ln 47",
                    );
                }

            } else {
                $arreglo = array(
                    "status" => false,
                    "icono" => "error",
                    "titulo" => "YA EXISTE!!",
                    "texto" => "Este usuario ya existe",
                );
            }
            
        } else {
            $arreglo = array(
                "status" => false,
                "icono" => "error",
                "titulo" => "INCORRECTO!!",
                "texto" => "Existen datos NO validos",
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