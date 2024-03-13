<?php

include '../../config/global.php';

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="<?= $ruta_raiz ?>/css/estilosIndex.css">
  <title>Home</title>
</head>

<body>

  <div class="modal modal-sheet position-static d-block p-4 py-md-5" tabindex="-1" role="dialog" id="modalSheet">
    <div class="modal-dialog" role="document">
      <div class="modal-content rounded-4 shadow">
        <div class="bienvenido text-center p-1 " margin-top: 1rem; ">
          <h1 class=" text">Bienvenid@</h1><br>
        </div>
        <div class="modal-body py-0 text-center">
          <h3>Nombre Profesor</h3>
          <p>Correo electronico</p>
        </div>
        <div class="modal-footer flex-column align-items-stretch w-100 gap-2 pb-3 border-top-0">

          <a href="<?= $ruta_raiz ?>/view/user/misClases.php" class="btn btn-lg btn-secondary ajustes">
            Mis clases
          </a>
          <a href="<?= $ruta_raiz ?>/view/user/misListas.php" class="btn btn-lg btn-secondary ajustes">
            Historial de pases
          </a>
          <a href="<?= $ruta_raiz ?>/view/user/cambiarContra.php" class="btn btn-lg btn-secondary ajustes">
            Ajustes
          </a>

          <button type="button" class="cerrar btn btn-lg btn-secondary">Cerrar sesión</button>
          <img src="<?= $ruta_raiz ?>/imagenes/logo tec.svg" class="logo">
        </div>
      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>