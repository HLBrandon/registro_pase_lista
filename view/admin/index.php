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
        <h1 class="h2">Home</h1>
    </div>

    <div class="container-fluid">

        Cuerpo del contenido

        <div class="table-responsive small">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th class="text-center">Online</th>
                    </tr>
                </thead>
                <tbody id="cuerpo_tabla">

                </tbody>
            </table>

        </div>

    </div>

    <?php include 'include/footer.php'; ?>

    <?php include 'include/scripts.php'; ?>

    <script src="<?= $ruta_raiz ?>view/admin/js/admin-home.js"></script>

</body>

</html>