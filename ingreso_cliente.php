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
    <div class="col-md-4">

<br>
    <div class="card text-white bg-primary mb-3" style="max-width: 20rem;">
        <div class="card-header"></div>
        <div class="card-body">

        <form action="validar_cliente.php" method="POST">

          <div class="form-group">
            <label><h2>Iniciar sesión: Cliente</h2></label>
            <br><br><br>
            <input type="text" name="cliente" class="form-control" placeholder="Documento" autofocus required>
          </div>

          <br><br>
          <input type="submit" name="iniciar" class="btn btn-secondary btn-block" value="Iniciar sesion">
          
        </form>

        </div>
      </div>
      <a class="btn btn-secondary btn-block" href="ingreso_usuario.php" role="button"><i class="fas fa-exchange-alt"></i> Cambiar de usuario</a>
    </div>

    <div class="col-md-8">
    <br><br>
    <center>
      <div class="jumbotron">
        <h1 class="display-4">Modisteria: Confecciones letti</h1>
        <br><br><br>
        <p class="lead">Si usted es cliente de nuestro establecimiento, lo invitamos a ingresar utilizando su número de documento</p>
      </div>
    </center>

    </div>
</html>
<?php 
include 'includes/footer.php'
?>