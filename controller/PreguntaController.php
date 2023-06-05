<?php

    class PreguntaController
    {

        private $renderer;
        private $preguntaModel;

        public function __construct($preguntaModel, $renderer)
        {
            $this->preguntaModel = $preguntaModel;
            $this->renderer = $renderer;
        }

        public function crear()
        {
            $data = [];
            $this->renderer->render('crearpregunta', $data);
        }

        public function insertar()
        {
            $pregunta = $_POST['pregunta'];
            $categoria = $_POST['categoria'];
            $noExisteOtraPreguntaIgual = count($this->preguntaModel->validarQueNoHayaDosPreguntasIguales($pregunta)) === 0;

            if (!empty($pregunta) && $noExisteOtraPreguntaIgual) {
                $preguntaInsertar = $this->preguntaModel->crearPregunta($pregunta, $categoria);
                $idLastPregunta = $this->preguntaModel->getLastPreguntaInsertada()[0]["idPregunta"];
                header("Location: /pregunta/crearRespuesta&idPregunta=" . $idLastPregunta);
            } else {
                header("Location: /pregunta/crear");
            }

        }

        public function crearRespuesta()
        {

            $idPregunta = $_GET['idPregunta'];
            $data["idPregunta"] = $idPregunta;
            $this->renderer->render('crearRespuestas', $data);
        }

        public function insertarRespuestas() {

            $idPregunta = $_POST['idPregunta'];
            $respuesta_a = $_POST['respuesta_a'];
            $respuesta_b = $_POST['respuesta_b'];
            $respuesta_c = $_POST['respuesta_c'];
            $respuesta_d = $_POST['respuesta_d'];
            $respuestaCorrecta = $_POST['respuesta_correcta'];


            if ($respuesta_a && $respuesta_b && $respuesta_c && $respuesta_d && $respuestaCorrecta) {



                $this->preguntaModel->insertarRespuesta($respuesta_a, $idPregunta);
                $this->preguntaModel->insertarRespuesta($respuesta_b, $idPregunta);
                $this->preguntaModel->insertarRespuesta($respuesta_c, $idPregunta);
                $this->preguntaModel->insertarRespuesta($respuesta_d, $idPregunta);
               $this->preguntaModel->setearTrue(`$`.`$respuestaCorrecta`);

            }

        }


    }

