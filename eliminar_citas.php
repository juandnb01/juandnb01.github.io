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

		$consulta = "UPDATE agenda SET estado = 'atendida' where id = $id ";

		$resultado = mysqli_query($conexion, $consulta);

		if(!$resultado)
		{
			$_SESSION['message'] = 'Error al atender la cita';
        	$_SESSION['message_type'] = 'danger';

       		header('Location:consultar_citas.php');
		}
	}
	$_SESSION['message'] = 'Cita atendida correctamente';
	$_SESSION['message_type'] = 'primary';

	header('Location:consultar_citas.php');
?>