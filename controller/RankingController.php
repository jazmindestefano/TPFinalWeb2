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
			$filtro = $_GET['filtro'] ?? 'desc';
			$users = $filtro == 'desc' ? $this->rankingModel->getUsersByOrderDesc() : $this->rankingModel->getUsersByOrderAsc();
			$response = ['users' => $users];

			header('Content-Type: application/json');
			echo json_encode($response);
		}





	}
