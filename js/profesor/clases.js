$(document).ready(function () {
   $(".seleccionar-presencia").change(function (e) { 
    e.preventDefault();
    let fila = e.target.parentNode.parentNode.children[0].children[0].value;
   
    console.log(fila);
    
   });
});