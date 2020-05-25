<?php
  session_start();
  $varsession = $_SESSION['usuario'];
  
  if($varsession == null || $varsession = '')
  {
    header ("location:error_sesion.php");
    die();
  }
?>

<?php

	include('includes/cn.php');

	if(isset($_GET['id']))
	{
		$id = $_GET['id'];

		$consulta = "delete from usuarios where id = $id";

		$resultado = mysqli_query($conexion, $consulta);

		if(!$resultado)
		{
			$_SESSION['message'] = 'Error al eliminar el usuario';
        	$_SESSION['message_type'] = 'warning';

       		header('Location:usuarios.php');
		}
	}
	$_SESSION['message'] = 'Usuario eliminado correctamente';
	$_SESSION['message_type'] = 'danger';

	header('Location:usuarios.php');
?>