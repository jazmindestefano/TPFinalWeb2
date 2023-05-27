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

		public function login()
		{
			$this->renderer->render('perfil');
		}

		public function verPerfil()
		{
		}
	}