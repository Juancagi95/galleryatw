<?php
session_start();

if (isset($_SESSION['Recupera']) && isset($_SESSION['Usuario_Recupera'])){
  ///si hay sesion
} else {
   // No hay Sesion
    header('location:/Vistas/login.php');
}
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <link href="https://d1roec4os7n4l7.cloudfront.net/style-1.css" rel="stylesheet">
    <title>Recupera cuenta</title>
  </head>
  <body class="text-center">
  <main class="form-signin">
    <form action="/Controladores/update_pass.php" method="POST" autocomplete="off">
      <img class="mb-6" src="https://d1roec4os7n4l7.cloudfront.net/logo.png" alt="" width="150" height="150">
      <h1 class="h3 mb-3 fw-normal">Cambiar la contraseña</h1>
      <p>Ingresa tu nueva contraseña.</p>

      <div class="form-floating">
        <input type="password" class="form-control" name="contraseña_nueva" id="floatingInput" placeholder="Contraseña nueva" required>
        <label for="floatingInput">Contraseña nueva</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" name="contraseña_nueva_otra_vez" id="floatingPassword" placeholder="Contraseña nueva otra vez" required>
        <label for="floatingPassword">Vuelve a escribir la contraseña nueva</label>
      </div>

      <div class="checkbox mb-6">
        <label>
        </label>
        <?php
          if (isset($_GET['update'])) {
            $update = $_GET['update'];
            echo "<div class='alert alert-primary alert-dismissible fade show' role='alert'>
                    <strong>".$update."</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>";
          }
        ?>
      </div>
      <button class="w-100 btn btn-lg btn-outline-primary" type="submit" checked>Guardar cambios</button>
      <p class="text-muted">Cancelar
        <a href="/Vistas/login.php" class="link-primary">Inicia sesión</a>
      </p>
      <p class="mt-5 mb-3 text-muted">&copy; 2021–2022</p>
    </form>
  </main>
  </body>
</html>
