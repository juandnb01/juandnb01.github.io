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

  $hoy = date('Y-m-d');
  $manana = date('Y-m-d',strtotime($hoy."+ 1 days"));
  $ayer = date('Y-m-d',strtotime($hoy."- 1 days"));
  

    error_reporting(0);

?>
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

<main class="container p-1">
	<div class="row">

    <div class="col-md-6">
    <center>
      <br>
     <h1>Agenda de hoy: <?php echo $hoy; ?></h1>
      <br>
      <div class="jumbotron">
        <table class="table-bordered">
          <thead>
            <tr class="navbar-dark">
              <th>Hora</th>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Telefono</th>
              <th>Estado</th>
              <th>Atender</th>
            </tr>
          </thead>

      		<?php

      		$consulta="SELECT * from agenda where fecha = '$hoy' and estado = 'por atender' order by hora";
      		$resultado=mysqli_query($conexion,$consulta);
      		while($mostrar=mysqli_fetch_array($resultado))
      		{

      		?>
      		<tr>
      			<td><center><?php echo $mostrar['hora'] ?></center></td>
      			<td><?php echo $mostrar['nombre'] ?></td>
      			<td><?php echo $mostrar['correo'] ?></td>
      			<td><?php echo $mostrar['telefono'] ?></td>
            <td><?php echo $mostrar['estado'] ?></td>
      			<td><a href="eliminar_citas.php?id=<?php echo $mostrar['id']?>" class="btn btn-primary btn-sm">
            <i class="fas fa-check-circle"></i> Atendida</a></td> 
      		</tr>
      		<?php } ?>
  	     </table>
      </div>
    </center>
    </div>

    <div class="col-md-6">
    <center>
      <br>
     <h1>Agenda de mañana: <?php echo $manana; ?></h1>
      <br>
      <div class="jumbotron">
        <table class="table-bordered">
          <thead>
            <tr class="navbar-dark">
              <th>Hora</th>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Telefono</th>
              <th>Estado</th>
              <th>Atender</th>
            </tr>
          </thead>

          <?php

          $consulta2="SELECT * from agenda where fecha = '$manana' and estado = 'por atender' order by hora";
          $resultado2=mysqli_query($conexion,$consulta2);
          while($mostrar2=mysqli_fetch_array($resultado2))
          {

          ?>
          <tr>
            <td><center><?php echo $mostrar2['hora'] ?></center></td>
            <td><?php echo $mostrar2['nombre'] ?></td>
            <td><?php echo $mostrar2['correo'] ?></td>
            <td><?php echo $mostrar2['telefono'] ?></td>
            <td><?php echo $mostrar2['estado'] ?></td>
            <td><a href="eliminar_citas.php?id=<?php echo $mostrar2['id']?>" class="btn btn-primary btn-sm">
            <i class="fas fa-check-circle"></i> Atendida</a></td> 
          </tr>
          <?php } ?>
         </table>
      </div>
    </center>
    </div>
  </div>
</main>

</html>