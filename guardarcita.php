<?php


include 'includes/cn.php';
//recibir los datos y almacenarlos en variables
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];


//consulta para insertar
$insertar = "insert into agenda(nombre, correo, telefono, fecha, hora, estado) values ('$nombre','$correo','$telefono','$fecha','$hora', 'por atender')";

mysqli_query($conexion, $insertar);

header('Location:contactenos.php');

?>