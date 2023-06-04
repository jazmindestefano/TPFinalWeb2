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
            //trae el id del usuario
            $idUsuario = $_SESSION['actualUser'];
            //trae una lista de respuestas que el usuario todavia no respondio
            $preguntasSinResponder = $this->partidaModel->getPreguntaSinRepetir($idUsuario);
            //trae una pregunta de la lista de preguntas sin responder
            $pregunta = $this->partidaModel->getPreguntaSinResponder($preguntasSinResponder);
            //trae una lista de respuestas para la pregunta
            $respuestas = $this->partidaModel->getRespuestas($pregunta[0]);//aca se rompe


            $data = array('preguntas' => $pregunta,
                'respuestas' => $respuestas);
            $this->renderer->render('partida', $data);
        }

        public function validar()
        {
            //trae el id del usuario
            $idUsuario = $_SESSION['actualUser'];
            //trae el id de la pregunta
            $idDePregunta = $this->partidaModel->getIdPreguntaByIdRespuesta($_GET['id'])[0]['idPregunta'];
            //trae otra vez una pregunta (no se si va getPreguntaByIdRespuesta o getPreguntaSinResponder)
            $preguntaRespondida = $this->partidaModel->getPregunta($idDePregunta);
            //trae la respuesta del usuario
            $respuestaDelUsuario = $this->partidaModel->getRespuestaPorId($_GET['id'])[0]['respuesta'];
            //trae la respuesta correcta
            $respuestaCorrecta = $this->partidaModel->getRespuestaCorrectaByIdDePregunta($idDePregunta)[0]['respuesta'];
            //setea el mensaje
            $mensaje = $this->partidaModel->respuestaMensaje($respuestaCorrecta, $respuestaDelUsuario);
            //guarda la pregunta en una lista de preguntas respondidas por el usuario
            $this->partidaModel->insertarPreguntaEnPreguntaRespondida($idDePregunta, $idUsuario);
            //trae una lista de respuestas que el usuario todavia no respondio
            $preguntasSinResponder = $this->partidaModel->getPreguntaSinRepetir($idUsuario);
            //trae otra pregunta
            $preguntaNueva = $this->partidaModel->getPreguntaSinResponder($preguntasSinResponder);
            //trae una lista de respuestas para la pregunta
            $respuestas = $this->partidaModel->getRespuestas($preguntaNueva[0]);//aca tambien se rompe


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
