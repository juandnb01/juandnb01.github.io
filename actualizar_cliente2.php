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

$upconsulta = "UPDATE clientes SET nom_cliente = '$upnom', ape_cliente = '$upape', dir_cliente = '$updir', tel_cliente = '$uptel', correo_cliente = '$upcor' where doc_cliente = $updoc ";

$_SESSION['message'] = 'Cliente actualizado correctamente';
$_SESSION['message_type'] = 'warning';

$resultado = mysqli_query($conexion, $upconsulta);


header('Location:clientes.php');

?>

