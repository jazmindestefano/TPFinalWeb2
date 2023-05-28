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
            $hashPassword= md5($password);
            $usuario = $this->loginModel->getUser($username, $hashPassword);

            if (!empty($usuario)) {
                session_start();
                $_SESSION['actualUser'] = $usuario[0]['idUsuario'];
                echo  $_SESSION['actualUser'];
                header('location: ../index.php');
                exit();
            } else {
                echo "usuario o contraseña incorrecta";
            }
        }
    }

