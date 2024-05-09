<!-- Modal -->
<div class="modal fade" id="carreraModal" tabindex="-1" aria-labelledby="carreraModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="carreraModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form__registro" autocomplete="OFF">

                    <div class="mb-3">
                        <label for="cveCarrera" class="form-label">Clave*</label>
                        <input type="text" class="form-control border-3" name="cveCarrera" id="cveCarrera" placeholder="Clave">
                        <span id="alert_nombre" class=""></span>
                    </div>
                    <div class="mb-3">
                        <label for="nombre_carrera" class="form-label">Nombre de Ingenieria*</label>
                        <input type="text" class="form-control border-3" name="nombre_carrera" id="nombre_carrera" placeholder="Nombre">
                        <span id="alerta_paterno"></span>
                    </div>

                    <div class="text-center mb-3">
                        <span>* Campos obligatorios</span>
                    </div>


                    <div class="text-center">
                        <button class="btn btn-primary fw-bolder" type="submit" id="btnGuardar" name="btnGuardar">Guardar</button>
                        <button type="button" class="btn btn-secondary fw-bolder" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>