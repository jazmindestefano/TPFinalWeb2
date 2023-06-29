function empezarPartida() {
    $.ajax({
        url: 'http://localhost/partida/jugarPartida',
        method: 'GET',
        success: function (data) {

            const categoria = data.categoria;
            const pregunta = data.preguntas.pregunta;

            let cat= `<div class="${categoria}">${categoria}</div>`
            let preg= `<p>${pregunta}</p>`

            $("#container-partida").append(cat);
            $("#container-partida").append(preg);

            data.respuestas.map(respuesta => {

                let res= `<a onclick="validarPregunta(${respuesta.idRespuesta},${respuesta.isCorrecta})">${respuesta.respuesta}<a>`

                $("#container-partida").append(res);
            })

        },
        error: function () {
            alert('Error en la solicitud AJAX empezar');
        }
    });
}

function validarPregunta(idRespuesta = 0,isCorrecta) {
  if(isCorrecta) {
      $.ajax({
          url: 'http://localhost/partida/jugarPartida',
          method: 'GET',
          data: {idRespuesta: idRespuesta},
          success: function (data) {

              const categoria = data.categoria;
              const pregunta = data.preguntas.pregunta;

              let cat = `<div class="${categoria}">${categoria}</div>`
              let preg = `<p>${pregunta}</p>`

              $("#container-partida").empty();

              $("#container-partida").append(cat);
              $("#container-partida").append(preg);

              data.respuestas.map(respuesta => {

                  let res = `<a onclick="validarPregunta(${respuesta.idRespuesta}, ${respuesta.isCorrecta})">${respuesta.respuesta}</a>`

                  $("#container-partida").append(res);
              })

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
        data: {idRespuesta: idRespuesta},
        success: function (data) {

            const mensajeDeLaPartida = data.mensajeDeLaPartida.mensajeDePartida;
            const puntaje = data.puntaje;
            const pregunta = data.pregunta[0].pregunta;

            let preg = `<p>${pregunta}</p>`
            let msj = `<p>${mensajeDeLaPartida}</p>`
            let punt = `<p>${puntaje}</p>`

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