<?php
session_start();

require_once '../google-authenticator/PHPGangsta/GoogleAuthenticator.php';
include_once '../Controladores/smtp.php';

$autenticador = new PHPGangsta_GoogleAuthenticator();

$codigo_secreto = $_POST['codigosecreto'];
$codigo_verificador = $_POST['codigo'];
$resultado = $autenticador->verifyCode($codigo_secreto, $codigo_verificador, 0);

if ($resultado) {
  // Si el codigo es correcto entra index
  $_SESSION['Verificado'] = $resultado;
  if(isset($_SESSION['Correo']) && isset($_SESSION['Cliente'])){
    $correo_econtrado = $_SESSION['Correo'];
    $usuario_encontrado = $_SESSION['Cliente'];
    enviarmail($correo_econtrado, $usuario_encontrado, 2);  
  }
  header('location:/index.php');
} else {
  // si el codigo es invalido no entra index
  $error = "El código que ingresaste es incorrecta";
  header('location:/Vistas/autenticator.php?error='.urlencode($error));
  ///enviar que no es valido
}
