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

    public function jugar()
    {
        $data = [];
        $this->renderer->render('partida', $data);
    }
}