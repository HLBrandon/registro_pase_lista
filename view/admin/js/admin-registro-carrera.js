
const ruta_raiz = '/pase_lista/';

listar_carrera();
listar_encargado();

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
// Cuerpo de la tabla principal
let cuerpo_tabla = document.getElementById("cuerpo_tabla");
// Cuerpo de la tabla de jefe-carrera
let cuerpo_tabla_encargar = document.getElementById("cuerpo_tabla_encargar");

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
                        <button onclick="editar('${element["cveCarrera"]}')" class="btn btn-sm btn-primary btnEditar">Editar</button>
                        ${(element["status"] == 1) ? '<button onclick="eliminar(\'' + element["cveCarrera"] + '\')" class="btn btn-sm btn-danger btnEliminar">Eliminar</button>' : '<button onclick="activar(\'' + element["cveCarrera"] + '\')" class="btn btn-success btnActivar">Activar</button>'}
                    </td>
                </tr>
                `;
            });
            cuerpo_tabla.innerHTML = temp;
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
        });

    opcion = 2; // significa editar
    modal.show();
}

function eliminar(cveCarrera) {

    console.log(cveCarrera);

    let cve = cveCarrera;
    let data = new FormData();
    data.append("cveCarrera", cve);

    fetch(ruta_raiz + "php/admi/quitar-carrera.php", {
        method: 'POST',
        body: data
    })
        .then(response => response.json())
        .then(data => {
            Swal.fire({
                position: "center",
                icon: data.icono,
                title: data.titulo,
                text: data.texto,
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true
            });
            listar_carrera();
        });

}

formulario.addEventListener("submit", (e) => {
    e.preventDefault();

    var data = new FormData(formulario);

    if (opcion == 1) {

        fetch(ruta_raiz + "php/admi/registrar-carrera.php",
            {
                method: "POST",
                body: data
            }
        )
            .then(response => response.json())
            .then(data => {

                if (data.status) {
                    Swal.fire({
                        position: "center",
                        icon: data.icono,
                        title: data.titulo,
                        text: data.texto,
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true
                    });
                    formulario.reset();
                    listar_carrera();
                    modal.hide();
                } else {
                    Swal.fire({
                        position: "center",
                        icon: data.icono,
                        title: data.titulo,
                        text: data.texto,
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true
                    });
                }

            })
    } else if (opcion == 2) {

        data.append("cveCarrera", cve_Carrera.value);

        fetch(ruta_raiz + "php/admi/editar-carrera.php",
            {
                method: "POST",
                body: data
            }
        )
            .then(response => response.json())
            .then(data => {

                if (data.status) {
                    Swal.fire({
                        position: "center",
                        icon: data.icono,
                        title: data.titulo,
                        text: data.texto,
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true
                    });
                    formulario.reset();
                    listar_carrera();
                    modal.hide();
                } else {
                    Swal.fire({
                        position: "center",
                        icon: data.icono,
                        title: data.titulo,
                        text: data.texto,
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true
                    });
                }

            })
    }


})

function listar_encargado() {
    fetch(ruta_raiz + "php/admi/listar_jefe-carrera.php", {
        method: 'GET'
    })
        .then(response => response.json())
        .then(data => {
            let temp = ``;
            data.forEach(element => {
                temp += `
                <tr>
                    <td class="text-center">${element["cveEncargar"]}</td>
                    <td class="text-center">${element["cveCarrera"]}</td>
                    <td class="text-center">${element["nombre"]}</td>
                    <td class="text-center">
                        <button onclick="editar('${element["cveCarrera"]}')" class="btn btn-sm btn-primary btnEditar">Editar</button>
                        ${(element["status"] == 1) ? '<button onclick="eliminar(\'' + element["cveCarrera"] + '\')" class="btn btn-sm btn-danger btnEliminar">Eliminar</button>' : '<button onclick="activar(\'' + element["cveCarrera"] + '\')" class="btn btn-sm btn-success btnActivar">Activar</button>'}
                    </td>
                </tr>
                `;
            });
            cuerpo_tabla_encargar.innerHTML = temp;
        })
}
