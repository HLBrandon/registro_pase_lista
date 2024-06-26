<?php

include '../conexion.php';

$sql = "SELECT cvePersona, nombre_persona, apellido_pa, apellido_ma, correo, telefono, rfc, status FROM user_admin
        NATURAL JOIN personal_escolar
        NATURAL JOIN usuario";

$query = $conexion -> query($sql);

if (!$query) {
    die("Ocurrio un error: " . $conexion -> connect_error);
}

$arreglo = array();

while ($row = $query -> fetch_object()) {
    $arreglo [] = array(
        'cvePersona' => $row -> cvePersona,
        'nombre'     => $row -> nombre_persona . " " . $row -> apellido_pa . " " . $row -> apellido_ma,
        'correo'     => $row -> correo,
        'telefono'   => $row -> telefono,
        'rfc'        => $row -> rfc,
        'status'     => $row -> status,
    );
}

$json = json_encode($arreglo, JSON_UNESCAPED_UNICODE);

print_r($json);

$query -> free_result();

$conexion -> close();


?>