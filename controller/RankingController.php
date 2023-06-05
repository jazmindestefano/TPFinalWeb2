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
            $users = $this->rankingModel->getUsers();
	        $contador = 1;
	        foreach ($users as &$user) {
		        $user['posicion'] = $contador;
		        $contador++;
	        }
            $data = array('users' => $users);
            $this->renderer->render('ranking', $data);
        }
    }
