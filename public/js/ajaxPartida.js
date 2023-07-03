let intervaloContador;
let idRespuestaLET;
document.addEventListener("DOMContentLoaded", function () {
    const preguntaElemento = document.querySelector('.cronometro');
    const contadorElemento = document.createElement("p");
    contadorElemento.id = "contador";
    preguntaElemento.insertAdjacentElement('afterend', contadorElemento);

    const tiempoRestante = obtenerTiempoRestante();
    if (tiempoRestante > 0) {
        contarAtras(tiempoRestante);
    }
    const opcionesRespuesta = document.querySelectorAll(".opcion-respuesta");
    opcionesRespuesta.forEach(opcion => {
        opcion.addEventListener("click", verificarRespuesta);
    });

});


let paginaRecargada = 1;

function empezarPartida() {
    if (performance.navigation.type === 1) {
        $.ajax({
            url: 'http://localhost/partida/preguntaActual',
            method: 'GET',
            success: function (data) {

                const categoria = data.categoria;
                const pregunta = data.preguntas.pregunta;
                const idPregunta = data.preguntas.idPregunta;

                if (paginaRecargada === 1) {
                    paginaRecargada = 0;
                } else {
                    iniciarNuevoContador()
                }

                let cat = `<div class="${categoria} partida-pregunta">${categoria}</div>`;
                let reportar = `<a href="http://localhost/partida/reportar?idPregunta=${idPregunta}" class="">Reportar pregunta</a>`;
                let preg = `<p class="partida-pregunta">${pregunta}</p>`;

                $("#container-partida").append(cat);
                $("#container-partida").append(reportar);
                $("#container-partida").append(preg);

                data.respuestas.map(respuesta => {

                    let res = `<a onclick="setearIdRespuesta(${respuesta.idRespuesta},${respuesta.isCorrecta})" class="opcion-respuesta">${respuesta.respuesta}</a>`;

                    $("#container-partida").append(res);
                })

                $(".opcion-respuesta").css("margin", "10px 0");

            },
            error: function () {
                alert('Error en la solicitud AJAX empezar');
            }
        });
    } else {
        iniciarNuevoContador()
        $.ajax({
            url: 'http://localhost/partida/jugarPartida',
            method: 'GET',
            success: function (data) {
                paginaRecargada = 0;
                const categoria = data.categoria;
                const pregunta = data.preguntas.pregunta;
                const idPregunta = data.preguntas.idPregunta;

                if (paginaRecargada === 1) {
                    paginaRecargada = 0;
                } else {
                    iniciarNuevoContador()
                }

                let cat = `<div class="${categoria} partida-pregunta">${categoria}</div>`;
                let preg = `<p class="partida-pregunta">${pregunta}</p>`;
                let reportar = `<a href="http://localhost/partida/reportar?idPregunta=${idPregunta}" class="">Reportar pregunta</a>`;

                $("#container-partida").append(cat);
                $("#container-partida").append(reportar);
                $("#container-partida").append(preg);

                data.respuestas.map(respuesta => {

                    let res = `<a onclick="setearIdRespuesta(${respuesta.idRespuesta},${respuesta.isCorrecta})" class="opcion-respuesta">${respuesta.respuesta}</a>`;

                    $("#container-partida").append(res);
                })

                $(".opcion-respuesta").css("margin", "10px 0");

            },
            error: function () {
                alert('Error en la solicitud AJAX empezar');
            }
        });
    }

}

function validarPregunta(idRespuesta = 0, isCorrecta) {
    if (isCorrecta) {
        $.ajax({
            url: 'http://localhost/partida/jugarPartida',
            method: 'GET',
            data: {idRespuesta: idRespuesta},
            success: function (data) {
                const categoria = data.categoria;
                const pregunta = data.preguntas.pregunta;
                const idPregunta = data.preguntas.idPregunta;

                if (paginaRecargada === 1) {
                    console.log("La página fue recargada validar pregunta");
                } else {
                    iniciarNuevoContador()
                }

                idRespuestaLET = idRespuesta;
                let cat = `<div class="${categoria} partida-pregunta">${categoria}</div>`;
                let preg = `<p class="partida-pregunta">${pregunta}</p>`;
                let reportar = `<a href="http://localhost/partida/reportar?idPregunta=${idPregunta}" class="">Reportar pregunta</a>`;
                $("#container-partida").empty();
                $("#container-partida").append(cat);
                $("#container-partida").append(reportar);
                $("#container-partida").append(preg);


                data.respuestas.map(respuesta => {

                    let res = `<a onclick="setearIdRespuesta(${respuesta.idRespuesta}, ${respuesta.isCorrecta})" class="opcion-respuesta">${respuesta.respuesta}</a>`;

                    $("#container-partida").append(res);
                })

                $(".opcion-respuesta").css("margin", "10px 0");

            },
            error: function () {
                terminoSinResponder();
                detenerContador();
            }
        });
    } else {
        preguntaIncorrecta(idRespuesta)
    }

}

function preguntaIncorrecta(idRespuesta) {
    detenerContador();
    $.ajax({
        url: 'http://localhost/partida/finalizarPartida',
        method: 'GET',
        data: {idRespuesta: idRespuesta},
        success: function (data) {

            const mensajeDeLaPartida = data.mensajeDeLaPartida.mensajeDePartida ?? "";
            const puntaje = data.puntaje;
            const pregunta = data.pregunta[0].pregunta;

            let preg = `<p class="partida-pregunta">${pregunta}</p>`;
            let msj = `<p style="text-align: center">${mensajeDeLaPartida}</p>`;
            let punt = `<p style="text-align: center">Tu puntaje alcanzado es de: <span style="font-weight: bold">${puntaje}</span></p>`;

            $("#container-partida").empty();
            $("#contador").empty();
            $("#container-partida").append(preg);
            $("#container-partida").append(msj);
            $("#container-partida").append(punt);

        },
        error: function () {
            terminoSinResponder()
        }
    });
}


function terminoSinResponder() {
    $.ajax({
        url: 'http://localhost/partida/terminoSinResponder',
        method: 'GET',
        success: function (data) {

            const puntaje = data.puntaje;

            let punt = `<p style="text-align: center">Tu puntaje alcanzado es de: <span style="font-weight: bold">${puntaje}</span></p>`;

            $("#container-partida").empty();
            $("#contador").empty();
            $("#container-partida").append(punt);

        },
        error: function () {
            alert(" error revisar termino sin responder")
        }
    });
}


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

    intervaloContador = setInterval(() => {
        if (tiempoRestante > 0) {
            contador.textContent = tiempoRestante;
            tiempoRestante--;
        } else {
            $("#container-partida").empty();
            contador.textContent = "¡Tiempo terminado!";
            detenerContador();
            preguntaIncorrecta(idRespuestaLET);
        }
        guardarTiempoRestante(tiempoRestante);
    }, 1000);
}


function iniciarNuevoContador() {
    detenerContador();
    guardarTiempoRestante(10); // Establece el tiempo inicial en 10 segundos
    contarAtras(10);
}

function redirigir() {
    localStorage.removeItem("tiempoRestante"); // Elimina el tiempo restante al finalizar el contador
    preguntaIncorrecta() // Reemplaza la URL con la que desees redirigir
}

function detenerContador() {
    if (intervaloContador) {
        clearInterval(intervaloContador);
    }
}

function setearIdRespuesta(idRespuesta, isCorrecta) {
    validarPregunta(idRespuesta, isCorrecta)
    idRespuestaLET = idRespuesta;
}
