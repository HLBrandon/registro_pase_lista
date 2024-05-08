<?php

include '../../../config/global.php';


$cveAsignatura = (!empty($_GET["cveAsignatura"])) ? $_GET["cveAsignatura"] : "";
$cveProfesor = (!empty($_GET["cveProfesor"])) ? $_GET["cveProfesor"] : "";

if ($cveAsignatura == "" || $cveProfesor == "") {
    echo "Parece que ha ocurrido un error";
    die();
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clase</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= $ruta_raiz ?>/plugins/toasts/vanillatoasts.css">

    <style>
        .contenedor {
            max-width: 1000px;
        }
    </style>
</head>

<body class="bg-body-secondary">

    <div class="container contenedor">
        <div class="bg-white p-2 rounded-2 my-3">
            <div class="text-center fw-bolder">
                <h3>Asistencia</h3>
                <?php
                print_r($_SESSION["pase_lista"]);
                ?>
            </div>
        </div>
        <div class="bg-white p-4 rounded-2 mb-3">

            <div class="row">
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label class="form-label" for="">Profesor</label>
                        <select class="form-select" name="select-profesor" disabled id="select-profesor">
                            <option value="" id="nombreProfesor"></option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label class="form-label" for="">Clase</label>
                        <select class="form-select" name="select-profesor" disabled id="select-clase">
                            <option id="nombreAsignatura" value=""></option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label class="form-label" for="">Fecha</label>
                        <input class="form-control" value="<?= date("Y-m-d"); ?>" type="date" disabled>
                    </div>
                </div>
            </div>

            <hr>

            <div class="mb-3">
                <h4>Lista de estudiantes</h4>
            </div>

            <div class="">

                <div id="contenedor-alumnos">

                </div>

                <div class="text-center">
                    <button class="btn btn-primary fw-bolder text-uppercase" type="button" id="btnGuardar">Guardar Lista</button>
                    <a class="btn btn-secondary fw-bolder text-uppercase" href="<?= $ruta_raiz ?>/view/user/user-profesor/misClases.php">Cancelar</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="<?= $ruta_raiz ?>plugins/toasts/vanillatoasts.js"></script>
    <script src="<?= $ruta_raiz ?>js/profesor/clases.js"></script>

</body>

</html>