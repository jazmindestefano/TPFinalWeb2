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

        public function desaprobarPregunta($idPregunta)
        {
            $query = "UPDATE preguntas SET estado='desaprobado' WHERE idPregunta='$idPregunta'";
            return $this->database->insert($query);
        }


        public function eliminarPregunta($idPregunta)
        {
            $query = "DELETE FROM preguntas WHERE idPregunta='$idPregunta'";
            return $this->database->insert($query);
        }


        public function editarPregunta($idPregunta)
        {
            $query = "UPDATE preguntas SET  WHERE idPregunta='$idPregunta'";
            return $this->database->insert($query);
        }


        public function getPreguntasPorAprobadas()
        {
            $query = "SELECT * FROM preguntas where estado='aprobado' ";
            $preguntas = $this->database->query($query);

            return $preguntas;
        }

        public function getPreguntasPorDesaprobado()
        {
            $query = "SELECT * FROM preguntas where estado='desaprobado' ";
            $preguntas = $this->database->query($query);

            return $preguntas;
        }

        public function getPreguntasPorSugeridas()
        {
            $query = "SELECT * FROM preguntas where estado='desaprobado' ";
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

    }
