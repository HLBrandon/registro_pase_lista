$(document).ready(function () {
   const urlParams = new URLSearchParams(window.location.search);
   const cveProfesor = urlParams.get('cveProfesor')
   const cveAsignatura = urlParams.get('cveAsignatura');

   
   const rutaRaiz = "/pase_lista/";

   $.ajax({
      type: "POST",
      url: rutaRaiz + "php/profesor/clase-profesor.php",
      data: { cveProfesor },
      success: function(response) {
          if (!response.error) {
              let datosProfesor = JSON.parse(response);
              $('#select-profesor').empty();
  
              $.each(datosProfesor, function(index, item) {
                  $('#select-profesor').append($('<option>', {
                      value: item.cvePersona,
                      text: item.nombre
                  }));
              });
          }
      }
  });
  

   $.ajax({
      type: "POST",
      url: rutaRaiz + "php/profesor/clase-asignatura.php",
      data: { cveAsignatura },
      success: function (response) {
         if (!response.error) {
            let datosAsignatura = JSON.parse(response);
            console.log(datosAsignatura);

            $('#nombreAsignatura').empty();
  
              $.each(datosAsignatura, function(index, item) {
                  $('#nombreAsignatura').append($('<option>', {
                      value: item.cveImpa_Asig,
                      text: item.nombre_asignatura
                  }));
              });
    
         }
      }
   });




});