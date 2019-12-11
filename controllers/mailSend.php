<?php

use PHPMailer\PHPMailer\PHPMailer;

// require '/home/sueduca1/public_html/enviocorreos/ext/PHPMailer/PHPMailer.php';
// require '/home/sueduca1/public_html/enviocorreos/ext/PHPMailer/SMTP.php';
require 'ext/PHPMailer/PHPMailer.php';
require 'ext/PHPMailer/SMTP.php';
require 'ctrlCategory.php';

class MailSend
{

    /**
     * Función encargada de fijar el body, el email a donde se enviara y el nombre de la persona
     * también se encarga de fijar el email desde donde se envia y finalmente enviarlo
     *
     * @param mixed $smtp - datos de la conexión smtp
     * @param mixed $body - El cuerpo del correo electronico
     * @param mixed $email -  El email a donde se enviara la información
     * @param mixed $nombre -  El nombre de la persona
     */
    public function sendMail($smtp, $body, $email, $nombre, $subject)
    {
        // Dirección de donde se envia y el nombre
        $smtp->setFrom('social@proyectoarena.com', 'ProyectoArena');
        $smtp->addAddress($email, $nombre);

        // Establecer en formato HTML
        $smtp->isHTML(true);

        // Titulo del correo
        // $smtp->Subject = 'CONSEJO SEMANAL 🌟 Hola '.$nombre.' aquí tienes el artículo que te sugerimos leer hoy';
        $smtp->Subject = $subject;
        $smtp->Body = $body;
        $smtp->send();
    }

    /**
     * Método que extrae el post actual donde se encuentra la persona
     * para enviar el email correspondiente
     *
     * @param mixed $id - Id de la semana donde se encuentra la persona
     * @param mixed $category - Categoria en la que esta la persona
     */
    public function getPost($id, $category)
    {
        $ejecucion = new sqlModel();
        $ejecucion->CrudModel();

        $query = "SELECT post.guid, post.post_title
                        FROM wp_posts_send send
                        INNER JOIN wp_posts post ON post.ID = send.id_post
                        WHERE send.category= '" . $category . "' AND
                        send.week=" . $id;

        $posts = $ejecucion->getDatos($query);

        foreach ($posts as $key => $value) {
            $datos = [];

            $url = $this->getUrl($value['guid']);
            array_push($datos, $url);
            array_push($datos, $value['post_title']);

            return $datos;
        }
    }

    /**
     * filtro que divide la url dejando la url amigable correcta
     * sin este filtro se envia el link incorrecto
     *
     * @param mixed $temp - Url completa del sitio
     */
    public function getUrl($temp)
    {
        $var = explode("com/", $temp);
        $url = $var[1];
        return $url;
    }

    /**
     * Método para actualizar las semanas de la persona, en caso de que le corresponda su día
     * suma 1 semana a la persona para que semanalmente tenga un email del sitio en su email personal
     *
     * @param mixed $weeks - Cantidad de semanas de vida del niño
     * @param mixed $date - fecha de nacimiento del niño
     * @param mixed $post - post actual de la persona
     * @param mixed $id - Id de la persona
     *
     */
    public function updateWeek($weeks, $date, $post, $id)
    {
        $weeks++;
        $post++;
        $fechaFinal = date($date);
        $nuevafecha = date("Y-m-d", strtotime($fechaFinal . "+ 1 week"));

        $ejecucion = new sqlModel();
        $ejecucion->CrudModel();
        $tabla = 'wp_user_register';
        $datos = 'weeks ="' . $weeks . '" ,date_now = "' . $nuevafecha . '", post_actual = "' . $post . '"';
        $condicion = "id =" . $id;

        $ejecucion->editDatos($tabla, $datos, $condicion);
    }

    /**
     * Función encargada de guardar los datos provenientes del home en la BD y enviar emails
     * (Sera mejorada para pasar todos los parametros a este metódo asi no repetir en register e index)
     *
     * @param mixed $date - fecha de nacimiento del niño
     * @param mixed $email - Email del usuario
     * @param mixed $user - Nombre del usuario
     */
    public function sendData($date, $email, $user, $point)
    {

        $getDates = new GetDate();
        $birthDay = new DateTime($date);

        $fechas = $getDates->getDates($date);
        $weeks = $getDates->getWeek($fechas[1], $birthDay);

        $today = date("Y-m-d");

        $edad = $fechas[0];

        switch ($edad) {
            case '-1':
                $category = "0 Años";
                break;
            case '0':
                $category = "1 Año";
                break;
            case '1':
                $category = "2 Años";
                break;
            case '2':
                $category = "3 Años";
                break;
            default:
                $category = null;
                break;
        }

        if ($category != null) {

            $plantilla = new sqlModel();
            $plantilla->CrudModel();
            $plantilla->mdlCrear('wp_user_register', 'email,name,weeks,date_now,date_register,post_actual,category', "'$email','$user','$weeks','$today','$today','$weeks','$category'");
            $getID = $plantilla->getDatos("select id from wp_user_register where email='" . $email . "' AND weeks='" . $weeks . "' AND category='" . $category . "'");

            $count = count($getID);
            $count--;
            $id = $getID[$count]['id'];

            $SendMsg = new MailSend();
            $post = $SendMsg->getPost($weeks, $category);
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

            $SendMsg->postSend($post, $user, $email, $weeks, $today, $weeks, $id, $texto, "Hola $user 🎇🌠 te damos la bienvenida a proyecto arena", $category);

        }

    }

    /**
     * Metódo encargado recibir los parametros de todos los formularios o llamados desde el index para enviar correos electronicos
     * y actualizar las semanas y categorias en la base de datos
     *
     *  @param mixed $post - array con el id del post y el titulo
     *  @param mixed $name - Nombre del usuario
     *  @param mixed $email - Email del usuario
     *  @param mixed $weeks - Semanas de vida del niño
     *  @param mixed $dateNow - Fecha Actual en la que se encuentra el usuario
     *  @param mixed $postNow - Post donde se encuentra el usuario
     *  @param mixed $id - Id del usuario
     *  @param mixed $texto - Texto que se enviara en el email
     *  @param mixed $point - De donde proviene el llamado de la función php, ejemplo (calculadora de embarazo)
     *  @param mixed $titulo - Titulo del email
     *  @param mixed $category - Categoria del usuario
     */
    public function postSend($post, $name, $email, $weeks, $dateNow, $postNow, $id, $texto,$point = "", $titulo, $category)
    {
        $mail = new PHPMailer(true);

        $temp = new smtp();
        $smtp = $temp->smtpConfig($mail);

        $html = new templateEmail();
        $body = $html->template($post[0], $post[1], $texto, $id);

        $SendMsg = new MailSend();
        $SendMsg->sendMail($smtp, $body, $email, $name, $titulo);
        $SendMsg->updateWeek($weeks, $dateNow, $postNow, $id);

        $updateCategory=new controllerCategory();
        $updateCategory->updateCategory($category,$postNow,$id);

        }
}
