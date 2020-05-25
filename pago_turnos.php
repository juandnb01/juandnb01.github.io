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

<main class="container p-1">
  <div class="row">
    <div class="col-md-9">
      <h3>Consulta de pago de turnos de empleados</h3>
      <br>
      <form action="pago_turnos.php" method="POST">
        <table>
          <tr>
            <td>
              
                <h6>Empleado:</h6>
                <select name="empleado" class="form-control" required>
                  <option value="0">Seleccione el empleado</option>
                  <?php 
                  $consulta_empleado = "select * from empleados";
                  $resultado_empleado = mysqli_query($conexion,$consulta_empleado);
                  while($mostrar_empleado = mysqli_fetch_array($resultado_empleado))
                  {?>
                    <option value=<?php echo $mostrar_empleado['doc_empleado']?>><?php echo $mostrar_empleado['ape_empleado'];echo " "; echo $mostrar_empleado['nom_empleado'];?></option>
                  <?php } ?>
                </select>
            </td>
            <td>
              <h6>Fecha inicial</h6>
              <input type="date" name="fecha_inicial" class="form-control" required>
            </td>
            <td>
              <h6>Fecha final</h6>
              <input type="date" name="fecha_final" class="form-control" required>
            </td>
            <td>
              <br>
              &nbsp;<button class="btn btn-primary my-2 my-sm-0" type="submit" name="buscar" id="buscar">Buscar</button>&nbsp;
                 <a href="pago_turnos.php"><input type="button" class="btn btn-primary my-2 my-sm-0" name="limpiar" id="limpiar" value="Limpiar"></a>
            </td>
          </tr>
        </table>
        </form>
    </div>
<?php

if(isset($_POST['buscar']))
{
  $documento = $_POST['empleado'];
  $fec_ini = $_POST['fecha_inicial'];
  $fec_fin = $_POST['fecha_final'];

  $consulta_empleado = "select * from empleados where doc_empleado = '$documento' ";
  $resultado_empleado = mysqli_query($conexion,$consulta_empleado);
  $mostrar_empleado = mysqli_fetch_array($resultado_empleado);
?>
    <div class="col-md-3">
      <br><br><br>
      <h6><b>Nombre: </b><?php echo $mostrar_empleado['ape_empleado'];echo " "; echo $mostrar_empleado['nom_empleado'];?></h6>
      <h6><b>Desde </b><?php echo $fec_ini; echo "<b> Hasta </b>"; echo $fec_fin;?></h6>      
      <br>
    </div>
  </div>
</main>

<main class="container p-1">
  <div class="row">
    <div class="col-md-12">
      <br><br>
      <h3>Reporte de turnos pagados al empleado</h3>
      <br>
      <table class="table table-hover">
        <thead>
          <tr class="table-dark">
          <th>Registro</th>
          <th>Fecha turno</th>
          <th>Hora ingreso</th>
          <th>Hora salida</th>
          <th>Total horas</th>
          <th>Total pagado</th>
          <th>Fecha de pago</th>
        </tr>
      </thead>
      <?php 
      $consulta_turnos = "select * from turnos where doc_empleado = '$documento' and fecha_turno between '$fec_ini' and '$fec_fin' and estado_turno = 'Cancelado' ";
      $resultado_turnos = mysqli_query($conexion,$consulta_turnos);
      while($mostrar_turnos = mysqli_fetch_array($resultado_turnos))
      { ?>
      <tr>
        <td><?php echo $mostrar_turnos['id_turno'];?></td>
        <td><?php echo $mostrar_turnos['fecha_turno'];?></td>
        <td><?php echo $mostrar_turnos['hora_ingreso'];?></td>
        <td><?php echo $mostrar_turnos['hora_salida'];?></td>
        <td><?php echo $mostrar_turnos['horas_turno'];?></td>
        <td><?php echo '$ '.number_format($mostrar_turnos['total_turno']);?></td>
        <td><?php echo $mostrar_turnos['fecha_cancela'];?></td>
      </tr>
      <?php } ?>
    </table>
    </div>
  </div>
</main>

<?php } ?>