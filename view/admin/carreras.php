<?php include '../../config/global.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documento</title>

    <?php include 'include/estilos.php'; ?>

</head>

<body>

    <?php include 'include/header.php'; ?>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Ingenierías ITSMT</h1>
    </div>

    <div class="container-fluid mb-4">

        <button class="btn btn-success mb-4 rounded-5 fw-bold text-uppercase" type="button" id="btnCrear">Crear</button>

        <?php include 'modals/modal-carrera.php'; ?>

        <div class="table-responsive small">
            <table class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>Clave</th>
                        <th>Nombre de la Ingeniería</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody id="cuerpo_tabla">

                </tbody>
            </table>
        </div>

    </div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Jefes</h1>
    </div>

    <?php include 'include/footer.php'; ?>

    <?php include 'include/scripts.php'; ?>

    <script src="<?= $ruta_raiz ?>view/admin/js/admin-registro-carrera.js"></script>



</body>

</html>