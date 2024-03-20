<?php

    function validarNombre ($nombre) {
        return preg_match("/^([A-ZÁÉÍÓÚÑ][a-záéíóúñ]+(?:\\s[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+)*)$/u", $nombre);
    }

    function validarApellido ($apellido){
        return preg_match("/^[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+$/u", $apellido);
    }

    function validarTelefono ($tel) {
        return preg_match("/^[0-9]{10}+$/", $tel);
    }

    function validarCorreo ($correo) {
        //$rule = "/^[a-zA-Z0-9._-]+@martineztorre.tecnm.mx$/";
        //return preg_match($rule, $correo);
        return filter_var($correo, FILTER_VALIDATE_EMAIL);
    }

    function validarPassword ($clave) {
        return preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[#@%*])[A-Za-z\\d#@%*]{5,10}$/", $clave);
    }


?>