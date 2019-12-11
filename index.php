<?php

require_once 'models/conexion.php';
require_once 'config/smtp.php';
require_once 'controllers/mailSend.php';
require_once 'models/ModelCrud.php';
require_once 'controllers/templateEmail.php';
require_once 'controllers/GetterDate.php';

$point = isset($_SERVER['HTTP_REFERER']) ? $point = $_SERVER['HTTP_REFERER'] : 'index';

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

        for ($i = 2; $i < count($data); $i++) {
            if (is_null($data[$i])) {
            } else {
                $SendMsg->sendData($data[$i], $email, $user, $point);
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
            $datos = $plantilla->getDatos('select * from wp_user_register order by id desc limit 1;');
            $id = $datos[0]['id'];

            $weeks--;
            $post = $SendMsg->getPost($weeks, 'Embarazo');

            $texto = '
                <p>
                Estamos muy contentos de que formas parte del
                proyecto, esto demuestra que de verdad comprendes la
                importancia de una buena educación. Ojalá y todas las
                madres y los padres del mundo pensaran como tú. 💖🤗
                </p>
                <br />
                <p>
                Sueños a parte, y para que te hagas una mejor idea de
                lo que vas a ir recibiendo semanalmente aquí tienes el
                consejo que te hubiera llegado la semana pasada. </p>
                <br />
                <p style="text-align: center">
                Ha sido un placer saludarte. </p>
                <br />
                <p style="text-align: center">Hasta la próxima semana.
                    </p>
                <br />

                    <p style="text-align: center">Un
                abrazo. 🙂
                </p>';

            $age = $weeks . "semanas de embarazo";

            $SendMsg->postSend($post, $user, $email, $weeks, $today, $weeks, $id,
                $texto, $point, "Hola $user 🎇🌠 te damos la bienvenida a proyecto arena", $age);
        }
        break;

    case 'index':
        $usuarios = $plantilla->getDatos('select * from wp_user_register');

        foreach ($usuarios as $key => $value) {
            $dateNow = date("Y-m-d");
            $dateEnd = date($value['date_now']);

            if ($dateEnd <= $dateNow) {
                $post = $SendMsg->getPost($value['weeks'], $value['category']);

                $texto = '
                    <p>Aquí tienes el consejo que te sugerimos leer esta semana. 💖🤗 </p>
                    <br />
                    <p>
                    Por cierto, gracias por seguir formando parte de este
                    precioso proyecto. 🤰🙂
                    </p>
                    <br />
                    <p style="text-align: center">
                    Esperamos que tengas una semana estupenda.
                    </p>
                    <br />';

                $name = $value['name'];
                $SendMsg->postSend($post, $value['name'], $value['email'], $value['weeks'], $value['date_now'],
                    $value['post_actual'], $value['id'], $texto, $point, "Hola $name, ¿Qué tal?",$value['category']);
            }
        }
        break;

    default:
        break;
}
