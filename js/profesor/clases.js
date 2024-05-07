$(document).ready(function () {
    const urlParams = new URLSearchParams(window.location.search);
    const cveProfesor = urlParams.get('cveProfesor')
    const cveAsignatura = urlParams.get('cveAsignatura');

    const rutaRaiz = "/pase_lista/";

    $.ajax({
        type: "POST",
        url: rutaRaiz + "php/profesor/clase-profesor.php",
        data: { cveProfesor },
        success: function (response) {
            if (!response.error) {
                let datosProfesor = JSON.parse(response);
                $('#select-profesor').empty();

                $.each(datosProfesor, function (index, item) {
                    $('#select-profesor').append($('<option>', {
                        value: item.cvePersona,
                        text: item.nombre
                    }));
                });
            }
        }
    });

    $.ajax({
        type: "POST",
        url: rutaRaiz + "php/profesor/clase-asignatura.php",
        data: { cveAsignatura },
        success: function (response) {
            if (!response.error) {
                let datosAsignatura = JSON.parse(response);


                $('#select-clase').empty();

                $.each(datosAsignatura, function (index, item) {
                    $('#select-clase').append($('<option>', {
                        value: item.cveImpa_Asig,
                        text: item.nombre_asignatura
                    }));
                });

            }
        }
    });

    $.ajax({
        type: "POST",
        url: rutaRaiz + "php/profesor/listar_alumnos.php",
        data: { cveAsignatura },
        success: function (response) {
            if (!response.error) {
                let alumnos = JSON.parse(response)
                let datos = ``;
                alumnos.forEach(element => {
                    datos += `
                    <div class="bg-body-secondary p-3 rounded-3 mb-3">
                        <div class="row">
                            <div class="col-sm-6 my-auto">
                                <input hidden value="${element['matricula']}" type="text">
                                ${element['nombre_alumno']}
                            </div>
                            <div class="col-sm-6">
                                <select class="form-select seleccionar-presencia" id="matricula">
                                    <option value="" selected>Seleccionar</option>
                                    <option value="1">Presente</option>
                                    <option value="2">No Presente</option>
                                    <option value="3">Retardo</option>
                                </select>
                            </div>
                        </div>
                    </div>
            
            `;
                });

                $("#contenedor-alumnos").html(datos);
            }

        }
    });

    $(document).on("change", ".seleccionar-presencia", function (e) {
        e.preventDefault();
        let fila = e.target.parentNode.parentNode.children[0].children[0];

        let matricula = fila.value;
        let asistencia = $(this).val();



        let datos = {
            "matricula": matricula,
            "asistencia": asistencia
        }

        $.ajax({
            type: "POST",
            url: rutaRaiz + "php/profesor/llenar-asistencia.php",
            data: datos,
            success: function (response) {

            }
        });
    });

    $("#btnGuardar").click(function (e) {
        e.preventDefault();
    
        let camposNoSeleccionados = false;
    
        $(".seleccionar-presencia").each(function () {
            if ($(this).val() === "") {
                camposNoSeleccionados = true;
                return false;
            }
        });
    
        if (camposNoSeleccionados) {
            VanillaToasts.create({
                title: "ADVERTENCIA!!",
                text: "Datos No Seleccionados",
                type: 'info',
                icon: rutaRaiz + "plugins/toasts/icons/icon_info.png",
                timeout: 3000,
            });
    
            return;
        }
    
        let idProfesor = $("#select-profesor").val();
        let idClase = $("#select-clase").val();
    
        let datos = {
            "cvePersona": idProfesor,
            "cveImpa_Asig": idClase
        };
    
        $.ajax({
            type: "POST",
            url: rutaRaiz + "php/profesor/pase_lista.php",
            data: datos,
            success: function (response) {
                if (!response.error) {
                    let data = JSON.parse(response);
    
                    if (data.status) {
                        window.location.reload(Swal.close());
                        VanillaToasts.create({
                            title: data.titulo,
                            text: data.texto,
                            type: data.tipo,
                            icon: data.icono,
                            timeout: 3000,
                        });
                    } else {
                        VanillaToasts.create({
                            title: data.titulo,
                            text: data.texto,
                            type: data.tipo,
                            icon: data.icono,
                            timeout: 3000,
                        });
                    }
                }
            }
        });
    });
    
});