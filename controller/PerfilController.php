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
                $esEditor = false;
                $miUser = $this->perfilModel->getUserById($idUser);
                if($miUser[0]['rol'] === 'editor') {
                    $esEditor = true;
                }
                $data = array("miPerfil" => $miUser, "esEditor" => $esEditor);
            } else {
                $data["otroPerfil"] = $this->perfilModel->getUserById($_GET['idUsuario']);
            }
            $this->renderer->render('perfil', $data);
            exit();

        }
    }



