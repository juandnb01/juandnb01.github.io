<?php

//mantiene la sesion para poder llevar los valores en las variables del emergente
session_start();

include 'includes/cn.php';

$id = $_GET['id'];

$a_espal = $_POST['upaespalda'];
$c_busto = $_POST['upcbusto'];
$c_pecho = $_POST['upcpecho'];
$cin_cam = $_POST['upcintura_cam'];
$base_cam = $_POST['upc_base_cam'];
$lar_man = $_POST['upl_manga'];
$lar_tot_cam = $_POST['upl_total_cam'];
$cin_pan = $_POST['upcintura_pan'];
$base_pan = $_POST['upc_base_pan'];
$rodilla = $_POST['uprodilla'];
$bota = $_POST['upbota'];
$lar_tot_pan = $_POST['upl_total_pan'];

$upmedidas = "Update medidas SET a_espalda = '$a_espal', cbusto = '$c_busto', cpecho = '$c_pecho', cintura_cam = '$cin_cam', c_base_cam = '$base_cam', l_manga = '$lar_man', l_total_cam = '$lar_tot_cam', cintura_pan = '$cin_pan', c_base_pan = '$base_pan', rodilla = '$rodilla', bota = '$bota', l_total_pan = '$lar_tot_pan' where doc_medidas = '$id' ";

mysqli_query($conexion, $upmedidas);

$_SESSION['message'] = 'Las medidas fueron actualizadas correctamente';
$_SESSION['message_type'] = 'warning';
header('Location:clientes.php');
?>