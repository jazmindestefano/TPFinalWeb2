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
            $query = "SELECT pregunta FROM preguntas";
            return $this->database->query($query);
        }

        public function getPregunta($id)
        {
            $query = "SELECT * FROM preguntas WHERE idPregunta= '$id' ";
            return $this->database->query($query);
        }

        public function getRespuestaCorrectaByIdDePregunta($id)
        {
            $query = "SELECT respuesta FROM respuestas WHERE isCorrecta= 1 AND idPregunta= '$id' ";
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


        public function getRespuesta($idPregunta)
        {
            $query = "SELECT * FROM respuestas WHERE idPregunta= '$idPregunta' ";
            return $this->database->query($query);
        }

        public function getRespuestaPorId($idRespuesta)
        {
            $query = "SELECT respuesta FROM respuestas WHERE idRespuesta= '$idRespuesta' ";
            return $this->database->query($query);
        }

        public function getPreguntaByIdRespuesta($id)
        {
            $query = "SELECT idPregunta FROM respuestas WHERE  idRespuesta= '$id' ";
            return $this->database->query($query);
        }

    }
