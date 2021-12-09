<?php
include_once '../Datos/conexion.php';

if (isset($_POST['nombre_usuario']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email']) && isset($_POST['contraseña'])) {

  $usuario_nuevo = trim($_POST['nombre_usuario']);
  $nombre_usuario = trim($_POST['nombre']);
  $apellido_usuario = trim($_POST['apellido']);
  $email_usuario = trim($_POST['email']);
  $contraseña1 = trim($_POST['contraseña']);
  $contraseña2 = trim($_POST['contraseña']);

  ///Aqui verificamos si el usuario con ese nombre existe.
  $sql_verificar1 = 'SELECT Usuario FROM usuarios WHERE Usuario = ?';
  $sentencia_verificar1 = $cn->prepare($sql_verificar1);
  $sentencia_verificar1->execute(array($usuario_nuevo));
  $resultado1 = $sentencia_verificar1->fetch();
  if ($resultado1) {
    ///Exisrte este usuario
    $sentencia_verificar1 = null;
    $cn = null;
    $error = "El nombre de usuario ya existe.";
    header('location:/Vistas/registro.php?error='.urlencode($error));
  } else {
    ///Creamos nuevo Usuario
    $contraseña1 = password_hash($contraseña2,PASSWORD_DEFAULT);
    ///Verificamos si la contraseña consida con el Hash
    if (password_verify($contraseña2,$contraseña1)) {
      $sql_agregar1 = 'INSERT INTO usuarios (idRol,Usuario,Contraseña,Estado) VALUES (?,?,?,?)';
      $sentencia_agregar1 = $cn->prepare($sql_agregar1);
      if ($sentencia_agregar1->execute(array('2',$usuario_nuevo,$contraseña1,'1'))) {
        //Aqui va codigo decir que se creo el usuario
        $sql_verificar2 = 'SELECT idUsuarios FROM usuarios WHERE Usuario = ?';
        $sentencia_verificar2 = $cn->prepare($sql_verificar2);
        if ($sentencia_verificar2->execute(array($usuario_nuevo))) {
          //si el usuiario se creo va ingresar tambien la tabla perosnas
          $resultado2 = $sentencia_verificar2->fetch();
          $sql_agregar2 = 'INSERT INTO personas (idUsuarios,Nombres,Apellidos,Correo,Estado) VALUES (?,?,?,?,?)';
          $sentencia_agregar2 = $cn->prepare($sql_agregar2);
          if ($sentencia_agregar2->execute(array($resultado2['idUsuarios'],$nombre_usuario,$apellido_usuario,$email_usuario,'1'))) {
            // Aqui ya se creo el usuario con su personas
            $sentencia_verificar1 = null;
            $sentencia_verificar2 = null;
            $sentencia_agregar1 = null;
            $sentencia_agregar2 = null;
            $cn = null;
            $error = "Usuario creado correctamente.";
            header('location:/Vistas/registro.php?error='.urlencode($error));
          } else {
            // aqui solo se creo el usuario pero no la persona
            $sentencia_verificar1 = null;
            $sentencia_verificar2 = null;
            $sentencia_agregar1 = null;
            $sentencia_agregar2 = null;
            $cn = null;
            $error = "Usuario no creado correctamente.";
            header('location:/Vistas/registro.php?error='.urlencode($error));
          }
        } else {
          ///Aqui va codigo decir que no se creo el usuario
          $sentencia_verificar1 = null;
          $sentencia_verificar2 = null;
          $sentencia_agregar1 = null;
          $cn = null;
          $error = "Usuario no creado correctamente.";
          header('location:/Vistas/registro.php?error='.urlencode($error));
        }
      } else {
        //La contraseña no considen
        $sentencia_verificar1 = null;
        $sentencia_agregar1 = null;
        $cn = null;
        $error = "La contraseña no coinciden.";
        header('location:/Vistas/registro.php?error='.urlencode($error));
      }
    }
  }
  $sentencia_verificar1 = null;
  $cn = null;
}
