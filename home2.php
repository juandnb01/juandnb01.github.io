<?php

  include 'includes/cn.php';
  session_start();
  $varsession = $_SESSION['cliente'];
  
  if($varsession == null || $varsession = '')
  {
    header ("location:error_sesion.php");
    die();
  }

  $cliente = $_SESSION['cliente'];

  //Consultamos los datos del Usuario

  $sql = "SELECT * from clientes INNER JOIN roles ON cod_rol = N_rol where doc_cliente = '$cliente' ";
  $result = mysqli_query($conexion, $sql);
  $row = mysqli_fetch_array($result);

  $_SESSION['rol'] = $row['cod_rol'];

	include('includes/header2.php');

  error_reporting(0);
  
  ?>
  <div class="alert alert-dismissible alert-<?=$_SESSION['message_type']?>">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo $_SESSION['message']; ?>
    <?php
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
    ?>
  </div>
	<main class="container p-5">
  	<div class="row">
      <div class="col-md-5">
        <center>
        <br>
        <h1><b>Bienvenido</b></h1>
          
        <br><br>
        <img src='buscar_imagen_cliente.php?id=<?php echo $row['doc_cliente']?>' alt='Img blob desde MySQL' width='200'/>
        <h2><?php echo $row['nom_cliente'] ?></h2>
        <h2><?php echo $row['ape_cliente'] ?></h2>
        <br><br>
        </center>
      </div>
    
      <div class="col-md-6">
      
        <br><br> 
        <center>
        <div class="jumbotron">
          <center>
            <h4 class="display-4">Confecciones letti , Bienvenido</h4>
            <h2 class="display-6">Gracias por confiar en nosotros</h2>
          </center>
        </div>
        </center>
      </div>
    </div>
