<?php

class ValidarUsuarioLogeado
{

    public function validarUsuarioLogeado(){
        session_start();
        if (!isset($_SESSION['actualUser'])) {
            header("Location: /login/login");
            exit;
        }
    }
}