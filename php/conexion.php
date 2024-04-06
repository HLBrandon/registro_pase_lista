<?php

$conexion = new mysqli('localhost', 'root', '', 'pase_lista_itsmt','3306');
if ($conexion -> connect_error) {
    print_r('ERROR AL CONECTAR: ' . $conexion -> connect_error);
    exit();
}