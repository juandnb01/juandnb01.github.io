<?php
	
	
include('includes/cn.php');

$usuario = $_POST['user'];
$password = $_POST['pass'];

	session_start();
	$_SESSION['usuario'] = $usuario;


$consulta = "select * from usuarios where nick = '$usuario' and contra = '$password'";

$resultado=mysqli_query($conexion,$consulta);

$mostrar = mysqli_fetch_assoc($resultado);

$_SESSION['id'] = $mostrar['id'];

$filas = mysqli_num_rows($resultado);
if ($filas > 0)
{ 
	$_SESSION['message'] = 'Autenticación realizada con éxito';
	$_SESSION['message_type'] = 'primary';
	header("location:home.php");
}
else
{	
	$_SESSION['message'] = 'Credenciales de ingreso erroneas';
	$_SESSION['message_type'] = 'danger';
	header("location:ingreso_usuario.php");
}
mysqli_free_result($resultado);
mysqli_close($conexion);
?>