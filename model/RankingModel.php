<?php

    class RankingModel
    {
        private $database;

        public function __construct($database)
        {
            $this->database = $database;
        }

	    public function getUsersByOrderDesc()
	    {
		    $query = "SELECT * FROM usuarios ORDER BY puntaje DESC";
		    $users = $this->database->query($query);

		    $posicion = 1;
		    foreach ($users as &$user) {
			    $user['posicion'] = $posicion;
			    $posicion++;
		    }

		    return $users;
	    }
    }
