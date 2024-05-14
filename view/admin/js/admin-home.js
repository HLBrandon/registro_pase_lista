
const ruta_raiz = '/pase_lista/';

listar_usuario();

// Cuerpo de la tabla principal
let cuerpo_tabla = document.getElementById("cuerpo_tabla");

function listar_usuario() {
    fetch(ruta_raiz + "php/admi/listar_usuario.php", {
        method: 'GET'
    })
        .then(response => response.json())
        .then(data => {
            let temp = ``;
            data.forEach(element => {
                temp += `
                <tr>
                    <td>${element["cvePersona"]}</td>
                    <td>${element["nombre"]}</td>
                    <td>${element["correo"]}</td>
                    <td class="text-center">${(element["conectar"] == 1) ? '<span class="badge text-bg-success">Conectado</span>' : '<span class="badge text-bg-danger">Desconectado</span>'}</td>
                </tr>
                `;
            });
            cuerpo_tabla.innerHTML = temp;
        })
}