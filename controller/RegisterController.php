<?php

	class RegisterController
	{

		private $registerModel;
		private $renderer;

		public function __construct($registerModel, $renderer)
		{
			$this->registerModel = $registerModel;
			$this->renderer = $renderer;
		}

		public function register()
		{
			$this->renderer->render('register');
		}

		public function userRegistration()
		{

			$nombreCompleto = $_POST['nombre-completo'];
			$fechaDeNacimiento = $_POST['fecha-nacimiento'];
			$username = $_POST['username'];
			$email = $_POST['email'];
			$password = $_POST['password'];
            $hashPassword= md5($password);
			$ubicacion = $_POST['ubicacion'];
			$foto = $_POST['foto'];
			$sexo = $_POST['sexo'];
			$rol = 'jugador';

				$method = $this->registerModel->userRegistration(
					$username,
					$nombreCompleto,
					$fechaDeNacimiento,
					$sexo,
                    $hashPassword,
					$ubicacion,
					$email,
					$foto,
					$rol);

				//como redireccionar al login, me inserta dos veces en register/register, problemas con rutas

		/*		if($method) {
					header("Location: login");
				} else {
					echo "no";
				}

 */
		}

	}