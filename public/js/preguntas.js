$(document).ready(function () {


    // Función para cargar una nueva pregunta y respuestas
    function loadQuestion() {
        let pregunta = $("#pregunta").val();
        if (pregunta) {
            $.ajax({
                url: `http://localhost/partida/pasarPregunta`,
                type: 'GET',
                data: {pregunta: pregunta},
                dataType: 'json',
                success: function (response) {
                    $('#question').text(response.pregunta);

                    /*
                    *   $('#answers').empty();
                    for (var i = 0; i < data.answers.length; i++) {
                        var answer = data.answers[i];
                        var listItem = $('<li>').text(answer);
                        $('#answers').append(listItem);
                    }
                    * */

                },
                error: function () {
                    alert('Error al cargar la pregunta.');
                    $('#question').text('error');
                }
            });
        }

    }

    // Función para verificar la respuesta seleccionada
    function checkAnswer(selectedAnswer) {
        if (selectedAnswer === currentQuestion.correctAnswer) {
            alert('¡Respuesta correcta!');
            loadQuestion();
        } else {
            alert('Respuesta incorrecta. ¡Vuelve a intentarlo!');
        }
    }

    // Manejador de eventos para el botón "Siguiente"
    $('#next').click(function () {
        if (currentQuestion === null) {
            loadQuestion();
        } else {
            alert('Debes seleccionar una respuesta.');
        }
    });

    // Manejador de eventos para las respuestas
    $('#answers').on('click', 'li', function () {
        var selectedAnswer = $(this).text();
        checkAnswer(selectedAnswer);
    });
});