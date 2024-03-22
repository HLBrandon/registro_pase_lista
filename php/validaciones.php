<?php

    // VALIDACIONES PARA LA TABLA USUARIO
    function validarNombre ($nombre) {
        return preg_match("/^([A-ZÁÉÍÓÚÑ][a-záéíóúñ]+(?:\\s[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+)*)$/u", $nombre);
    }

    function validarApellido ($apellido){
        return preg_match("/^[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+$/u", $apellido);
    }

    function validarTelefono ($tel) {
        return preg_match("/^[0-9]{10}+$/", $tel);
    }

    // VALIDACIONES PARA LA TABLA INFO PERSONAL
    function validarCorreo ($correo) {
        //$rule = "/^[a-zA-Z0-9._-]+@martineztorre.tecnm.mx$/";
        //return preg_match($rule, $correo);
        return filter_var($correo, FILTER_VALIDATE_EMAIL);
    }

    function validarPassword ($clave) {
        return preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[#@%*])[A-Za-z\\d#@%*]{5,10}$/", $clave);
    }

    // VALIDACIONES PARA LA TABLA ESTUDIANTE
    function validarMatricula ($matricula) {
        return preg_match("/^[0-9]{3}[A-Za-i][0-9]{4}$/", $matricula);
    }

    function validarFechaIngreso ($fecha) {
        return preg_match("/^(19|20)\d\d-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/", $fecha);
    }

    function validarCarrera ($carrera) {
        return preg_match("/^(IA|IGE|IIA|IMT|ISC)$/", $carrera);
    }


?>