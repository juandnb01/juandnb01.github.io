<?php
  session_start();
  $varsession = $_SESSION['usuario'];
  
  if($varsession == null || $varsession = '')
  {
    header ("location:error_sesion.php");
    die();
  }

  $hoy = date('Y-m-d');

include('includes/cn.php');

$_SESSION['entrega'] = $_POST['identi'];

$identifica = $_POST['identi'];
$faltante = $_POST['faltante'];
$observa = $_POST['observa'];

$consulta = "UPDATE arreglos SET estado = 'entregado', abono_2 = '$faltante', fec_entregado = '$hoy', observaciones = '$observa' where id = '$identifica' ";

$resultado = mysqli_query($conexion, $consulta);


if(!$resultado)
{
	$_SESSION['message'] = 'Error al entregar el arreglo';
	$_SESSION['message_type'] = 'danger';
	$_SESSION['dato'] = '';
	header('Location:consultar_arreglos.php');
}

$_SESSION['message'] = 'Arreglo entregado correctamente';
$_SESSION['message_type'] = 'primary';
$_SESSION['dato'] = '';
header('Location:consultar_arreglos.php');
?>
