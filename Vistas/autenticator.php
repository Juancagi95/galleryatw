<?php
require_once '../google-authenticator/gerador.php';

if (isset($_SESSION['Cliente']) && isset($_SESSION['Rol'])){
    // Si hay sesion
    if (!empty($_SESSION['Verificado'])) {
      // si es valido la session no entre Aqui
      header('location:/index.php');
    } else {
      // code...
    }
} else {
   // NO hay Sesion
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
    <link href="https://d1roec4os7n4l7.cloudfront.net/style-2.css" rel="stylesheet">
    <title>Login</title>
  </head>
  <body class="text-center">
  <main class="form-signin">
    <form action="/google-authenticator/verificador.php" method="POST" autocomplete="off">
      <?php
      if (!is_null($url_qr_code)) {
      ?>
      <img class="mb-4" src="<?php echo $url_qr_code; ?>" alt="" width="150" height="150">
      <?php
      }else {
      ?>
        <img class="mb-4" src="https://d1roec4os7n4l7.cloudfront.net/logo.png" alt="" width="150" height="150">
      <?php
      }
      ?>
      <h1 class="h3 mb-3 fw-normal">Google Authenticator</h1>

      <div class="form-floating">
        <input type="text" class="form-control" name="codigo" id="floatingInput" placeholder="Codigo de Seguridad" required>
        <label for="floatingInput">Codigo de Seguridad</label>
      </div>

      <div class="checkbox mb-3">
        <label>
          <a href="/Controladores/verificar.php">¿Has olvidado la Autenticador?</a>
          <input type="hidden" name="codigosecreto" value="<?php echo $codigo_secreto ?>">
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
      <p class="mt-5 mb-3 text-muted">&copy; 2021–2022</p>
    </form>
  </main>
  </body>
</html>
