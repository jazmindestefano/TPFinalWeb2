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
            if (empty($_GET['idUsuario'])) {
                $idUser = $_SESSION['actualUser'];
                $data["miPerfil"] = $this->perfilModel->getUserById($idUser);
            } else {
                $data["otroPerfil"] = $this->perfilModel->getUserById($_GET['idUsuario']);
            }

            $this->renderer->render('perfil', $data);
            exit();

        }
    }



