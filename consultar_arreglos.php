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

if(isset($_POST['buscar']))
{

  $buscar = $_POST['busqueda'];
  $_SESSION['dato'] = $buscar;

  $consulta_arreglo = "select * from arreglos where fec_entrega = '$buscar' or id = '$buscar' or doc_cli ='$buscar'";
  $resultado = mysqli_query($conexion,$consulta_arreglo);
  if (mysqli_num_rows($resultado) > 0)
  {
      $_SESSION['message'] = 'Se encontraron arreglos para la fecha o ticket buscado';
      $_SESSION['message_type'] = 'primary';
      $mostrar = mysqli_fetch_assoc($resultado);
  }
  else
  {
    $_SESSION['message'] = 'No hay arreglos programados para la fecha o ticket buscado';
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

<main class="container p-5">
    <div class="row">

    <div class="col-md-4">
      <h3>Buscar por cliente</h3>
        <table>
          <tr>
            <td>
              <form class="form-inline my-2 my-lg-0" action="consultar_arreglos.php" method="POST" >
                <input class="form-control mr-sm-2" type="text" name="busqueda" id="busqueda" placeholder="Documento cliente">
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
              <form class="form-inline my-2 my-lg-0" action="consultar_arreglos.php" method="POST" >
                <input class="form-control mr-sm-2" type="text" name="busqueda" id="busqueda" placeholder="Número de ticket">
                <button class="btn btn-primary my-2 my-sm-0" type="submit" name="buscar" id="buscar">Buscar</button>
              </form>
            </td>
          </tr>
        </table>
    </div>

    <div class="col-md-4">
      <br><br>
      <form class="form-inline my-2 my-lg-0" action="consultar_arreglos.php" method="POST">
        <input class="btn btn-primary" type="submit" value="Limpiar campos">&nbsp;
        <a href="consultar_arreglos_entregados.php"><input class="btn btn-warning btn-block" type="button" value="Arreglos entregados"></a>
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

    <div class="col-md-20">
    <center>

        <table class="table table-hover">
          <tr class="table-dark">
              <td>Tipo servicio</td>
              <td>Cliente</td>
              <td>Recepción</td>
              <td><font color="red"><b>Entrega</b></font></td>
              <td>Prendas</td>
              <td>Tipo prendas</td>
              <td>Arreglo</td>
              <td><font color="red"><b>Cobrado</b></font></td>
              <td>Abono</td>
              <td><font color="red"><b>Pendiente</b></font></td>
              <td>Recibido</td>
              <td>Observaciones</td>
              <td>Acción</td>
            </tr>
          </thead>

      		<?php

      		$consulta2="SELECT * from arreglos inner join clientes on doc_cli = doc_cliente where fec_entrega = '$buscar' and estado = 'por entregar' or id='$buscar' and estado = 'por entregar' or doc_cli = '$buscar' and estado ='por entregar' order by fec_ingreso";
      		$resultado2=mysqli_query($conexion,$consulta2);
      		while($mostrar2=mysqli_fetch_array($resultado2))
      		{

      		?>
          <form action="entregar_arreglo.php" method="POST">
      		<tr>
            <td><?php echo $mostrar2['tipo_arreglo'] ?></td>
      			<td><center><?php echo $mostrar2['nom_cliente'];echo " ";echo $mostrar2['ape_cliente'];  ?></center></td>
      			<td><?php echo $mostrar2['fec_ingreso'] ?></td>
      			<td><font color="red"><?php echo $mostrar2['fec_entrega'] ?></font></td>
      			<td><center><?php echo $mostrar2['cantidad'] ?></center></td>
            <td><?php echo $mostrar2['tipo_prendas'] ?></td>
            <td><?php echo $mostrar2['arreglo'] ?></td>
            <td><font color="red"><?php echo'$'.number_format($mostrar2['total_arreglo']) ?></font></td>
            <td><?php echo '$'.number_format( $mostrar2['abono']) ?></td>
            <td><font color="red"><?php echo'$'.number_format($mostrar2['saldo']) ?></font></td>
            <td><input type="text" class="form-control" name="faltante" placeholder="$"></td>
            <td><input type="text" class="form-control" name="observa" maxlength="500"></td>
            <input type="hidden" id="identi" name="identi" value="<?php echo $mostrar2['id']?>">
      			<td><input type="submit" class="btn btn-primary btn-sm" value="Entregar" onclick="reporte_entrega()"></td> 
      		</tr>
          </form>
      		<?php 
          } 
          $_SESSION['dato'] = '';?>
  	     </table>

    </center>
    </div>

  </div>
</main>
<?php } ?>

</html>