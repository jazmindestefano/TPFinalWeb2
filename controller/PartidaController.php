<?php

class PartidaController
{

    private $renderer;
    private $partidaModel;

    public function __construct($partidaModel, $renderer)
    {
        $this->partidaModel = $partidaModel;
        $this->renderer = $renderer;
    }

    public function empezar()
    {
        $idUsuario = $_SESSION['actualUser'];
        $_SESSION['puntajeDePartida'] = 0;
        $dificultadUsuario = $this->partidaModel->getDificultadDelUsuario($idUsuario)[0]['dificultad'];


        if (count($this->partidaModel->getListaDePreguntasSinResponderByIdUsuario($idUsuario,$dificultadUsuario)) == 0) {
            $this->partidaModel->borrarPreguntasRespondidasByIdUsuario($idUsuario);
        }

        $preguntasSinResponder = $this->partidaModel->getListaDePreguntasSinResponderByIdUsuario($idUsuario,$dificultadUsuario);
        $pregunta = $this->partidaModel->getPreguntaSinResponder($preguntasSinResponder);
        $respuestas = $this->partidaModel->getRespuestasByIdPregunta($pregunta[0]);
        $categoria = $this->partidaModel->getCategoriaByIdDePregunta($pregunta[0])[0]["categoria"];

        $data = array('preguntas' => $pregunta,
            'respuestas' => $respuestas,
            'categoria' => $categoria);
        $this->renderer->render('partida', $data);


    }

    public function validar()
    {
	    $idUsuario = $_SESSION['actualUser'];
	    $dificultadUsuario = $this->partidaModel->getDificultadDelUsuario($idUsuario)[0]['dificultad'];
	    $idDePregunta = $this->partidaModel->getIdPreguntaByIdRespuesta($_GET['idRespuesta'])[0]['idPregunta'];
	    $preguntaRespondida = $this->partidaModel->getPreguntaByIdDePregunta($idDePregunta);
	    $respuestaDelUsuario = $this->partidaModel->getRespuestaPorId($_GET['idRespuesta'])[0]['respuesta'];
	    $respuestaCorrecta = $this->partidaModel->getRespuestaCorrectaByIdDePregunta($idDePregunta)[0]['respuesta'];
	    $mensaje = $this->partidaModel->respuestaMensaje($respuestaCorrecta, $respuestaDelUsuario);

	    $this->partidaModel->insertarPreguntaEnPreguntaRespondida($idDePregunta, $idUsuario);

	    if (count($this->partidaModel->getListaDePreguntasSinResponderByIdUsuario($idUsuario, $dificultadUsuario)) == 0) {
		    $this->partidaModel->borrarPreguntasRespondidasByIdUsuario($idUsuario);
	    }

	    $preguntasSinResponder = $this->partidaModel->getListaDePreguntasSinResponderByIdUsuario($idUsuario, $dificultadUsuario);
	    $preguntaNueva = $this->partidaModel->getPreguntaSinResponder($preguntasSinResponder);
	    $respuestas = $this->partidaModel->getRespuestasByIdPregunta($preguntaNueva[0]);

	    $puntajeTotal = $this->partidaModel->getPuntajeTotalByIdUser($idUsuario)[0]['puntaje'];
	    $cantidadpartidasJugadas = $this->partidaModel->getCantidadPartidasJugadas($idUsuario)[0]['partidasJugadas'];
	    $categoria = $this->partidaModel->getCategoriaByIdDePregunta($preguntaNueva[0])[0]["categoria"];
	    $this->partidaModel->updateDificultadPregunta($idDePregunta);
	    $porcentaje = $this->partidaModel->getPorcentajeDePreguntasRespondidasCorrectamentePorUsuario($idUsuario)[0][0];

	    if ($respuestaDelUsuario) {
	    if ($respuestaDelUsuario == $respuestaCorrecta) {
		    $data = array('preguntas' => $preguntaNueva,
			    'respuestas' => $respuestas,
			    'categoria' => $categoria);
		    $_SESSION['puntajeDePartida']++;
		    $puntajeTotal++;
		    $this->partidaModel->updatePreguntaRespondida($idDePregunta, $idUsuario);
		    $this->partidaModel->updatePuntajeTotal($idUsuario, $puntajeTotal);
		    $this->renderer->render('partida', $data);
	    } else {
		    $cantidadpartidasJugadas++;
		    $this->partidaModel->updatePartidasJugadas($idUsuario, $cantidadpartidasJugadas);
		    $this->partidaModel->updateDificultadUsuario($idUsuario, $porcentaje);
		    $data = array('preguntas' => $preguntaRespondida,
			    'mensajeDeLaPartida' => $mensaje,
			    'puntaje' => $_SESSION['puntajeDePartida']);
		    $this->renderer->render('partida', $data);
	    }
    } else {
		    if (isset($_SESSION['respondido']) && $_SESSION['respondido'] === false) {

			    $preguntaActual = $_SESSION['pregunta'];

			    $preguntasSinResponder = $this->partidaModel->getListaDePreguntasSinResponderByIdUsuario($idUsuario,$dificultadUsuario);
			    $pregunta = $this->partidaModel->getPreguntaSinResponder($preguntasSinResponder);
			    $respuestas = $this->partidaModel->getRespuestasByIdPregunta($preguntaActual[0]);
			    $categoria = $this->partidaModel->getCategoriaByIdDePregunta($preguntaActual[0])[0]["categoria"];

			    $data = array('preguntas' => $preguntaActual,
				    'respuestas' => $respuestas,
				    'categoria' => $categoria);

			    $this->renderer->render('partida', $data);
		    } else {

			    unset($_SESSION['pregunta']);
			    unset($_SESSION['respondido']);
		    }

		    $_SESSION['pregunta'] = $preguntaRespondida;
		    $_SESSION['respondido'] = false;
	    }
    }

    public function getNuevaPregunta($idUsuario, $dificultadUsuario)
    {
        $preguntasSinResponder = $this->partidaModel->getListaDePreguntasSinResponderByIdUsuario($idUsuario, $dificultadUsuario);
        $preguntaNueva = $this->partidaModel->getPreguntaSinResponder($preguntasSinResponder);
        $respuestas = $this->partidaModel->getRespuestasByIdPregunta($preguntaNueva[0]);
        $resultado = [
            'preguntasSinResponder' => $preguntasSinResponder,
            'preguntaNueva' => $preguntaNueva,
            'respuestas' => $respuestas
        ];

        return $resultado;
    }

    public function reportar()
    {
        $idPreguntaReportada = $_GET['id'];
        $this->partidaModel->marcarPreguntaComoReportada($idPreguntaReportada);
        $pregunta = $this->partidaModel->getPreguntaByIdDePregunta($idPreguntaReportada);
        $data = array('pregunta' => $pregunta);
        $this->renderer->render('reportar', $data);
    }
}
