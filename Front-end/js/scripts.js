//Arrays iniciales
let listaPreferencias = ["Terror", "Romance"];
let listaDisponibles = [
    "Ficcion",
    "Policiaca",
    "Histórica",
    "Politica",
    "Ciencia",
    "Superacion personal",
];

//Mostrando nombre y género del usuario
let nombre = "Antonio Zarate";
let genero = "Masculino";
document.getElementById("txt_nombre").innerHTML = nombre;
document.getElementById("txt_genero").innerHTML = genero;

//Impriendo Preferencias y Disponibles
function mostrarListas() {
    console.log("Mostrando listas...");
    mostrarPreferencias();
    mostrarDisponibles();
}

//Imprimiendo Array de Preferencias
const mostrarPreferencias = () => {
    console.log("Mostrando preferencias...");
    let texto = "";
    listaPreferencias.map((preferencia) => {
        texto += `<div class="li" ondblclick="quitarPreferencia(this)" >${preferencia}</div>`;
    });
    document.getElementById("idPreferencias").innerHTML = texto;
};

//Imprimiendo Array de Disponibles
const mostrarDisponibles = () => {
    console.log("Mostrando disponibles...");
    let texto = "";
    listaDisponibles.map((disponible) => {
        texto += `<div class="li" ondblclick="quitarDisponible(this)">${disponible}</div>`;
    });
    document.getElementById("idDisponibles").innerHTML = texto;
};

//Quitando un elemento de la lista de Preferencias
function quitarPreferencia(e) {
    //e.preventDefault();
    //Agregamos a Disponibles
    listaDisponibles.push(e.innerHTML);
    //Reiniciamos Disponibles
    mostrarDisponibles();
    //Eliminamos de Preferencias
    listaPreferencias = listaPreferencias.filter(
        (preferencia) => preferencia != e.innerHTML
    );
    //Reiniciamos Preferencias
    mostrarPreferencias();
}

//Quitando un elemento de la lista de Disponibles
function quitarDisponible(e) {
    //e.preventDefault();
    //Agregamos a Preferencias
    listaPreferencias.push(e.innerHTML);
    //Reiniciamos Preferencias
    mostrarPreferencias();
    //Eliminamos de Disponibles
    listaDisponibles = listaDisponibles.filter(
        (disponible) => disponible != e.innerHTML
    );
    //Reiniciamos Disponibles
    mostrarDisponibles();
}

/*SECCIÓN AJAX*/
//Variable para almacenar el ID
let id = "";
let stringJson = "";
let dataString = "";
let dataJson = {};

//Función para obtener ID
function obtenerId() {
    for (let i = 0; i < nombre.length; i++) {
        if (nombre[i] != " ") {
            id += nombre[i];
        } else {
            id += nombre[i + 1];
            break;
        }
    }
    id = id.toLowerCase();
    //console.log(id);
}

function crearJson() {
    dataString = `{ "nombre": "${nombre}", "genero": "${genero}", "preferencias": ${JSON.stringify(listaPreferencias)} }`;
    dataJson = JSON.parse(dataString);
    //console.log(formatJson);
}
