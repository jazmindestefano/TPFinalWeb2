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

	          $puntajeDePartida = 0;
	          $_SESSION['puntajeDePartida'] = $puntajeDePartida;

            $preguntasSinResponder = $this->partidaModel->getPreguntaSinRepetir($idUsuario);

            $pregunta = $this->partidaModel->getPreguntaSinResponder($preguntasSinResponder);

            $respuestas = $this->partidaModel->getRespuestas($pregunta[0]);

						$categoria = $this->partidaModel->getCategoriaByIdDePregunta($pregunta[0])[0]["categoria"];

            $data = array('preguntas' => $pregunta,
                'respuestas' => $respuestas,
	              'categoria' => $categoria);
            $this->renderer->render('partida', $data);
        }

        public function validar()
        {

            $idUsuario = $_SESSION['actualUser'];

            $idDePregunta = $this->partidaModel->getIdPreguntaByIdRespuesta($_GET['id'])[0]['idPregunta'];

            $preguntaRespondida = $this->partidaModel->getPregunta($idDePregunta);

            $respuestaDelUsuario = $this->partidaModel->getRespuestaPorId($_GET['id'])[0]['respuesta'];

            $respuestaCorrecta = $this->partidaModel->getRespuestaCorrectaByIdDePregunta($idDePregunta)[0]['respuesta'];

            $mensaje = $this->partidaModel->respuestaMensaje($respuestaCorrecta, $respuestaDelUsuario);

            $this->partidaModel->insertarPreguntaEnPreguntaRespondida($idDePregunta, $idUsuario);

            $preguntasSinResponder = $this->partidaModel->getPreguntaSinRepetir($idUsuario);

            $preguntaNueva = $this->partidaModel->getPreguntaSinResponder($preguntasSinResponder);

            $respuestas = $this->partidaModel->getRespuestas($preguntaNueva[0]);

						$puntajeTotal = $this->partidaModel->getPuntajeActualByIdUser($idUsuario)[0]['puntaje'];

	          $categoria = $this->partidaModel->getCategoriaByIdDePregunta($preguntaNueva[0])[0]["categoria"];

            if($respuestaDelUsuario == $respuestaCorrecta) {

                $data = array('preguntas' => $preguntaNueva,
                    'respuestas' => $respuestas,
	                  'categoria' => $categoria);

	            $_SESSION['puntajeDePartida']++;
							$puntajeTotal++;

							$this->partidaModel->updatePuntajeTotal($idUsuario,$puntajeTotal);
	            $this->renderer->render('partida', $data);
            } else {

                $data = array('preguntas' => $preguntaRespondida,
                    'mensajeDeLaPartida' => $mensaje,
                    'puntaje' => $_SESSION['puntajeDePartida']);

                $this->renderer->render('partida', $data);

            }

        }

    }
