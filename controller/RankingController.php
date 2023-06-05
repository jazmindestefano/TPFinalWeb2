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
	        $filtro = isset($_POST['filtro']) ? $_POST['filtro'] : 'desc';



						if($filtro == 'desc') {
							$users = $this->rankingModel->getUsersByOrderDesc();
						} else {
							$users = $this->rankingModel->getUsersByOrderAsc();
						}

            $data = array('users' => $users);
            $this->renderer->render('ranking', $data);
        }
    }
