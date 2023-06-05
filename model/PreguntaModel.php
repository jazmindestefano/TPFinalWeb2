<?php

class PreguntaModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function crearPregunta($pregunta, $categoria)
    {
        $sql = "INSERT INTO preguntas(pregunta, categoria) VALUES('$pregunta','$categoria')";
        return $this->database->insert($sql);
    }

    public function validarQueNoHayaDosPreguntasIguales($pregunta) {
        $sql = "SELECT * FROM preguntas WHERE pregunta = '$pregunta'";
        return $this->database->query($sql);
    }

    public function getIdPregunta($pregunta){
        $sql = "SELECT idPregunta FROM preguntas WHERE pregunta = '$pregunta'";
        return $this->database->query($sql);
    }

    public function insertarRespuesta($respuesta, $isCorrecta, $idPregunta){
        $sql = "INSERT INTO respuestas(respuesta, isCorrecta, idPregunta) VALUES('$respuesta', '$isCorrecta', '$idPregunta')";
        return $this->database->insert($sql);
    }

		public function getLastPreguntaInsertada() {
				$query = "SELECT *
									FROM preguntas
									WHERE idPregunta = (SELECT MAX(idPregunta) FROM preguntas);";
				return $this->database->query($query);

		}



}