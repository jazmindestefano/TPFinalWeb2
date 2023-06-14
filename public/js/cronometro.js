document.addEventListener("DOMContentLoaded", function() {
    const preguntaElemento = document.querySelector('.w3-container .w3-wide');

    const contadorElemento = document.createElement("p");
    contadorElemento.id = "contador";
    preguntaElemento.insertAdjacentElement('afterend', contadorElemento);

    contarAtras();
});

function contarAtras() {
    const contador = document.getElementById("contador");
    let segundos = 10;

    const intervalo = setInterval(() => {
        if (segundos > 0) {
            contador.textContent = segundos;
            segundos--;
        } else {
            contador.textContent = "¡Tiempo terminado!";
            clearInterval(intervalo);
        }
    }, 1000);
}
