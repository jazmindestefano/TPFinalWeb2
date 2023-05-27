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
            session_start();
            $idUser = $_SESSION['actualUser'];
            $data["perfil"] = $this->perfilModel->getUserById($idUser);
			$this->renderer->render('perfil', $data);
            exit();
		}

		public function verPerfil()
		{
            session_start();
            $idUser = $_SESSION['actualUser'];
            $this->perfilModel->getUserById($idUser);
            exit();
		}
	}