<?php

namespace Clases;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }
    public function EnviarConfirmacion()
    {
        //Crear objeto Email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PUERTO'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom("appSalon@example.net");//de donde
        $mail->addAddress($this->email, 'AppSalon.com');//para quien
        $mail->Subject = 'Confirmar Cuenta';

        //Usando HTML
        $mail->isHTML();
        $mail->CharSet = 'UTF-8';

        $contenido ="<html>";
        $contenido .="<p><strong>Hola ".$this->nombre." </strong> Has creado tu cuenta en App Salon, solo debes confirmar presionando el siguiente enlace</p>";
        $contenido .="<p>Preione aqui: <a href='". $_ENV['PROJECT_URL'] ."/confirmar-cuenta?token=". $this->token ."'>Confirmar Cuenta</a> </p>";
        $contenido .="<p>Si tu no solicitaste esta cuenta, ignora este mensaje</p>";
        $contenido .="</html>";

        $mail->Body = $contenido;

        //Enviar el Email
        $mail->send();
    }

    public function enviarInstrucciones(){
        //Crear objeto Email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PUERTO'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom("appSalon@example.net");//de donde
        $mail->addAddress($this->email, 'AppSalon.com');//para quien
        $mail->Subject = 'Restablecer tu Password';

        //Usando HTML
        $mail->isHTML();
        $mail->CharSet = 'UTF-8';

        $contenido ="<html>";
        $contenido .="<p><strong>Hola ".$this->nombre." </strong>, Has solicitado restablecer tu password, sigue el siguiente enlace para hacerlo</p>";
        $contenido .="<p>Presione aqui: <a href='". $_ENV['PROJECT_URL'] ."/recuperar?token=". $this->token ."'>Restablecer password</a> </p>";
        $contenido .="<p>Si tu no solicitaste esta cuenta, ignora este mensaje</p>";
        $contenido .="</html>";

        $mail->Body = $contenido;

        //Enviar el Email
        $mail->send();
    }
}