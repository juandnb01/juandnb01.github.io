<?php

session_start();
include 'includes/cn.php';
//este error reporting se coloca para que no muestre la advertencia de cambiar un valor de fecha a numero entero
error_reporting(0);

$fecha = $_POST['fecha'];
$ingreso = $_POST['ingreso'];
$salida = $_POST['salida'];
$doc_emp = $_POST['documento_empleado'];
$observa = $_POST['observaciones'];

function RestarHoras($ingreso,$salida)
{
    $h1 = new DateTime($ingreso);
    $h2 = new DateTime($salida);
    $horas = $h1->diff($h2);
    return $horas->format('%H:%I:%S');
}

$calculo_horas = RestarHoras($ingreso,$salida);

$horas = number_format($calculo_horas);
$dinero = $horas*3150;

$verificar_turno = "select * from turnos where doc_empleado = '$doc_emp' and fecha_turno = '$fecha'";
$resultado_verificar = mysqli_query($conexion,$verificar_turno);
if(mysqli_num_rows($resultado_verificar) > 0)
{
	$_SESSION['message'] = 'Ya se encuentra un turno registrado para el empleado en esa fecha';
    $_SESSION['message_type'] = 'danger';
    header('Location:turnos.php');
	exit;
}

$insertar_turno = "insert into turnos (doc_empleado,fecha_turno,hora_ingreso,hora_salida,horas_turno,total_turno,observaciones_turno) 
values ('$doc_emp','$fecha','$ingreso','$salida','$horas','$dinero','$observa')";
$resultado = mysqli_query($conexion,$insertar_turno);

if(!$resultado)
{
	$_SESSION['message'] = 'Error al registrar el turno del empleado';
    $_SESSION['message_type'] = 'danger';
    header('Location:turnos.php');
    exit;
}
else
{
	$_SESSION['message'] = 'El turno se ha registrado correctamente';
    $_SESSION['message_type'] = 'primary';
    header('Location:turnos.php');
    exit;
}

?>