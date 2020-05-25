<?php
  session_start();
  $varsession = $_SESSION['usuario'];
  
  if($varsession == null || $varsession = '')
  {
    header ("location:error_sesion.php");
    die();
  }

	include ('includes/cn.php');

	if(isset($_GET['id']))
    //variable creada para llevar el id de cada usuario
    $_SESSION['identificacion'] = $_GET['id'];
	{
		$id = $_GET['id'];

		$consulta = "SELECT * from usuarios WHERE id = $id";

		$resultado = mysqli_query($conexion, $consulta);

		if(mysqli_num_rows($resultado) == 1)
		{
			$mostrar = mysqli_fetch_array($resultado);

      $identificacion = $mostrar['id'];
			$usuario = $mostrar['nick'];
			$nombre = $mostrar['nombre'];
			$correo = $mostrar['correo'];
			$contra = $mostrar['contra'];
			$rol = $mostrar['cod_rol'];
		}
	}



  include('includes/cn.php');
  include('includes/header2.php');
?>

<main class="container p-1">
  	<div class="row">
    <div class="col-md-5">

      <div class="jumbotron">

        <div class="card card-body">
            <form action="actualizar_usuario2.php?id=<?php echo $identificacion; ?>" method="POST">
              <div class="form-group">
              	<label><h2>Actualizar usuario</h2></label>
                <br>

                <h6>Usuario</h6><input type="text" name="upuser" class="form-control" value="<?php echo $usuario; ?>" autofocus required>

                <h6>Nombre</h6><input type="text" name="upnombre" class="form-control" value="<?php echo $nombre; ?>" required>
              
                <h6>Email</h6><input type="text" name="upcorreo" class="form-control" value="<?php echo $correo; ?>" required>
                
                <h6>Password</h6><input type="text" name="upcontra" class="form-control" value="<?php echo $contra; ?>" required>
              
              <?php 
                  $tipo_rol = $_SESSION['identificacion'];
                   //se hace esta consulta para conocer que rol tiene el usuario inicialmente
                  $consultar = "SELECT * from usuarios INNER JOIN roles ON cod_rol = N_rol where id = '$tipo_rol' ";
                  $ejecutar = mysqli_query($conexion, $consultar);
                  $roles = mysqli_fetch_array($ejecutar);
              ?>
                <br>
                <h6>Seleccione el nuevo rol del usuario</h6>
                <label>1 - Para Administrador</label>
                <br>
                <label>2 - Para Empleado</label>
                <input type="text" name="upcod_rol" maxlength="1" class="form-control" value="<?php echo $rol; ?>" required>

              </div>
              <input type="submit" class="btn btn-warning btn-block" value="Actualizar usuario">
              <br>
              <a class="btn btn-danger btn-block" href="usuarios.php"><i class="fas fa-window-close"></i> Cancelar</a>
            </form>
          </div>

      </div>
    </div>

    <div class="col-md-6">
    <div align="right">
    <br>
    </div>
    <br><br><br>
    <h1>Actualizar usuario:</h2><br>
    <img src='buscar_imagen_usuario.php?id=<?php echo $mostrar['id']?>' alt='Img blob desde MySQL' width='250' /></td>
    <br> 
    <h4><?php echo $nombre;?><br><br>Tipo de rol: <b> <?php echo $roles['tipo_rol']; ?></b></h4>
	</div>
