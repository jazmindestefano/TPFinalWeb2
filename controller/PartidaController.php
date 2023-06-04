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

            $pregunta = $this->partidaModel->getPreguntaSinResponder($preguntasSinResponder);

            $respuestas = $this->partidaModel->getRespuestas($pregunta[0]);


            $data = array('preguntas' => $pregunta,
                'respuestas' => $respuestas);
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


            if ($respuestaDelUsuario == $respuestaCorrecta) {
                $data = array('preguntas' => $preguntaNueva,
                    'respuestas' => $respuestas);

                //aca capaz se puede usar un render y pasarle una nueva pregunta con
                // nuevas respuestas para no ir moviendonos de metodo a metodo
                //capas esto nos ayuda para el tema de los puntos

                $this->renderer->render('partida', $data);
//                header('location: /partida/empezar');
            } else {
                $data = array('preguntas' => $preguntaRespondida,
                    'mensajeDeLaPartida' => $mensaje);
                $this->renderer->render('partida', $data);

            }

        }

    }
