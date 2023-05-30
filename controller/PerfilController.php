<?php

    class PerfilController
    {
        private $perfilModel;
        private $renderer;


        public function __construct($perfilModel, $renderer)
        {
            $this->perfilModel = $perfilModel;
            $this->renderer = $renderer;
        }


        public function perfil()
        {
            $idUser = $_SESSION['actualUser'];
            $data["perfil"] = $this->perfilModel->getUserById($idUser);
            $this->renderer->render('perfil', $data);
            exit();
        }
    }



