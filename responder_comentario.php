<?php
  
include('includes/cn.php');
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

if(isset($_GET['id']))
{
	$id = $_GET['id'];

	$consulta = "SELECT * from comentarios WHERE id = $id";

	$resultado = mysqli_query($conexion, $consulta);

	if(mysqli_num_rows($resultado) == 1)
	{
		$mostrar = mysqli_fetch_array($resultado);

  		$cor = $mostrar['correo'];
  		$id = $mostrar['id'];

	}
}
?>

<main class="container p-1">
  	<div class="row">
    	<div class="col-md-2">    
    	</div>
  
    	<div class="col-md-6">
    		<form action="responder_comentario2.php" method="POST">
    		<center>
   				<h4 class="display-4">Contestar comentario</h4>
   			</center>
    		<div class="jumbotron">
    			<div class="form-group">
    				<label>Correo registrado</label>
    				<input type="text" name="correo" class="form-control" value="<?php echo $cor;	?>" readonly="readonly">
    			</div>
    			<div class="form-group">
    				<label>Mensaje</label>
    				<textarea class="form-control" name="mensaje" placeholder="Escriba el mensaje aqui"></textarea>
    			</div>

    				<input type="hidden" name="id" value="<?php echo $id;?>">

    			<input type="submit" name="responder" class="btn btn-primary btn-block" value="Responder">
    			<br>
    			<a href="consultar_comentarios.php"><button class="btn btn-danger btn-block" value="Cancelar">Cancelar</button></a>

    		</div>
    		</form>
    	</div>
    </div>
</main>