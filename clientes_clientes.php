<?php

  include 'includes/cn.php';
  session_start();
  $varsession = $_SESSION['cliente'];
  
  if($varsession == null || $varsession = '')
  {
    header ("location:error_sesion.php");
    die();
  }
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

<main class="container p-1">
  <div class="row">

    <div class="col-md-8">

        <h1 class="display-3">Servicios para clientes</h1>
        
        <br>

    </div>

    <div class="col-md-4">
    	<br>
    </div>
  </div>
</main>

<main class="container p-1">
    <div class="row">
	    <div class="col-md-5">
	    <form action="clientes_clientesmedidas.php" method="POST">
	      <div class="jumbotron">
	        <div class="card card-body">

	          <div class="form-group">
	            <label><h3>Consulte sus medidas</h3></label>
	            <input type="text" name="consulmedidas" class="form-control" placeholder="Documento" required>
	            <br>



	            <div align="right">
	            	<input type="submit" value="Consultar" class="btn btn-primary">
	            </div>
	          </div>

	        </div>
	      </div> 
	    </form>             
	    </div>

	    <div class="col-md-1">
	    </div>

		<div class="col-md-5">
		<form action="clientes_clientespedidos.php" method="POST">
	      <div class="jumbotron">
	        <div class="card card-body">

	          <div class="form-group">
	            <label><h3>Consulte sus pedidos</h3></label>
	            <input type="text" name="consulpedidos" class="form-control" placeholder="Documento" required>
	            <br>
	            <div align="right">
	            	<input type="submit" value="Consultar" class="btn btn-primary">
	            </div>
	          </div>

	        </div>
	      </div>
	    </form>              
	    </div>
	</div>
</main>