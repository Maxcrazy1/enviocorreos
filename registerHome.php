<?php

require_once 'models/conexion.php';
require_once 'config/smtp.php';
require_once 'controllers/mailSend.php';
require_once 'models/ModelCrud.php';
require_once 'controllers/templateEmail.php';
require_once 'controllers/GetterDate.php';


$data = json_decode($_POST['lista']);
$user = $data[0];
$email = $data[1];

$send = new MailSend();

    for ($i = 2; $i < count($data); $i++) {
        if (is_null($data[$i])) {
        }else{
        $send->sendData($data[$i], $email, $user);
    }

} 