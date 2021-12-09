<?php
session_start();

include_once '../Datos/conexion.php';

if (isset($_POST['nombre_usuario']) && isset($_POST['contraseña_usuario'])) {
  $usuario_login = $_POST['nombre_usuario'];
  $contraseñ_login = $_POST['contraseña_usuario'];

  $sql_verificar1 = 'SELECT u.Usuario, u.Contraseña, u.idRol, p.idPersonas, p.Nombres, p.Apellidos, p.Correo FROM usuarios AS u INNER JOIN personas AS p ON u.idUsuarios = p.idUsuarios WHERE u.Usuario = ?';
  $sentencia_verificar1 = $cn->prepare($sql_verificar1);
  $sentencia_verificar1->execute(array($usuario_login));
  $resultado1 = $sentencia_verificar1->fetch();
  ///Aqui vereficamos si el usuario existe
  if (!$resultado1) {
    //El usuario no existe
    $sentencia_verificar1 = null;
    $cn = null;
    $error = "El usuario que ingresaste es incorrecta.";
    header('location:/Vistas/login.php?error='.urlencode($error));
  }
  if (password_verify($contraseñ_login, $resultado1['Contraseña'])) {
    // si la contraseña es correcta entramos al index pero antes vamos al segundo factor de google
    $_SESSION['Cliente'] = $usuario_login;
    $_SESSION['Nombre'] = $resultado1['Nombres'];
    $_SESSION['Apellido'] = $resultado1['Apellidos'];
    $_SESSION['Rol'] = $resultado1['idRol'];
    $_SESSION['IdPersona'] = $resultado1['idPersonas'];
    $_SESSION['Correo'] = $resultado1['Correo'];
    $sentencia_verificar1 = null;
    $cn = null;
    header('location:/Vistas/autenticator.php');
  }else {
    // enviar un encabezado que la contraseña no es la correcta.
    $sentencia_verificar1 = null;
    $cn = null;
    $error = "La contraseña que ingresaste es incorrecta.";
    header('location:/Vistas/login.php?error='.urlencode($error));
  }
}
