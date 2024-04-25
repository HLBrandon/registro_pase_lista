$(document).ready(function () {
    //Inicializar funciones

    listarGrupo();
    listarCarrera();
    eliminarClases();
    resetearCampos();


    // FUNCIONES PARA LLENAR LOS SELECT

    function listarCarrera() {
        $.ajax({
            type: "GET",
            url: "../../../php/listar_carrera.php",
            success: function (response) {

                if (!response.error) {
                    let carrera = JSON.parse(response);
                    let datos = `<option value=""></option>`;
                    carrera.forEach(element => {
                        datos += `<select class='form-select border-3' name='select__carrera' id='select__carrera'>
                                     <option id = 'optionCarrera' value='${element['cveCarrera']}'>${element['nombre_carrera']}</option>
                                    </select>`;
                    });
                    $("#select__carrera").html(datos);
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
                        datosGrupo += `<option value='${element['cveGrupo']}'> ${element['num_semestre']} - ${element['modalidad']}</option>`;
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


    $("#matricula").blur(function (e) {
        e.preventDefault();
        let matricula = $("#matricula").val();
        if (matricula.length == 8) {
            $("#alerta_matricula").html('');
            $("#alerta_matricula").removeClass('invalid-feedback');
            $(this).removeClass('border-danger is-invalid');

            if (validarMAtricula(matricula)) {
                $("#alerta_matricula").html('');
                $("#alerta_matricula").removeClass('invalid-feedback');
                $(this).removeClass('border-danger is-invalid');
                $(this).addClass('border-success is-valid');
            } else {
                $("#alerta_matricula").html('Matricula no valida');
                $("#alerta_matricula").addClass('invalid-feedback');
                $(this).addClass('border-danger is-invalid');
                $(this).removeClass('border-success is-valid');
            }

        } else {
            $("#alerta_matricula").html('Ingrese 8 caracteres');
            $("#alerta_matricula").addClass('invalid-feedback');
            $(this).addClass('border-danger is-invalid');
        }

    });

    $("#telefono").blur(function (e) {
        e.preventDefault();
        let telefono = $("#telefono").val();
        if (telefono.length == 10) {
            $("#alerta_telefono").html('');
            $("#alerta_telefono").removeClass('invalid-feedback');
            $(this).removeClass('border-danger is-invalid');

            if (validarTelefono(telefono)) {
                $("#alerta_telefono").html('');
                $("#alerta_telefono").removeClass('invalid-feedback');
                $(this).removeClass('border-danger is-invalid');
                $(this).addClass('border-success is-valid');
            } else {
                $("#alerta_telefono").html('Numero de Telefono no valido');
                $("#alerta_telefono").addClass('invalid-feedback');
                $(this).addClass('border-danger is-invalid');
                $(this).removeClass('border-success is-valid');
            }

        } else {
            $("#alerta_telefono").html('Ingrese 10 digitos');
            $("#alerta_telefono").addClass('invalid-feedback');
            $(this).addClass('border-danger is-invalid');
        }

    });

    $("#fecha__ingreso").blur(function (e) {
        e.preventDefault();
        let fechaIngreso = $("#fecha__ingreso").val();
        if (fechaIngreso.length == 10) {
            $("#alerta_fecha").html('');
            $("#alerta_fecha").removeClass('invalid-feedback');
            $(this).removeClass('border-danger is-invalid');

            if (validarFechaIngreso(fechaIngreso)) {
                $("#alerta_fecha").html('');
                $("#alerta_fecha").removeClass('invalid-feedback');
                $(this).removeClass('border-danger is-invalid');
                $(this).addClass('border-success is-valid');
            } else {
                $("#alerta_fecha").html('Fecha de Ingreso no valido');
                $("#alerta_fecha").addClass('invalid-feedback');
                $(this).addClass('border-danger is-invalid');
                $(this).removeClass('border-success is-valid');
            }

        } else {
            $("#alerta_fecha").html('Complete la Fecha');
            $("#alerta_fecha").addClass('invalid-feedback');
            $(this).addClass('border-danger is-invalid');
        }

    });

    $("#select__carrera").on('change', function () {
        if ($(this).val() !== '') {
            $(this).addClass('border-success is-valid');
            $("#alerta_carrera").html('');
            $("#alerta_carrera").removeClass('invalid-feedback');
            $(this).removeClass('border-danger is-invalid');
        } else {
            $(this).removeClass('border-success is-valid');
            $("#alerta_carrera").html('Seleccione una Carrera');
            $("#alerta_carrera").addClass('invalid-feedback');
            $(this).addClass('border-danger is-invalid');
        }
    });

    $("#select__grupo").on('change', function () {
        if ($(this).val() !== '') {
            $(this).addClass('border-success is-valid');
            $("#alerta_grupo").html('');
            $("#alerta_grupo").removeClass('invalid-feedback');
            $(this).removeClass('border-danger is-invalid');
        } else {
            $(this).removeClass('border-success is-valid');
            $("#alerta_grupo").html('Seleccione un Grupo');
            $("#alerta_grupo").addClass('invalid-feedback');
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
    function validarTelefono(telefono) {
        var validar = /^[0-9]{10}/;
        return validar.test(telefono);
    }
    function validarMAtricula(matricula) {
        var validar = /^\d{3}[A-Za-z]\d{4}$/;
        return validar.test(matricula);
    }
    function validarFechaIngreso(fechaIngreso) {
        var validar = /^(19|20)\d\d-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/;
        return validar.test(fechaIngreso);
    }

    function eliminarClases() {
        $("fecha__ingreso").removeClass('border-success is-valid');
    }

    //FUNCION PARA BORRAR CLASES DE LOS INPUT Y SELECT
    function resetearCampos() {
        // Restablecer campos de texto
        $("#nombre_usuario, #apellido_pa, #apellido_ma, #telefono, #matricula, #fecha__ingreso").removeClass('border-success is-valid border-danger is-invalid');
        $("#nombre_usuario, #apellido_pa, #apellido_ma, #telefono, #matricula, #fecha__ingreso").val('');
        // Restablecer campos de select
        $("#select__carrera, #select__grupo").removeClass('border-success is-valid border-danger is-invalid');
        $("#select__carrera, #select__grupo").val('');

        // Restablecer mensajes de alerta
        $("#alert_nombre, #alerta_paterno, #alerta_materno, #alerta_telefono, #alerta_matricula, #alerta_carrera, #alerta_grupo, #alerta_fecha").html('');
        $("#alert_nombre, #alerta_paterno, #alerta_materno, #alerta_telefono, #alerta_matricula, #alerta_carrera, #alerta_grupo, #alerta_fecha").removeClass('invalid-feedback');
    }

    //ENVIAR REGISTRO RUTA DEL ARCHIVO REGISTRAR : "../../../php/insert/registrar-estudiante.php"

    $("#form__registro").submit(function (e) {
        e.preventDefault();

        let nombre = $("#nombre_usuario").val();
        let apellido_pa = $("#apellido_pa").val();
        let apellido_ma = $("#apellido_ma").val();
        let telefono = $("#telefono").val();
        let matricula = $("#matricula").val();
        let carrera = $("#select__carrera").val();
        let grupo = $("#select__grupo").val();
        let fecha_ingreso = $("#fecha__ingreso").val();

        if (nombre !== '' && apellido_pa !== '' && apellido_ma !== '' && telefono !== '' && matricula !== ''
            && carrera !== '' && grupo !== '' && fecha_ingreso !== '') {

            if (validarNombre(nombre) && validarApellido(apellido_pa) && validarApellido(apellido_ma) &&
                validarTelefono(telefono) && validarMAtricula(matricula) && validarFechaIngreso(fecha_ingreso)) {


                const datos = {
                    nombre: nombre,
                    apellido_pa: apellido_pa,
                    apellido_ma: apellido_ma,
                    telefono: telefono,
                    matricula: matricula,
                    carrera: carrera,
                    grupo: grupo,
                    fecha_ingreso: fecha_ingreso
                };

                $.ajax({
                    type: "POST",
                    url: "../../../php/insert/registrar-estudiante.php",
                    data: datos,
                    success: function (response) {
                        if (!response.error) {
                            if (response == 105) {
                                VanillaToasts.create({
                                    title: 'FELICIDADES!',
                                    text: 'Usuario Registrado Correctamente',
                                    type: 'success', //valores aceptados: success, warning, info, error
                                    icon: '../../../plugins/toasts/icons/icon_success.png',
                                    timeout: 3000, // visible 3 segundos
                                });

                                $("#form__registro").trigger("reset");


                            } else if (response == 102) {
                                VanillaToasts.create({
                                    title: 'ADVERTENCIA!',
                                    text: 'Usuario Ya Existente',
                                    type: 'info', //valores aceptados: success, warning, info, error
                                    icon: '../../../plugins/toasts/icons/icon_info.png',
                                    timeout: 3000, // visible 3 segundos
                                });
                                $("#form__registro").trigger("reset");

                            }
                            resetearCampos();

                        }
                    }
                });

            } else {
                VanillaToasts.create({
                    title: 'ADVERTENCIA!',
                    text: 'Valores No Validos',
                    type: 'error', //valores aceptados: success, warning, info, error
                    icon: '../../../plugins/toasts/icons/icon_error.png',
                    timeout: 3000, // visible 3 segundos
                });
                resetearCampos();
            }
        } else {
            VanillaToasts.create({
                title: 'ADVERTENCIA!',
                text: 'Existen Campos Vacios',
                type: 'warning', //valores aceptados: success, warning, info, error
                icon: '../../../plugins/toasts/icons/icon_warning.png',
                timeout: 3000, // visible 3 segundos
            });


        }


    });

});