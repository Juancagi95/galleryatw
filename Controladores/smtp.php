<?php
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';
require '../PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function enviarmail($from, $name, $body){

  $mail = new PHPMailer();

  $mail->IsSMTP();

  $mail->Mailer = "smtp";
  $mail->SMTPAuth   = TRUE;
  $mail->SMTPSecure = "tls";
  $mail->Port       = 587;
  $mail->Host       = "smtp.gmail.com";
  $mail->Username   = "ujdmhptts@gmail.com";
  $mail->Password   = "ujmd1234";
  $mail->IsHTML(true);
  $mail->SetFrom("no-reply@gmail.com", "ujdmhptts");

  $mail->AddAddress($from, $name);
  $mail->Subject = "Alerta de seguridad critica";
  $mail->addAttachment('../Imagenes/logo.png');
  $content = "";
  if ($body == "1") {
    $content = " <h2>Hola, ".$name .":</h2></br><p>Se cambió su contraseña de ujdmhptts.codes</p>";
  }else {
    $content = " <h2>Hola, ".$name .":</h2></br><p>Has iniciado sesión en ujdmhptts.codes</p>";
  }
  $mail->MsgHTML($content);

  if(!$mail->Send()) {

  } else {

  }
}
