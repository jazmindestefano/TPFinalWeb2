<?php

class PartidaController
{

    private $renderer;
    private $partidaModel;

    public function __construct($partidaModel, $renderer)
    {
        $this->partidaModel = $partidaModel;
        $this->renderer = $renderer;
    }

    public function ver()
    {
        $users = $this->partidaModel->getUsers();
        $data = array('users' => $users);
        $this->renderer->render('partida', $data);
    }

    public function empezar(){
        $cantidadDePreguntas= Count($this->partidaModel->getCantidadDePreguntas());
        $id= rand(1, $cantidadDePreguntas);
        $pregunta = $this->partidaModel->getPregunta($id);
				$respuestaCorrecta = $this->partidaModel->getPreguntaCorrectaByIdDePregunta($id);
				$respuestaDelUsuario = isset($_POST['respuestaDelUsuario']) ?? "";

        $data = array('preguntas'=>$pregunta) ;


	    $this->renderer->render('partida', $data);
    }
}