
$(document).ready(function () {


    //Inicializar funciones
    listarSemestre();
    listarModalidad();
    listarGrupo();
    listarCarrera();

    // FUNCIONES PARA LLENAR LOS SELECT

    function listarSemestre() {
        $.ajax({
            type: "GET",
            url: "../../../php/listar_semestres.php",
            success: function (response) {
                if (!response.error) {
                    let semestre = JSON.parse(response);
                    let datos = `<option value="">Selecciona un semestre</option>`;
                    semestre.forEach(element => {
                        datos += `<option value='${element['cveSemestre']}'>${element['num_semestre']}</option>`;
                    });
                    $("#select__semestre").html(datos);
                }
            }
        });
    }

    function listarCarrera() {
        $.ajax({
            type: "GET",
            url: "../../../php/listar_carrera.php",
            success: function (response) {

                if (!response.error) {
                    let carrera = JSON.parse(response);
                    let datos = `<option value="">Selecciona una Carrera</option>`;
                    carrera.forEach(element => {
                        datos += `<option value='${element['cveCarrera']}'>${element['nombre_carrera']}</option>`;
                    });
                    $("#select__carrera").html(datos);
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
                    let datosModalidad = `<option value="">Selecciona la modalidad</option>`;
                    modalidad.forEach(element => {
                        datosModalidad += `<option value='${element['cveModalidad']}'>${element['modalidad']}</option>`;
                    });
                    $("#select__modalidad").html(datosModalidad);
                }

            }
        });
    }

    function listarGrupo() {
        $.ajax({
            type: "GET",
            url: "../../../php/listar_grupo.php",
            success: function (response) {
                let grupo = JSON.parse(response);
                if (!response.error) {
                    let datosGrupo = `<option value="">Selecciona un grupo</option>`;
                    grupo.forEach(element => {
                        datosGrupo += `<option value='${element['cveGrupo']}'>${element['num_semestre']} - ${element['modalidad']}</option>`;
                    });
                    $("#select__grupo").html(datosGrupo);
                }

            }
        });
    }

    // VALIDAR LOS CAMPOS DE LOS INPUTS Y SELECTS

    $('#nombre_usuario').blur(function (e) { // Evento blur es igual al Lost Focus de Java
        e.preventDefault();

        let nombre = $(this).val(); // recupera el valor del input, su usa el this para hacer referencia al id

        if (nombre.length > 3) { // verifica que el valor ingresado tenga más de tres digitos

            $('#alert_nombre').html(''); // Vaciar alerta 
            $('#alert_nombre').removeClass('invalid-feedback'); // remover color rojo de la alerta
            $(this).removeClass('border-danger is-invalid'); // remover borde rojo e icono

            if (validarNombre(nombre)) {// Llamada de la función donde se usa la expresion regular

                $('#alert_nombre').html(''); // Vaciar la alerta
                $('#alert_nombre').removeClass('invalid-feedback'); //remover la clase de la alerta
                $(this).removeClass('border-danger is-invalid'); // remueve dos clases del input donde se genera el evento
                $(this).addClass('border-success is-valid'); // agregar clases con un borde verde y afirmación
            } else {
                $('#alert_nombre').html('Nombre no valido'); // Agregar un mensaje a la alerta
                $('#alert_nombre').addClass('invalid-feedback');// agregar color rojo a la alerta
                $(this).removeClass('border-success is-valid');// quita el borde verde y la paloma verde
                $(this).addClass('border-danger is-invalid');// agrega el borde rojo y el icono de alerta
            }
        } else {
            $('#alert_nombre').html('Ingresar un nombre más largo');// Llena el span de alerta
            $('#alert_nombre').addClass('invalid-feedback'); // clase de bootstrap que pone un iconoco de alerta
            $(this).addClass('border-danger is-invalid'); // clase de bootstrap que pone el borde rojo
        }

    });

    $("#apellido_pa").blur(function (e) {
        e.preventDefault();
        let apellidoP = $(this).val();
        if (apellidoP.length > 2) {
            $("#alerta_paterno").html('');
            $("#alerta_paterno").removeClass('invalid-feedback');
            $(this).removeClass('border-danger is-invalid');

            if (validarApellido(apellidoP)) {
                $("#alerta_paterno").html('');
                $("#alerta_paterno").removeClass('invalid-feedback');
                $(this).removeClass('border-danger is-invalid');
                $(this).addClass('border-success is-valid');
            } else {
                $("#alerta_paterno").html('Apellido no valido');
                $("#alerta_paterno").addClass('invalid-feedback');
                $(this).addClass('border-danger is-invalid');
                $(this).removeClass('border-success is-valid');
            }

        } else {
            $("#alerta_paterno").html('Ingresar un apellido más largo');
            $("#alerta_paterno").addClass('invalid-feedback');
            $(this).addClass('border-danger is-invalid');
        }
    });

    $("#apellido_ma").blur(function (e) {
        e.preventDefault();
        let apellidoM = $("#apellido_ma").val();
        if (apellidoM.length > 2) {
            $("#alerta_materno").html('');
            $("#alerta_materno").removeClass('invalid-feedback');
            $(this).removeClass('border-danger is-invalid');

            if (validarApellido(apellidoM)) {
                $("#alerta_materno").html('');
                $("#alerta_materno").removeClass('invalid-feedback');
                $(this).removeClass('border-danger is-invalid');
                $(this).addClass('border-success is-valid');
            } else {
                $("#alerta_materno").html('Apellido no valido');
                $("#alerta_materno").addClass('invalid-feedback');
                $(this).addClass('border-danger is-invalid');
                $(this).removeClass('border-success is-valid');
            }

        } else {
            $("#alerta_materno").html('Ingresar un apellido más largo');
            $("#alerta_materno").addClass('invalid-feedback');
            $(this).addClass('border-danger is-invalid');
        }

    });

    //EXPRESIONES REGULARES

    function validarNombre(nombre) {
        var validar = /^[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+(?:\s[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+)*$/;
        return validar.test(nombre);
    }
    function validarApellido(apellido) {
        var validar = /^[A-ZÁÉÍÓÚÑ][a-záéíóúñ]+$/;
        return validar.test(apellido);
    }

    //ENVIAR REGISTRO RUTA DEL ARCHIVO REGISTRAR : "../../../php/insert/registrar-estudiante.php"

});

//utf8_spanish_ci