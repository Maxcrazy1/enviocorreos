<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once 'models/conexion.php';
require_once 'config/smtp.php';
require_once 'controllers/mailSend.php';
require_once 'models/ModelCrud.php';
require_once 'controllers/templateEmail.php';

require 'ext/PHPMailer/Exception.php';
// require 'ext/PHPMailer/PHPMailer.php';
// require 'ext/PHPMailer/SMTP.php';

$user = $_POST['name'];
$email = $_POST['email'];
$weeks = $_POST['weeks'];
$today = date("Y-m-d");

if (empty($email)) {
} else {

    $plantilla = new sqlModel();
    $plantilla->CrudModel();
    $plantilla->mdlCrear('wp_user_register', 'email,name,weeks,date_now,date_register,post_actual', "'$email','$user','$weeks','$today','$today','$weeks'");

    $SendMsg = new MailSend();
    $weeks--;

    $post = $SendMsg->getPost($weeks,'Embarazo');

    $mail = new PHPMailer(true);
    $temp = new smtp();
    $smtp = $temp->smtpConfig($mail);

    $html = new templateEmail();
    $body = $html->newRegister($post[0], $post[1]);
    $SendMsg->sendMail($smtp, $body, $email, $user, "Hola $user 🎇🌠 te damos la bienvenida a proyecto arena");
}
