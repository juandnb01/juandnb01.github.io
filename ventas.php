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

  include('includes/cn.php');
  include('includes/header2.php');

    error_reporting(0);

    if(isset($_POST['buscar']))
    {

      $buscar = $_POST['busqueda'];
      $_SESSION['dato'] = $buscar;

      $consulta_cliente = "select * from clientes where doc_cliente = '$buscar'";
      $resultado = mysqli_query($conexion,$consulta_cliente);
      if (mysqli_num_rows($resultado) > 0)
      {
          $_SESSION['message'] = 'El cliente se encuentra registrado en la base de datos';
          $_SESSION['message_type'] = 'primary';
          $mostrar = mysqli_fetch_assoc($resultado);
      }
      else
      {
        $_SESSION['message'] = 'El cliente no se encuentra registrado en la base de datos';
        $_SESSION['hiper'] = '<a href="clientes.php" class="alert-link">Registrar aqui</a>';
        $_SESSION['message_type'] = 'warning';
        $_SESSION['dato'] = '';
      }
    }
?>
<br>
<?php if(isset($_SESSION['message'])) { ?>
<div class="alert alert-dismissible alert-<?=$_SESSION['message_type']?>">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <?php echo $_SESSION['message']; echo " "; echo $_SESSION['hiper'];?>
  <?php
  unset($_SESSION['message']);
  unset($_SESSION['message_type']);
  unset($_SESSION['hiper']);
  ?>
</div>
<?php } ?>
<main class="container p-5">
    <div class="row">
    <div class="col-md-5">
      <h3>Nuevo ingreso</h3>
        <table>
          <tr>
            <td>
              <form class="form-inline my-2 my-lg-0" action="ventas.php" method="POST">
                <input class="form-control mr-sm-2" type="text" placeholder="Documento cliente" name="busqueda" id="busqueda">
                <button class="btn btn-primary my-2 my-sm-0" type="submit" name="buscar" id="buscar">Buscar</button>&nbsp;
                 <a href="ventas.php"><button class="btn btn-primary my-2 my-sm-0" type="submit" name="buscar" id="buscar">Limpiar</button></a>
              </form>
            </td>
          </tr>
        </table>
    </div>

<?php
if($_SESSION['dato'] ==  null || $_SESSION['dato']== '')
{ }
else
{ ?>

    <div class="col-md-4">
        <h3>Cliente</h3>
        <input type="text" class="form-control" value="<?php echo $mostrar['nom_cliente']; echo " "; echo $mostrar['ape_cliente'];?>" readonly="readonly">
    </div> 

    <div class="col-md-3">
      <h3>Tipo de ingreso</h3>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="check1" onchange="habilitararreglo(this.checked);">
          <label class="custom-control-label" for="check1">Arreglo</label>
        </div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="check2" onchange="habilitarsobremedida(this.checked);">
          <label class="custom-control-label" for="check2">Sobremedida</label>
        </div>
    </div>

    </div>
</main>
<?php } ?>

<main class="container p-1" name="arreglos" id="form_arreglos" hidden="true">
  <div class="row">
    <div class="col-md-20">
      <div class="jumbotron">
        <form action="guardar_arreglo.php" method="POST">
          <h4>Registro de arreglos</h4>
          <br>
          <table>
            <tr>
              <td><label>Fecha ingreso</label><input type="date" class="form-control" name="fecha_ingreso" value="<?php echo date("Y-m-d");?>"></td>
              <td><label><font color="red"><b>Fecha entrega</b></font></label><input type="date" class="form-control" name="fecha_entrega" min="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>"></td>
            </tr>
          </table>
          <br><br>
          <table>
            <tr>
              <td>Cantidad de prendas<input type="text" class="form-control" name="cantidad" maxlength="400" required>
              <td>Tipo de prendas<input type="text" class="form-control" name="tipo" maxlength="400" required>
              <td><font color="red"><b>Arreglo solicitado</b></font><input type="text" class="form-control" name="arreglo" maxlength="400" required>
              <td><font color="grey"><b>Total cobrado</b></font><input type="text" class="form-control" name="total_inicial" maxlength="400" placeholder="$" required>
              <td><font color="grey"><b>Abono</b></font><input type="text" class="form-control" name="abono" maxlength="400" placeholder="$" required>
              <td><font color="red"><b>Saldo</b></font><input type="text" class="form-control" name="total_final" maxlength="400" placeholder="$" required>
            </tr>
          </table>
          <div align="right">
            <br>
            <input type="submit" id="enviar" name="enviar" value="Registrar" class="btn btn-primary my-2 my-sm-0" onclick="reporte_ingreso()">
            <input type="hidden" value="<?php echo $mostrar['doc_cliente']?>" name="documento">
          </div>
        </form>
      </div>
    </div>
  </div>
</main>

<main class="container p-1" name="sobremedidas" id="form_sobremedidas" hidden="true">
  <div class="row">
    <div class="col-md-20">
      <div class="jumbotron">
        <form action="guardar_sobremedida.php" method="POST">
          <h4>Registro de sobremedidas</h4>
          <br>
          <table>
            <tr>
              <td><label>Fecha ingreso</label><input type="date" class="form-control" name="fecha_ingreso" value="<?php echo date("Y-m-d");?>"></td>
              <td><label><font color="red"><b>Fecha entrega</b></font></label><input type="date" class="form-control" name="fecha_entrega" min="<?php echo date("Y-m-d");?>" ></td>
            </tr>
          </table>
          <br><br>
          <table>
            <tr>
              <td>Cantidad de prendas<input type="text" class="form-control" name="cantidad" maxlength="400" required>
              <td>Tipo de prendas<input type="text" class="form-control" name="tipo" maxlength="400" required>
              <td><font color="red"><b>Sobremedida solicitada</b></font><input type="text" class="form-control" name="arreglo" maxlength="400" required>
              <td><font color="grey"><b>Total cobrado</b></font><input type="text" class="form-control" name="total_inicial" maxlength="400" placeholder="$" required>
              <td><font color="grey"><b>Abono</b></font><input type="text" class="form-control" name="abono" maxlength="400" placeholder="$" required>
              <td><font color="red"><b>Saldo</b></font><input type="text" class="form-control" name="total_final" maxlength="400" placeholder="$" required>
            </tr>
          </table>
          <div align="right">
            <br>
            <input type="submit" id="enviar" name="enviar" value="Registrar" class="btn btn-primary my-2 my-sm-0" onclick="reporte_ingreso()">
            <input type="hidden" value="<?php echo $mostrar['doc_cliente']?>" name="documento">
          </div>
        </form>
      </div>
    </div>
  </div>
</main>