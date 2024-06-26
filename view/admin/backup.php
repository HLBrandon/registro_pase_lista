<?php include '../../config/global.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respaldo</title>

    <?php include 'include/estilos.php'; ?>

</head>

<body>

    <?php include 'include/header.php'; ?>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><i class="bi bi-database me-2"></i>Respaldo Base de Datos</h1>
    </div>

    <div class="container-fluid">

        <a href="<?= $ruta_raiz ?>php/admi/backup/backup.php" class="btn btn-lg btn-primary fs-2 fw-bold text-uppercase rounded-3">
            Respaldar<i class="bi bi-database-fill-down ms-3"></i>
        </a>

    </div>

    <?php include 'include/footer.php'; ?>

    <?php include 'include/scripts.php'; ?>



</body>

</html>