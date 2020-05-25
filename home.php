<?php

  include 'includes/cn.php';
  session_start();
  $varsession = $_SESSION['usuario'];
  
  if($varsession == null || $varsession = '')
  {
    header ("location:error_sesion.php");
    die();
  }

  $Usuario = $_SESSION['usuario'];

  //Consultamos los datos del Usuario
  $sql = "SELECT * from usuarios INNER JOIN roles ON cod_rol = N_rol where nick = '$Usuario' ";
  $result = mysqli_query($conexion, $sql);
  $row = mysqli_fetch_array($result);

  $_SESSION['rol'] = $row['cod_rol'];


	include('includes/cn.php');
	include('includes/header2.php');

  error_reporting(0);
	
  ?>
  <br>
  <?php if(isset($_SESSION['message'])) { ?>
  <div class="alert alert-dismissible alert-<?=$_SESSION['message_type']?>">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo $_SESSION['message']; ?>
    <?php
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
    ?>
  </div>
  <?php } ?>

	<main class="container p-1">
  	<div class="row">
      <div class="col-md-5">
        <center>
        <br><br><br><br><br>
        <h1><b>Bienvenido</b></h1>
          
        <br><br>
        <h2><b>Usuario: </b> <?php echo $_SESSION['usuario']?></h2>
        <h2><b>Rol: </b> <?php echo $row['tipo_rol']?></h2>
        <br><br>

        </center>
      </div>
    
      <div class="col-md-6">
      
        <br><br> 
        <center>
        <div class="jumbotron">
          
        <img src='buscar_imagen_usuario.php?id=<?php echo $row['id']?>' alt='Img blob desde MySQL' width='340'/>
        </div>
        </center>
      </div>
    </div>
