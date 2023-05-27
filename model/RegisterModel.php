<?php

	class RegisterModel
	{


		private $database;

		public function __construct($database) {
			$this->database = $database;
		}

		public function userRegistration($username, $nombreCompleto, $fechaDeNacimiento, $sexo, $password, $ubicacion, $email, $foto, $rol) {
			$sql = "INSERT INTO usuarios (username, nombreCompleto, fechaDeNacimiento, sexo, password, ubicacion, mail, fotoDePerfil, rol)
            VALUES ('$username', '$nombreCompleto', '$fechaDeNacimiento', '$sexo', '$password', '$ubicacion', '$email', '$foto', '$rol')";
			return $this->database->insert($sql);
		}


	}