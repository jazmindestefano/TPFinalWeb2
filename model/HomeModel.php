<?php

	class HomeModel

	{
		private $database;

		public function __construct($database) {
			$this->database = $database;
		}

		public function getUserById($id) {
			$query = "SELECT * FROM usuarios WHERE idUsuario = '$id'";
			return $this->database->query($query);
		}
	}