<?php
session_start();

include_once '../Datos/conexion.php';
require_once '../google-authenticator/PHPGangsta/GoogleAuthenticator.php';

$autenticador = new PHPGangsta_GoogleAuthenticator();
$codigo_secreto = null;
$website = null;
$titulo = null;
$url_qr_code = null;

if (isset($_SESSION['Cliente'])) {
  $idusuario = $_SESSION['Cliente'];
  $sql_consulta = 'SELECT Key_Authenticator FROM usuarios WHERE Usuario = ?';
  $sentencia_consulta = $cn->prepare($sql_consulta);
  $sentencia_consulta->execute(array($idusuario));
  $result_consulta = $sentencia_consulta->fetch();
  if (is_null($result_consulta['Key_Authenticator'])) {
    ///el usuario no tiene key
    $codigo_secreto = $autenticador->createSecret();
    $website = "http://localhost/";
    $titulo = "Google Authenticator";
    $url_qr_code = $autenticador->getQRCodeGoogleUrl($titulo,$codigo_secreto,$website);

    $sql_update = 'UPDATE usuarios SET Key_Authenticator = :Key_Authenticator WHERE Usuario = :Usuario';
    $sentencia_agregar = $cn->prepare($sql_update);
    $sentencia_agregar->bindParam(':Key_Authenticator', $codigo_secreto, PDO::PARAM_STR);
    $sentencia_agregar->bindParam(':Usuario', $idusuario, PDO::PARAM_STR);
    if($sentencia_agregar->execute()){
      $sentencia_agregar = null;
      $cn = null;
    }
    $sentencia_agregar = null;
    $cn = null;
  }else {
    // el usuario tiene key
    $codigo_secreto = $result_consulta['Key_Authenticator'];
    $website = "http://localhost/google-authenticator";
    $titulo = "Google Authenticator";
    $sentencia_agregar = null;
    $cn = null;
  }
}
