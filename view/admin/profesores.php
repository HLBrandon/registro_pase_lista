<?php include '../../config/global.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profesores - Admin</title>

    <?php include 'include/estilos.php'; ?>

</head>

<body>

    <?php include 'include/header.php'; ?>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Profesores</h1>
    </div>

    <div class="container-fluid">

        <button class="btn btn-success rounded-5 fw-bold text-uppercase" type="button" id="btnCrear">Crear</button>

        <?php include 'modals/modal-profesor.php'; ?>

        <div class="table-responsive small">
            <table class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Telefono</th>
                        <th>RFC</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody id="cuerpo_tabla_profesor">

                    <tr>
                        <td>1</td>
                        <td>Brandon</td>
                        <td>brandon@ejemplo.com</td>
                        <td>HELB030517HVZRPRA4</td>
                        <td>2321112233</td>
                        <td class="text-center">
                            <button class="btn btn-primary" id="btnEditar">Editar</button>
                            <button class="btn btn-danger">Eliminar</button>
                        </td>
                    </tr>

                </tbody>
            </table>

        </div>

    </div>

    <?php include 'include/footer.php'; ?>

    <?php include 'include/scripts.php'; ?>

    <script src="<?= $ruta_raiz ?>js/admin/admin-registro-profesor.js"></script>

</body>

</html>