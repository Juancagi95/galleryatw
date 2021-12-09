<?php
include_once '../Datos/conexion.php';

if (isset($_POST['nuevo_nombre']) && isset($_POST['nuevo_descripcion']) && isset($_POST['id'])) {

  $nuevo_nombre = trim($_POST['nuevo_nombre']);
  $nuevo_descripcion = trim($_POST['nuevo_descripcion']);
  $id = trim($_POST['id']);

  $sql_update = 'UPDATE multimedias SET Nombre = :Nombre, Descripcion = :Descripcion WHERE idMultimedias = :idMultimedias';
  $sentencia_agregar = $cn->prepare($sql_update);
  $sentencia_agregar->bindParam(':Nombre', $nuevo_nombre, PDO::PARAM_STR);
  $sentencia_agregar->bindParam(':Descripcion', $nuevo_descripcion, PDO::PARAM_STR);
  $sentencia_agregar->bindParam(':idMultimedias', $id, PDO::PARAM_INT);
  if($sentencia_agregar->execute()){
    ///Aqui enviar un mensaje si se actualizo la tabla
    $sentencia_agregar = null;
    $cn = null;
    $update = "Datos modificados correctamente.";
    header('location:/Vistas/album.php?update='.urlencode($update));
  }else {
    ///Aqui no se actualizo la tabla
    $sentencia_agregar = null;
    $cn = null;
    $update = "No se modificados datos.";
    header('location:/Vistas/album.php?update='.urlencode($update));
  }
}
?>
