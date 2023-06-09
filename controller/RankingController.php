<?php

	class RankingController
	{
		private $rankingModel;
		private $renderer;

		public function __construct(RankingModel $rankingModel, MustacheRender $renderer)
		{
			$this->rankingModel = $rankingModel;
			$this->renderer = $renderer;
		}


		public function ver()
		{
			$users = $this->rankingModel->getUsersByOrderDesc();

			$data = array('users' => $users);
			$this->renderer->render('ranking', $data);
		}

		public function filtrar()
		{

			$filtro = $_GET['filtro'];

			switch ($filtro) {
				case 'ascPuntos':
					$users = $this->rankingModel->getUsersByOrderAsc();
					break;
				case 'descPartidas':
					$users = $this->rankingModel->getUsersByPartidasDesc();
					break;
				case 'ascPartidas':
					$users = $this->rankingModel->getUsersByPartidasAsc();
					break;
				default:
					$users = $this->rankingModel->getUsersByOrderDesc();
					break;
			}

			$response = ['users' => $users];

			header('Content-Type: application/json');
			echo json_encode($response);
		}

	}
