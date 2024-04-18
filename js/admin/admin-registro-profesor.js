$(document).ready(function () {

    let opcion = 0;

    //const ruta_raiz = '//' + window.location.host + '/';
    const ruta_raiz = '/pase_lista/';

    console.log(ruta_raiz);

    const modal = new bootstrap.Modal(document.getElementById('ProfesorModal'));

    validarCampo("#nombre_usuario", 2, "#alert_nombre", validarNombre);
    validarCampo("#apellido_pa", 2, "#alerta_paterno", validarApellido);
    validarCampo("#apellido_ma", 2, "#alerta_materno", validarApellido);
    validarCampo("#correo", 10, "#alerta_correo", validarCorreo);
    validarCampo("#clave", 10, "#alerta_clave", validarPassword);

    function validarCampo(selector, tamaño, idSpan, validar) {
        $(selector).blur(function (e) {
            e.preventDefault();
            let valorCampo = $(this).val();
            if (valorCampo.length >= tamaño) {
                $(idSpan).html('');
                $(idSpan).removeClass('invalid-feedback');
                $(this).removeClass('border-danger is-invalid');

                if (validar(valorCampo)) {
                    $(idSpan).html('');
                    $(idSpan).removeClass('invalid-feedback');
                    $(this).removeClass('border-danger is-invalid');
                    $(this).addClass('border-success is-valid');
                } else {
                    $(idSpan).html('Campo no válido');
                    $(idSpan).addClass('invalid-feedback');
                    $(this).addClass('border-danger is-invalid');
                    $(this).removeClass('border-success is-valid');
                }
            } else {
                $(idSpan).html('Ingrese un valor válido');
                $(idSpan).addClass('invalid-feedback');
                $(this).addClass('border-danger is-invalid');
            }
        });
    }

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

    //FUNCION PARA BORRAR CLASES DE LOS INPUT
    function resetearCampos() {
        // Restablecer campos de texto
        $("#nombre_usuario, #apellido_pa, #apellido_ma, #telefono, #correo, #clave").removeClass('border-success is-valid border-danger is-invalid');
        $("#nombre_usuario, #apellido_pa, #apellido_ma, #telefono, #correo, #clave").val('');
        // Restablecer mensajes de alerta
        $("#alert_nombre, #alerta_paterno, #alerta_materno, #alerta_telefono, #alerta_correo, #alerta_clave").html('');
        $("#alert_nombre, #alerta_paterno, #alerta_materno, #alerta_telefono, #alerta_correo, #alerta_clave").removeClass('invalid-feedback');
    }

    $("#btnCrear").click(function (e) {
        e.preventDefault();
        $("#ProfesorModalLabel").html("Registrar Profesor");
        $("#btnGuardar").html("Registrar");
        modal.show();
        opcion = 1;
    });

    $("#btnEditar").click(function (e) {
        e.preventDefault();
        $("#ProfesorModalLabel").html("Editar Profesor");
        $("#btnGuardar").html("Guardar");
        modal.show();
        opcion = 2;
    });

    $("#form__registro").submit(function (e) {
        e.preventDefault();
        if (opcion == 1) {
            let nombre_usuario = $("#nombre_usuario").val();
            let apellido_pa = $("#apellido_pa").val();
            let apellido_ma = $("#apellido_ma").val();
            let telefono = $("#telefono").val();
            let correo = $("#correo").val();
            let clave = $("#clave").val();

            /*SI LOS CAMPOS NO ESTAN VACIOS*/
            if (nombre_usuario !== '' && apellido_pa !== '' && apellido_ma !== ''
                && telefono !== '' && correo !== '' && clave !== '') {

                if (validarNombre(nombre_usuario) && validarApellido(apellido_pa) && validarApellido(apellido_ma)
                    && validarTelefono(telefono) && validarCorreo(correo) && validarPassword(clave)) {

                    var formulario = new FormData(this);
                    $.ajax({
                        type: "POST",
                        url: "../../../php/insert/registrar-profesor.php",
                        data: formulario,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            if (!response.error) {
                                if (response == 105) {
                                    VanillaToasts.create({
                                        title: 'FELICIDADES!',
                                        text: 'Usuario Registrado Correctamente',
                                        type: 'success', //valores aceptados: success, warning, info, error
                                        icon: ruta_raiz + 'plugins/toasts/icons/icon_success.png',
                                        timeout: 3000, // visible 3 segundos
                                    });

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
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Your work has been saved",
                    showConfirmButton: false,
                    timer: 1500
                });

            }
        } else {
            alert("Editar");
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

    function validarCorreo(correo) {
        var validar = /^[a-zA-Z0-9._-]+@martineztorre.tecnm.mx+$/;
        return validar.test(correo);
    }

    function validarPassword(clave) {
        var validar = /^(?=.*\d)(?=.*[@#%*,])[A-Z][a-zA-Z\d#@%*,]{1,20}$/;
        return validar.test(clave);
    }



});