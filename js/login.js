$(document).ready(function () {

    $(document).on('submit', '#iniciar-sesion-profesor', function (e) {
        e.preventDefault();

        alert("Profesor");

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
    //aqui va el ajax para el formulario del profesor
}