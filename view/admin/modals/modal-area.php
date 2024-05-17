<!-- Modal -->
<div class="modal fade" id="areaModal" tabindex="-1" aria-labelledby="areaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="areaModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form__registro" autocomplete="OFF">

                    <div class="mb-3">
                        <label for="nombre_area" class="form-label">Nombre de Área*</label>
                        <input type="text" class="form-control border-3" name="nombre_area" id="nombre_area" placeholder="Nombre">
                        <input hidden type="number" id="cveArea" name="cveArea">
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