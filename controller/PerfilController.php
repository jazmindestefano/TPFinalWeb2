<?php

    include_once("./helpers/ValidarUsuarioLogeado.php");

    class PerfilController extends ValidarUsuarioLogeado
    {
        private $perfilModel;
        private $renderer;


        public function __construct($perfilModel, $renderer)
        {
            $this->perfilModel = $perfilModel;
            $this->renderer = $renderer;
        }

	    public function perfil() {
		    $this->validarUsuarioLogeado();

		    session_start();
		    $idUser = $_SESSION['actualUser'];
		    $data["perfil"] = $this->perfilModel->getUserById($idUser);
		    $this->renderer->render('perfil', $data);
		    exit();
	    }
    }



