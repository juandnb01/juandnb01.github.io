<?php
session_start();
include 'includes/cn.php';

$documento = $_POST['documento'];

$fecha_ingreso = $_POST['fecha_ingreso'];
$fecha_entrega = $_POST['fecha_entrega'];
$cantidad = $_POST['cantidad'];
$tipo = $_POST['tipo'];
$arreglo = $_POST['arreglo'];
$total_inicial = $_POST['total_inicial'];
$abono = $_POST['abono'];
$total_final = $_POST['total_final'];


$consulta = "Insert into arreglos(tipo_arreglo,fec_ingreso,fec_entrega,cantidad,tipo_prendas,arreglo,saldo,abono,total_arreglo,doc_cli) values ('arreglo','$fecha_ingreso','$fecha_entrega','$cantidad','$tipo','$arreglo','$total_final','$abono','$total_inicial','$documento')";

$resultado = mysqli_query($conexion,$consulta);


if (!$resultado)
{
	$_SESSION['message'] = 'Error al registrar el arreglo';
	$_SESSION['message_type'] = 'danger';
	$_SESSION['dato'] = '';

	header('Location:ventas.php');
}
else
{

	$_SESSION['message'] = 'Arreglo registrado y programado correctamente';
	$_SESSION['message_type'] = 'primary';
	$_SESSION['dato'] = '';

	header('Location:ventas.php');
}

?>