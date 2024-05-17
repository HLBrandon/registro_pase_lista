
const ruta_raiz = '/pase_lista/';

listar_area();

let opcion = 0;
let op = 0;
// Botones de crear, editar, eliminar y activar
let btnCrear = document.getElementById("btnCrear");
let btnEditar = document.getElementsByClassName("btnEditar");
let btnEliminar = document.getElementsByClassName("btnEliminar");
let btnActivar = document.getElementsByClassName("btnActivar");
let btnEncargar = document.getElementById('btnEncargar');
// Partes del modal
let tituloModal = document.getElementById("areaModalLabel");
let btnGuardar = document.getElementById("btnGuardar");
// Inputs dentro del modal
let formulario = document.getElementById('form__registro');
let cveArea = document.getElementById('cveArea');
// Cuerpo de la tabla principal
let cuerpo_tabla = document.getElementById("cuerpo_tabla");

const modal = new bootstrap.Modal(document.getElementById('areaModal'));

function listar_area() {
    fetch(ruta_raiz + "php/admi/listar_area.php", {
        method: 'GET'
    })
        .then(response => response.json())
        .then(data => {
            let temp = ``;
            data.forEach(element => {
                temp += `
                <tr>
                    <td>${element["cveArea"]}</td>
                    <td>${element["area"]}</td>
                    <td class="text-center">${(element["status"] == 1) ? '<span class="badge text-bg-success">Activo</span>' : '<span class="badge text-bg-danger">Inactivo</span>'}</td>
                    <td class="text-center">
                        <button onclick="editar(${element["cveArea"]})" class="btn btn-sm btn-primary btnEditar">Editar</button>
                        ${(element["status"] == 1) ? '<button onclick="eliminar(\'' + element["cveArea"] + '\')" class="btn btn-sm btn-danger btnEliminar">Eliminar</button>' : '<button onclick="activar(\'' + element["cveArea"] + '\')" class="btn btn-sm btn-success btnActivar">Activar</button>'}
                    </td>
                </tr>
                `;
            });
            cuerpo_tabla.innerHTML = temp;
        })
}

btnCrear.addEventListener("click", () => {
    tituloModal.textContent = 'Registrar Área';
    btnGuardar.textContent = 'Registrar';
    formulario.reset();
    opcion = 1; // significa crear
    modal.show();
});

function editar(cvearea) { // No existe el evento ON
    tituloModal.textContent = 'Modificar Área';
    btnGuardar.textContent = 'Guardar cambios';

    let cve = cvearea;
    formulario.reset();
    let data = new FormData();

    data.append("cve", cve);

    fetch(ruta_raiz + "php/admi/optener-area.php", {
        method: 'POST',
        body: data
    })
        .then(response => response.json())
        .then(data => {
            cveArea.value = data.cveArea;
            nombre_area.value = data.area;
        });

    opcion = 2; // significa editar
    modal.show();
}

function eliminar(cvearea) {

    console.log(cvearea);

    let cve = cvearea;
    let data = new FormData();
    data.append("cvearea", cve);

    fetch(ruta_raiz + "php/admi/quitar-area.php", {
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
            listar_area();
        });

}

function activar(cvearea) {

    console.log(cvearea);

    let cve = cvearea;
    let data = new FormData();
    data.append("cvearea", cve);

    fetch(ruta_raiz + "php/admi/dar-area.php", {
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
            listar_area();
        });

}

formulario.addEventListener("submit", (e) => {
    e.preventDefault();

    var data = new FormData(formulario);

    if (opcion == 1) {

        fetch(ruta_raiz + "php/admi/registrar-area.php",
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
                    listar_area();
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

        data.append("cvearea", cveArea.value);

        fetch(ruta_raiz + "php/admi/editar-area.php",
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
                    listar_area();
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

