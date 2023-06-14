
window.addEventListener("load", contarAtras);

function contarAtras() {

    console.log('por favor, dame algo');

    let segundos = 10;

    const intervalo = setInterval(() => {
        if (segundos > 0) {
            console.log(segundos);
            segundos--;
        } else {
            console.log("¡Tiempo terminado!");
            clearInterval(intervalo);
        }
    }, 1000);
}