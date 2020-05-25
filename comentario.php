<?php

  include 'includes/cn.php';
  session_start();
  $varsession = $_SESSION['cliente'];
  
  if($varsession == null || $varsession = '')
  {
    header ("location:error_sesion.php");
    die();
  }

  $cliente = $_SESSION['cliente'];

  //Consultamos los datos del Usuario

  $sql = "SELECT * from clientes INNER JOIN roles ON cod_rol = N_rol where doc_cliente = '$cliente' ";
  $result = mysqli_query($conexion, $sql);
  $row = mysqli_fetch_array($result);

  $_SESSION['rol'] = $row['cod_rol'];

	include('includes/header2.php');

  if(isset($_SESSION['message']))
  { ?>
    <div class="alert alert-<?= $_SESSION['message_type'];?> alert-dismissible fade show" role="alert">
      <?php echo $_SESSION['message'] ?>

      <button type="button" class="close" data-dismiss="alert" arial-label="Close">
        <span arial-hidden="true">&times;</span>
      </button>
    </div>
  <?php }
	
  ?>

<main class="container p-1">
  <div class="row">

    <div class="col-md-12">

        <h1 class="display-3">Estamos atentos a tus comentarios</h1>
        
        <br>

    </div>

    <div class="col-md-4">
      <br>
    </div>
  </div>
</main>

<main class="container p-1">
  <div class="row">
    <div class="col-md-5">

      <div class="jumbotron">
        <div class="card card-body">
          <form action="guardarcomentario.php" method="POST">
            <div class="form-group">
              <input type="text" name="nombre" class="form-control" placeholder="Nombre completo" autofocus required>
            </div>
            <div class="form-group">
              <input type="text" name="correo" class="form-control" placeholder="Correo electrónico" required>
            </div>
            <div class="form-group">
              <input type="text" name="telefono" class="form-control" placeholder="Telefono" required>
            </div>
            <div class="form-group">
              <textarea name="comentario" class="form-control" placeholder="Comentario" maxlength="400" required></textarea>
            </div>
            <input type="submit" name="enviar" class="btn btn-primary btn-block" value="Enviar">
          </form>
        </div>
      </div>
    
    </div>
  </div>
</main>