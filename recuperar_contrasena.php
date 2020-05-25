<?php

session_start();

include 'includes/header.php';
include 'includes/funciones.php';

error_reporting(0);
?>
<head>
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
</head>

  <body>

  <div class="alert alert-dismissible alert-<?=$_SESSION['message_type']?>">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo $_SESSION['message']; ?>
    <?php
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
    ?>
  </div>

  <main class="container p-5">
    <div class="row">
    <div class="col-md-12">

      <h1 class="display-4">Recuperar contraseña de usuario</h1>
    </div>

    <div class="col-md-8">
      <div class="jumbotron">
        <p class="lead">Por favor diligencie los datos solicitados</p>


            <form action="recuperar_contrasena_validar.php" method="POST">
              <div class="form-group">
                <p class="lead">Ingrese su usuario</p>
                <input type="text" class="form-control" name="usuario" id="usuario" autofocus required>
              </div>
              <div class="form-group">
                <p class="lead">Ingrese el correo electrónico registrado</p>
                <input type="text" class="form-control" name="correo" id="correo" required>
              </div>
              <div align="right">
                <input type="submit" class="btn btn-primary btn-lg" value="Enviar">
                <a href="ingreso_usuario.php" class="btn btn-primary btn-lg">Cancelar</a>
              </div>
            </form>


      </div>
    </div>

    </div>
</main>
</html>
<?php 
include 'includes/footer.php'
?>