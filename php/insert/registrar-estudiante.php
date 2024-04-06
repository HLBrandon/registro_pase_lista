<?php

include '../conexion.php';
include '../validaciones.php';

if (isset($_POST)) {

    if (
        // ESTOS NOMBRES VIENEN DESDE LA DATA DEL AJAX
        !empty($_POST["nombre"]) and
        !empty($_POST["apellido_pa"]) and
        !empty($_POST["apellido_ma"]) and
        !empty($_POST["telefono"]) and
        !empty($_POST["matricula"]) and
        !empty($_POST["carrera"]) and
        !empty($_POST["grupo"]) and
        !empty($_POST["fecha_ingreso"])
    ) {

        if (
            validarNombre($_POST["nombre"]) and
            validarApellido($_POST["apellido_pa"]) and
            validarApellido($_POST["apellido_ma"]) and
            validarTelefono($_POST["telefono"]) and
            validarMatricula($_POST["matricula"]) and
            validarCarrera($_POST["carrera"]) and
            is_numeric($_POST["grupo"]) and
            validarFechaIngreso($_POST["fecha_ingreso"])
        ) {
            $nombre        = $_POST["nombre"];
            $pa            = $_POST["apellido_pa"];
            $ma            = $_POST["apellido_ma"];
            $tel           = $_POST["telefono"];
            $matricula     = $_POST["matricula"];
            $carrera       = $_POST["carrera"];
            $grupo         = $_POST["grupo"];
            $fecha_ingreso = $_POST["fecha_ingreso"];

            // VALIDAR SI LA MATRICULA YA ESTA REGISTRADA CON UN USUARIO
            $stmt = $conexion->prepare("SELECT * FROM estudiante NATURAL JOIN usuario WHERE matricula = ?");
            $stmt->bind_param("s", $matricula);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows == 0) { //No hay columnas, el alumno no existe

                //Procede a registrar un alumno
                $stmt = $conexion->prepare("CALL registrar_estudiante(?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssssss", $nombre, $pa, $ma, $tel, $matricula, $grupo, $carrera, $fecha_ingreso);

                if ($stmt->execute()) {
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
