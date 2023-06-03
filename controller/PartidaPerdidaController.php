<?php

	class PartidaPerdidaController
	{
		private $renderer;
		private $partidaPerdidaModel;

		public function __construct($partidaPerdidaModel, $renderer)
		{
			$this->partidaPerdidaModel = $partidaPerdidaModel;
			$this->renderer = $renderer;
		}

		public function list() {
			$data = [];
			$this->renderer->render('partidaPerdida', $data);
		}
	}