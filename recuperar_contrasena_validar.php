<?php

session_start();

include 'includes/cn.php';

$usuario = $_POST['usuario'];
$correo = $_POST['correo'];

$consulta = "Select * from usuarios where nick = '$usuario' and correo = '$correo'";

$resultado = mysqli_query($conexion,$consulta);

$mostrar = mysqli_fetch_array($resultado);

$_SESSION['identificacion'] = $mostrar['id'];

if (mysqli_num_rows($resultado) > 0)
{
	header('location:recuperar_contrasena_formulario.php');
}
else
{
	$_SESSION['message'] = 'Credenciales de usuario erroneas';
    $_SESSION['message_type'] = 'danger';
	header('location: recuperar_contrasena.php');
}

?>