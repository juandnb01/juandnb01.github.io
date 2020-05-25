<?php

session_start();

include 'includes/cn.php';
//recibir los datos y almacenarlos en variables
$nombre = $_POST["nombre"];
$correo = $_POST["correo"];
$telefono = $_POST['telefono'];
$comentario = $_POST["comentario"];


//consulta para insertar
$insertar = "insert into comentarios(nombre, correo, telefono, comentario, estado, observacion) values ('$nombre','$correo','$telefono','$comentario','por contestar',' ')";

$resultado = mysqli_query($conexion, $insertar);

$_SESSION['message'] = 'El comentario fue enviado correctamente';
$_SESSION['message_type'] = 'primary';

header('Location:comentario.php');

?>
