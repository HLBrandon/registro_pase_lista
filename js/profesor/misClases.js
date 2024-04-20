$(document).ready(function () {

   const rutaRaiz = "/pase_lista/";

   $.ajax({
      type: "GET",
      url: rutaRaiz + "php/profesor/misClases.php",
      success: function (response) {
         if (!response.error) {
            let respuesta = JSON.parse(response);
            let datos = ``;
            respuesta.forEach(element => {
               datos += `<a href="clase.php?cveAsignatura=${element['cveAsignatura']}" class="misClases btn btn-lg  ajustes">
                           ${element['cveCarrera']} - ${element['cveSemestre']}${element['cveModalidad']} - 
                           ${element['nombre_asignatura']} - ${element['fecha_inicio_semestre']}
                         </a>`;
            });
   
            $("#misClases").html(datos);
         }
      }
   });
});