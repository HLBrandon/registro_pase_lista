<?php

include('config/global.php');

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="<?= $ruta_raiz ?>plugins/toasts/vanillatoasts.css">
    <link rel="stylesheet" href="<?= $ruta_raiz ?>css/login.css">
</head>

<body>

    <div class="contenedor__total">

        <div class="contenedor__login bg-white rounded-3 p-4" style="max-width: 450px;">
            <div class="text-center mb-3">
                <h1>Bienvenid@</h1>
            </div>

            <nav class="mb-3">
                <div class="nav nav-tabs text-center" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Profesor</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Personal</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-jefe" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Jefe</button>
                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Admin</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">

                <!--  FORMULARIO DE ACCESO PARA LOS PROFESORES  -->
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                    <form method="post" id="iniciar-sesion-profesor">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-3" id="correoProfesor" placeholder="@email.com">
                            <label for="correoProfesor">Correo electronico</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control rounded-3" id="claveProfesor" placeholder="Contraseña">
                            <label for="claveProfesor">Contraseña</label>
                        </div>
                        <button class="iniciar w-100 mb-2 btn btn-lg rounded-3 " type="submit">Iniciar sesión</button>
                        <div id="acceso-profesor"></div>
                    </form>
                </div>


                <!--  FORMULARIO DE ACCESO PARA EL PERSONAL DE OFICINA  -->
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                    <form method="post" id="iniciar-sesion-personal">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-3" id="correoPersonal" placeholder="@email.com">
                            <label for="correoPersonal">Correo electronico</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control rounded-3" id="clavePersonal" placeholder="Contraseña">
                            <label for="clavePersonal">Contraseña</label>
                        </div>
                        <button class="iniciar w-100 mb-2 btn btn-lg rounded-3 " type="submit">Iniciar sesión</button>
                        <div id="acceso-personal"></div>
                    </form>
                </div>
                <!--  FORMULARIO DE ACCESO PARA JEFE -->
                <div class="tab-pane fade" id="nav-jefe" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                    <form method="post" id="iniciar-sesion-jefe">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-3" id="correoJefe" placeholder="@email.com">
                            <label for="correoJefe">Correo electronico</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control rounded-3" id="claveJefe" placeholder="Contraseña">
                            <label for="claveJefe">Contraseña</label>
                        </div>
                        <button class="iniciar w-100 mb-2 btn btn-lg rounded-3 " type="submit">Iniciar sesión</button>
                        <div id="acceso-jefe"></div>
                    </form>
                </div>

                <!--  FORMULARIO DE ACCESO PARA ADMIN -->
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
                    <form method="post" id="iniciar-sesion-admin">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-3" id="correoAdmin" placeholder="@email.com">
                            <label for="correoAdmin">Correo electronico</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control rounded-3" id="claveAdmin" placeholder="Contraseña">
                            <label for="claveAdmin">Contraseña</label>
                        </div>
                        <button class="iniciar w-100 mb-2 btn btn-lg rounded-3 " type="submit">Iniciar sesión</button>
                        <div id="acceso-admin"></div>
                    </form>
                </div>

            </div>

            <div class="text-center">
                <img src="<?= $ruta_raiz ?>/img/logo-tec.svg" class="logo" style="height: 15vh;">
            </div>

        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="<?= $ruta_raiz ?>/plugins/toasts/vanillatoasts.js"></script>
    <script src="<?= $ruta_raiz ?>/js/login.js"></script>
</body>

</html>