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

		$consulta = "delete from empleados where doc_empleado = $id";

		$resultado = mysqli_query($conexion, $consulta);

		if(!$resultado)
		{
			$_SESSION['message'] = 'Error al eliminar el empleado';
        	$_SESSION['message_type'] = 'warning';

       		header('Location:empleados.php');
		}
	}
	$_SESSION['message'] = 'Empleado eliminado correctamente';
	$_SESSION['message_type'] = 'danger';

	header('Location:empleados.php');
?>