<?php
session_start();
include 'includes/cn.php';

$fecha_ingreso = $_POST['fecha_ingreso'];
$fecha_entrega = $_POST['fecha_entrega'];
$cantidad = $_POST['cantidad'];
$tipo = $_POST['tipo'];
$arreglo = $_POST['arreglo'];
$total_inicial = $_POST['total_inicial'];
$abono = $_POST['abono'];
$total_final = $_POST['total_final'];
$documento = $_POST['documento'];

$consulta = "Insert into arreglos(tipo_arreglo,fec_ingreso,fec_entrega,cantidad,tipo_prendas,arreglo,saldo,abono,total_arreglo,doc_cli) values ('sobremedida','$fecha_ingreso','$fecha_entrega','$cantidad','$tipo','$arreglo','$total_final','$abono','$total_inicial','$documento')";

$resultado = mysqli_query($conexion,$consulta);

if (!$resultado)
{
	$_SESSION['message'] = 'Error al registrar la sobremedida';
	$_SESSION['message_type'] = 'danger';
	$_SESSION['dato'] = '';

	header('Location:ventas.php');
}
else
{

	$_SESSION['message'] = 'Sobremedida programada y registrada correctamente';
	$_SESSION['message_type'] = 'primary';
	$_SESSION['dato'] = '';

	header('Location:ventas.php');
}

?>