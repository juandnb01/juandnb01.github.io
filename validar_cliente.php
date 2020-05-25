<?php
	
	
include('includes/cn.php');

$cliente = $_POST['cliente'];

session_start();

$_SESSION['cliente'] = $cliente;


//calcular el tiempo de inactividad



$consulta = "select * from clientes where doc_cliente = '$cliente'";

$resultado=mysqli_query($conexion,$consulta);

$mostrar = mysqli_fetch_assoc($resultado);

$_SESSION['id'] = $mostrar['doc_cliente'];

if (mysqli_num_rows($resultado) > 0)
{ 
	$_SESSION['message'] = 'Autenticación realizada con éxito';
	$_SESSION['message_type'] = 'primary';
	header("location:home2.php");
	exit;
}
	$_SESSION['message'] = 'El cliente no se encuentra registrado en la base de datos';
	$_SESSION['message_type'] = 'warning';
	header("location:ingreso_cliente.php");
	exit;

?>