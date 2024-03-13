
$(document).ready(function () {


    //Inicializar funciones
    listarSemestre();

    function listarSemestre() {
        $.ajax({
            type: "GET",
            url: "../../../php/listar_semestres.php",
            success: function (response) {

                console.log(response); //verifica que lleguen datos en la terminal del navegador

                if (!response.error) {
                    let semestre = JSON.parse(response);
                    let datos = `<option selected value="">Selecciona un semestre</option>`;
                    semestre.forEach(element => {
                        datos += `<option value='${element['cveSemestre']}'>${element['cveSemestre']}</option>`;
                    });
                    $("#select__semestre").html(datos);
                } 
            }
        });
    }

});

//utf8_spanish_ci