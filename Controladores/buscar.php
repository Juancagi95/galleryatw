<?php
session_start();

include_once '../Datos/conexion.php';

if(isset($_POST['correo_usuario']) && isset($_POST['nombre_usuario'])){
  $correo_usuario = $_POST['correo_usuario'];
  $nombre_usuario = $_POST['nombre_usuario'];

  $sql_verificar2 = 'SELECT u.Usuario, p.Correo FROM usuarios AS u INNER JOIN personas AS p ON u.idUsuarios = p.idUsuarios WHERE u.Usuario = ? AND p.Correo = ?';
  $sentencia_verificar2 = $cn->prepare($sql_verificar2);
  $sentencia_verificar2->execute(array($nombre_usuario, $correo_usuario));
  $resultado2 = $sentencia_verificar2->fetch();
  ///Aqui vereficamos si el usuario existe
  if (!$resultado2) {
    //El usuario no existe
    $sentencia_verificar2 = null;
    $cn = null;
    $error = "Usuario no encontrado.";
    header('location:/Vistas/identificar.php?error='.urlencode($error));
  }else{
    $_SESSION['Usuario_Recupera'] = $resultado2['Usuario'];
    $_SESSION['Recupera'] = $resultado2['Correo'];
    $sentencia_verificar2 = null;
    $cn = null;
    header('location:/Vistas/recuperar.php');
  }
}
