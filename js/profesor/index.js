$(document).ready(function () {
  // const rutaRaiz = "//"+window.location.host+"/";
  

  $.ajax({
    type: "GET",
    url: rutaRaiz + "php/profesor/home.php",
    success: function (response) {
      if (!response.error) {
        let datosProfesor = JSON.parse(response);
        $("#nombreProfesor").html(datosProfesor.nombre_persona + " " + datosProfesor.apellido_pa + " " + datosProfesor.apellido_ma);
        $("#correoProfesor").html(datosProfesor.correo);
      }
    }
  });
});