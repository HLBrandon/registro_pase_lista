
$(document).ready(function () {


    //Inicializar funciones
    listarSemestre();
    listarModalidad();

    function listarSemestre() {
        $.ajax({
            type: "GET",
            url: "../../../php/listar_semestres.php",
            success: function (response) {

                console.log(response); //verifica que lleguen datos en la terminal del navegador

                if (!response.error) {
                    let semestre = JSON.parse(response);
                    let datos = `<option  value="">Selecciona un semestre</option>`;
                    semestre.forEach(element => {
                        datos += `<option value='${element['cveSemestre']}'>${element['num_semestre']}</option>`;
                    });
                    $("#select__semestre").html(datos);
                }
            }
        });
    }

    function listarModalidad() {
        $.ajax({
            type: "GET",
            url: "../../../php/listar_modalidad.php",
            success: function (response) {
                if (!response.error) {
                    let modalidad = JSON.parse(response);
                    let datosModalidad = `<option  value="">Selecciona la Modalidad</option>`;
                    modalidad.forEach(element => {
                        datosModalidad += `<option value='${element['cveModalidad']}'>${element['modalidad']}</option>`;
                    });
                    $("#select__modalidad").html(datosModalidad);
                }

            }
        });
    }

});

//utf8_spanish_ci