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
      $buscar = $_POST['empleado'];
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

<main class="container p-1">
    <div class="row">
    <div class="col-md-5">
      <h3>Consulta de turnos por empleado</h3>
        <table>
          <tr>
            <td>
              <form class="form-inline my-2 my-lg-0" action="consultar_turnos.php" method="POST">
                <select name="empleado" class="form-control">
                  <option value="0">Seleccione el empleado</option>
                  <?php 
                  $consulta_empleado = "select * from empleados";
                  $resultado_empleado = mysqli_query($conexion,$consulta_empleado);
                  while($mostrar_empleado = mysqli_fetch_array($resultado_empleado))
                  {?>
                    <option value=<?php echo $mostrar_empleado['doc_empleado']?>><?php echo $mostrar_empleado['ape_empleado'];echo " "; echo $mostrar_empleado['nom_empleado'];?></option>
                  <?php } ?>
                </select> &nbsp;
                <button class="btn btn-primary my-2 my-sm-0" type="submit" name="buscar" id="buscar">Buscar</button>&nbsp;
                 <a href="turnos.php"><button class="btn btn-primary my-2 my-sm-0" type="submit" name="limpiar" id="limpiar">Limpiar</button></a>
              </form>
            </td>
          </tr>
        </table>
    </div>

<?php
if($buscar ==  null || $buscar== '')
{ }
else
{ 
  $info_empleado = "select * from empleados where doc_empleado = '$buscar'";
  $resultado_empleado = mysqli_query($conexion,$info_empleado);
  $mostrar_info_empleado = mysqli_fetch_array($resultado_empleado);

  ?>

    <div class="col-md-7">
      <br>
      <h4><b>Documento: </b><?php echo $mostrar_info_empleado['doc_empleado']?></h4>
      <h4><b>Nombre: </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $mostrar_info_empleado['ape_empleado']; echo " "; echo $mostrar_info_empleado['nom_empleado']; ?></h4>
    </div>
  </div>

  <div class="row">
    <div class="col-md-10">
      <br>
      <h3>Turnos registrados para el empleado</h3>
      <br><br>
      <table class="table table-hover">
        <thead>
          <tr class="table-dark">
          <th>Registro</th>
          <th>Fecha</th>
          <th>Hora ingreso</th>
          <th>Hora salida</th>
          <th>Total horas</th>
          <th>Total a pagar</th>
          <th>Observaciones</th>
          <th>Pagar turno</th>
        </tr>
      </thead>
      <?php
      $consulta_turnos = "select * from turnos where doc_empleado = '$buscar' and estado_turno = 'Por cancelar'";
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
          <td><?php echo $mostrar_turnos['observaciones_turno'];?></td>
          <td><a href="cancelar_turnos.php?id=<?php echo $mostrar_turnos['id_turno']?>"><input type="button" name="cancelar" id="cancelar" class="btn btn-primary" value="Pagar"></a></td>
        </tr>
      <?php } ?>
      </table>
      <div align="right">
        <?php 
        $consulta_horas = "select sum(horas_turno) as total_horas from turnos where doc_empleado = '$buscar' and estado_turno = 'Por cancelar'";
        $resultado_horas = mysqli_query($conexion,$consulta_horas);
        $mostrar_horas = mysqli_fetch_array($resultado_horas);
        $horas = $mostrar_horas['total_horas'];
        ?>
        <h3><b><font color="red" size="4">Total horas: </b><?php echo $horas;?></font></h3>
      </div>
    </div>

  </div>
</main>
<?php } ?>