<?php

include '../../../config/global.php';

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Estudiantes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body class="bg-body-secondary">

    <div class="container" style="max-width: 1000px;">

        <div class="bg-white p-4 rounded-2 my-3 text-center fw-bolder text-uppercase">
            <h3>Registrar Estudiantes</h3>
        </div>
        <div class="form-container bg-white p-4 rounded-2">

            <form class="row g-3" id="form__registro">

                <div class="col-md-6">
                    <label for="nombre_usuario" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre_usuario" placeholder="Nombre" required>
                </div>
                <div class="col-md-6">
                    <label for="apellido_pa" class="form-label">Apellido Paterno</label>
                    <input type="text" class="form-control" id="apellido_pa" placeholder="Paterno" required>
                </div>
                <div class="col-md-6">
                    <label for="apellido_ma" class="form-label">Apellido Materno</label>
                    <input type="text" class="form-control" id="apellido_ma" placeholder="Materno" required>
                </div>
                <div class="col-md-6">
                    <label for="telefono" class="form-label">No. Telefono</label>
                    <input type="text" class="form-control" id="telefono" placeholder="Telefono" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="select__semestre">Semestre</label>
                    <select class="form-select" name="select__semestre" id="select__semestre">
                       
                     
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="select__modalidad">Modalidad</label>
                    <select class="form-select" name="select__modalidad" id="select__modalidad">
                        
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="select__carrera">Carrera</label>
                    <select class="form-select" name="select__carrera" id="select__carrera">
                        
                    </select>
                </div>
                <!--
                <div class="col-md-6">
                    <label for="correo_usuario" class="form-label">Correo Electronico</label>
                    <div class="input-group">
                        <span class="input-group-text" id="inputGroupPrepend2">@</span>
                        <input type="text" class="form-control" id="correo_usuario" placeholder="@email.com" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="contra_usuario" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="contra_usuario" placeholder="Contraseña" required>
                </div> -->

                <div class="col-12 text-center">
                    <button class="btn btn-primary fw-bolder" type="submit">Guardar</button>
                    <a class="btn btn-secondary fw-bold" href="<?= $ruta_raiz ?>/view/user/index.php">Cancelar</a>
                </div>

            </form>
        </div>
        <div class="bg-white p-4 rounded-2 my-3">
            <div class="text-center">
                <img src="<?= $ruta_raiz ?>/imagenes/logo tec.svg" class="logo" style="height: 20vh;">
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="<?= $ruta_raiz ?>/js/register-estudiante.js"></script>
</body>

</html>