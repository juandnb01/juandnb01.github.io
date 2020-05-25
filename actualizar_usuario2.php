<?php
//mantiene la sesion para poder llevar los valores en las variables del emergente
session_start();

include 'includes/cn.php';

$upid = $_GET['id'];

//$upid = $_POST['upid'];
$upusuario = $_POST['upuser'];
$upnombre = $_POST['upnombre'];
$upcorreo = $_POST['upcorreo'];
$upcontra = $_POST['upcontra'];
$uprol = $_POST['upcod_rol'];

$upconsulta = "UPDATE usuarios SET nick = '$upusuario', nombre = '$upnombre', correo = '$upcorreo', contra = '$upcontra', cod_rol = '$uprol' where id = $upid ";

$_SESSION['message'] = 'Usuario actualizado correctamente';
$_SESSION['message_type'] = 'warning';

$resultado = mysqli_query($conexion, $upconsulta);


header('Location:usuarios.php');

?>

