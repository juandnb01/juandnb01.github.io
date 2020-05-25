<?php

session_start();

include 'includes/cn.php';

$correo = $_POST['correo'];
$mensaje = $_POST['mensaje'];
$id = $_POST['id'];

$consulta = "UPDATE comentarios SET estado = 'atendido', observacion = '$mensaje'where id = $id ";

$resultado = mysqli_query($conexion, $consulta);

$_SESSION['message'] = 'Comentario respondido correctamente';
$_SESSION['message_type'] = 'primary';

header('Location:consultar_comentarios.php');

?>