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
            $correo        = $_POST["correo"];
            $clave         = password_hash($_POST["clave"], PASSWORD_DEFAULT);

            // VALIDAR SI LA MATRICULA YA ESTA REGISTRADA CON UN USUARIO
            $stmt = $conexion -> prepare("SELECT * FROM info_personal WHERE correo = ?");
            $stmt -> bind_param("s", $correo);
            $stmt -> execute();
            $stmt -> store_result();

            if ($stmt -> num_rows == 0) { //No hay columnas, el profesor no existe
                
                //Procede a registrar un alumno
                $stmt = $conexion -> prepare("CALL registrar_profesor (?, ?, ?, ?, ?, ?)");
                $stmt -> bind_param("ssssss", $correo, $clave, $nombre, $pa, $ma, $tel);
                
                if ($stmt -> execute()) {
                    print_r(105); // Registro exitoso
                } else {
                    print_r(103); // Error al insertar
                }

            } else {
                print_r(102); // Usuario ya existente
            }
            
        } else {
            print_r(101); // valores no validos
        }
        
    } else {
        print_r(100); // campos vacios
    }

}