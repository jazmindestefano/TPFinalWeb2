<?php


    class PartidaModel
    {


        private $database;

        public function __construct($database)
        {
            $this->database = $database;
        }


        public function getCantidadDePreguntas()
        {
            $query = "SELECT Pregunta FROM preguntas";
            return $this->database->query($query);
        }

        public function getPregunta($id)
        {
            $query = "SELECT * FROM preguntas WHERE ID= '$id' ";
            return $this->database->query($query);
        }

        public function getPreguntaCorrectaByIdDePregunta($id)
        {
            $query = "SELECT RespuestaCorrecta FROM preguntas WHERE ID= '$id' ";
            return $this->database->query($query);
        }

        public function respuestaMensaje($respuestaCorrecta, $respuestaDelUsuario)
        {
            if ($respuestaCorrecta != $respuestaDelUsuario) {
                $data["mensajeDePartida"] = "Incorrecto, la respuesta correcta es " . $respuestaCorrecta;
            } else {
                $data["mensajeDePartida"] = "Correcto";
            }

            return $data;
        }


    }
