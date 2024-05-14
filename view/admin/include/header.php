<header class="navbar sticky-top  flex-md-nowrap p-2" data-bs-theme="dark">
    <div class="container-fluid">
        <a href="<?= $ruta_raiz ?>view/admin/"><img src="../../img/logo_itsmt.png" class="logo" alt="Logo"></a>
        <a class="titulo navbar-brand col-md-3  px-3" href="<?= $ruta_raiz ?>view/admin/">ITSMT</a>
        <a href="<?= $ruta_raiz ?>view/admin/"><img src="../../img/logo_tecNM.png" class="logotecnm" alt="Logo"></a>
        <ul class="navbar-nav flex-row d-md-none">
            <li class="nav-item text-nowrap">
                <button class="nav-link px-3 text-white fs-4" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="bi bi-list"></i>
                </button>
            </li>
        </ul>
    </div>
</header>
<div class="b-example-divider"></div>
<div class="container-fluid">
    <div class="row">

        <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
            <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
                <!-- <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="sidebarMenuLabel">ITSMT</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
                </div>-->

                <div class="fondo d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">

                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="<?= $ruta_raiz ?>view/admin/">
                                <i class="bi bi-house-fill"></i>
                                Inicio
                            </a>

                        </li>
                        <h6 class="uc sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 ">
                            <span>Usuarios</span>
                        </h6>
                        <li class="nav-item diseño">
                            <a class="oficina nav-link d-flex align-items-center gap-2" href="<?= $ruta_raiz ?>view/admin/oficinistas.php">
                                Oficinistas
                            </a>
                        </li>
                        <li class="nav-item diseño">
                            <a class="nav-link d-flex align-items-center gap-2" href="<?= $ruta_raiz ?>view/admin/profesores.php">
                                Profesores
                            </a>
                        </li>
                        <li class="nav-item diseño">
                            <a class="nav-link d-flex align-items-center gap-2" href="<?= $ruta_raiz ?>view/admin/jefes-carrera.php">
                                Jefes de Carrera
                            </a>
                        </li>
                        <li class="nav-item diseño">
                            <a class="nav-link d-flex align-items-center gap-2" href="<?= $ruta_raiz ?>view/admin/administradores.php">
                                Administradores
                            </a>
                        </li>
                    </ul>

                    <h6 class="uc sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1">
                        <span>Complementos</span>
                    </h6>
                    <ul class="nav flex-column mb-auto">
                        <li class="nav-item diseño">
                            <a class="nav-link d-flex align-items-center gap-2" href="<?= $ruta_raiz ?>view/admin/carreras.php">
                                Carreras
                            </a>
                        </li>
                        <li class="nav-item diseño">
                            <a class="nav-link d-flex align-items-center gap-2" href="<?= $ruta_raiz ?>view/admin/backup.php">
                                Respaldo
                            </a>
                        </li>
                    </ul>

                    <hr class="my-3">

                    <ul class="nav flex-column mb-auto">
                        <li class="nav-item diseño">
                            <a class="nav-link d-flex align-items-center gap-2" href="#">
                                <i class="bi bi-sliders2"></i>
                                Configuración
                            </a>
                        </li>
                        <li class="nav-item diseño">
                            <a class="nav-link d-flex align-items-center gap-2" href="<?= $ruta_raiz ?>php/login/logout.php">
                                <i class="bi bi-door-closed"></i>
                                Cerrar Sesión
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">