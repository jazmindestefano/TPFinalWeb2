document.addEventListener("DOMContentLoaded", function() {
    const preguntaElemento = document.querySelector('.w3-container .w3-wide');

    const contadorElemento = document.createElement("p");
    contadorElemento.id = "contador";
    preguntaElemento.insertAdjacentElement('afterend', contadorElemento);

    const tiempoRestante = obtenerTiempoRestante();
    if (tiempoRestante > 0) {
        contarAtras(tiempoRestante);
    } else {
        iniciarNuevoContador();
    }

    const opcionesRespuesta = document.querySelectorAll(".opcion-respuesta");
    opcionesRespuesta.forEach(opcion => {
        opcion.addEventListener("click", verificarRespuesta);
    });
});

function obtenerTiempoRestante() {
    const tiempoGuardado = localStorage.getItem("tiempoRestante");
    return tiempoGuardado ? parseInt(tiempoGuardado) : 0;
}

function guardarTiempoRestante(tiempoRestante) {
    localStorage.setItem("tiempoRestante", tiempoRestante.toString());
}

function contarAtras(segundos) {
    const contador = document.getElementById("contador");
    let tiempoRestante = segundos;

    const intervalo = setInterval(() => {
        if (tiempoRestante > 0) {
            contador.textContent = tiempoRestante;
            tiempoRestante--;
        } else {
            contador.textContent = "¡Tiempo terminado!";
            clearInterval(intervalo);
           // redirigir();
        }
        guardarTiempoRestante(tiempoRestante);
    }, 1000);
}

function iniciarNuevoContador() {
    guardarTiempoRestante(10); // Establece el tiempo inicial en 10 segundos
    contarAtras(10);
}

function redirigir() {
    localStorage.removeItem("tiempoRestante"); // Elimina el tiempo restante al finalizar el contador
    window.location.href = "https://www.ejemplo.com"; // Reemplaza la URL con la que desees redirigir
}

function verificarRespuesta(event) {

    /*
    const respuestaCorrecta = false; // Reemplaza con tu lógica de verificación de respuesta

    if (!respuestaCorrecta) {
        const tiempoRestante = obtenerTiempoRestante();
        contarAtras(tiempoRestante);
    }
     */
console.log('verificar respuesta')

    // Resto de la lógica de verificación y acciones correspondientes
}

