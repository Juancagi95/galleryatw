<?php
session_start();

include_once '../Datos/conexion.php';
include_once '../Controladores/smtp.php';


if (isset($_POST['contraseña_nueva']) && isset($_POST['contraseña_nueva_otra_vez']) && isset($_SESSION['Usuario_Recupera']) && isset($_SESSION['Recupera'])) {

  $contraseña_nueva1 = trim($_POST['contraseña_nueva']);
  $contraseña_nueva2 = trim($_POST['contraseña_nueva_otra_vez']);
  $contraseña_nueva1 = password_hash($contraseña_nueva2,PASSWORD_DEFAULT);
  ///Datos del usuario encontrado
  $correo_econtrado = $_SESSION['Recupera'];
  $usuario_encontrado = $_SESSION['Usuario_Recupera'];
  $Key_Authenticator = null;

  if (password_verify($contraseña_nueva2,$contraseña_nueva1)) {

    $sql_update1 = 'UPDATE usuarios SET Contraseña = ?, Key_Authenticator = ? WHERE Usuario = ?';
    $sentencia_agregar1 = $cn->prepare($sql_update1);
    $sentencia_agregar1->bindParam(1, $contraseña_nueva1, PDO::PARAM_STR);
    $sentencia_agregar1->bindParam(2, $Key_Authenticator, PDO::PARAM_STR);
    $sentencia_agregar1->bindParam(3, $usuario_encontrado, PDO::PARAM_STR);
    if($sentencia_agregar1->execute()){
      ///Aqui enviar un mensaje si se actualizo la tabla
      enviarmail($correo_econtrado, $usuario_encontrado, 1);
      $sentencia_agregar1 = null;
      $cn = null;
      $_SESSION = array();
      if (ini_get("session.use_cookies")) {
          $params = session_get_cookie_params();
          setcookie(session_name(), '', time() - 42000,
              $params["path"], $params["domain"],
              $params["secure"], $params["httponly"]
          );
      }
      session_destroy();
      $error = "Datos modificados correctamente.";
      header('location:/Vistas/login.php?error='.urlencode($error));
    } else {
      ///Aqui no se actualizo la tabla
      $sentencia_agregar1 = null;
      $cn = null;
      $update = "No se modificados datos.";
      header('location:/Vistas/recuperar.php?update='.urlencode($update));
    }
  } else {
    $error = "La contraseña no coinciden.";
    header('location:/Vistas/recuperar.php?update='.urlencode($error));
  }
} else {
  $_SESSION = array();
  if (ini_get("session.use_cookies")) {
      $params = session_get_cookie_params();
      setcookie(session_name(), '', time() - 42000,
          $params["path"], $params["domain"],
          $params["secure"], $params["httponly"]
      );
  }
  session_destroy();
  header('location:/Vistas/login.php');
}
