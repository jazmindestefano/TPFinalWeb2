<?php

class LogoutController
{
    public function __construct( )
    {

    }

    public function logout()
    {
        session_destroy();
        header('location: /login/login');
    }
}
