<?php

    class EditorModel

    {
        private $database;

        public function __construct($database)
        {
            $this->database = $database;
        }


        public function listaDePreguntas()
        {
            $query = "SELECT * FROM preguntas";
            return $this->database->query($query);
        }

        public function aprobarPregunta($idPregunta)
        {
            $query = "UPDATE preguntas SET estado='aprobado' WHERE idPregunta='$idPregunta'";
            return $this->database->insert($query);
        }


        public function eliminarPregunta($idPregunta)
        {
            $query = "DELETE FROM preguntas WHERE idPregunta='$idPregunta'";
            return $this->database->insert($query);
        }


        public function editarPregunta($idPregunta, $pregunta, $categoria)
        {
            $query = "UPDATE preguntas SET pregunta='$pregunta', categoria='$categoria' WHERE idPregunta='$idPregunta'";
            return $this->database->insert($query);
        }

        public function editarRespuesta($idRespuesta, $respuesta, $esCorrecta)
        {
            $query = "UPDATE respuestas SET respuesta='$respuesta', isCorrecta='$esCorrecta' WHERE idRespuesta='$idRespuesta'";
            return $this->database->insert($query);
        }


        public function getPreguntasPorAprobadas()
        {
            $query = "SELECT * FROM preguntas where estado='aprobada'";
            $preguntas = $this->database->query($query);

            return $preguntas;
        }

        public function getPreguntasPorReportadas()
        {
            $query = "SELECT * FROM preguntas where estado='reportada'";
            $preguntas = $this->database->query($query);

            return $preguntas;
        }

        public function getPreguntasPorDesaprobados()
        {
            $query = "SELECT * FROM preguntas where estado='desaprobada'";
            $preguntas = $this->database->query($query);

            return $preguntas;
        }

        public function getPreguntasByIdASC()
        {
            $query = "SELECT * FROM preguntas where idPregunta ASC";
            $preguntas = $this->database->query($query);

            return $preguntas;
        }


        public function getPreguntaById($id)
        {
            $query = "SELECT * FROM preguntas WHERE idPregunta= '$id' ";
            return $this->database->query($query);
        }

        public function getRespuestasByIdDePregunta($idPregunta)
        {
            $query = "SELECT * FROM respuestas WHERE idPregunta= '$idPregunta' ";
            return $this->database->query($query);
        }

        public function getCategoriaByIdPregunta($idPregunta) {
            $query = "SELECT categoria FROM preguntas WHERE idPregunta= '$idPregunta' ";
            return $this->database->query($query);
        }

    }
