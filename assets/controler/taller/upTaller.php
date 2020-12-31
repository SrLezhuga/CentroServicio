<?php
session_start();
include("../conexion.php");
require_once '../../vendor/PHPMailer/src/Exception.php';
require_once '../../vendor/PHPMailer/src/PHPMailer.php';
require_once '../../vendor/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Obtengo los datos cargados en el formulario de login.
$Status     = $_POST['formStatus'];
$Id         = $_POST['formId'];

if ($Status == "REPARADA") {
    $Fecha = date('Y-m-d', strtotime("now"));

    // Consulta segura para evitar inyecciones SQL.

    $sql = "UPDATE tab_orden
            SET   status_orden  = '" . $Status . "',
                  fech_salida   =  '" . $Fecha . "'
            WHERE id_orden      = " . $Id . ";";

    if (mysqli_query($con, $sql)) {

        $sql2 = "UPDATE tab_users
                SET   taller    = 0
                WHERE code_user = " . $_SESSION['code_user'] . ";";

        if (mysqli_query($con, $sql2)) {

            $queryOrden = "SELECT id_orden, id_cliente FROM tab_orden WHERE id_orden =".$Id; 
            $rsOrden = mysqli_query($con, $queryOrden) or die ("Error de consulta"); 
            $Orden = mysqli_fetch_array($rsOrden);
                
                $folio=$Orden['id_orden'];
                if(strlen($folio)==1){
                    $folio="0000".$folio;
                }else if(strlen($folio)==2){
                    $folio="000".$folio;
                }else if(strlen($folio)==3){
                    $folio="00".$folio;
                }else if(strlen($folio)==4){
                    $folio="0".$folio;
                }

                $queryCliente = "SELECT * FROM tab_cliente WHERE id_cliente = ".$Orden['id_cliente']; 
                $rsCliente = mysqli_query($con, $queryCliente) or die ("Error de consulta"); 
                $Cliente = mysqli_fetch_array($rsCliente);

            $remitente="Centro de Servicio MFA";
            $clienteMail=$Cliente['mail_cliente'];
            $destinatario=$Cliente['nom_cliente'];
            $titulo="Orden folio: ".$folio;
            $body = '
            <body style="margin: 0; padding: 0;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td>
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="800">
            <tr>
            <td align="center" bgcolor="#f44336" style="padding: 10px 0 10px 0; color: #ffffff; font-family: Arial, sans-serif; font-size: 38px; line-height: 32px;">
            <img src="cid:fma" width="150" height="150" style="display: block;" />
            <img src="cid:txt" width="300" style="display: block;" />
            </td>
            </tr>
            <tr>
            <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td>
            Estimado/a '.$destinatario .':
            <br>Se le informa que la orden con el folio '.$folio.' ya esta lista y en espera de ser recogida
            <br>Favor de pasar a recogerla a la brevedad.
            <br>&nbsp;
            <br>Recuerde, pasado 90 días naturales, <b>Mayoreo Ferretero Atlas</b> no se hace
            responsable del producto.
            <br>&nbsp;
            <br>Si tiene dudas, póngase en contacto con el Centro de Servicio.
            <br> &nbsp;
            <br> <b>Mayoreo Ferretero Atlas</b> le agradece su preferencia.
            <br> &nbsp;
            </td>
            </tr>
            <tr>
            <td align="center"
            style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;">
            <b>Matriz Centro de Servicio</b>
            </td>
            </tr>
            <tr>
            <td style="padding: 20px 0 30px 0;"
            style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
            Guadalupe Victoria #55<br>
            Tel: 33450116 ext 134/124<br>
            csa@mayoreoferreteroatlas.com<br>
            Lunes a Viernes: 08:30am - 06:00pm<br>
            Sábados: 08:30am - 02:00pm
            </td>
            </tr>
            <tr>
            <td>
            &nbsp;
            </td>
            </tr>
            <tr>
            <td style="padding: 10px 0 10px 0;"
            style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
            <b>A T E N T A M E N T E</b><br>
            <a href="https://mayoreoferreteroatlas.com/mfatlas/" >
            Mayoreo Ferretero Atlas
            </a>
            <br> &nbsp;
            <br> No responda a este correo electrónico. 
            <br>Para comunicarse con nosotros utilice nuestras redes sociales o comuníquese con las sucursales de <b>Mayoreo Ferretero Atlas</b>.
            </td>
            </tr>
            </table>
            </td>
            </tr>
            <tr>
            <td bgcolor="#dddfeb" style="padding: 30px 30px 30px 30px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
            <td width="60%"
            style="color: #858796; font-family: Arial, sans-serif; font-size: 14px;">
            &reg; MFA, Centro de Servicio '.date('Y').'
            </td>
            <td align="right">
            <table border="0" cellpadding="0" cellspacing="0">
            <tr>
            <td>
            <a href="https://twitter.com/SISTEATLAS?lang=es">
            <img src="cid:tw" alt="Twitter" width="38" height="38"
            style="display: block;" border="0" />
            </a>
            </td>
            <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
            <td>
            <a href="https://www.facebook.com/mayoreoferreatlasgdl/">
            <img src="cid:fb" alt="Facebook" width="38" height="38"
            style="display: block;" border="0" />
            </a>
            </td>
            <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
            <td>
            <a href="https://www.youtube.com/channel/UCvOGiYvRYUUTkRZC35t28Qg">
            <img src="cid:yt" alt="YouTube" width="38" height="38"
            style="display: block;" border="0" />
            </a>
            </td>
            <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
            <td>
            <a href="https://api.whatsapp.com/send?phone=523315731134&fbclid=IwAR0YsC6-ff7ymrT2dyP3KaFyzSDecIoL_6SAivv3ULqBFsmhAMFF6grgcpA">
            <img src="cid:wp" alt="Whatsapp" width="38" height="38"
            style="display: block;" border="0" />
            </a>
            </td>
            </tr>
            </table>
            </td>
            </tr>
            </table>
            </td>
            </tr>
            </table>
            </td>
            </tr>
            </table>
            </body>
            ';

            //Crear una instancia de PHPMailer
            $mail = new PHPMailer();
            //Definir que vamos a usar SMTP
            $mail->IsSMTP();
            //Esto es para activar el modo depuración. En entorno de pruebas lo mejor es 2, en producción siempre 0
            // 0 = off (producción)
            // 1 = client messages
            // 2 = client and server messages
            $mail->SMTPDebug  = 0;
            //Ahora definimos gmail como servidor que aloja nuestro SMTP
            $mail->Host       = 'smtp.gmail.com';
            //El puerto será el 587 ya que usamos encriptación TLS
            $mail->Port       = 587;
            //Definmos la seguridad como TLS
            $mail->SMTPSecure = 'tls';
            //Tenemos que usar gmail autenticados, así que esto a TRUE
            $mail->SMTPAuth   = true;
            //Definimos la cuenta que vamos a usar. Dirección completa de la misma
            $mail->Username   = "csa.mayoreoferreteroatlas@gmail.com";
            //Introducimos nuestra contraseña de gmail
            $mail->Password   = "M@y0r30F3rr3t3r0";
            //Definimos el remitente (dirección y, opcionalmente, nombre)
            $mail->SetFrom('csa@mayoreoferreteroatlas.com', $remitente);
            //Y, ahora sí, definimos el destinatario (dirección y, opcionalmente, nombre)
            $mail->AddAddress($clienteMail, $destinatario);
            //Definimos el tema del email
            $mail->Subject = $titulo;
            //Y por si nos bloquean el contenido HTML (algunos correos lo hacen por seguridad) una versión alternativa en texto plano (también será válida para lectores de pantalla)
            $mail->Body = $body;
            //Y por si nos bloquean el contenido HTML (algunos correos lo hacen por seguridad) una versión alternativa en texto plano (también será válida para lectores de pantalla)
            $mail->AltBody = $body;
            $mail->CharSet = 'UTF-8';
            // Attachments
            $mail->addEmbeddedImage(dirname(__FILE__).'/img/logo.png','fma');
            $mail->addEmbeddedImage(dirname(__FILE__).'/img/logo-mfa.png','txt');
            $mail->addEmbeddedImage(dirname(__FILE__).'/img/fb.png','fb');
            $mail->addEmbeddedImage(dirname(__FILE__).'/img/tw.png','tw');
            $mail->addEmbeddedImage(dirname(__FILE__).'/img/yt.png','yt');
            $mail->addEmbeddedImage(dirname(__FILE__).'/img/wp.png','wp');
            //Enviamos el correo
            $mail->Send();

            header("HTTP/1.0 404 Not Found");
            header("Location: http://" . $base_url . "/CentroServicio/taller?alert=1'");
        }
    }

    // close connection
    mysqli_close($con);
} else {

    // Consulta segura para evitar inyecciones SQL.

    $sql = "UPDATE tab_orden
            SET   status_orden  = '" . $Status . "'
            WHERE id_orden      = " . $Id . ";";

    if (mysqli_query($con, $sql)) {

        $sql2 = "UPDATE tab_users
                SET   taller    = 0
                WHERE code_user = " . $_SESSION['code_user'] . ";";

        if (mysqli_query($con, $sql2)) {
            header("HTTP/1.0 404 Not Found");
            header("Location: http://" . $base_url . "/CentroServicio/taller?alert=1'");
        }
    }

    // close connection

    mysqli_close($con);
}
