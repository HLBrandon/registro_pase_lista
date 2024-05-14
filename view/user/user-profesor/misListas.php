<?php

include '../../../config/global.php';

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clase</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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
                <h3>Mi historial de pase de lista</h3>
            </div>
        </div>

        <div class="bg-white p-4 rounded-2 mb-3">

            <div class="mb-3">
                <h5>Filtros de busqueda</h5>
            </div>
            <div class="row mb-4">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="select-clase">Clase</label>
                        <select class="form-select" name="select-clase" id="select-clase">
                            <option value="1">ISC-6A-2024</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label" for="select-fecha">Fecha</label>
                        <input class="form-control" value="" type="date" name="select-fecha" id="select-fecha">
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button class="btn btn-primary fw-bold text-uppercase" type="submit">Filtrar</button>
                <a class="btn btn-secondary fw-bold text-uppercase" href="<?= $ruta_raiz ?>/view/user/user-profesor/index.php">cancelar</a>
            </div>

        </div>

        <div class="bg-white p-4 rounded-2 mb-3">

            <div class="text-end">
                <a class="btn btn-success fw-bold text-uppercase" href="">Generar EXCEL</a>
                <a class="btn btn-danger fw-bold text-uppercase" href="">Generar PDF</a>
            </div>

            <div class="table-responsive">
                <table class="table table-sm text-center">
                    <thead>
                        <tr>
                            <th>Matricula</th>
                            <th>Nombre del estudiante</th>
                            <th>Asistencia</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">

                        <tr>
                            <td>1</td>
                            <td>Nombre Apellido Apellido 1</td>
                            <td>Presente</td>
                            <td>
                                <a class="btn btn-sm btn-primary fw-bold" href="">Editar</a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>