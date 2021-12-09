<?php
session_start();

include_once '../Datos/conexion.php';

if (isset($_SESSION['Cliente']) && isset($_SESSION['Rol']) && isset($_SESSION['Verificado'])){
    // Si hay sesion
} else {
   // No hay Sesion
    header('location:/Vistas/login.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,900" rel="stylesheet">
        <link href="https://d1roec4os7n4l7.cloudfront.net/style-3.css" rel="stylesheet">
        <title>Cuenta</title>
    </head>
    <body>
        <div id="notfound">
		<div class="notfound">
			<div class="notfound-404">
				<h1>Oops!</h1>
			</div>
			<h2>PAGINA EN MANTENIMIENTO</h2>
			<p>Actualmente estamos realizando labores de mantenimineto y mejoras a nuestro portal..</p>
		</div>
	</div
    </body>
</html>
