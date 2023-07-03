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

        public function empezarPartida()
        {
            $_SESSION['puntajeDePartida'] = 0;
            $data = array();
            $this->renderer->render('partida', $data);
        }


        public function jugarPartida()
        {
            $idUsuario = $_SESSION['actualUser'];
            $dificultadUsuario = $this->partidaModel->getDificultadDelUsuario($idUsuario)[0]['dificultad'];

            if (count($this->partidaModel->getListaDePreguntasSinResponderByIdUsuario($idUsuario, $dificultadUsuario)) == 1) {
                $this->partidaModel->borrarPreguntasRespondidasByIdUsuario($idUsuario);
            }

            if (isset($_GET["idRespuesta"])) {

                $timestamp = time();

                $diferencia = $_SESSION['timestampPregunta'] - $timestamp;

                if ($diferencia < -10) {
                    $this->finalizarPartida();
                }

                $idPregunta = $this->partidaModel->getIdPreguntaByIdRespuesta($_GET["idRespuesta"])[0]['idPregunta'];
                $this->partidaModel->insertarPreguntaEnPreguntaRespondida($idPregunta, $idUsuario);
                $this->partidaModel->updatePreguntaRespondida($idPregunta, $idUsuario);
                $_SESSION['puntajeDePartida']++;
            }

            $pregunta = $this->getNuevaPregunta($idUsuario, $dificultadUsuario);


            $data = array('preguntas' => $pregunta['preguntaNueva'],
                'respuestas' => $pregunta['respuestas'],
                'categoria' => $pregunta['categoria']);

            header('Content-Type: application/json');
            echo json_encode($data);

        }

        public function finalizarPartida()
        {
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

        public function reportar()
        {
            $idPreguntaReportada = $_GET['id'];
            $this->partidaModel->marcarPreguntaComoReportada($idPreguntaReportada);
            $pregunta = $this->partidaModel->getPreguntaByIdDePregunta($idPreguntaReportada);
            $data = array('pregunta' => $pregunta);
            $this->renderer->render('reportar', $data);
        }


        public function preguntaActual()
        {
            $data = array('preguntas' => $_SESSION['preguntaActual'],
                'respuestas' => $_SESSION['respuestasActuales'],
                'categoria' => $_SESSION['categoriaActual']);

            header('Content-Type: application/json');
            echo json_encode($data);
        }


        public function getNuevaPregunta($idUsuario, $dificultadUsuario)
        {
            $preguntasSinResponder = $this->partidaModel->getListaDePreguntasSinResponderByIdUsuario($idUsuario, $dificultadUsuario);
            $preguntaNueva = $this->partidaModel->getPreguntaSinResponder($preguntasSinResponder);
            $respuestas = $this->partidaModel->getRespuestasByIdPregunta($preguntaNueva[0]);
            $_SESSION['preguntaActual'] = $preguntaNueva;
            $_SESSION['respuestasActuales'] = $respuestas;
            $_SESSION['categoriaActual'] = $preguntaNueva['categoria'];
            $timestamp = time();
            $_SESSION['timestampPregunta'] = $timestamp;
            $resultado = [
                'preguntasSinResponder' => $preguntasSinResponder,
                'preguntaNueva' => $preguntaNueva,
                'respuestas' => $respuestas,
                'categoria' => $preguntaNueva['categoria'],
            ];

            return $resultado;
        }


        public function terminoSinResponder()
        {
            $idUsuario = $_SESSION['actualUser'];
            $puntajeTotal = $this->partidaModel->getPuntajeTotalByIdUser($idUsuario)[0]['puntaje'] + $_SESSION['puntajeDePartida'];
            $this->partidaModel->updatePuntajeTotal($idUsuario, $puntajeTotal);

            $data = array(
                "puntaje" => $_SESSION['puntajeDePartida']);

            header('Content-Type: application/json');
            echo json_encode($data);

        }
    }
