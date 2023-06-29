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
    public function empezarPartida(){
			$_SESSION['puntajeDePartida'] = 0;
        $data = array();
        $this->renderer->render('partida', $data);
    }


    public function jugarPartida()
    {
        $idUsuario = $_SESSION['actualUser'];
        $_SESSION['RespuestaIncorrecta'] = false;
        $_SESSION['PrimerRender'] = true;
        $dificultadUsuario = $this->getDificultadUsuario($idUsuario);

        //si el usuario no tiene mas preguntas para responder, reset tabla preguntas respondidas
        if (count($this->getListaPreguntasSinResponder($idUsuario, $dificultadUsuario)) == 0) {
            $this->partidaModel->borrarPreguntasRespondidasByIdUsuario($idUsuario);
        }

        //buscamos una primera pregunta nueva
        $primeraPregunta = $this->getNuevaPregunta($idUsuario, $dificultadUsuario);

        if (isset($_GET['idRespuesta'])) {
            $idRespuesta = $_GET['idRespuesta'];
            $idDePregunta = $this->partidaModel->getIdPreguntaByIdRespuesta($idRespuesta)[0]['idPregunta'];
            $insertarPregunta = $this->insertarPreguntaEnPreguntasRespondidas($idRespuesta, $idUsuario, $idDePregunta);
            $nuevaPregunta = $this->getNuevaPregunta($idUsuario, $dificultadUsuario);

            $infoJugador = $this->getInformacionJugador($idUsuario);
            $this->partidaModel->updateDificultadPregunta($idDePregunta);

            if ($insertarPregunta['respuestaDelUsuario'] == $insertarPregunta['respuestaCorrecta']) {
                $_SESSION['PrimerRender'] = false;
                $infoJugador['puntajeTotal']++;
                $this->partidaModel->updatePreguntaRespondida($idDePregunta, $idUsuario);


                // si la respuesta es correcta y no es el primer render
                if (!$_SESSION['RespuestaIncorrecta'] && !$_SESSION['PrimerRender']) {

                    $data = array('preguntas' => $nuevaPregunta['preguntaNueva'],
                        'respuestas' => $nuevaPregunta['respuestas'],
                        'categoria' => $nuevaPregunta['categoria']);

	                header('Content-Type: application/json');
	                echo json_encode($data);
                }
            }

        }

        // si la respuesta es correcta y es el primer render
        if (!$_SESSION['RespuestaIncorrecta'] && $_SESSION['PrimerRender']) {
	        $_SESSION['puntajeDePartida']++;
            $data = array('preguntas' => $primeraPregunta['preguntaNueva'],
                'respuestas' => $primeraPregunta['respuestas'],
                'categoria' => $primeraPregunta['categoria']);

	        header('Content-Type: application/json');
	        echo json_encode($data);
        }
    }


    public function reportar()
    {
        $idPreguntaReportada = $_GET['id'];
        $this->partidaModel->marcarPreguntaComoReportada($idPreguntaReportada);
        $pregunta = $this->partidaModel->getPreguntaByIdDePregunta($idPreguntaReportada);
        $data = array('pregunta' => $pregunta);
        $this->renderer->render('reportar', $data);
    }

    public function getInformacionJugador($idUsuario)
    {
        $puntajeTotal = $this->partidaModel->getPuntajeTotalByIdUser($idUsuario)[0]['puntaje'];
        $cantidadpartidasJugadas = $this->partidaModel->getCantidadPartidasJugadas($idUsuario)[0]['partidasJugadas'];
        $porcentaje = $this->partidaModel->getPorcentajeDePreguntasRespondidasCorrectamentePorUsuario($idUsuario)[0][0];
        $resultado = [
            'puntajeTotal' => $puntajeTotal,
            'cantidadpartidasJugadas' => $cantidadpartidasJugadas,
            'porcentaje' => $porcentaje,
        ];

        return $resultado;
    }

		public function finalizarPartida() {

			$idUsuario = $_SESSION['actualUser'];
			$porcentaje = $this->partidaModel->getPorcentajeDePreguntasRespondidasCorrectamentePorUsuario($idUsuario)[0][0];

			$idPregunta = $this->partidaModel->getIdPreguntaByIdRespuesta($_GET['idRespuesta'])[0]['idPregunta'];
			$preguntaRespondida = $this->partidaModel->getPreguntaByIdDePregunta($idPregunta);
			$respuestaCorrecta = $this->partidaModel->getRespuestaCorrectaByIdDePregunta($idPregunta)[0]['respuesta'];
			$respuestaDelUsuario = $this->partidaModel->getRespuestaPorId($_GET['idRespuesta'])[0]['respuesta'];

			$cantidadpartidasJugadas = $this->partidaModel->getCantidadPartidasJugadas($idUsuario)[0]['partidasJugadas'];
			$cantidadpartidasJugadas++;
			$this->partidaModel->updatePartidasJugadas($idUsuario, $cantidadpartidasJugadas);

			$this->partidaModel->updateDificultadUsuario($idUsuario, $porcentaje);

			$puntajeTotal = $this->partidaModel->getPuntajeTotalByIdUser($idUsuario)[0]['puntaje'] + $_SESSION['puntajeDePartida'];
			$this->partidaModel->updatePuntajeTotal($idUsuario, $puntajeTotal);

			$mensaje = $this->partidaModel->respuestaMensaje($respuestaCorrecta, $respuestaDelUsuario);

			$data = array(
				"pregunta" => $preguntaRespondida,
				"mensajeDeLaPartida" => $mensaje,
				"puntaje" => $_SESSION['puntajeDePartida']);

			header('Content-Type: application/json');
			echo json_encode($data);
		}

    public function insertarPreguntaEnPreguntasRespondidas($idRespuesta, $idUsuario, $idPregunta)
    {
        $preguntaRespondida = $this->partidaModel->getPreguntaByIdDePregunta($idPregunta);
        $respuestaDelUsuario = $this->partidaModel->getRespuestaPorId($idRespuesta)[0]['respuesta'];
        $respuestaCorrecta = $this->partidaModel->getRespuestaCorrectaByIdDePregunta($idPregunta)[0]['respuesta'];
        $mensaje = $this->partidaModel->respuestaMensaje($respuestaCorrecta, $respuestaDelUsuario);
        $this->partidaModel->insertarPreguntaEnPreguntaRespondida($idPregunta, $idUsuario);
        $resultado = [
            'preguntaRespondida' => $preguntaRespondida,
            'mensaje' => $mensaje,
            'respuestaCorrecta' => $respuestaCorrecta,
            'respuestaDelUsuario' => $respuestaDelUsuario
        ];

        return $resultado;
    }

    public function getDificultadUsuario($idUsuario)
    {
        return $this->partidaModel->getDificultadDelUsuario($idUsuario)[0]['dificultad'];
    }

    public function getListaPreguntasSinResponder($idUsuario, $dificultadUsuario)
    {
        return $this->partidaModel->getListaDePreguntasSinResponderByIdUsuario($idUsuario, $dificultadUsuario);
    }

    public function getNuevaPregunta($idUsuario, $dificultadUsuario)
    {
        $preguntasSinResponder = $this->partidaModel->getListaDePreguntasSinResponderByIdUsuario($idUsuario, $dificultadUsuario);
        $preguntaNueva = $this->partidaModel->getPreguntaSinResponder($preguntasSinResponder);
        $respuestas = $this->partidaModel->getRespuestasByIdPregunta($preguntaNueva[0]);
        $resultado = [
            'preguntasSinResponder' => $preguntasSinResponder,
            'preguntaNueva' => $preguntaNueva,
            'respuestas' => $respuestas,
            'categoria' => $preguntaNueva['categoria']
        ];

        return $resultado;
    }



}
