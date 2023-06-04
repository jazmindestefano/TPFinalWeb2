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
       $preguntaInsertar = null;
        if(isset($_POST['pregunta'])) {
            if(count($this->preguntaModel->validarQueNoHayaDosPreguntasIguales($_POST['pregunta'])) === 0) {
                $preguntaInsertar = $this->preguntaModel->crearPregunta($_POST['pregunta']);
                if($preguntaInsertar) {
                    header('location: /');
                } else {
                    header('location: /pregunta/crear');
                }
            } else {
                header('location: /pregunta/crear'); // deberia mostrar mensaje de que pregunta ya existe
            }
        }
    }
}

