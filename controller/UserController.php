<?php

	class LoginController {
		private $loginModel;
		private $renderer;

		public function __construct($loginModel, $renderer) {
			$this->loginModel = $loginModel;
			$this->renderer = $renderer;
		}

		public function login() {

			$data["login"] = $this->loginModel->getLogin();
			$this->renderer->render("login", $data);

		}




	}