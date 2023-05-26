<?php

    class LoginModel
    {
        private $database;

        public function __construct($database)
        {
            $this->database = $database;
        }

        public function getUser($username, $password)
        {
            $query = "SELECT * FROM usuarios WHERE username = '$username' AND password = '$password'";
            return $this->database->query($query);
        }

    }
