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
        <h1 class="h2">Respaldo</h1>
    </div>

    <div class="container-fluid">

        <a href="<?= $ruta_raiz ?>php/admi/backup/backup.php" class="btn btn-lg btn-primary fw-bold rounded-3">Respaldar base de datos</a>

    </div>

    <?php include 'include/footer.php'; ?>

    <?php include 'include/scripts.php'; ?>



</body>

</html>