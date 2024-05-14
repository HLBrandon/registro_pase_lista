<!-- Modal -->
<div class="modal fade" id="jefe_carreraModal" tabindex="-1" aria-labelledby="jefe_carreraModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="jefe_carreraModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form_encargar" autocomplete="OFF">

                    <div class="mb-3">
                        <label for="select-carrera" class="form-label">Carrera</label>
                        <select class="form-select" name="select-carrera" id="select-carrera">
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="select-jefe" class="form-label">Jefe de Carrera</label>
                        <select class="form-select" name="select-jefe" id="select-jefe">
                        </select>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-primary fw-bolder" type="submit" id="btnGuardar_jefeCarrera" name="btnGuardar_jefeCarrera">Guardar</button>
                        <button type="button" class="btn btn-secondary fw-bolder" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>