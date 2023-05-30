<?php

    include_once("./helpers/ValidarUsuarioLogeado.php");
    include_once("./helpers/qr/Conectarbd.php");
    include_once("./helpers/qr/phpqrcode/qrlib.php");

    use QRcode;

    class PerfilController
    {
        private $perfilModel;
        private $renderer;


        public function __construct($perfilModel, $renderer)
        {
            $this->perfilModel = $perfilModel;
            $this->renderer = $renderer;
        }


        public function perfil()
        {
            $validarUsuarioLogeado = new ValidarUsuarioLogeado();
            $validarUsuarioLogeado->validarUsuarioLogeado();

            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $idUser = $_SESSION['actualUser'];
            $data["perfil"] = $this->perfilModel->getUserById($idUser);
            $datos = "Nombre: " . $data["perfil"]["nombreCompleto"];
            $imagenQR = "../public/qrs/" . $data["nombreCompleto"] . ".png";
            QRcode::png($datos, $imagenQR, QR_ECLEVEL_L, 8);
            $this->renderer->render('perfil', $data);
            exit();
        }
    }



