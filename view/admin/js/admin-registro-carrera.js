
const ruta_raiz = '/pase_lista/';

listar_carrera();
listar_jefe();

let opcion = 0;
// Botones de crear, editar, eliminar y activar
let btnCrear = document.getElementById("btnCrear");
let btnEditar = document.getElementsByClassName("btnEditar");
let btnEliminar = document.getElementsByClassName("btnEliminar");
let btnActivar = document.getElementsByClassName("btnActivar");
// Partes del modal
let tituloModal = document.getElementById("carreraModalLabel");
let btnGuardar = document.getElementById("btnGuardar");
// Inputs dentro del modal
let formulario = document.getElementById('form__registro');
let cve_Carrera = document.getElementById("cveCarrera");
let nombre_carrera = document.getElementById("nombre_carrera");
let select_jefe = document.getElementById("select-jefe");
// Cuerpo de la tabla principal
let cuerpo_tabla = document.getElementById("cuerpo_tabla");

const modal = new bootstrap.Modal(document.getElementById('carreraModal'));

function listar_carrera() {
    fetch(ruta_raiz + "php/admi/listar_carrera.php", {
        method: 'GET'
    })
        .then(response => response.json())
        .then(data => {
            let temp = ``;
            data.forEach(element => {
                temp += `
                <tr>
                    <td>${element["cveCarrera"]}</td>
                    <td>${element["nombre_carrera"]}</td>
                    <td class="text-center">${(element["status"] == 1) ? '<span class="badge text-bg-success">Activo</span>' : '<span class="badge text-bg-danger">Inactivo</span>'}</td>
                    <td class="text-center">
                        <button onclick="editar('${element["cveCarrera"]}')" class="btn btn-primary btnEditar">Editar</button>
                        ${(element["status"] == 1) ? '<button onclick="eliminar(\'' + element["cveCarrera"] + '\')" class="btn btn-danger btnEliminar">Eliminar</button>' : '<button onclick="activar(\'' + element["cveCarrera"] + '\')" class="btn btn-success btnActivar">Activar</button>'}
                    </td>
                </tr>
                `;
            });
            cuerpo_tabla.innerHTML = temp;
        })
}

function listar_jefe() {
    fetch(ruta_raiz + "php/admi/listar_jefe-carrera.php", {
        method: 'GET'
    })
        .then(response => response.json())
        .then(data => {
            let temp = `<option selected>Selecciona</option>`;
            data.forEach(element => {
                temp += `
                    <option value="${element['cvePersona']}">${element['nombre']}</option>
                `;
            });
            select_jefe.innerHTML = temp;
        })
}

btnCrear.addEventListener("click", () => {
    tituloModal.textContent = 'Registrar asignatura';
    btnGuardar.textContent = 'Registrar';
    formulario.reset();
    cve_Carrera.disabled = false;
    opcion = 1; // significa crear
    modal.show();
});

function editar(cveCarrera) { // No existe el evento ON
    tituloModal.textContent = 'Modificar Carrera';
    btnGuardar.textContent = 'Guardar cambios';

    let cve = cveCarrera;
    formulario.reset();
    cve_Carrera.disabled = true;
    let data = new FormData();

    data.append("cve", cve);

    fetch(ruta_raiz + "php/admi/optener-carrera.php", {
        method: 'POST',
        body: data
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            cve_Carrera.value = data.cve_Carrera;
            nombre_carrera.value = data.nombre_carrera;
            select_jefe.value = data.cvePersona;
        });

    opcion = 2; // significa editar
    modal.show();
}

function eliminar(cveCarrera) {
    console.log(cveCarrera);
}

formulario.addEventListener("submit", (e) => {
    e.preventDefault();

    let data = new FormData(formulario);

    if (opcion == 1) {
        fetch(ruta_raiz + "php/admi/registrar-carrera.php",
            {
                method: "POST",
                body: data
            }
        )
            .then(response => response.json())
            .then(data => {
                console.log(data);
                Swal.fire({
                    position: "center",
                    icon: data.icono,
                    title: data.titulo,
                    text: data.texto,
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true
                });
            })
    } else {

    } 


})
