
function jugarPartidaAjax() {
    $.ajax({
        url: 'http://localhost/partida/jugarPartida',
        method: 'GET',
        success: function (data) {

            const categoria = data.categoria;
            const pregunta = data.preguntas.pregunta;

            console.log(categoria)
            console.log(pregunta)

            data.respuestas.map(respuesta => {
                let res= `
                    <h3>${respuesta.respuesta}</h3>`

                $("#container-partida").append(res);
            })

        },
        error: function () {
            alert('Error en la solicitud AJAX');
        }
    });
}
