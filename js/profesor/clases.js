$(document).ready(function () {
   const urlParams = new URLSearchParams(window.location.search);
    const cveProfesor = urlParams.get('cveProfesor') 

    const rutaRaiz = "/pase_lista/";

    $.ajax({
      type: "POST",
      url: rutaRaiz + "php/profesor/clase-profesor.php",
      data: cveProfesor,
      success: function (response) {
         if(!response.error){
            console.log(response);

         }
         
      }
    });
});