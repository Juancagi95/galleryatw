<?php
session_start();
if (isset($_SESSION['Cliente']) && isset($_SESSION['Rol']) && isset($_SESSION['Verificado'])){
    // Si hay sesion
} else {
   // NO hay Sesion
    header('location:/Vistas/login.php');
}
?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <link href="https://ujdmhptts.s3.amazonaws.com/style4.css" rel="stylesheet">
    <title>Inicio</title>
  </head>
  <body>

<header>
  <div class="collapse bg-dark" id="navbarHeader">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-md-7 py-4">
          <h4 class="text-white">Acerca de</h4>
          <p class="text-muted">ATW  es un servicio de almacenamiento sencillo que ofrece excelente durabilidad, disponibilidad, rendimiento, seguridad y escalabilidad prácticamente ilimitada a costos muy reducidos.</p>
        </div>
        <div class="col-sm-4 offset-md-1 py-4">
          <h4 class="text-white">Perfil</h4>
          <ul class="list-unstyled">
            <li><a href="/Vistas/cuenta.php" class="text-white">Cuenta</a></li>
            <li><a href="/Controladores/cerrar.php" class="text-white">Cerrar Sesión</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container">
      <a href="/Vistas/album.php" class="navbar-brand d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24">
          <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/>
        </svg>
        <strong>Álbum</strong>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </div>
</header>

<main>

  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Bienvenido: <?php echo $_SESSION['Nombre'] ," ",$_SESSION['Apellido'] ?></h1>
        <p class="lead text-muted">Este es su repositorio donde puede subir imágenes a su nube personal. A medida que se desplaza podrá visualizar su galería de imágenes.</p>
        <p>
          <form action="/Controladores/cargar.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="formFile" class="form-label">Selecciona archivo a subir:</label>
            </div>
            <div class="input-group">
              <input type="file" class="form-control" name="uploaded" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" required>
              <button class="btn btn-outline-secondary" type="submit" name="Upload" id="inputGroupFileAddon04">Subir</button>
            </div>
          </form>
        </p>
        <?php
          if (isset($_GET['upload'])) {
            $upload = $_GET['upload'];
        ?>
          <div class='alert alert-primary alert-dismissible fade show' role='alert'>
            <strong><?php echo $upload; ?></strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>
        <?php
        }
        ?>
      </div>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">
    </div>
  </div>

</main>

<footer class="text-muted py-5">
  <div class="container">
    <p class="mb-1">ATW &copy; 2021</p>
    <p class="mb-0"><a href="#"> Privacidad y cookies</a> <a href="#">Términos de uso</a> <a href="#">Acerca de nuestros anuncios</a> <a href="#">Contacto</a></p>
  </div>
</footer>

  </body>
</html>
