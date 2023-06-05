<?php

    class RankingModel
    {
        private $database;

        public function __construct($database)
        {
            $this->database = $database;
        }

        public function getUsers()
        {
            $query = "SELECT * FROM usuarios ORDER BY puntaje DESC";
            return $this->database->query($query);
        }
    }
