<?php

include '../../config/global.php';

?>

<!doctype html>
<html lang="es" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Nueva Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/modals/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link rel="stylesheet" href="<?= $ruta_raiz ?>/css/misClases.css">
</head>

<body>
    <div class="modal modal-sheet position-static d-block p-4 py-md-5" tabindex="-1" role="dialog" id="modalSignin">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <h1 class="fw-bold mb-0 fs-2">Mis clases</h1>
                    <a href="<?= $ruta_raiz ?>/view/user/index.php" class="btn btn-close"></a>
                </div>

                <div class="modal-footer flex-column align-items-stretch w-100 gap-2 pb-3 border-top-0">

                    <a href="clase.php" class="misClases btn btn-lg  ajustes">
                        ISC-1A-2024
                    </a>
                    <a href="" class="misClases btn btn-lg  ajustes">
                        ISC-1A-2024
                    </a>
                    <a href="" class="misClases btn btn-lg  ajustes">
                        ISC-1A-2024
                    </a>
                    <a href="" class="misClases btn btn-lg  ajustes">
                        ISC-1A-2024
                    </a>
                    <a href="" class="misClases btn btn-lg  ajustes">
                        ISC-1A-2024
                    </a>

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>