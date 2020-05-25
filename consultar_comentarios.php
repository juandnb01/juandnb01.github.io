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
    <div class="col-md-3">
      <h4 class="display-4">Respuestas</h4>
        <div class="jumbotron">
          <p class="lead"><a class="btn btn-primary btn-block" href="respuestas_comentarios.php" role="button"><i class="fas fa-search"></i> Ver respuestas</a></p>
        </div>
    </div>
  
    <div class="col-md-9">
    <center>
   <h4 class="display-4">Consulta de comentarios</h4>
    <div class="jumbotron">

      <table class="table-bordered">
        <thead>
          <tr class="navbar-dark">
            <th>Consecutivo</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Telefono</th>
            <th>Comentario</th>

            <?php 
            if($_SESSION['rol']==1) 
            { ?>
            <th>Responder</th>
            <?php } ?>
          </tr>
        </thead>
    	<tbody>

		<?php

		$consulta="SELECT * from comentarios where estado = 'por contestar'";
		$resultado=mysqli_query($conexion,$consulta);
		while($mostrar=mysqli_fetch_array($resultado))
		{

		?>
		<tr>
			<td><center><?php echo $mostrar['id'] ?></center></td>
			<td><?php echo $mostrar['nombre'] ?></td>
			<td><?php echo $mostrar['correo'] ?></td>
			<td><?php echo $mostrar['telefono'] ?></td>
      <td><?php echo $mostrar['comentario'] ?></td>
			<td><a href="responder_comentario.php?id=<?php echo $mostrar['id']?>" class="btn btn-warning btn-sm">
      <i class="fas fa-keyboard"></i> Responder</a></td> 
		</tr>
		<?php } ?>
	</table>
  </div>
</center>
</div>

</html>