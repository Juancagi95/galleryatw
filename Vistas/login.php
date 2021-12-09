<!DOCTYPE html>
<?php
session_start();
if (!empty($_SESSION['Cliente'])) {
  header('location:/index.php');
  if (empty($_SESSION['Verificado'])) {
     header('location:/Controladores/cerrar.php');
  }
}
?>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <link href="https://d1roec4os7n4l7.cloudfront.net/style.css" rel="stylesheet">
    <title>Login</title>
  </head>
  <body class="text-center">
  <main class="form-signin">
    <form action="/Controladores/sesion.php" method="POST" autocomplete="off">
      <img class="mb-6" src="https://d1roec4os7n4l7.cloudfront.net/logo.png" alt="" width="150" height="150">
      <h1 class="h3 mb-3 fw-normal">Iniciar sesión</h1>

      <div class="form-floating">
        <input type="text" class="form-control" name="nombre_usuario" id="floatingInput" placeholder="Usuario" required>
        <label for="floatingInput">Usuario</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" name="contraseña_usuario" id="floatingPassword" placeholder="Contraseña" required>
        <label for="floatingPassword">Contraseña</label>
      </div>

      <div class="checkbox mb-3">
        <label>
          <a href="/Controladores/verificar.php">¿Has olvidado la Contraseña?</a>
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
      <button class="w-100 btn btn-lg btn-primary" type="submit">Entrar</button>
      <p class="text-muted">¿No tienes cuenta?
        <a href="/Vistas/registro.php" class="link-primary">Regístrate</a>
      </p>
      <p class="mt-5 mb-3 text-muted">&copy; 2021–2022</p>
    </form>
  </main>
  </body>
</html>
