<?php

require_once 'models/conexion.php';
require_once 'config/smtp.php';
require_once 'controllers/mailSend.php';
require_once 'models/ModelCrud.php';
require_once 'controllers/templateEmail.php';
require_once 'controllers/GetterDate.php';

$point = isset($_SERVER['HTTP_REFERER']) ? $point=$_SERVER['HTTP_REFERER'] : 'index';


$plantilla = new sqlModel();
$plantilla->CrudModel();
$SendMsg = new MailSend();

/**
 * Switch encargado de ejecutar métodos, dependiendo de donde se reciba la información, sea del home, calculadora o index directo
 */
switch ($point) {
    case 'https://www.proyectoarena.com/':
        $data = json_decode($_POST['lista']);
        $user = $data[0];
        $email = $data[1];
        $send = new MailSend();

        for ($i = 2; $i < count($data); $i++) {
            if (is_null($data[$i])) {
            } else {
                $send->sendData($data[$i], $email, $user);
            }
        }
        break;

    case 'https://www.proyectoarena.com/calculadora-embarazo/':
        $user = $_POST['name'];
        $email = $_POST['email'];
        $weeks = $_POST['weeks'];
        $today = date("Y-m-d");

        if (empty($email)) {
        } else {

            $plantilla->mdlCrear('wp_user_register', 'email,name,weeks,date_now,date_register,post_actual', "'$email','$user','$weeks','$today','$today','$weeks'");
            
            $weeks--;
            $post = $SendMsg->getPost($weeks, 'Embarazo');

            $mail = new PHPMailer(true);
            $temp = new smtp();
            $smtp = $temp->smtpConfig($mail);

            $html = new templateEmail();
            $body = $html->newRegister($post[0], $post[1]);
            $SendMsg->sendMail($smtp, $body, $email, $user, "Hola $user 🎇🌠 te damos la bienvenida a proyecto arena");
        }
        break;

    case 'index':
        $usuarios = $plantilla->getDatos('select * from wp_user_register');

        foreach ($usuarios as $key => $value) {
            $dateNow = date("Y-m-d");
            $dateEnd = date($value['date_now']);

            if ($dateEnd <= $dateNow) {
                $post = $SendMsg->getPost($value['weeks'], $value['category']);
                try {
                    $SendMsg->postTemp($post, $value['name'], $value['email'], $value['weeks'],
                    $value['date_now'], $value['post_actual'], $value['id']);

                } catch (Exception $th) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
        }
        break;
    default:
    break;
}
