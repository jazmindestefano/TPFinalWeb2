document.addEventListener("DOMContentLoaded", function() {
    //const preguntaElemento = document.querySelector('.w3-container .w3-center');
    const preguntaElemento = document.querySelector('.cronometro');
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




function empezarPartida() {

    $.ajax({
        url: 'http://localhost/partida/jugarPartida',
        method: 'GET',
        success: function (data) {

            const categoria = data.categoria;
            const pregunta = data.preguntas.pregunta;


            let text =`<h3 class='w3-wide'>JUGA TU PARTIDA</h3>`;
            let cronometro = `<div class="cronometro"></div>`;
            let cat = `<div class="${categoria} partida-pregunta">${categoria}</div>`;
            let preg = `<p class="partida-pregunta">${pregunta}</p>`;

            $("#container-partida").append(text);
            $("#container-partida").append(cronometro);
            $("#container-partida").append(cat);
            $("#container-partida").append(preg);

            data.respuestas.map(respuesta => {

                let res = `<a onclick="validarPregunta(${respuesta.idRespuesta},${respuesta.isCorrecta})" class="opcion-respuesta">${respuesta.respuesta}</a>`;

                $("#container-partida").append(res);
            })

            $(".opcion-respuesta").css("margin", "10px 0");

        },
        error: function () {
            alert('Error en la solicitud AJAX empezar');
        }
    });
}

function validarPregunta(idRespuesta = 0, isCorrecta) {
    if (isCorrecta) {
        iniciarNuevoContador()
        $.ajax({
            url: 'http://localhost/partida/jugarPartida',
            method: 'GET',
            data: { idRespuesta: idRespuesta },
            success: function (data) {

                const categoria = data.categoria;
                const pregunta = data.preguntas.pregunta;


                let cronometro = `<div class="cronometro"></div>`;
                let text =`<h3 class='w3-wide'>JUGA TU PARTIDA</h3>`;
                let cat = `<div class="${categoria} partida-pregunta">${categoria}</div>`;
                let preg = `<p class="partida-pregunta">${pregunta}</p>`;

                $("#container-partida").empty();
                $("#container-partida").append(text);
                $("#container-partida").append(cronometro);
                $("#container-partida").append(cat);
                $("#container-partida").append(preg);

                data.respuestas.map(respuesta => {

                    let res = `<a onclick="validarPregunta(${respuesta.idRespuesta}, ${respuesta.isCorrecta})" class="opcion-respuesta">${respuesta.respuesta}</a>`;

                    $("#container-partida").append(res);
                })

                $(".opcion-respuesta").css("margin", "10px 0");

            },
            error: function () {
                alert('Error en la solicitud AJAX jugar');
            }
        });
    } else {
        preguntaIncorrecta(idRespuesta)
    }
}

function preguntaIncorrecta(idRespuesta) {
    $.ajax({
        url: 'http://localhost/partida/finalizarPartida',
        method: 'GET',
        data: { idRespuesta: idRespuesta },
        success: function (data) {

            const mensajeDeLaPartida = data.mensajeDeLaPartida.mensajeDePartida;
            const puntaje = data.puntaje;
            const pregunta = data.pregunta[0].pregunta;

            let preg = `<p class="partida-pregunta">${pregunta}</p>`;
            let msj = `<p style="text-align: center">${mensajeDeLaPartida}</p>`;
            let punt = `<p style="text-align: center">Tu puntaje alcanzado es de: <span style="font-weight: bold">${puntaje}</span></p>`;

            $("#container-partida").empty();

            $("#container-partida").append(preg);
            $("#container-partida").append(msj);
            $("#container-partida").append(punt);

        },
        error: function () {
            alert('Error en la solicitud AJAX. Consulta la consola para más detalles.');
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

    const intervalo = setInterval(() => {
        if (tiempoRestante > 0) {
            contador.textContent = tiempoRestante;
            tiempoRestante--;
        } else {
            contador.textContent = "¡Tiempo terminado!";
            clearInterval(intervalo);

            setTimeout(() => {
                redirigir();
            }, 2000)

        }
        guardarTiempoRestante(tiempoRestante);
    }, 1000);
}

function iniciarNuevoContador() {
    guardarTiempoRestante(100); // Establece el tiempo inicial en 10 segundos
    contarAtras(10);
}

function redirigir() {
    localStorage.removeItem("tiempoRestante"); // Elimina el tiempo restante al finalizar el contador
    window.location.href = "http://localhost/partida/tiempoTerminado"; // Reemplaza la URL con la que desees redirigir
}
