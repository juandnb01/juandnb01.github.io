<?php
//mantiene la sesion para poder llevar los valores en las variables del emergente
session_start();

include 'includes/cn.php';

$updoc = $_GET['id'];

//$upid = $_POST['upid'];
$upnom = $_POST['upnom'];
$upape = $_POST['upape'];
$updir = $_POST['updir'];
$uptel = $_POST['uptel'];
$upcor = $_POST['upcor'];

$upconsulta = "UPDATE empleados SET nom_empleado = '$upnom', ape_empleado = '$upape', dir_empleado = '$updir', tel_empleado = '$uptel', correo_empleado = '$upcor' where doc_empleado = $updoc ";

$_SESSION['message'] = 'Empleado actualizado correctamente';
$_SESSION['message_type'] = 'warning';

$resultado = mysqli_query($conexion, $upconsulta);


header('Location:empleados.php');

?>

