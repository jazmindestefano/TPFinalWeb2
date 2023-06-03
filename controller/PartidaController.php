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

		public function empezar()
		{
			$cantidadDePreguntas = Count($this->partidaModel->getCantidadDePreguntas());
			$id = rand(1, $cantidadDePreguntas);
			$pregunta = $this->partidaModel->getPregunta($id);
			$respuestaCorrecta = $this->partidaModel->getPreguntaCorrectaByIdDePregunta($id)[0]['RespuestaCorrecta'];
			$respuestaDelUsuario = $_POST['respuestaDelUsuario'];

			$mensaje = $this->partidaModel->respuestaMensaje($respuestaCorrecta, $respuestaDelUsuario);


			if($respuestaDelUsuario) {
				$data = array('preguntas' => $pregunta,
					'mensajeDeLaPartida' => $mensaje);

			} else {
				$data = array('preguntas' => $pregunta);

			}
			$this->renderer->render('partida', $data);

		}

	}