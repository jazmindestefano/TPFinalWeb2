function empezarPartida() {
    $.ajax({
        url: 'http://localhost/partida/jugarPartida',
        method: 'GET',
        success: function (data) {

            const categoria = data.categoria;
            const pregunta = data.preguntas.pregunta;

            let cat = `<div class="${categoria} partida-pregunta">${categoria}</div>`;
            let preg = `<p class="partida-pregunta">${pregunta}</p>`;

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
        $.ajax({
            url: 'http://localhost/partida/jugarPartida',
            method: 'GET',
            data: { idRespuesta: idRespuesta },
            success: function (data) {

                const categoria = data.categoria;
                const pregunta = data.preguntas.pregunta;

                let cat = `<div class="${categoria} partida-pregunta">${categoria}</div>`;
                let preg = `<p class="partida-pregunta">${pregunta}</p>`;

                $("#container-partida").empty();

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
