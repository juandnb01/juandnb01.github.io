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

		$consulta = "delete from comentarios where id = $id";

		$resultado = mysqli_query($conexion, $consulta);

		if(!$resultado)
		{
			$_SESSION['message'] = 'Error al eliminar el comentaio';
        	$_SESSION['message_type'] = 'warning';

       		header('Location:consultar_comentarios.php');
		}
	}
	$_SESSION['message'] = 'Comentario eliminado correctamente';
	$_SESSION['message_type'] = 'danger';

	header('Location:consultar_comentarios.php');
?>