<?php
	include_once("./helpers/ValidarUsuarioLogeado.php");
    class LogoutController extends ValidarUsuarioLogeado
    {
        public function __construct()
        {

        }

        public function logout()
        {
            session_start();
            session_destroy();
            header('location: /login/login');
        }
    }
