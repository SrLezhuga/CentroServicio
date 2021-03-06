<?php

require_once '../../vendor/PHPMailer/src/Exception.php';
require_once '../../vendor/PHPMailer/src/PHPMailer.php';
require_once '../../vendor/PHPMailer/src/SMTP.php';

require_once '../../vendor/dompdf/autoload.inc.php';

$destinatario="Lechuga";

// reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;

// instantiate and use the dompdf clas
$options = new Options();
$options->set('isRemoteEnabled', TRUE);
$dompdf = new Dompdf($options);

$html="Hola mundo";


$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('Letter', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser

$output = $dompdf->output(); 

$dompdf->stream('document.pdf',array('Attachment'=>0));

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

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
$mail->Username   = "lechupedia@gmail.com";
//Introducimos nuestra contraseña de gmail
$mail->Password   = "Poiuytrewq123";
//Definimos el remitente (dirección y, opcionalmente, nombre)
$mail->SetFrom('lechupedia@gmail.com', 'Mi nombre');
//Y, ahora sí, definimos el destinatario (dirección y, opcionalmente, nombre)
$mail->AddAddress('brihand.lech@gmail.com', 'El Destinatario');
//Definimos el tema del email
$mail->Subject = 'Esto es un correo de prueba';
//Y por si nos bloquean el contenido HTML (algunos correos lo hacen por seguridad) una versión alternativa en texto plano (también será válida para lectores de pantalla)
$body = '
<body style="margin: 0; padding: 0;">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td>
<table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
<tr>
<td align="center" bgcolor="#f44336" style="padding: 10px 0 10px 0; color: #ffffff; font-family: Arial, sans-serif; font-size: 38px; line-height: 32px;">
<img src="cid:fma" width="100" height="100" style="display: block;" />
Mayoreo Ferretero Atlas
<br>
S.A. de C.V.
</td>
</tr>
<tr>
<td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td>
Estimado/a '.$destinatario .':
<br>Se envio una copia de la  orden con el folio XXXXX 
<br>&nbsp;
<br>Si tiene dudas, póngase en contacto con el Centro de Servicio.
<br> &nbsp;
<br> Mayoreo Ferretero Atlas le agradece su preferencia.
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
Guadalupe Victoria #31<br>
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
<br>Para comunicarse con nosotros utilize nuestras redes sociales o comuniquese con las sucursales de Mayoreo Ferretero Atlas.
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
$mail->addEmbeddedImage(dirname(__FILE__).'/img/logo.png','fma');
$mail->addEmbeddedImage(dirname(__FILE__).'/img/fb.png','fb');
$mail->addEmbeddedImage(dirname(__FILE__).'/img/tw.png','tw');
$mail->addEmbeddedImage(dirname(__FILE__).'/img/yt.png','yt');
$mail->addEmbeddedImage(dirname(__FILE__).'/img/wp.png','wp');
$mail->Body = $body;
//Y por si nos bloquean el contenido HTML (algunos correos lo hacen por seguridad) una versión alternativa en texto plano (también será válida para lectores de pantalla)
$mail->AltBody = $body;
// Attachments
$filename = 'MyDocument.pdf';
        $encoding = 'base64';
        $type = 'application/pdf';

        $mail->AddStringAttachment($output,$filename,$encoding,$type);
//Enviamos el correo
if(!$mail->Send()) {
  echo "Error: " . $mail->ErrorInfo;
} else {
  echo "Enviado!";
}

?>