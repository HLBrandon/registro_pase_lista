<!-- Modal -->
<div class="modal fade" id="AdminModal" tabindex="-1" aria-labelledby="AdminModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="AdminModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-5">
                <form class="row g-3" method="POST" id="form__registro" autocomplete="OFF">

                    <div class="col-md-6">
                        <label for="nombre_usuario" class="form-label">Nombre</label>
                        <input type="text" class="form-control border-3" name="nombre_usuario" id="nombre_usuario" placeholder="Nombre">
                        <input hidden type="number" id="cve" name="cve">
                        <span id="alert_nombre" class=""></span>
                    </div>
                    <div class="col-md-6">
                        <label for="apellido_pa" class="form-label">Apellido Paterno</label>
                        <input type="text" class="form-control border-3" name="apellido_pa" id="apellido_pa" placeholder="Paterno">
                        <span id="alerta_paterno"></span>
                    </div>
                    <div class="col-md-6">
                        <label for="apellido_ma" class="form-label">Apellido Materno</label>
                        <input type="text" class="form-control border-3" name="apellido_ma" id="apellido_ma" placeholder="Materno">
                        <span id="alerta_materno"></span>
                    </div>
                    <div class="col-md-6">
                        <label for="rfc" class="form-label">RFC</label>
                        <input type="text" class="form-control border-3" name="rfc" id="rfc" placeholder="RFC">
                        <span id="alerta_rfc"></span>
                    </div>
                    <div class="col-md-6">
                        <label for="telefono" class="form-label">No. Telefono</label>
                        <input type="text" class="form-control border-3" name="telefono" id="telefono" placeholder="Telefono">
                        <span id="alerta_telefono"></span>
                    </div>
                    <div class="col-md-6">
                        <label for="correo" class="form-label">Correo electrónico</label>
                        <input type="text" class="form-control border-3" name="correo" id="correo" placeholder="Correo electrónico">
                        <span id="alerta_correo"></span>
                    </div>
                    <div class="col-md-6">
                        <label for="clave" class="form-label">Contraseña</label>
                        <input type="password" class="form-control border-3" name="clave" id="clave" placeholder="Contraseña">
                        <span id="alerta_clave"></span>
                    </div>
                    <div class="col-12 text-center">
                        <button class="btn btn-primary fw-bolder" type="submit" id="btnGuardar" name="btnGuardar">Guardar</button>
                        <button type="button" class="btn btn-secondary fw-bolder" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>