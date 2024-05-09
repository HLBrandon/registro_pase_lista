$(document).ready(function () {

    let opcion = 0;
    //const ruta_raiz = '//' + window.location.host + '/';
    const ruta_raiz = '/pase_lista/';

    listar_profesor();

    function listar_profesor() {
        $.ajax({
            type: "GET",
            url: ruta_raiz + "php/admi/listar_profesor.php",
            success: function (response) {
                if (!response.error) {
                    let datos = JSON.parse(response);
                    let temp = "";
                    datos.forEach(element => {
                        temp += `
                            <tr>
                                <td>${element["cvePersona"]}</td>
                                <td>${element["nombre"]}</td>
                                <td>${element["correo"]}</td>
                                <td>${element["telefono"]}</td>
                                <td>${element["rfc"]}</td>
                                <td class="text-center">${(element["status"] == 1) ? '<span class="badge text-bg-success">Activo</span>' : '<span class="badge text-bg-danger">Inactivo</span>'}</td>
                                <td class="text-center">
                                    <button class="btn btn-primary btnEditar">Editar</button>
                                    ${(element["status"] == 1) ? '<button class="btn btn-danger btnEliminar">Eliminar</button>' : '<button class="btn btn-success btnActivar">Activar</button>'}
                                </td>
                            </tr>
                        `;
                    });

                    $("#cuerpo_tabla_profesor").html(temp);
                }
            }
        });
    }

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
        $("#form__registro").trigger("reset");
        resetearCampos();
        modal.show();
        opcion = 1;
    });

    $(document).on("click", ".btnEditar", function (e) {
        e.preventDefault();
        $("#ProfesorModalLabel").html("Editar Profesor");
        $("#btnGuardar").html("Guardar");

        let fila = e.target.parentNode.parentNode;
        let id_profesor = fila.children[0].innerHTML;
        console.log(id_profesor);

        $.ajax({
            type: "POST",
            url: ruta_raiz + "php/admi/optener_profesor.php",
            data: { id_profesor },
            success: function (response) {
                console.log(response);
                if (!response.error) {
                    let dato = JSON.parse(response);
                    console.log(dato);
                    $("#nombre_usuario").val(dato.nombre_persona);
                    $("#cve").val(dato.cvePersona);
                    $("#apellido_pa").val(dato.apellido_pa);
                    $("#apellido_ma").val(dato.apellido_ma);
                    $("#telefono").val(dato.telefono);
                    $("#rfc").val(dato.rfc);
                    $("#correo").val(dato.correo);
                }
            }
        });

        modal.show();
        opcion = 2;
    });

    $(document).on("click", ".btnEliminar", function (e) {
        e.preventDefault();

        let fila = e.target.parentNode.parentNode;
        let cvePersona = fila.children[0].innerHTML;
        console.log(cvePersona);

        Swal.fire({
            title: "¿Quieres quitar acceso?",
            text: "Este usuario no podra acceder al sistema",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, desactivar",
            cancelButtonText: "cancelar"
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "POST",
                    url: ruta_raiz + "php/admi/quitar-acceso.php",
                    data: { cvePersona },
                    success: function (response) {
                        console.log(response);
                        if (!response.error) {
                            let dato = JSON.parse(response);
                            console.log(dato);
                            Swal.fire({
                                position: "center",
                                icon: dato.icono,
                                title: dato.titulo,
                                text: dato.texto,
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true
                            });
                            listar_profesor();
                        }
                    }
                });
                
            }
        });

    });

    $(document).on("click", ".btnActivar", function (e) {
        e.preventDefault();

        let fila = e.target.parentNode.parentNode;
        let cvePersona = fila.children[0].innerHTML;
        console.log(cvePersona);

        Swal.fire({
            title: "¿Quieres dar acceso?",
            text: "Este usuario tendra acceder al sistema",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, Activar",
            cancelButtonText: "cancelar"
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "POST",
                    url: ruta_raiz + "php/admi/dar-acceso.php",
                    data: { cvePersona },
                    success: function (response) {
                        console.log(response);
                        if (!response.error) {
                            let dato = JSON.parse(response);
                            console.log(dato);
                            Swal.fire({
                                position: "center",
                                icon: dato.icono,
                                title: dato.titulo,
                                text: dato.texto,
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true
                            });
                            listar_profesor();
                        }
                    }
                });
            }
        });

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
                        url: ruta_raiz + "php/insert/registrar-profesor.php",
                        data: formulario,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            if (!response.error) {
                                if (response == 105) {
                                    Swal.fire({
                                        position: "center",
                                        icon: "success",
                                        title: "EXITO",
                                        text: "Usuario registrado correctamente",
                                        showConfirmButton: false,
                                        timer: 2000,
                                        timerProgressBar: true
                                    });

                                    listar_profesor();

                                    modal.hide();

                                } else if (response == 102) {
                                    Swal.fire({
                                        position: "center",
                                        icon: "info",
                                        title: "YA EXISTE",
                                        text: "Este usuario ya existe",
                                        showConfirmButton: false,
                                        timer: 2000,
                                        timerProgressBar: true
                                    });
                                    $("#form__registro").trigger("reset");

                                }
                                resetearCampos();
                            }
                        }
                    });
                } else {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "ADVERTENCIA!!",
                        text: "Valores NO validos",
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true
                    });
                    resetearCampos();
                }

            } else {
                Swal.fire({
                    position: "center",
                    icon: "warning",
                    title: "Existen campos vacios",
                    text: "Debes completar todo el formulario",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true
                });

            }
        } else {

            let nombre_usuario = $("#nombre_usuario").val();
            let apellido_pa = $("#apellido_pa").val();
            let apellido_ma = $("#apellido_ma").val();
            let telefono = $("#telefono").val();
            let correo = $("#correo").val();
            let clave = $("#clave").val();

            /*SI LOS CAMPOS NO ESTAN VACIOS*/
            if (nombre_usuario !== '' && apellido_pa !== '' && apellido_ma !== ''
                && telefono !== '' && correo !== '') {

                if (validarNombre(nombre_usuario) && validarApellido(apellido_pa) && validarApellido(apellido_ma)
                    && validarTelefono(telefono) && validarCorreo(correo)) {

                    var formulario = new FormData(this);
                    $.ajax({
                        type: "POST",
                        url: ruta_raiz + "php/insert/editar-profesor.php",
                        data: formulario,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            console.log(response);
                            if (!response.error) {

                                let dato = JSON.parse(response);

                                if (dato.status) {
                                    Swal.fire({
                                        position: "center",
                                        icon: dato.icono,
                                        title: dato.titulo,
                                        text: dato.texto,
                                        showConfirmButton: false,
                                        timer: 2000,
                                        timerProgressBar: true
                                    });
                                    $("#form__registro").trigger("reset");
                                    resetearCampos();
                                    modal.hide();
                                    listar_profesor();
                                } else {
                                    Swal.fire({
                                        position: "center",
                                        icon: dato.icono,
                                        title: dato.titulo,
                                        text: dato.texto,
                                        showConfirmButton: false,
                                        timer: 2000,
                                        timerProgressBar: true
                                    });
                                }
                            }
                        }
                    });
                } else {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "ADVERTENCIA!!",
                        text: "Valores NO validos",
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true
                    });
                }

            } else {
                Swal.fire({
                    position: "center",
                    icon: "warning",
                    title: "Existen campos vacios",
                    text: "Debes completar todo el formulario",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true
                });

            }
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