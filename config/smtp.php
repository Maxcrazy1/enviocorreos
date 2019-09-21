<?php

class smtp
{
    // las variables referentes a la confexion conf la clase PDO
    public function smtpConfig($smtp)
    {
        try {
            $smtp->SMTPDebug = 0; // Enable verbose debug output
            $smtp->isSMTP(); // Set thiser to use SMTP
            $smtp->Host = 'mail.proyectoarena.com'; // Specify main and backup SMTP servers
            $smtp->SMTPAuth = true; // Enable SMTP authentication
            $smtp->Username = 'equipo@proyectoarena.com'; // SMTP username
            $smtp->Password = ',GV?Tt%fSE39'; // SMTP password
            $smtp->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
            $smtp->Port = 587; // TCP port to connect to
            $smtp->CharSet = 'UTF-8';

            $smtp->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true,
                ),
            );
            return $smtp;

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
