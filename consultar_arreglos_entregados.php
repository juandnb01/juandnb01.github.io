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

if(isset($_POST['buscar']))
{

  $buscar = $_POST['busqueda'];
  $_SESSION['dato'] = $buscar;

  $consulta_arreglo = "select * from arreglos where doc_cli = '$buscar' or id='$buscar'";
  $resultado = mysqli_query($conexion,$consulta_arreglo);
  if (mysqli_num_rows($resultado) > 0)
  {
      $_SESSION['message'] = 'Se encontraron arreglos para el cliente o ticket buscado';
      $_SESSION['message_type'] = 'primary';
      $mostrar = mysqli_fetch_assoc($resultado);
  }
  else
  {
    $_SESSION['message'] = 'No se encontraron arreglos para el cliente o ticket buscado';
    $_SESSION['message_type'] = 'danger';
    $_SESSION['dato'] = ''; //deja la variable sin nada para que no muestre la tabla
  }
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

</div>
<main class="container p-5">
    <div class="row">
    <div class="col-md-4">
      <h3>Buscar arreglo por cliente</h3>
        <table>
          <tr>
            <td>
              <form class="form-inline my-2 my-lg-0" action="consultar_arreglos_entregados.php" method="POST">
                <input class="form-control mr-sm-2" type="text" name="busqueda" id="busqueda" placeholder="Documento del cliente">
                <button class="btn btn-primary my-2 my-sm-0" type="submit" name="buscar" id="buscar">Buscar</button>
              </form>
            </td>
          </tr>
        </table>
    </div>

    <div class="col-md-4">
      <h3>Buscar por ticket</h3>
        <table>
          <tr>
            <td>
              <form class="form-inline my-2 my-lg-0" action="consultar_arreglos_entregados.php" method="POST">
                <input class="form-control mr-sm-2" type="text" name="busqueda" id="busqueda" placeholder="Número de ticket">
                <button class="btn btn-primary my-2 my-sm-0" type="submit" name="buscar" id="buscar">Buscar</button>
              </form>
            </td>
          </tr>
        </table>
    </div>

    <div class="col-md-4">
      <br><br>
      <form class="form-inline my-2 my-lg-0" action="consultar_arreglos_entregados.php" method="POST">
        <a href="consultar_arreglos_entregados.php"><input class="btn btn-primary my-2 my-sm-0" type="submit" value="Limpiar campos"></a>&nbsp;
        <a href="consultar_arreglos.php"><input type="button" value="Regresar" class="btn btn-danger my-2 my-sm-0"></a>
      </form>
    </div>
  </div>
</main>

<?php
if($_SESSION['dato'] ==  null || $_SESSION['dato']== '')
{ }
else
{ ?>

<main class="container p-1">
	<div class="row">

    <div class="col-md-12">
    <center>
      <div class="jumbotron">
        <table class="table table-hover">
          <tr class="table-dark">
              <td>Ticket</td>
              <td>Cliente</td>
              <td>Recepción</td>
              <td><font color="red"><b></b>Entregado</font></td>
              <td>Arreglo</td>
              <td><font color="red"><b>Cobrado</b></font></td>
              <td>Abono</td>
              <td><font color="red"><b>Pendiente</b></font></td>
              <td><font color="red"><b>Recibido entrega</b></font></td>
              <td>Estado</td>
              <td>Observaciones</td>
            </tr>
          </thead>

      		<?php

      		$consulta2="SELECT * from arreglos inner join clientes on doc_cli = doc_cliente where doc_cli = '$buscar' and estado = 'entregado' or id='$buscar' and estado = 'entregado' ";
      		$resultado2=mysqli_query($conexion,$consulta2);
      		while($mostrar2=mysqli_fetch_array($resultado2))
      		{

      		?>

      		<tr>
            <td><center><?php echo $mostrar2['id'];?></center></td>
      			<td><center><?php echo $mostrar2['nom_cliente'];echo " ";echo $mostrar2['ape_cliente'];  ?></center></td>
      			<td><?php echo $mostrar2['fec_ingreso'] ?></td>
      			<td><font color="red"><b><?php echo $mostrar2['fec_entregado'] ?></b></font></td>
      			<td><?php echo $mostrar2['arreglo'] ?></td>
            <td><?php echo '$'.number_format($mostrar2['total_arreglo']) ?></td>
            <td><?php echo '$'.number_format($mostrar2['abono']) ?></td>
            <td><font color="red"><b><?php echo '$'.number_format($mostrar2['saldo']) ?></b></font></td>
            <td><?php echo '$'.number_format($mostrar2['abono_2']) ?></td>
            <td><font color="red"><b><?php echo $mostrar2['estado'] ?></b></font></td>
            <td><?php echo $mostrar2['observaciones'] ?></td> 
      		</tr>

      		<?php 
          }
          $_SESSION['dato'] = ''; ?>
  	     </table>
      </div>
    </center>
    </div>

  </div>
</main>
<?php } ?>

</html>