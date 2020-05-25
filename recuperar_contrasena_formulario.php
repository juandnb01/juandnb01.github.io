<?php



include 'includes/header.php';
include 'includes/cn.php';

session_start();
error_reporting(0);
$id = $_SESSION['identificacion'];

if(isset($_POST["enviar"]))
{
  $contrasena1 = $_POST['contrasena1'];
  $contrasena2 = $_POST['contrasena2'];
  $identifi = $_POST['identi'];

  if($contrasena1 == $contrasena2)
  {
    $upconsulta = "UPDATE usuarios SET contra = '$contrasena1' where id = '$identifi' ";
    $upresultado = mysqli_query($conexion, $upconsulta);

    $_SESSION['message'] = 'Contraseña actualizada correctamente';
    $_SESSION['message_type'] = 'primary';
    header("location:ingreso_usuario.php");

  }
  else
  {
    $_SESSION['message'] = 'Las contraseñas digitadas no son iguales';
    $_SESSION['message_type'] = 'danger';
  }

}
?>
<head>
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
</head>

  <body>

<div class="alert alert-dismissible alert-<?=$_SESSION['message_type']?>">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <?php echo $_SESSION['message']; //echo " "; echo $_SESSION['hiper'];?>
  <?php
  unset($_SESSION['message']);
  unset($_SESSION['message_type']);
  ?>
</div>

  <main class="container p-5">
    <div class="row">
    <div class="col-md-12">

      <h1 class="display-4">Nueva contraseña</h1>
    </div>

    <div class="col-md-6">
      <div class="jumbotron">
        <form action="recuperar_contrasena_formulario.php" method="POST">
          <div class="form-group">
            <p class="lead">Ingrese su nueva contraseña</p>
            <input type="password" class="form-control" name="contrasena1" id="contrasena1" minlength="5" autofocus required>
          </div>
          <div class="form-group">
            <p class="lead">Vuelva a ingresar la misma contraseña</p>
            <input type="password" class="form-control" name="contrasena2" id="contrasena2" minlength="5" required>
          </div>
          <div align="right">
            <input type="hidden" name="identi" value="<?php echo $id;?>">
            <input type="submit" name="enviar" id="enviar" class="btn btn-primary btn-lg" value="Enviar">
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