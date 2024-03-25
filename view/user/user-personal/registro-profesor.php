<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Profesor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= $ruta_raiz ?>/plugins/toasts/vanillatoasts.css">
    
    <link rel="stylesheet" href="<?= $ruta_raiz ?>/css/registro-profesor.css">
</head>

<body class="bg-body-secondary">

    <div class="container" style="max-width: 1000px;">

        <div class="bg-white p-4 rounded-2 my-3 text-center fw-bolder text-uppercase">
            <h3>Registrar Profesor</h3>
        </div>
        <div class="form-container bg-white p-4 rounded-2">

            <form class="row g-3" method="POST" id="form__registro" autocomplete="OFF">

                <div class="col-md-6">
                    <label for="nombre_usuario" class="form-label">Nombre</label>
                    <input type="text" class="form-control border-3" id="nombre_profe" placeholder="Nombre">
                    <span id="alert_nombre" class=""></span>
                </div>
                <div class="col-md-6">
                    <label for="apellido_pa" class="form-label">Apellido Paterno</label>
                    <input type="text" class="form-control border-3" id="apellido_pa_profe" placeholder="Paterno">
                    <span id="alerta_paterno"></span>
                </div>
                <div class="col-md-6">
                    <label for="apellido_ma" class="form-label">Apellido Materno</label>
                    <input type="text" class="form-control border-3" id="apellido_ma_profe" placeholder="Materno">
                    <span id="alerta_materno"></span>
                </div>
                <div class="col-md-6">
                    <label for="telefono" class="form-label">No. Telefono</label>
                    <input type="text" class="form-control border-3" id="telefono_profe" placeholder="Telefono">
                    <span id="alerta_telefono"></span>
                </div>
                <div class="col-12 text-center">
                    <button class="btn btn-primary fw-bolder" type="submit" id="btnGuardar" name="btnGuardar">Guardar</button>
                    <a class="cancelar btn  fw-bold" href="<?= $ruta_raiz ?>/view/user/index.php">Cancelar</a>
                </div>

            </form>
        </div>
        <div class="bg-white p-4 rounded-2 my-3">
            <div class="text-center">
                <img src="<?= $ruta_raiz ?>/imagenes/logo tec.svg" class="logo" style="height: 20vh;">
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>

</html>