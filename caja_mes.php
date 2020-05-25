<?php
  
  include 'includes/cn.php';
  include 'includes/funciones.php';

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
  $_SESSION['user'] = $row['id'];

  include('includes/cn.php');
  include('includes/header2.php');

  error_reporting(0);

  if(isset($_POST['buscar']))
  {

    $buscar = $_POST['busqueda1'];

    $fecha1 = $_POST['busqueda1'];
    $fecha2 = $_POST['busqueda2'];

    $_SESSION['dato'] = $buscar;

    $consulta_fecha = "select * from arreglos where fec_ingreso between '$fecha1' and '$fecha2' or fec_entregado between '$fecha1' and '$fecha2' ";
    $resultado = mysqli_query($conexion,$consulta_fecha);
    if (mysqli_num_rows($resultado) > 0)
    {
        $_SESSION['message'] = 'Se encontraron las siguientes ventas registradas para el rango de fecha seleccionado';
        $_SESSION['message_type'] = 'primary';
        $mostrar = mysqli_fetch_assoc($resultado);
    }
    else
    {
      $_SESSION['message'] = 'No se encontraron ventas registradas para el rango de fecha seleccionado';
      $_SESSION['message_type'] = 'warning';
      $_SESSION['dato'] = '';
    }
  }

?>
<br>
<?php if(isset($_SESSION['message'])) { ?>
<div class="alert alert-dismissible alert-<?=$_SESSION['message_type']?>">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <?php echo $_SESSION['message'];?>
  <?php
  unset($_SESSION['message']);
  unset($_SESSION['message_type']);
  ?>
</div>
<?php } ?>
<main class="container p-4">
    <div class="row">
    <div class="col-md-7">
      <h3>Indique el rango de fechas</h3>
      <form class="form-inline my-2 my-lg-0" action="caja_mes.php" method="POST">
        <table>
          <tr>
            <td>Inicial</td>
            <td>Final</td>
          </tr>
          <tr>
            <td>
              <input class="form-control mr-sm-2" type="date" name="busqueda1" id="busqueda1" autofocus>
            </td>
            <td>
                <input class="form-control mr-sm-2" type="date" name="busqueda2" id="busqueda2">
            </td>
            <td>
              <button class="btn btn-primary my-2 my-sm-0" type="submit" name="buscar" id="buscar">Buscar</button>
            </td>
            <td>
              <a href="caja_mes.php"><button class="btn btn-primary my-2 my-sm-0" type="submit" name="limpiar" id="limpiar">Limpiar campos</button></a>
            </td>
          </tr>
        </table>
      </form>
    </div>

    <?php
    if($_SESSION['dato'] ==  null || $_SESSION['dato']== '')
    { }
    else
    { ?>
    <div class="col-md-5">
      <h3>Recolectado mes</h3>
      <br>
        <table>
          <tr>
            <td>
              <?php
              $consulta_abono = "Select sum(abono) as recaudo_abono from arreglos where fec_ingreso between '$fecha1' and '$fecha2' or fec_entregado between '$fecha1' and '$fecha2' ";
              $resultado_abono = mysqli_query($conexion, $consulta_abono);
              $mostrar_abono = mysqli_fetch_array($resultado_abono);
              $total_abono = $mostrar_abono['recaudo_abono'];

              $consulta_abono_2 = "Select sum(abono_2) as recaudo_abono_2 from arreglos where fec_ingreso between '$fecha1' and '$fecha2' or fec_entregado between '$fecha1' and '$fecha2' ";
              $resultado_abono_2 = mysqli_query($conexion, $consulta_abono_2);
              $mostrar_abono_2 = mysqli_fetch_array($resultado_abono_2);
              $total_abono_2 = $mostrar_abono_2['recaudo_abono_2'];

              $total_mes = $total_abono + $total_abono_2;
              ?>
              <input type="text" name="dinero_dia" class="form-control" value="<?php echo '$ '.number_format($total_mes); ?>"/ readonly="readonly">
            </td>
          </tr>
        </table>
    </div>
    <?php } ?>

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
        <h3>Ventas registradas fechas: <?php echo $fecha1; echo " // "; echo $fecha2; ?></h3>
        <table class="table table-hover">
          <tr class="table-dark">
            <td>Ticket</td>
            <td>Cliente</td>
            <td>Servicio</td>
            <td>Fecha ingreso</td>
            <td>Fecha programada</td>
            <td>Fecha entrega</td>
            <td>Total cobrado</td>
            <td>Abono &nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>Abono entrega</td>
            <td>Estado</td>
          </tr>
          <?php
          $consulta_venta = "Select * from arreglos inner join clientes on doc_cli = doc_cliente where fec_ingreso between '$fecha1' and '$fecha2' or fec_entregado between '$fecha1' and '$fecha2' ";
          $resultado_venta = mysqli_query($conexion, $consulta_venta);
          while($mostrar_venta = mysqli_fetch_array($resultado_venta))
          {
          ?>
          <tr>
            <td><?php echo $mostrar_venta['id'];?></td>
            <td><?php echo $mostrar_venta['nom_cliente'];echo '<br>'; echo $mostrar_venta['ape_cliente']?></td>
            <td><?php echo $mostrar_venta['tipo_arreglo'];?></td>
            <td><?php echo $mostrar_venta['fec_ingreso'];?></td>
            <td><?php echo $mostrar_venta['fec_entrega'];?></td>
            <td><?php echo $mostrar_venta['fec_entregado'];?></td>
            <td><?php echo'$ '.number_format( $mostrar_venta['total_arreglo']); ?></td>
            <td><?php echo'$ '.number_format( $mostrar_venta['abono']); ?></td>
            <td><?php echo'$ '.number_format( $mostrar_venta['abono_2']); ?></td>
            <td><?php echo $mostrar_venta['estado'];?></td>
          </tr>
          <?php } ?>
        </table>
    </div>
  </div>
</main>
<?php } ?>