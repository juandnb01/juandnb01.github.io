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
  $sql = "SELECT * from usuarios where nick = '$Usuario'";
  $result = mysqli_query($conexion, $sql);
  $row = mysqli_fetch_array($result);

  $_SESSION['rol'] = $row['cod_rol'];

	include('includes/cn.php');
	include('includes/header2.php');

    error_reporting(0);

    //buscar el empleado

    if(isset($_POST['buscar']))
    {

    $buscar = $_POST['busqueda'];
    $_SESSION['dato'] = $buscar;

    }

?>

	<main class="container p-1">
  	<div class="row">
    <div class="col-md-4">

      <div class="jumbotron">

        <div class="card card-body">
        <form action="nuevo_empleado.php" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label><h2>Nuevo empleado</h2></label>
            <input type="text" name="documento" class="form-control" placeholder="Documento" autofocus required>
          </div>
          <div class="form-group">
            <input type="text" name="nombres" class="form-control" placeholder="Nombres" required>
          </div>
          <div class="form-group">
            <input type="text" name="apellidos" class="form-control" placeholder="Apellidos" required>
          </div>
          <div class="form-group">
            <input type="text" name="direccion" class="form-control" placeholder="Direccion" required>
          </div>
          <div class="form-group">
            <input type="text" name="telefono" class="form-control" placeholder="Telefono" required>
          </div>
          <div class="form-group">
            <input type="text" name="correo" class="form-control" placeholder="Email" required>
          </div>
          <div class="form-group">
            <input type="file" name="image" id="image" class="form-control" required>
          </div>
          <input type="submit" name="submit" class="btn btn-primary btn-block" value="Registrar empleado">
        </form>
        </div>
      </div>              
    </div>
  
    <div class="col-md-8">
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

      <form class="form-inline my-2 my-lg-0" action="empleados.php" method="POST">
        <input class="form-control mr-sm-2" type="text" placeholder="Buscar por apellido" name="busqueda" id="busqueda">
        <button class="btn btn-primary my-2 my-sm-0" type="submit" name="buscar" id="buscar">Buscar</button>&nbsp;
        <a href="empleados.php"><button class="btn btn-primary my-2 my-sm-0" name="buscar" id="buscar">Mostrar todos</button></a>
      </form>

    <br>

    <?php 
    if($_SESSION['dato'] ==  null || $_SESSION['dato']== '')
    { ?>
      <h2>Empleados registrados</h2>
      <br>
      <table class="table-bordered">
        <thead>
          <tr class="navbar-dark">
            <th>Documento</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Dirección</th>
            <th>Telefono</th>
            <th>Correo</th>
            <th>Imágen</th>

            <?php 
            if($_SESSION['rol']==1) 
            { ?>
            <th colspan="2" >Acciones</th>
            <?php } ?>
          </tr>
        </thead>
      <tbody>

      <?php

        $consulta="SELECT * from empleados INNER JOIN roles ON cod_rol = N_rol order by doc_empleado";
        $resultado=mysqli_query($conexion,$consulta);
        while($mostrar=mysqli_fetch_array($resultado))
        {?>
          <tr>
            <td><?php echo $mostrar['doc_empleado'] ?></td>
            <td><?php echo $mostrar['nom_empleado'] ?></td>
            <td><?php echo $mostrar['ape_empleado'] ?></td>
            <td><?php echo $mostrar['dir_empleado'] ?></td>
            <td><?php echo $mostrar['tel_empleado'] ?></td>
            <td><?php echo $mostrar['correo_empleado'] ?></td>
            <td><img src='buscar_imagen_empleado.php?id=<?php echo $mostrar['doc_empleado']?>' alt='Img blob desde MySQL' width='50' /></td>

            <?php 
            if($_SESSION['rol']==1) 
            { 
            ?>
            <td><a href="actualizar_empleado.php?id=<?php echo $mostrar['doc_empleado']?>" class="btn btn-warning btn-sm">
              <i class="fas fa-user-edit " ></i> Actualizar</a></td>

            <td><a href="eliminar_empleado.php?id=<?php echo $mostrar['doc_empleado']?>" class="btn btn-danger btn-sm">
              <i class="fas fa-user-times"></i> Eliminar</a></td> 

            <?php } ?>

          </tr>

        <?php } ?>
      </table>
    <?php } 
    else
      {?>
        <h2>Empleado filtrado</h2>
      <br>
      <table class="table-bordered">
        <thead>
          <tr class="navbar-dark">
            <th>Documento</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Dirección</th>
            <th>Telefono</th>
            <th>Correo</th>
            <th>Imágen</th>

            <?php 
            if($_SESSION['rol']==1) 
            { ?>
            <th colspan="2" >Acciones</th>
            <?php } ?>
          </tr>
        </thead>
      <tbody>

      <?php

        $consulta2="SELECT * from empleados where ape_empleado LIKE '%$buscar%' ";
        $resultado2=mysqli_query($conexion,$consulta2);
        while($row=mysqli_fetch_array($resultado2))
        {?>
          <tr>
            <td><?php echo $row['doc_empleado'] ?></td>
            <td><?php echo $row['nom_empleado'] ?></td>
            <td><?php echo $row['ape_empleado'] ?></td>
            <td><?php echo $row['dir_empleado'] ?></td>
            <td><?php echo $row['tel_empleado'] ?></td>
            <td><?php echo $row['correo_empleado'] ?></td>
            <td><img src='buscar_imagen_empleado.php?id=<?php echo $row['doc_empleado']?>' alt='Img blob desde MySQL' width='50' /></td>

            <?php 
            if($_SESSION['rol']==1) 
            { 
            ?>
            <td><a href="actualizar_empleado.php?id=<?php echo $row['doc_empleado']?>" class="btn btn-warning btn-sm">
              <i class="fas fa-user-edit " ></i> Actualizar</a></td>

            <td><a href="eliminar_empleado.php?id=<?php echo $row['doc_empleado']?>" class="btn btn-danger btn-sm">
              <i class="fas fa-user-times"></i> Eliminar</a></td> 

            <?php } ?>

          </tr>

        <?php } ?>
      </table>
    <?php } ?>
    
</html>