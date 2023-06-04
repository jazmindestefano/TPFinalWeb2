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
                $this->insertarRespuestas($_POST['pregunta'], $_POST['respuesta_a'], $_POST['respuesta_b'], $_POST['respuesta_c'], $_POST['respuesta_d'], $_POST['respuesta_correcta'], $_POST['categoria']);
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

    public function insertarRespuestas($pregunta, $respuesta_a, $respuesta_b, $respuesta_c, $respuesta_d, $respuesta_correcta, $categoria){
        $idPregunta = $this->preguntaModel->getIdPregunta($pregunta)[0]['idPregunta'];
        var_dump( $respuesta_a, $respuesta_b, $respuesta_c, $respuesta_d, $respuesta_correcta, $categoria);
        exit();
    }
}

