<?php

class PreguntaModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function crearPregunta($pregunta) {
        $sql =  "INSERT INTO `preguntas` (`pregunta`) VALUES ('$pregunta')";
        return $this->database->insert($sql);
    }

}