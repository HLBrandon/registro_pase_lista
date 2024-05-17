$(document).ready(function () {

    const rutaRaiz = "/pase_lista/";

    $.ajax({
        type: "GET",
        url: rutaRaiz + "php/profesor/misClases.php",
        success: function (response) {
            let respuesta = JSON.parse(response);

            $('#select-clase').empty();

            $.each(respuesta, function (index, item) {
                $('#select-clase').append($('<option>', {
                    value: item.cveImpa_Asig,
                    text: item.cveCarrera + '-' + item.cveSemestre + item.cveModalidad + "-" + item.nombre_asignatura + '-' + item.fecha_inicio_semestre
                }));
            });

        }
    });

    $('#filtro_busqueda').submit(function (e) {
        e.preventDefault();

        const datos = {
            "select-clase": $('#select-clase').val(),
            "select-fecha": $('#select-fecha').val()
        }

        let fecha = $('#select-fecha').val();

        $.ajax({
            type: "POST",
            url: rutaRaiz + "php/profesor/misListas.php",
            data: datos,
            success: function (response) {
                if (!response.error) {

                    let respuesta = JSON.parse(response);
                    console.log(respuesta);

                    if (respuesta[0].status) {

                        let tmp = `
                        <div class="text-end">
                            <a class="btn btn-success fw-bold text-uppercase" href="${respuesta[0].cveAsistencia}">Generar EXCEL</a>
                            <a class="btn btn-danger fw-bold text-uppercase" href="${rutaRaiz}php/generar-reportes/profesor/index.php?cveImpa=${respuesta[0].cveImpa_Asig}&fecha=${fecha}">Generar PDF</a>
                        </div>

                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-2 col-form-label fw-bold">CLAVE:</label>
                            <div class="col-md-3">
                                <input disabled type="number" value="${respuesta[0].cveAsistencia}" class="form-control" id="cve_asistencia">
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-sm text-center">
                                <thead>
                                    <tr>
                                        <th>Matricula</th>
                                        <th>Nombre del estudiante</th>
                                        <th>Asistencia</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                        `;

                        respuesta.forEach(element => {
                            tmp += `
                                    <tr>
                                        <td>${element.matricula}</td>
                                        <td>${element.nombre_estudiante}</td>
                                        <td>${element.presente}</td>
                                        <td>
                                            <a class="btn btn-sm btn-primary fw-bold" href="">Editar</a>
                                        </td>
                                    </tr>
                            `;
                        });

                        tmp += `
                                </tbody>
                            </table>
                        </div>
                        `;

                        $("#contenedor_alumnos_clase").html(tmp);

                        

                    } else {
                        VanillaToasts.create({
                            title: respuesta[0].titulo,
                            text: respuesta[0].texto,
                            type: respuesta[0].tipo, //valores aceptados: success, warning, info, error
                            icon: respuesta[0].icono,
                            timeout: 3000, // visible 3 segundos
                        });
                    }

                }
            }
        });

    });


});