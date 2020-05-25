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
      <h3>Registro de turnos para empleados</h3>
        <table>
          <tr>
            <td>
              <form class="form-inline my-2 my-lg-0" action="turnos.php" method="POST">
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
    <div class="col-md-12">
      <br><br>
      <h3>Ingrese la información del turno</h3>
    </div>
  </div>

  <div class="row">
    <div class="col-md-3">
      <form action="guardar_turnos.php" method="POST">
      <br>
      <h6>Seleccione la fecha</h6>
      <input type="date" name="fecha" class="form-control" value="<?php echo date("Y-m-d");?>">
    </div>

    <div class="col-md-2">
      <br>
      <h6>Hora de ingreso</h6>
      <input type="time" name="ingreso" class="form-control">
    </div>

    <div class="col-md-2">
      <br>
      <h6>Hora de salida</h6>
      <input type="time" name="salida" class="form-control">
    </div>

    <div class="col-md-2">
      <br>
      <h6>Observaciones</h6>
      <input type="text" class="form-control" name="observaciones">
    </div>

    <div class="col-md-3">
      <br><br>
      <input type="hidden" name="documento_empleado" value=<?php echo $mostrar_info_empleado['doc_empleado'];?>>
      <input type="submit" name="registrar" id="registrar" class="btn btn-primary btn-lg" value="Registrar">
    </div>
  </form>
  </div>
</div>
</main>
<?php } ?>