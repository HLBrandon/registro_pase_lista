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

                $('#nombreAsignatura').empty();

                $.each(datosAsignatura, function (index, item) {
                    $('#nombreAsignatura').append($('<option>', {
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
                                <input hidden value=" ${element['matricula']}" type="text" name="" id="">
                                ${element['nombre_alumno']}
                            </div>
                            <div class="col-sm-6">
                                <select class="form-select seleccionar-presencia" name="" id="matricula">
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



});