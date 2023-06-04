<?php

class PreguntaController
{

    private $renderer;
    private $preguntaModel;

    public function __construct($preguntaModel,$renderer)
    {
        $this->preguntaModel = $preguntaModel;
        $this->renderer = $renderer;
    }

    public function crear()
    {
        $data = [];
        $this->renderer->render('crearpregunta', $data);
    }

    public function insertar(){
        var_dump($_POST['pregunta']);
        exit();
    }
}