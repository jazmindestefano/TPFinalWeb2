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

        public function respuestaMensaje($respuestaCorrecta, $respuestaDelUsuario)
        {
            if ($respuestaCorrecta != $respuestaDelUsuario) {
                $data["mensajeDePartida"] = "Incorrecto, la respuesta correcta es " . $respuestaCorrecta;
            }

            return $data ?? "";
        }


        public function getRespuestas($idPregunta)
        {
            $query = "SELECT * FROM respuestas WHERE idPregunta= '$idPregunta' ";
            return $this->database->query($query);
        }

        public function getRespuestaPorId($idRespuesta)
        {
            $query = "SELECT respuesta FROM respuestas WHERE idRespuesta= '$idRespuesta' ";
            return $this->database->query($query);
        }

        public function getPregunta($id)
        {
            $query = "SELECT * FROM preguntas WHERE idPregunta= '$id' ";
            return $this->database->query($query);
        }

        public function getPreguntaSinResponder($preguntasSinResponder)
        {
            return $preguntasSinResponder[rand(0, count($preguntasSinResponder) - 1)];
        }


        public function getIdPreguntaByIdRespuesta($id)
        {
            $query = "SELECT idPregunta FROM respuestas WHERE  idRespuesta= '$id' ";
            return $this->database->query($query);
        }

        public function getRespuestaCorrectaByIdDePregunta($id)
        {
            $query = "SELECT respuesta FROM respuestas WHERE isCorrecta= 1 AND idPregunta= '$id' ";
            return $this->database->query($query);
        }

        public function getPreguntaSinRepetir($idUsuario)
        {
            $query = "SELECT p.*
                        FROM Preguntas p
                        WHERE p.idPregunta NOT IN (
                             SELECT pr.idPregunta
                              FROM preguntasRespondidas pr
                            WHERE pr.idUsuario = $idUsuario)";
            return $this->database->query($query);
        }

        public function insertarPreguntaEnPreguntaRespondida($idDePregunta, $idUsuario)
        {
            $sql = "INSERT INTO `preguntasrespondidas` ( `idUsuario`, `idPregunta`) VALUES ( '$idUsuario', '$idDePregunta')";
            return $this->database->insert($sql);
        }

        public function updatePreguntaRespondida($idDePregunta, $idUsuario)
        {
            $sql = "UPDATE preguntasrespondidas SET acertada = 1 WHERE idUsuario = '$idUsuario' AND idPregunta= '$idDePregunta'";
            return $this->database->insert($sql);
        }


        public function getPuntajeActualByIdUser($id)
        {
            $query = "SELECT puntaje FROM usuarios WHERE idUsuario = '$id'";
            return $this->database->query($query);
        }

        public function getPartidasJugadas($id)
        {
            $query = "SELECT partidasJugadas FROM usuarios WHERE idUsuario = '$id'";
            return $this->database->query($query);
        }

        public function updatePuntajeTotal($idUsuario, $puntaje)
        {
            $query = "UPDATE usuarios SET puntaje = '$puntaje' WHERE idUsuario = '$idUsuario'";
            return $this->database->insert($query);
        }

        public function updatePartidasJugadas($idUsuario, $partidas)
        {
            $query = "UPDATE usuarios SET partidasJugadas = '$partidas' WHERE idUsuario = '$idUsuario'";
            return $this->database->insert($query);
        }

        public function getCategoriaByIdDePregunta($id)
        {
            $query = "SELECT categoria FROM preguntas WHERE idPregunta= '$id'";
            return $this->database->query($query);
        }

        public function borrarPreguntasRespondidasByIdUsuario($idUsuario)
        {
            $query = "DELETE FROM preguntasRespondidas WHERE idUsuario = '$idUsuario'";
            return $this->database->insert($query);
        }

        public function updateDificultadPregunta($idDePregunta)
        {

            $vecesRespondida = count($this->vecesRespondida($idDePregunta));
            $vecesAcertada = count($this->vecesAcertada($idDePregunta));
            if ($vecesAcertada != 0) {
                $porcentaje = ($vecesRespondida / 100) * $vecesAcertada;
            }

            if ($porcentaje < 35) {
                $dificultad = "dificil";
            } else if ($porcentaje > 67) {
                $dificultad = "facil";
            } else {
                $dificultad = "media";
            }

            $query = "UPDATE preguntas SET dificultad='$dificultad' WHERE idPregunta= '$idDePregunta'";

            return $this->database->insert($query);
        }

        public function vecesRespondida($idDePregunta)
        {
            $query = "SELECT * FROM preguntasrespondidas WHERE idPregunta= '$idDePregunta'";
            return $this->database->query($query);
        }

        public function vecesAcertada($idDePregunta)
        {
            $query = "SELECT * FROM preguntasrespondidas WHERE idPregunta= '$idDePregunta' AND acertada= 1";
            return $this->database->query($query);
        }


    }
