<?php
session_start();

if (isset($_SESSION['validar']) && !isset($_SESSION['Verificado'])){
    // Si hay sesion
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
    <title>Buscar cuenta</title>
  </head>
  <body class="text-center">
  <main class="form-signin">
    <form action="/Controladores/buscar.php" method="POST" autocomplete="off">
      <img class="mb-6" src="https://d1roec4os7n4l7.cloudfront.net/logo.png" alt="" width="150" height="150">
      <h1 class="h3 mb-3 fw-normal">Recupera tu cuenta</h1>
      <p>Ingresa tu correo electrónico y usuario para buscar tu cuenta.</p>

      <div class="form-floating">
        <input type="email" class="form-control" name="correo_usuario" id="floatingInput" placeholder="name@example.com" required>
        <label for="floatingInput">Correo electrónico</label>
      </div>
      <div class="form-floating">
        <input type="text" class="form-control" name="nombre_usuario" id="floatingPassword" placeholder="Usuario" required>
        <label for="floatingPassword">Usuario</label>
      </div>

      <div class="checkbox mb-6">
        <label>
        </label>
        <?php
          if (isset($_GET['error'])) {
            $error = $_GET['error'];
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>".$error."</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>";
          }
        ?>
      </div>
      <button class="w-100 btn btn-lg btn-outline-primary" type="submit" checked>Buscar</button>
      <p class="text-muted">Cancelar
        <a href="/Vistas/login.php" class="link-primary">Inicia sesión</a>
      </p>
      <p class="mt-5 mb-3 text-muted">&copy; 2021–2022</p>
    </form>
  </main>
  </body>
</html>
