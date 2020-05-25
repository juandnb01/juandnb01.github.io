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

    $fecha1 = $_POST['busqueda1'];
    $fecha2 = $_POST['busqueda2'];
    $_SESSION['dato'] = $fecha1;

    $consulta_fecha = "select * from caja where dia_caja between '$fecha1' and '$fecha2' ";
    $resultado = mysqli_query($conexion,$consulta_fecha);
    if (mysqli_num_rows($resultado) > 0)
    {
        $_SESSION['message'] = 'Se encontraron las siguientes ventas registradas';
        $_SESSION['message_type'] = 'primary';
        $mostrar = mysqli_fetch_assoc($resultado);
    }
    else
    {
      $_SESSION['message'] = 'No se encontraron reportes de caja registrados para la fecha o rango de fechas buscadas';
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
      <h3>Buscar el reporte de caja por fechas</h3>
        <table>
        <form class="form-inline my-2 my-lg-0" action="caja_reporte.php" method="POST">
          <tr>
            <td>Incial </td><td>Final</td>
          </tr>
          <tr>
            <td><input class="form-control mr-sm-2" type="date" name="busqueda1" id="busqueda1" value="" autofocus></td>
            <td><input class="form-control mr-sm-2" type="date" name="busqueda2" id="busqueda2" value=""><td>
            <td><button class="btn btn-primary my-2 my-sm-0" type="submit" name="buscar" id="buscar">Buscar</button><!--&nbsp;-->
            <a href="caja_reporte.php"><button class="btn btn-primary my-2 my-sm-0" type="submit" name="buscar" id="buscar">Limpiar campos</button></a>
            </td>
          </tr>
        </form>
        </table>
    </div>

    <?php
    if($_SESSION['dato'] ==  null || $_SESSION['dato']== '')
    { }
    else
    { ?>
    <?php 
    if($_SESSION['rol']==1) 
    { 
    ?>
    <div class="col-md-4">
      
      <form action="ticket_reporte_caja.php" method="POST" target="_blank">
        <table>
          <tr><td><h3>Imprimir reporte</h3><br></td></tr>
          <tr>
            <td>
              <input type="hidden" name="fecha1" value="<?php echo $fecha1;?>">
              <input type="hidden" name="fecha2" value="<?php echo $fecha2;?>">
              <input type="submit" class="btn btn-primary" value="Imprimir reporte"> 
            </td>
            <?php } ?>
          </tr>
        </table>
      </form>
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
    <div class="col-md-12">
      <div class="jumbotron">
        <h3>Cajas registradas entre <?php echo $fecha1; echo " y "; echo $fecha2;?></h3>
        <table class="table table-hover" border="0" align="center">
          <tr class="table-dark">
            <td>Fecha de caja</td>
            <td>Venta registrada</td>
            <td>Fecha de registro</td>
            <td>Usuario</td>
            <td>Rol</td>
          </tr>
          <?php
          $consulta_caja = "Select * from caja inner join usuarios on usuario_registra_caja = id 
          inner join roles on cod_rol = N_rol where dia_caja between '$fecha1' and '$fecha2'  ";
          $resultado_caja = mysqli_query($conexion, $consulta_caja);
          while($mostrar_caja = mysqli_fetch_array($resultado_caja))
          {
          ?>
          <tr>
            <td><?php echo $mostrar_caja['dia_caja'];?></td>
            <td><?php echo '$ '.number_format($mostrar_caja['venta_caja']);?></td>
            <td><?php echo $mostrar_caja['fec_registro'];?></td>
            <td><?php echo $mostrar_caja['nombre'];?></td>
            <td><?php echo $mostrar_caja['tipo_rol'];?></td>
          </tr>
          <?php } ?>
        </table>
      </div>
    </div>
  </div>
</main>
<?php } ?>