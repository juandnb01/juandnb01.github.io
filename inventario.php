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

  include('includes/header2.php');
  include ('includes/funciones.php');

  $hoy = date('Y-m-d');
  

error_reporting(0);


$consulta_inventario = "Select * from arreglos where estado = 'por entregar'";

$resultado_inventario = mysqli_query($conexion,$consulta_inventario);

if(mysqli_num_rows($resultado_inventario) > 0)
{
  $_SESSION['message'] = 'Inventario encontrado en la base de datos';
  $_SESSION['message_type'] = 'primary';
  $control = 1;
}
else
{
  $_SESSION['message'] = 'No hay inventario registrado en la base de datos';
  $_SESSION['message_type'] = 'danger';
}

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

<main class="container p-5">
  <div class="row">

    <div class="col-md-12">

        <table>
          <tr>
            <td><h3>Imprimir reporte &nbsp; <a href="ticket_inventario.php" class="btn btn-primary my-2 my-sm-0" target="_blank">Imprimir</a></h3></td>
          </tr>
        </table>

    </div>
  </div>
</main>

<?php
if($control == 1)
{ ?>
<main class="container p-1">
  <div class="row">

    <div class="col-md-12">
    
      <div class="jumbotron">
        <h3>Inventario de prendas</h3>
        <center>
        <table class="table table-hover">
          <tr class="table-dark">
              <td>Ticket</td>
              <td>Cliente</td>
              <td>Cantidad</td>
              <td>Prendas</td>
              <td>Ingreso</td>
              <td>Arreglo</td>
            </tr>
          </thead>

          <?php

          $consulta_inventario2="SELECT * from arreglos inner join clientes on doc_cli = doc_cliente where estado = 'por entregar' and tipo_arreglo = 'arreglo'";
          $resultado2=mysqli_query($conexion,$consulta_inventario2);
          while($mostrar2=mysqli_fetch_array($resultado2))
          {

          ?>
          <form action="entregar_arreglo.php" method="POST">
          <tr>
            <td><?php echo $mostrar2['id'] ?></td>
            <td><?php echo $mostrar2['ape_cliente'];echo " "; echo $mostrar2['nom_cliente'];?></td>
            <td><?php echo $mostrar2['cantidad'] ?></td>
            <td><?php echo $mostrar2['tipo_prendas'] ?></td>
            <td><?php echo $mostrar2['fec_ingreso'] ?></td>
            <td><?php echo $mostrar2['arreglo'] ?></td>
          </tr>
          </form>
          <?php 
          } 
          $dato == '';?>
         </table>
       </div>
    </center>
    </div>
  </div>
</main>
<?php
} ?>
</body>
</html>