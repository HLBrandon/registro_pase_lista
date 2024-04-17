$(document).ready(function () {

    let opcion = 0;
    
    const modal = new bootstrap.Modal(document.getElementById('ProfesorModal'));

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

    $("#form_modal").submit(function (e) { 
        e.preventDefault();
        if (opcion == 1) {
            alert("Registrar");
        } else {
            alert("Editar");
        }
    });



});