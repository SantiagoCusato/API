"use strict"

const URL = "api/tasks/";

let Instrumentos = [];

let form = document.querySelector('#Instrumento-form');
form.addEventListener('submit', insertTask);
async function getAll() {
    try {
        let response = await fetch(URL);
        if (!response.ok) {
            throw new Error('Recurso no existe');
        }
        tasks = await response.json();

        ShowInstrumentos();
    } catch(e) {
        console.log(e);
    }
}

async function insertInstrumentos(e) {
    e.preventDefault();
    
    let data = new FormData(form);
    let Instrumento = {
        titulo: data.get('titulo'),
        descripcion: data.get('descripcion'),
        precio: data.get('prioridad'),
    };

    try {
        let response = await fetch(URL, {
            method: "POST",
            headers: { 'Content-Type': 'application/json'},
            body: JSON.stringify(Instrumento)
        });
        if (!response.ok) {
            throw new Error('Error del servidor');
        }

        let nInstrumento = await response.json();

        // inserto la tarea nuevo
        Instrumentos.push(nInstrumento);
        showTasks();

        form.reset();
    } catch(e) {
        console.log(e);
    }
} 

async function deleteInstrumentos(e) {
    e.preventDefault();
    try {
        let id = e.target.dataset.Instrumento;
        let response = await fetch(URL + id, {method: 'DELETE'});
        if (!response.ok) {
            throw new Error('Recurso no existe');
        }

        // eliminar la tarea del arreglo global
        Instrumento = Instrumentos.filter(instrumento => Instrumento.id != id);
        ShowInstrumentos();
    } catch(e) {
        console.log(e);
    }
}

function ShowInstrumentos() {
    let ul = document.querySelector("#Instrumentos-list");
    ul.innerHTML = "";
    for (const Instrumento of tasks) {

        let html = `
            <li class='
                    list-group-item d-flex justify-content-between align-items-center
                    ${ Instrumento.finalizada == 1 ? 'finalizada' : ''}
                '>
                <span> <b>${Instrumento.titulo}</b> - ${Intrumento.descripcion} (prioridad ${Instrumento.prioridad}) </span>
                <div class="ml-auto">
                    ${Instrumento.finalizada != 1 ? `<a href='#' data-Instrumento="${Instrumento.id}" type='button' class='btn btn-success btn-finalize'>Finalizar</a>` : ''}
                    <a href='#' data-Instrumento="${Instrumento.id}" type='button' class='btn btn-danger btn-delete'>Borrar</a>
                </div>
            </li>
        `;

        ul.innerHTML += html;
    }

    // asigno event listener para los botones
    const btnsDelete = document.querySelectorAll('a.btn-delete');
    for (const btnDelete of btnsDelete) {
        btnDelete.addEventListener('click', deleteInstrumento);
    }
}

getAll();