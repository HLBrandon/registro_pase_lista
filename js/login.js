$(document).ready(function () {

    $(document).on('submit', '#iniciar-sesion-profesor', function (e) {
        e.preventDefault();

        loginProfesor();
    });

    $(document).on('submit', '#iniciar-sesion-personal', function (e) {
        e.preventDefault();
        alert("Personal");
    });

    $(document).on('submit', '#iniciar-sesion-admin', function (e) {
        e.preventDefault();
        alert("admin");
    });

});

function loginProfesor() {

    const datos = {
        correoProfesor: $("#correoProfesor").val(),
        claveProfesor: $("#claveProfesor").val()
    }

    $.ajax({
        type: "POST",
        url: "php/login/login-profesor.php",
        data: datos,
        success: function (response) {
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
                        timeout: 3000, // visible 3 segundos
                    });

                }
            }

        }
    });

}