<?php
  
  include 'includes/cn.php';
  session_start();
  $varsession = $_SESSION['usuario'];
  
  if($varsession == null || $varsession = '')
  {
    header ("location:error_sesion.php");
    die();
  }

  $Usuario = $_SESSION['usuario'];

  //Consultamos los datos del Usuario
  $sql = "SELECT * from usuarios where nick = '$Usuario'";
  $result = mysqli_query($conexion, $sql);
  $row = mysqli_fetch_array($result);

  $_SESSION['rol'] = $row['cod_rol'];

	include('includes/cn.php');
	include('includes/header2.php');

  error_reporting(0);

?>

	<main class="container p-1">
  	<div class="row">
    <div class="col-md-4">

      <div class="jumbotron">

        <div class="card card-body">
        <form action="nuevo_usuario.php" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label><h2>Nuevo usuario</h2></label>
            <input type="text" name="usuario" class="form-control" placeholder="Usuario" autofocus required>
          </div>
          <div class="form-group">
            <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
          </div>
          <div class="form-group">
            <input type="text" name="correo" class="form-control" placeholder="Email" required>
          </div>
          <div class="form-group">
            <input type="text" name="contra" class="form-control" placeholder="Password" required>
          </div>
          <div class="form-group">
            <input type="file" name="image" id="image" class="form-control" required>
          </div>
          <div class="form-group">
            <p>Seleccione el nuevo rol del usuario</p>
            <p>1 - Para Administrador</p>
            <p>2 - Para Empleado</p>
            <input class="form-control" name = "cod_rol">
              <?php 

              $sql1 = "SELECT * from roles where N_rol = '1' N_rol = '2' ";
              $result1 = mysqli_query($conexion, $sql1);
              while($mostrar = mysqli_fetch_array($result1))
              {
              ?>
                <option value =<?php echo $mostrar['N_rol'] ?>><?php echo $mostrar['tipo_rol'] ?></option>
              <?php } ?>
            </input>
          </div>
          <input type="submit" name="submit" class="btn btn-primary btn-block" value="Agregar usuario">
        </form>
        </div>
      </div>              
    </div>
  
    <div class="col-md-8">
    <br>
<?php if(isset($_SESSION['message'])) { ?>
<div class="alert alert-dismissible alert-<?=$_SESSION['message_type']?>">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <?php echo $_SESSION['message']; ?>
  <?php
  unset($_SESSION['message']);
  unset($_SESSION['message_type']);
  ?>
</div>
<?php } ?>


    <br><br><br>
    <h2>Usuarios registrados</h2>
    <br>
      <table class="table-bordered">
        <thead>
          <tr class="navbar-dark">
            <th>Usuario</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Contraseña</th>
            <th>Imagen</th>
            <th>Permisos</th>

            <?php 
            if($_SESSION['rol']==1) 
            { ?>
            <th colspan="2">Acciones</th>
            <?php } ?>
          </tr>
        </thead>
    	<tbody>

		<?php

		$consulta="SELECT * from usuarios INNER JOIN roles ON cod_rol = N_rol order by cod_rol";
		$resultado=mysqli_query($conexion,$consulta);
		while($mostrar=mysqli_fetch_array($resultado))
		{

		?>
		<tr>
			<td><?php echo $mostrar['nick'] ?></td>
			<td><?php echo $mostrar['nombre'] ?></td>
			<td><?php echo $mostrar['correo'] ?></td>
      <?php 
      if($_SESSION['rol']==1) 
      { 
      ?>
			<td><?php echo $mostrar['contra'] ?></td>
      <?php } ?>

      <?php 
      if($_SESSION['rol']==2) 
      { 
      ?>
      <td><input type="password" class="form-control" value="<?php echo $mostrar['contra'] ?>" readonly="readonly"></td>
      <?php } ?>

      <td><img src='buscar_imagen_usuario.php?id=<?php echo $mostrar['id']?>' alt='Img blob desde MySQL' width='50' /></td>
			<td><?php echo $mostrar['tipo_rol'] ?></td>

      <?php 
      if($_SESSION['rol']==1) 
      { 
      ?>
			<td><a href="actualizar_usuario.php?id=<?php echo $mostrar['id']?>" class="btn btn-warning btn-sm">
        <i class="fas fa-user-edit " ></i> Actualizar</a></td>

			<td><a href="eliminar_usuario.php?id=<?php echo $mostrar['id']?>" class="btn btn-danger btn-sm">
        <i class="fas fa-user-times"></i> Eliminar</a></td> 

      <?php } ?>

		</tr>


		<?php 
		}

		?>
	</table>
</center>

</html>