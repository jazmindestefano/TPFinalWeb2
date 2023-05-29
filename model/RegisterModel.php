<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

	class RegisterModel
	{


		private $database;

		public function __construct($database) {
			$this->database = $database;
		}

        public function sendemail_verify($nombreCompleto,$email,$verify_token) {

            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
          //  $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'jazminisabeldestefano@gmail.com';                     //SMTP username
            $mail->Password   = 'kpojehupdgrzhyeg';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;
            //Recipients
            $mail->setFrom('jazminisabeldestefano@gmail.com', $nombreCompleto);
            $mail->addAddress($email);

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Email verification from KnowItAll';

            $email_template= "
                   <h2>Te has registrado en KnowItAll</h2>
                   <h5>Verifica tu mail con el link de aqui abajo</h5>
                   <br></br>
                   <a href='http://localhost/login/login?token=$verify_token'>Link para verificarte</a>
            ";

            $mail->Body = $email_template;

            $mail->send();
        }

		public function validarContrasenas($password, $confirmPassword)
		{
			if ($password !== $confirmPassword) {
				$data["error"] = "Las contraseñas no coinciden";
			}

			return $data ?? "";
		}

		public function userRegistration($username, $nombreCompleto, $fechaDeNacimiento, $sexo, $password, $confirmPassword,$ubicacion, $email, $foto, $rol,$verify_token) {

			$sql = "INSERT INTO usuarios (username, nombreCompleto, fechaDeNacimiento, sexo, password, ubicacion, mail, fotoDePerfil, rol,   verify_token)
            VALUES ('$username', '$nombreCompleto', '$fechaDeNacimiento', '$sexo', '$password', '$ubicacion', '$email', '$foto', '$rol', '$verify_token')";
            $this->sendemail_verify($nombreCompleto,$email,$verify_token);
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