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

	    public function getUsersByOrderAsc()
	    {
		    $query = "SELECT * FROM usuarios ORDER BY puntaje ASC";
		    $users = $this->database->query($query);

		    $totalUsers = count($users);

		    foreach ($users as &$user) {
			    $user['posicion'] = $totalUsers;
			    $totalUsers--;
		    }

		    return $users;
	    }

	    public function getUsersByPartidasDesc()
	    {
		    $query = "SELECT * FROM usuarios ORDER BY partidasJugadas DESC";
		    $users = $this->database->query($query);

		    $posicion = 1;
		    foreach ($users as &$user) {
			    $user['posicion'] = $posicion;
			    $posicion++;
		    }

		    return $users;
	    }

	    public function getUsersByPartidasAsc()
	    {
		    $query = "SELECT * FROM usuarios ORDER BY partidasJugadas ASC";
		    $users = $this->database->query($query);

		    $totalUsers = count($users);

		    foreach ($users as &$user) {
			    $user['posicion'] = $totalUsers;
			    $totalUsers--;
		    }

		    return $users;
	    }


    }

