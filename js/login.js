$(document).ready(function () {

    $(document).on('submit', '#iniciar-sesion-profesor', function (e) {
        e.preventDefault();

        loginProfesor();
    });

    $(document).on('submit', '#iniciar-sesion-personal', function (e) {
        e.preventDefault();
        
        loginPersonal();
    });

    $(document).on('submit', '#iniciar-sesion-admin', function (e) {
        e.preventDefault();
        
        loginAdministrador();
    });

});

function loginProfesor() {

    const datosProfesor = {
        correoProfesor: $("#correoProfesor").val(),
        claveProfesor: $("#claveProfesor").val()
    }

    $.ajax({
        type: "POST",
        url: "php/login/login-profesor.php",
        data: datosProfesor,
        success: function (response) {
            console.log(response);
            if (!response.error) {
                let respuesta = JSON.parse(response);
                if (respuesta.status) {
                    $("#acceso-profesor").html(respuesta.acceso);
                    setTimeout(function () {
                        window.location.href = "view/user/user-profesor/"
                    }, 1000);
                } else {
                    VanillaToasts.create({
                        title: respuesta.titulo,
                        text: respuesta.texto,
                        type: respuesta.tipo,
                        icon: respuesta.icon,
                        timeout: respuesta.tiempo, // visible 3 segundos
                    });
                }
            }

        }
    });

}

function loginPersonal(){
    const datosPersonal = {
        correoPersonal: $("#correoPersonal").val(),
        clavePersonal: $("#clavePersonal").val()
    }

    $.ajax({
        type: "POST",
        url: "php/login/login-personal.php",
        data: datosPersonal,
        success: function (response) {
           if (!response.error) {
            let respuesta = JSON.parse(response);
            if (respuesta.status) {
                $("#acceso-personal").html(respuesta.acceso);
                setTimeout(function () {
                    window.location.href = "view/user/user-personal/"
                }, 1000);


            } else {

                VanillaToasts.create({
                    title: respuesta.titulo,
                    text: respuesta.texto,
                    type: respuesta.tipo,
                    icon: respuesta.icon,
                    timeout: 3000, // visible 3 segundos
                });

            }
        } 
        }
    });
}

function loginAdministrador(){
    const datosAdministrador = {
        correoAdmin: $("#correoAdmin").val(),
        claveAdmin: $("#claveAdmin").val()
    }

    $.ajax({
        type: "POST",
        url: "php/login/login-admin.php",
        data: datosAdministrador,
        success: function (response) {
           if (!response.error) {
            let respuesta = JSON.parse(response);
            if (respuesta.status) {
                $("#acceso-admin").html(respuesta.acceso);
                setTimeout(function () {
                    window.location.href = "view/admin/"
                }, 1000);


            } else {

                VanillaToasts.create({
                    title: respuesta.titulo,
                    text: respuesta.texto,
                    type: respuesta.tipo,
                    icon: respuesta.icon,
                    timeout: 3000, // visible 3 segundos
                });

            }
        } 
        }
    });
}