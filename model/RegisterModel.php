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

        public function consultarTodosLosMailDeUsuarios()
        {
            return $this->database->query("SELECT mail FROM usuarios");
        }

        public function consultarTodosLosNombresDeUsuarios()
        {
            return $this->database->query("SELECT username FROM usuarios");
        }

        public function estaDuplicado($mail, $username)
        {
            $duplicado = "";

            //consulto todos los mails y los guardo
            $todosLosMails = $this->consultarTodosLosMailDeUsuarios();
            $todosLosUsername = $this->consultarTodosLosNombresDeUsuarios();

            //recorro todos los mails y me devuelve true o false si esta repetido
            foreach ($todosLosMails as $mails) {
                if ($mails["mail"] == $mail) {
                    $duplicado = "mail en uso ";
                    break;
                }
            }
            foreach ($todosLosUsername as $user) {
                if ($user["username"] == $username) {
                    $duplicado = $duplicado."usuario en uso!";
                    break;
                }
            }
            return $duplicado;
        }


	}