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

        public function ver()
        {
            $users = $this->partidaModel->getUsers();
            $data = array('users' => $users);
            $this->renderer->render('partida', $data);
        }

        public function empezar()
        {
            $cantidadDePreguntas = Count($this->partidaModel->getCantidadDePreguntas());
            $id = rand(1, $cantidadDePreguntas);

            $pregunta = $this->partidaModel->getPregunta($id);
            $respuesta = $this->partidaModel->getRespuesta($id);
            $data = array('preguntas' => $pregunta,
                'respuestas' => $respuesta );
            $this->renderer->render('partida', $data);
        }

        public function validar()
        {
            $idDePregunta= $this->partidaModel->getPreguntaByIdRespuesta($_GET['id'])[0]['idPregunta'];
            $respuestaDelUsuario= $this->partidaModel->getRespuestaPorId($_GET['id'])[0]['respuesta'];
            $respuestaCorrecta = $this->partidaModel->getRespuestaCorrectaByIdDePregunta($idDePregunta)[0]['respuesta'];
            $mensaje = $this->partidaModel->respuestaMensaje($respuestaCorrecta, $respuestaDelUsuario);
            $pregunta = $this->partidaModel->getPregunta($idDePregunta);

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
