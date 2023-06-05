<?php

	class PreguntaController
	{

		private $renderer;
		private $preguntaModel;

		public function __construct($preguntaModel, $renderer)
		{
			$this->preguntaModel = $preguntaModel;
			$this->renderer = $renderer;
		}

		public function crear()
		{
			$data = [];
			$this->renderer->render('crearpregunta', $data);
		}

		public function insertar()
		{

			$pregunta = isset($_POST['pregunta']);
			$categoria = isset($_POST['categoria']);
			$noExisteOtraPreguntaIgual = count($this->preguntaModel->validarQueNoHayaDosPreguntasIguales($pregunta)) === 0;

			if (!empty($pregunta) && $noExisteOtraPreguntaIgual) {
				$preguntaInsertar = $this->preguntaModel->crearPregunta($pregunta, $categoria);
				$idLastPregunta = $this->preguntaModel->getLastPreguntaInsertada()[0]["idPregunta"];
				header("Location: /pregunta/crearRespuesta&idPregunta=".$idLastPregunta);
			} else {
				$mensaje["mensaje"] = "La pregunta ya existe, por favor ingresa otra!";
				$this->renderer->render('/crearpregunta', $mensaje);
			}

		}

		public function crearRespuesta() {

			$idPregunta = $_GET['idPregunta'];

			$respuesta_a = isset($_POST['respuesta_a']);
			$respuesta_b = isset($_POST['respuesta_b']);
			$respuesta_c = isset($_POST['respuesta_c']);
			$respuesta_d = isset($_POST['respuesta_d']);
			$respuestaCorrecta = isset($_POST['respuesta_correcta']);



			if($respuesta_a && $respuesta_b && $respuesta_c && $respuesta_d && $respuestaCorrecta) {

			}

			$this->renderer->render('crearRespuestas', []);
		}

	}

