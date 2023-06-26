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
            $confirmPassword = $_POST['confirm-password'];
            $hashPassword = md5($password);
            $ubicacion = $_POST['ubicacion'];
            $foto = $_POST['foto'];
            $sexo = $_POST['sexo'];
            $rol = 'jugador';
            $verify_token = md5(rand());
            $duplicado = $this->registerModel->estaDuplicado($email, $username);
            $contraseñasInvalidas = $this->registerModel->validarContrasenas($password, $confirmPassword);

            if ($contraseñasInvalidas) {
                $this->renderer->render('register', $contraseñasInvalidas);
            }

            if (!empty($duplicado)) {
                $data["duplicado"] = $duplicado;
                $this->renderer->render('register', $data);

            } else {
                $method = $this->registerModel->userRegistration(
                    $username,
                    $nombreCompleto,
                    $fechaDeNacimiento,
                    $sexo,
                    $hashPassword,
                    $confirmPassword,
                    $ubicacion,
                    $email,
                    $foto,
                    $rol,
                    $verify_token);
                if ($method) {
                    $data['statusEmail'] = 'Registro Exitoso! Verifique su mail';
                    $this->renderer->render('register', $data);
                }
            }
        }
    }
