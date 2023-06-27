function jugarPartidaAjax(idRespuesta) {
    $.ajax({
        url: 'http://localhost/partida/jugarPartida',
        method: 'GET',
        success: function (data) {

            const categoria = data.categoria;
            const pregunta = data.preguntas.pregunta;

            console.log(categoria)
            console.log(pregunta)

            data.respuestas.map(respuesta => {
                console.log(respuesta.respuesta)
            })

        },
        error: function () {
            alert('Error en la solicitud AJAX');
        }
    });
}
