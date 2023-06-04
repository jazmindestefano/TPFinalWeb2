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

            $preguntasSinResponder = $this->partidaModel->getPreguntaSinRepetir($idUsuario);
            $cantidadDePreguntas = Count($this->partidaModel->getCantidadDePreguntas());

            $pregunta = null;

            if (!empty($preguntasSinResponder)) {
                $pregunta = $this->partidaModel->getPreguntaSinResponder($preguntasSinResponder);
            }


            $respuesta = $this->partidaModel->getRespuesta($pregunta[0]);

            $data = array('preguntas' => $pregunta,
                'respuestas' => $respuesta);
            $this->renderer->render('partida', $data);
        }

        public function validar()
        {

            $idUsuario = $_SESSION['actualUser'];
            $idDePregunta = $this->partidaModel->getPreguntaByIdRespuesta($_GET['id'])[0]['idPregunta'];
            $respuestaDelUsuario = $this->partidaModel->getRespuestaPorId($_GET['id'])[0]['respuesta'];
            $respuestaCorrecta = $this->partidaModel->getRespuestaCorrectaByIdDePregunta($idDePregunta)[0]['respuesta'];
            $mensaje = $this->partidaModel->respuestaMensaje($respuestaCorrecta, $respuestaDelUsuario);
            $pregunta = $this->partidaModel->getPreguntaSinRepetir($idUsuario);
            $this->partidaModel->insertarPreguntaEnPreguntaRespondida($idDePregunta, $idUsuario);

            if ($respuestaDelUsuario == $respuestaCorrecta) {
                $data = array('preguntas' => $pregunta,
                    'mensajeDeLaPartida' => $mensaje);
                header('location: /partida/empezar');

            } else {
                $data = array('preguntas' => $pregunta,
                    'mensajeDeLaPartida' => $mensaje);
                $this->renderer->render('partida', $data);

            }

        }

    }
