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


    public function getRespuestasByIdPregunta($idPregunta)
    {
        $query = "SELECT * FROM respuestas WHERE idPregunta= '$idPregunta' ";
        return $this->database->query($query);
    }

    public function getRespuestaPorId($idRespuesta)
    {
        $query = "SELECT respuesta FROM respuestas WHERE idRespuesta= '$idRespuesta' ";
        return $this->database->query($query);
    }

    public function getPreguntaByIdDePregunta($id)
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

    public function getDificultadDelUsuario($idUsuario)
    {
        $query = "SELECT dificultad FROM usuarios WHERE idUsuario = '$idUsuario' ";
        return $this->database->query($query);
    }

    public function getListaDePreguntasSinResponderByIdUsuario($idUsuario, $dificultad)
    {
        $query = "SELECT p.* FROM Preguntas p WHERE p.idPregunta NOT IN ( SELECT pr.idPregunta FROM preguntasRespondidas pr WHERE pr.idUsuario = $idUsuario ) AND (p.estado = 'aprobada' OR p.estado = 'reportada') AND (p.dificultad = '$dificultad')";
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


    public function getPuntajeTotalByIdUser($id)
    {
        $query = "SELECT puntaje FROM usuarios WHERE idUsuario = '$id'";
        return $this->database->query($query);
    }

    public function getCantidadPartidasJugadas($id)
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
            $porcentaje = ($vecesAcertada / $vecesRespondida) * 100;
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

    public function marcarPreguntaComoReportada($idPreguntaReportada)
    {
        $update = "UPDATE preguntas SET estado = 'reportada' WHERE idPregunta = '$idPreguntaReportada'";
        return $this->database->insert($update);
    }

    public function getPorcentajeDePreguntasRespondidasCorrectamentePorUsuario($idUsuario)
    {
        $query = "SELECT (COUNT(CASE WHEN acertada = 1 THEN 1 END) / COUNT(*)) * 100 FROM preguntasrespondidas WHERE idUsuario = '$idUsuario'";
        return $this->database->query($query);
    }

    public function updateDificultadUsuario($idUsuario, $porcentaje)
    {
        $edadUsuario = $this->getEdadUsuario($idUsuario);

        if ($edadUsuario < 18) {
            $dificultad = 'facil';
        } elseif ($edadUsuario >= 18 && $edadUsuario < 65) {
            if ($porcentaje >= 75) {
                $dificultad = 'dificil';
            } elseif ($porcentaje >= 35 && $porcentaje < 75) {
                $dificultad = 'media';
            } else {
                $dificultad = 'facil';
            }
        } else {
            $dificultad = 'media';
        }

        $query = "UPDATE usuarios SET dificultad = '$dificultad' WHERE idUsuario = '$idUsuario'";
        return $this->database->insert($query);
    }

    public function getEdadUsuario($idUsuario)
    {
        // Obtener la fecha de nacimiento del usuario desde la base de datos
        $query = "SELECT fechaDeNacimiento FROM usuarios WHERE idUsuario = '$idUsuario'";
        $result = $this->database->query($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $fechaNacimiento = $row['fechaDeNacimiento'];

            // Calcular la edad en base a la fecha de nacimiento
            $fechaNacimiento = new DateTime($fechaNacimiento);
            $hoy = new DateTime();
            $edad = $hoy->diff($fechaNacimiento)->y;

            return $edad;
        }

        return 0;
    }

}
