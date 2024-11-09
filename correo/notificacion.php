<?php
ob_start();
session_start();

// Conectar a base de datos
require_once('../controller/db/cone.php');

$conect = new basedatos;
$con = $conect->conectarBD();

$pm_nombre = $_SESSION['mush_nombre'] ?? '';
$pm_email = $_SESSION['mush_email'] ?? '';

date_default_timezone_set("America/Guatemala");
setlocale(LC_TIME, 'Spanish_Guatemala');

error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', '1');

// Incluir PHPMailer y credenciales de correo
require_once '../docs/archivosformulario/PHPMailerAutoload.php';
require_once '../controller/assets/varicorreo.php';

// Obtener datos del formulario
$pais = $_POST['pais'] ?? '';
$tipo_de_gestion = $_POST['tipo_de_gestion'] ?? '';
$tipologia_f = $_POST['tipologia_f'] ?? '';
$regionf = $_POST['regionf'] ?? '';
$ticket = $_POST['ticket'] ?? '';

// Mostrar datos para depuración
// echo "País: " . $pais . "<br>";
// echo "Tipo de Gestión: " . $tipo_de_gestion . "<br>";
// echo "Tipología: " . $tipologia_f . "<br>";
// echo "Región: " . $regionf . "<br>";
echo "ticket" .$ticket. "<br>";
// Consulta SQL para obtener datos de escalación
$queryDato = "SELECT * FROM logica WHERE pais = '$pais' AND tipogestion = '$tipo_de_gestion' AND tipologia = '$tipologia_f' AND grupo = '$regionf'";
$QueryBusqueda = mysqli_query($con, $queryDato);

if ($QueryBusqueda && mysqli_num_rows($QueryBusqueda) > 0) {

    $lineaDeBusqueda = mysqli_fetch_assoc($QueryBusqueda);
    $escalacion = $lineaDeBusqueda['escalacion'] ?? '';

    // echo "Escalacion: " . $escalacion . "<br>";

    // Consulta SQL para obtener datos del usuario
    // Consulta SQL para obtener datos del usuario
    $queryDatousuario = "SELECT * FROM user WHERE grupo = '$escalacion'";
    $QueryBusquedausuario = mysqli_query($con, $queryDatousuario);

    if ($QueryBusquedausuario && mysqli_num_rows($QueryBusquedausuario) > 0) {
        $correos = [];

        while ($lineaDeBusquedausuario = mysqli_fetch_assoc($QueryBusquedausuario)) {
            $correo = $lineaDeBusquedausuario['email'] ?? '';
            if (!empty($correo)) {
                $correos[] = $correo;
            }
        }

        //echo "Correos de escalacion: " . implode(", ", $correos) . "<br>";

        // Configurar y enviar el correo
        $message = file_get_contents('../controller/email/seguimiento.html');
        $message = str_replace('%ticket%', $ticket, $message);
        $message = str_replace('%comentarioresolucion%', $comentario_seguimientos, $message);

        $mailcomentado = new PHPMailer;
        $mailcomentado->isSMTP();
        $mailcomentado->Host = $uhost;
        $mailcomentado->SMTPAuth = true;
        $mailcomentado->Username = $ucorreo;
        $mailcomentado->Password = $ccontra;
        $mailcomentado->SMTPSecure = 'ssl';
        $mailcomentado->Port = 465;
        $mailcomentado->IsHTML(true);
        $mailcomentado->CharSet = 'UTF-8';

        $mailcomentado->setFrom($ucorreo, 'Notificación Lacthosa - ProntoBPO');

        // Ciclo para envio principal
        foreach ($correos as $correo) {
            $mailcomentado->addAddress($correo, "Notificacion Lacthosa");
        }

        // Copias
        //$mailcomentado->addBCC("anthony.aguirre@prontobpo.com", "Anonimous");

        $mailcomentado->Subject = "Ticket $ticket asignado";
        $mailcomentado->MsgHTML($message);
        $mailcomentado->AltBody = strip_tags($message);

        if ($mailcomentado->send()) {
            echo "Correo enviado correctamente.";
        } else {
            echo "Error al enviar correo: " . $mailcomentado->ErrorInfo;
        }

        echo json_encode(array('error' => false, 'cl_ticket' => $ticket, 'cl_accion' => "asignado"));
    } else {
        echo "Error en la consulta de usuario: " . mysqli_error($con);
    }
} else {
    echo "Error en la consulta de escalación: " . mysqli_error($con);
}

ob_end_flush();
