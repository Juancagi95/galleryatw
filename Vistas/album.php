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
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <title>Álbum</title>
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
      <a href="/index.php" class="navbar-brand d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
        <strong>Inicio</strong>
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
        <h1 class="fw-light">Álbum</h1>
        <p class="lead text-muted">Echa un vistazo a las vistas previas y modifica el nombre y descripción de tus imágenes. Podrás ver la fecha de subida de tus imágenes. A una calidad excelente de las imágenes.</p>
      </div>
      <?php
        if (isset($_GET['update'])) {
          $upload = $_GET['update'];
      ?>
        <div class='alert alert-primary alert-dismissible fade show' role='alert'>
          <strong><?php echo $upload; ?></strong>
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
      <?php
      }
      ?>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <?php
        ///Creamos una el query para buscar si existe datos de imagenes del usuario
        $sql_imagenes = 'SELECT idMultimedias, Nombre, Descripcion, Fecha, Url FROM multimedias WHERE idPersonas = ? ORDER BY idMultimedias DESC';
        $sentencia_imagenes = $cn->prepare($sql_imagenes);
        $sentencia_imagenes->execute(array($_SESSION['IdPersona']));
        $resultado_imagnes = $sentencia_imagenes->fetchAll();
        if ($resultado_imagnes){
          for ($i=0; $i < count($resultado_imagnes); $i++) {
            $url_ext = '..' .substr($resultado_imagnes[$i]['Url'], strrpos($resultado_imagnes[$i]['Url'],'/Archivos/'));
        ?>
        <div class="col">
          <div class="card shadow-sm">
            <img class="bd-placeholder-img card-img-top" src="<?php echo $url_ext; ?>" width="100%" height="275" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"></img>

            <div class="card-body">
              <p class="card-text"><?php echo $resultado_imagnes[$i]['Descripcion']; ?>.</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary"data-bs-toggle="modal" data-bs-target="#exampleModa" data-bs-whatever="<?php echo $url_ext; ?>">Ver</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="<?php echo $resultado_imagnes[$i]['Nombre'] .'/' .$resultado_imagnes[$i]['idMultimedias']; ?>">Editar</button>
                </div>
                <small class="text-muted"><?php echo $resultado_imagnes[$i]['Fecha']; ?></small>
              </div>
            </div>
          </div>
        </div>
        <?php
          }
        }
        ?>
      </div>

    </div>
  </div>

</main>

<footer class="text-muted py-5">
  <div class="container">
    <p class="float-end mb-1">
      <a href="#">Volver arriba</a>
    </p>
    <p class="mb-1">ATW &copy; 2021</p>
    <p class="mb-0"><a href="#"> Privacidad y cookies</a> <a href="#">Términos de uso</a> <a href="#">Acerca de nuestros anuncios</a> <a href="#">Contacto</a></p>
  </div>
</footer>
<!-- Modal1 -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Imagen</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/Controladores/update_imagen.php" method="POST" autocomplete="off">
        <div class="modal-body">
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Nombre:</label>
              <input type="text" class="form-control" id="recipient-name" name="nuevo_nombre">
              <input type="hidden" class="form-control" id="recipient-id" name="id">
            </div>
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Descripción:</label>
              <textarea class="form-control" id="message-text" name="nuevo_descripcion"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal2 -->
<div class="modal fade" id="exampleModa" tabindex="-1" aria-labelledby="exampleModaLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModaLabel">Vista previa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="text-center">
              <img class="img-fluid" id="img01">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Para pasar los datos Modal1 -->
<script type="text/javascript">
var exampleModal = document.getElementById('exampleModal')
var exampleModaId = document.getElementById('recipient-id')
exampleModal.addEventListener('show.bs.modal', function (event) {
  var button = event.relatedTarget
  var recipient = button.getAttribute('data-bs-whatever')
  var modalTitle = exampleModal.querySelector('.modal-title')
  var modalBodyInput = exampleModal.querySelector('.modal-body input')
  modalTitle.textContent = 'Editar Imagen'
  var rec = recipient.split("/", 1)
  var recid = recipient.split("/")
  exampleModaId.value = recid[1]
  modalBodyInput.value = rec
})
</script>
<!-- Para pasar los datos Modal2 -->
<script type="text/javascript">
var modalImg = document.getElementById("img01")
exampleModa.addEventListener('show.bs.modal', function (event) {
  var button = event.relatedTarget
  var recipient = button.getAttribute('data-bs-whatever')
  modalImg.src = recipient
})
</script>

  </body>
</html>
