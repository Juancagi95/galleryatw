<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

include_once '../Datos/conexion.php';

if (isset($_POST['Upload'])) {
  // informacion de archivos
  $uploaded_name = $_FILES['uploaded']['name'];
  $uploaded_ext = substr($uploaded_name, strrpos($uploaded_name,'.') + 1);
  $uploaded_size = $_FILES['uploaded']['size'];
  $uploaded_type = $_FILES['uploaded']['type'];
  $uploaded_tmp = $_FILES['uploaded']['tmp_name'];
  /// donde se ira el Archivos
  $target_path = $_SERVER['DOCUMENT_ROOT'] .'/Archivos/' .$_SESSION['Cliente'];
  $dateTime = new DateTime('now', new DateTimeZone('America/El_Salvador'));
  $hoy = $dateTime->format('F j, Y, g:i a');
  $Descripción = 'Descripción generada automáticamente con confianza media';
  ///Si el archivo existe
  if(file_exists($target_path)){
    ///Aqui ecriptamos el archivo por el nombre una varible temporar
    $target_file = md5(uniqid() .$uploaded_name) .'.' .$uploaded_ext;
    $temp_file = (ini_get('upload_tmp_dir') == '') ? (sys_get_temp_dir()) : (ini_get('upload_tmp_dir'));
    $temp_file .= DIRECTORY_SEPARATOR .md5(uniqid() .$uploaded_name) .'.' .$uploaded_ext;
    ///Ahora preguntamos si es una imagen o video
    if ((strtolower($uploaded_ext) == 'jpg' || strtolower($uploaded_ext) == 'jpeg' || strtolower($uploaded_ext) == 'png') && ($uploaded_size <50000000)
    && ($uploaded_type == 'image/jpeg' || $uploaded_type == 'image/png') && getimagesize($uploaded_tmp)) {
      ///Aqui elomoamo la data de la imagen
        if($uploaded_type == 'image/jpeg') {
          $img = imagecreatefromjpeg($uploaded_tmp);
          imagejpeg($img, $temp_file, 100);
        }else {
          $img = imagecreatefrompng($uploaded_tmp);
          imagepng($img, $temp_file, 9);
        }
        imagedestroy($img);
        // Aqui lo mueve al a carpeta
        if(rename($temp_file, ($target_path .'/' .$target_file))) {
            // Si se subio
            ///Direccion del archivo
            $formato = null;
            if($uploaded_ext == 'png'){
              $formato = 1;
            }
            if($uploaded_ext == 'jpg'){
              $formato = 2;
            }
            if($uploaded_ext == 'jpeg'){
              $formato = 3;
            }
            $ruta = $target_path .'/' .$target_file;

            $sql_agregar_archivo = 'INSERT INTO multimedias (idPersonas,idFormatos,Nombre,Descripcion,Url,Fecha,Estado) VALUES (?,?,?,?,?,?,?)';
            $sentencia_agregar_archivo = $cn->prepare($sql_agregar_archivo);
            if($sentencia_agregar_archivo->execute(array($_SESSION['IdPersona'],$formato,$uploaded_name,$Descripción,$ruta,$hoy,1))) {
              // Aqui insetamos los Datos
              $sentencia_agregar_archivo = null;
              $cn = null;
              $upload = "El archivo ". $uploaded_name ." ha sido subido.";
              header('location:/index.php?upload='.urlencode($upload));
            }else {
              //Cerramos base de datos y la sentencias
              $sentencia_agregar_archivo = null;
              $cn = null;
              $upload = "Lo sentimos, hubo un error al guardar su archivo.";
              header('location:/index.php?upload='.urlencode($upload));
            }
        }else {
            // No se subido
            $upload = "Lo sentimos, su archivo no fue subido.";
            header('location:/index.php?upload='.urlencode($upload));
        }
        // Se elimna el archivo temporar
        if(file_exists($temp_file))
            unlink($temp_file);
    }else {
      // El archivo no se subio por el tipo de formato.
      $upload = "Lo sentimos, solo se permiten archivos: JPG, JPEG, & PNG.";
      header('location:/index.php?upload='.urlencode($upload));
    }
  }else {
    // si el archivo no existe lo crea.
    if(create_directory($target_path)){
      ///Aqui creo la carpeta ahora subira la foto
      ///Aqui ecriptamos el archivo por el nombre una varible temporar
      $target_file = md5(uniqid() .$uploaded_name) .'.' .$uploaded_ext;
      $temp_file = (ini_get('upload_tmp_dir') == '') ? (sys_get_temp_dir()) : (ini_get('upload_tmp_dir'));
      $temp_file .= DIRECTORY_SEPARATOR .md5(uniqid() .$uploaded_name) .'.' .$uploaded_ext;
      ///Ahora preguntamos si es una imagen o video
      if ((strtolower($uploaded_ext) == 'jpg' || strtolower($uploaded_ext) == 'jpeg' || strtolower($uploaded_ext) == 'png') && ($uploaded_size <50000000)
      && ($uploaded_type == 'image/jpeg' || $uploaded_type == 'image/png') && getimagesize($uploaded_tmp)) {
        ///Aqui elomoamo la data de la imagen
          if($uploaded_type == 'image/jpeg') {
            $img = imagecreatefromjpeg($uploaded_tmp);
            imagejpeg($img, $temp_file, 100);
          }else {
            $img = imagecreatefrompng($uploaded_tmp);
            imagepng($img, $temp_file, 9);
          }
          imagedestroy($img);
          // Aqui lo mueve al a carpeta
          if(rename($temp_file, ($target_path .'/' .$target_file))) {
            // Si se subio
            ///Direccion del archivo
            $formato = null;
            if($uploaded_ext == 'png'){
              $formato = 1;
            }
            if($uploaded_ext == 'jpg'){
              $formato = 2;
            }
            if($uploaded_ext == 'jpeg'){
              $formato = 3;
            }
            $ruta = $target_path .'/' .$target_file;

            $sql_agregar_archivo = 'INSERT INTO multimedias (idPersonas,idFormatos,Nombre,Descripcion,Url,Fecha,Estado) VALUES (?,?,?,?,?,?,?)';
            $sentencia_agregar_archivo = $cn->prepare($sql_agregar_archivo);
            if($sentencia_agregar_archivo->execute(array($_SESSION['IdPersona'],$formato,$uploaded_name,$Descripción,$ruta,$hoy,1))) {
              // Aqui insetamos los Datos
              $sentencia_agregar_archivo = null;
              $cn = null;
              $upload = "El archivo ". $uploaded_name ." ha sido subido.";
              header('location:/index.php?upload='.urlencode($upload));
            }else {
              //Cerramos base de datos y la sentencias
              $sentencia_agregar_archivo = null;
              $cn = null;
              $upload = "Lo sentimos, hubo un error al guardar su archivo.";
              header('location:/index.php?upload='.urlencode($upload));
            }
          }else {
              // No se subido
              $upload = "Lo sentimos, su archivo no fue subido.";
              header('location:/index.php?upload='.urlencode($upload));
          }
          // Se elimna el archivo temporar
          if(file_exists($temp_file))
              unlink($temp_file);
      }else {
        // El archivo no se subio por el tipo de formato.
        $upload = "Lo sentimos, solo se permiten archivos: JPG, JPEG, & PNG.";
        header('location:/index.php?upload='.urlencode($upload));
      }
    }else{
      //Aqui decimos que hubo error subir el archivo en la carpeta no se creo
      $upload = "Lo sentimos, su archivo no fue subido a su carpeta de destino.";
      header('location:/index.php?upload='.urlencode($upload));
    }
  }
}
///Funcion para crear la carpeta con el nombre del usuario
function create_directory($target_path){
  $result = mkdir($target_path);
  if(!$result):
    return false;
  else:
    return true;
  endif;
}
