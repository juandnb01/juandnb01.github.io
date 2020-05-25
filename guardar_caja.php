<?php

session_start();
include 'includes/cn.php';

$fecha_de_caja = $_POST['fecha_de_caja'];
$dinero_dia = $_POST['dinero_dia'];
$fecha_guardar_caja = $_POST['fecha_guardar_caja'];
$usuario = $_POST['usuario'];

$verifica_caja = mysqli_query($conexion, "select * from caja where dia_caja = '$fecha_de_caja'");
if (mysqli_num_rows($verifica_caja) > 0)
{
	$_SESSION['message'] = 'El reporte de caja de ese día ya se encuentra registrado';
	$_SESSION['message_type'] = 'warning';

header('Location:caja.php');
exit;
}

$consulta = "insert into caja (dia_caja,venta_caja,fec_registro,usuario_registra_caja) 
values ('$fecha_de_caja', '$dinero_dia', '$fecha_guardar_caja','$usuario')";

$resultado = mysqli_query($conexion,$consulta);

if (!$resultado)
{
	echo "Error al registrar la caja del día";
}
else
{

	$_SESSION['message'] = 'Registro de caja agregado de manera exitosa';
	$_SESSION['message_type'] = 'primary';

header('Location:caja.php');
}

?>