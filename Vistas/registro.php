<?php
session_start();

if (isset($_SESSION['Cliente']) && isset($_SESSION['Rol'])){
    // Si hay sesion
    if (!empty($_SESSION['Verificado'])) {
      // si es valido la session no entre Aqui
      header('location:/index.php');
    }
}
 ?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <link href="https://d1roec4os7n4l7.cloudfront.net/style-2.css" rel="stylesheet">
    <title>Regístrate</title>
  </head>
  <body class="text-center">
<main class="form-signin">
  <form action="/Controladores/agregar_usuario.php" method="POST" autocomplete="off">
    <img class="mb-6" src="https://d1roec4os7n4l7.cloudfront.net/logo.png" alt="" width="150" height="150">
    <h1 class="h3 mb-3 fw-normal">Por favor, registrese</h1>

    <div class="form-floating">
      <input type="text" class="form-control" name="nombre" id="floatingInput" placeholder="Usuario" required>
      <label for="floatingInput">Nombres</label>
    </div>
    <div class="form-floating">
      <input type="text" class="form-control" name="apellido" id="floatingInput" placeholder="Usuario" required>
      <label for="floatingInput">Apellidos</label>
    </div>
    <div class="form-floating">
      <input type="email" class="form-control" name="email" id="floatingInput" placeholder="nombre@example.com" required>
      <label for="floatingInput">Email</label>
    </div>
    <div class="form-floating">
      <input type="text" class="form-control" name="nombre_usuario" id="floatingInput" placeholder="Usuario" required>
      <label for="floatingInput">Nombre de usuario</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="contraseña" id="floatingPassword" placeholder="Contraseña" required>
      <label for="floatingPassword">Contraseña</label>
    </div>

    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"><h8> Acepto las condiciones del servicio y las politicas de privacidad de ATW</h8>
      </label>
      <?php
        if (isset($_GET['error'])) {
          $error = $_GET['error'];
          ///echo "<p>".$error."</p>";
          echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                  <strong>".$error."</strong>
                  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
        }
      ?>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Regístrate</button>
    <p class="text-muted">¿Tienes cuenta?
      <a href="/Vistas/login.php" class="link-primary">Inicia sesión</a>
    </p>
    <p class="mt-6 mb-4 text-muted">&copy; 2021-2022</p>
  </form>
</main>
  </body>
</html>
