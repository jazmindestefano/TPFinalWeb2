<?php

    class LoginController
    {
        private $loginModel;
        private $renderer;

        public function __construct($loginModel, $renderer)
        {
            $this->loginModel = $loginModel;
            $this->renderer = $renderer;
        }

        public function login()
        {
            $this->renderer->render('login');
        }

        public function ingresarlogin()
        {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $usuario = $this->loginModel->getUser($username, $password);

            if (!empty($usuario)) {
                echo "usuario y contraseña correcta";
            } else {
                echo "usuario o contraseña incorrecta";
            }
        }
    }

