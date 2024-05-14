<?php
session_start();

if (!empty($_SESSION["cvePersona"])) {
    $cvePersona = $_SESSION["cvePersona"];
    include '../conexion.php';
    $sql = "UPDATE personal_escolar SET conectar = 0 WHERE cvePersona = $cvePersona";
    $update = $conexion -> query($sql);
    $conexion -> close();
}

session_unset();

session_destroy();

header("Location:../../index.php");

?>