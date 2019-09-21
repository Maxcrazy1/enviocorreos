<?php

// use PHPMailer\PHPMailer\Exception;
// use PHPMailer\PHPMailer\PHPMailer;

require_once 'models/conexion.php';
require_once 'config/smtp.php';
require_once 'controllers/mailSend.php';
require_once 'models/ModelCrud.php';
require_once 'controllers/templateEmail.php';

// require 'ext/PHPMailer/PHPMailer.php';
// require 'ext/PHPMailer/SMTP.php';

$plantilla = new sqlModel();
$plantilla->CrudModel();

/*Obtenemos los Usuarios*/
$usuarios = $plantilla->getDatos('select * from wp_user_register');

foreach ($usuarios as $key => $value) {

    $dateNow = date("Y-m-d");
    $dateEnd = date($value['date_now']);

    if ($dateEnd <= $dateNow) {
        $SendMsg = new MailSend();
        $post = $SendMsg->getPost($value['weeks'],$value['category']);
        try {
            $SendMsg->postTemp($post,$value['name'],$value['email'],$value['weeks'],
            $value['date_now'],$value['post_actual'],$value['id']);

        } catch (Exception $th) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

}
