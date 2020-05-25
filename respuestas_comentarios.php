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

	include('includes/header2.php');

    error_reporting(0);

?>

	<main class="container p-1">
  	<div class="row">

  
    <div class="col-md-12">
    <center>
   <h4 class="display-4">Comentarios resueltos</h4>
    <div class="jumbotron">
    	<div align="right">
    		<p class="lead"><a class="btn btn-primary" href="consultar_comentarios.php" role="button">Regresar</a></p>
    	</div>
      <table class="table-bordered">
        <thead>
          <tr class="navbar-dark">
            <th>Consecutivo</th>
            <th>Nombre</th>
            <th>Comentario</th>
            <th>Respuesta</th>
          </tr>
        </thead>
    	<tbody>

		<?php

		$consulta="SELECT * from comentarios where estado = 'atendido'";
		$resultado=mysqli_query($conexion,$consulta);
		while($mostrar=mysqli_fetch_array($resultado))
		{

		?>
		<tr>
			<td><center><?php echo $mostrar['id'] ?></center></td>
			<td><?php echo $mostrar['nombre'] ?></td>
      		<td><?php echo $mostrar['comentario'] ?></td>
			<td><?php echo $mostrar['observacion'] ?></td> 
		</tr>
		<?php } ?>
	</table>

  </div>
</center>
</div>