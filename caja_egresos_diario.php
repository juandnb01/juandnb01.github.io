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

    $buscar = $_POST['busqueda'];

    $consulta_fecha = "select * from turnos where fecha_cancela = '$buscar'";
    $resultado = mysqli_query($conexion,$consulta_fecha);
    if (mysqli_num_rows($resultado) > 0)
    {
        $_SESSION['message'] = 'Se encontraron los siguientes pagos registrados';
        $_SESSION['message_type'] = 'primary';
        $mostrar = mysqli_fetch_assoc($resultado);
        $fecha_cancela = $mostrar['fecha_cancela'];
        $control = '1';
    }
    else
    {
      $_SESSION['message'] = 'No se encontraron pagos registrados para la fecha o rango de fechas buscadas';
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
<main class="container p-6">
  <div class="row">
    <div class="col-md-5">
      <h3>Buscar el reporte diario de egresos</h3>
        <table>
          <tr>
            <td>
              <form class="form-inline my-2 my-lg-0" action="caja_egresos_diario.php" method="POST">
                <input class="form-control mr-sm-2" type="date" name="busqueda" id="busqueda" value="" autofocus required>
                <button class="btn btn-primary my-2 my-sm-0" type="submit" name="buscar" id="buscar">Buscar</button>&nbsp;
                 <a href="caja_egresos_diario.php"><input class="btn btn-primary my-2 my-sm-0" type="button" name="buscar" id="buscar" value="Limpiar campos"</a>
              </form>
            </td>
          </tr>
        </table>
    </div>

    <?php
    if($control == '1')
    { ?>
    <div class="col-md-6">
      <h3>Egresos del día</h3>
      <?php 
      $consulta_total = "select sum(total_turno) as total_egreso from turnos where fecha_cancela = '$fecha_cancela' and estado_turno = 'Cancelado'";
      $resultado_total = mysqli_query($conexion,$consulta_total);
      $mostrar_total = mysqli_fetch_array($resultado_total);
      $total_egreso = $mostrar_total['total_egreso'];
      ?>
        <table>
          <tr>
            <td><font size ="4">Total egresos:</font>&nbsp;&nbsp;</td>
            <td><font color="red" size ="4"><?php echo '$ '.number_format($total_egreso);?></font></td>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</main>

<main class="container p-6">
  <div class="row">
    <div class="col-md-12">
      <br><br>
      <h3>Reporte de egresos</h3>
      <br>
      <table class="table table-hover">
          <tr class="table-dark">
          <td>Registro</td>
          <td>Fecha turno</td>
          <td>Nombre empleado</td>
          <td>Hora entrada</td>
          <td>Hora salida</td>
          <td>Total horas</td>
          <td>Total egreso</td>
          <td>Fecha cancelación</td>
        </tr>
      <?php 
      $consulta_egresos = "select * from turnos inner join empleados on turnos.doc_empleado = empleados.doc_empleado where fecha_cancela = '$fecha_cancela' and estado_turno = 'Cancelado'";
      $resultado_egresos = mysqli_query($conexion,$consulta_egresos);
      while($mostrar_egresos = mysqli_fetch_array($resultado_egresos))
      {
      ?>
      <tr>
        <td><?php echo $mostrar_egresos['id_turno']; ?></td>
        <td><?php echo $mostrar_egresos['fecha_turno']; ?></td>
        <td><?php echo $mostrar_egresos['ape_empleado'];echo " "; echo $mostrar_egresos['nom_empleado'] ?></td>
        <td><?php echo $mostrar_egresos['hora_ingreso']; ?></td>
        <td><?php echo $mostrar_egresos['hora_salida']; ?></td>
        <td><?php echo $mostrar_egresos['horas_turno']; ?></td>
        <td><font color="red"><?php echo '$ '.number_format($mostrar_egresos['total_turno']); ?></font></td>
        <td><?php echo $mostrar_egresos['fecha_cancela']; ?></td>
      </tr>
      <?php } ?>
    </table>
    </div>
  </div>
</main>
<?php } ?>   