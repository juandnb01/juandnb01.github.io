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

  include 'includes/cn.php';
  include 'includes/header2.php';

  $pedido = $_POST['consulpedidos'];

  $verificar_cliente = mysqli_query($conexion, "select * from clientes where doc_cliente = '$pedido' ");
  if (mysqli_num_rows($verificar_cliente) == 0)
  {
  	$_SESSION['message'] = 'El cliente no se encuentra registrado en la base de datos';
    $_SESSION['message_type'] = 'danger';

    header('Location:clientes_clientes.php');
    exit;
  }

  $consulta ="Select * from clientes where doc_cliente = '$pedido'";
  $resultado = mysqli_query($conexion, $consulta);
  $mostrar = mysqli_fetch_array($resultado);

?>

<main class="container p-1">
  <div class="row">
    <div class="col-md-12">
        <h1 class="display-4">Sus pedidos <?php echo $mostrar['nom_cliente']; echo " "; echo $mostrar['ape_cliente'];?></h1>
        <br>
    </div>
  </div>
</main>

<main class="container p-1">
    <div class="row">
    <div class="col-md-10">
      <label><h4>Arreglos</h4></label>
      <div class="jumbotron">
        <table class="table table-hover">
          <tr class="table-dark">
            <td>Ticket</td>
            <td>Ingreso</td>
            <td>Entrega</td>
            <td>Total cobrado</td>
            <td>Abono</td>
            <td>Saldo</td>
            <td>Abono entrega</td>
            <td>Estado</td>
          </tr>

          <?php
          $consulta1 = "select * from arreglos where doc_cli = '$pedido' and tipo_arreglo = 'arreglo'";
          $resultado1 = mysqli_query($conexion,$consulta1);
          while($mostrar1 = mysqli_fetch_array($resultado1))
          {
          ?>
          <tr>
            <td><?php echo $mostrar1['id']?></td>
            <td><?php echo $mostrar1['fec_ingreso']?></td>
            <td><?php echo $mostrar1['fec_entrega']?></td>
            <td><?php echo $mostrar1['total_arreglo']?></td>
            <td><?php echo $mostrar1['abono']?></td>
            <td><?php echo $mostrar1['saldo']?></td>
            <td><?php echo $mostrar1['abono_2']?></td>
            <td><?php echo $mostrar1['estado']?></td>
          </tr>
          <?php } ?>
        </table>
      </div>
    </div>

    <div class="col-md-2">
      <div align="right">
      <p class="lead"><a class="btn btn-primary btn-lg" href="clientes_clientes.php" role="button"> Regresar</a></p>
      </div>
    </div>

    </div>

    <div class="row">
      <div class="col-md-10">
      <label><h4>Sobremedidas</h4></label>
      <div class="jumbotron">
        <table class="table table-hover">
          <tr class="table-dark">
            <td>Ticket</td>
            <td>Ingreso</td>
            <td>Entrega</td>
            <td>Total cobrado</td>
            <td>Abono</td>
            <td>Saldo</td>
            <td>Abono entrega</td>
            <td>Estado</td>
          </tr>

          <?php
          $consulta1 = "select * from arreglos where doc_cli = '$pedido' and tipo_arreglo = 'sobremedida'";
          $resultado1 = mysqli_query($conexion,$consulta1);
          while($mostrar1 = mysqli_fetch_array($resultado1))
          {
          ?>
          <tr>
            <td><?php echo $mostrar1['id']?></td>
            <td><?php echo $mostrar1['fec_ingreso']?></td>
            <td><?php echo $mostrar1['fec_entrega']?></td>
            <td><?php echo $mostrar1['total_arreglo']?></td>
            <td><?php echo $mostrar1['abono']?></td>
            <td><?php echo $mostrar1['saldo']?></td>
            <td><?php echo $mostrar1['abono_2']?></td>
            <td><?php echo $mostrar1['estado']?></td>
          </tr>
          <?php } ?>
        </table>

      </div>
    </div>
</main>