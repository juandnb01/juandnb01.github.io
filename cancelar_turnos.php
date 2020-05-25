<?php

session_start();
include 'includes/cn.php';

$id = $_GET['id'];
$fecha_cancela = date("Y-m-d");

$pagar_turno = "update turnos set estado_turno = 'Cancelado', fecha_cancela = '$fecha_cancela' where id_turno = '$id'";
$resultado_pagar = mysqli_query($conexion,$pagar_turno);

if(!$resultado_pagar)
{
	$_SESSION['message'] = 'Error al pagar el turno al empleado';
    $_SESSION['message_type'] = 'danger';
    header('Location:consultar_turnos.php');
	exit;
}
else
{
	$_SESSION['message'] = 'Turno pagado correctamente al empleado';
    $_SESSION['message_type'] = 'primary';
    header('Location:consultar_turnos.php');
	exit;
}
?>