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

      $consulta_cliente = "select * from arreglos inner join clientes on doc_cli = doc_cliente where id = '$buscar'";
      $resultado = mysqli_query($conexion,$consulta_cliente);
      if (mysqli_num_rows($resultado) > 0)
      {
          $_SESSION['message'] = 'El ticket se encuentra registrado en la base de datos';
          $_SESSION['message_type'] = 'primary';
          $mostrar = mysqli_fetch_assoc($resultado);
      }
      else
      {
        $_SESSION['message'] = 'El Ticket no se encuentra registrado en la base de datos';
        $_SESSION['message_type'] = 'warning';
        $_SESSION['dato'] = '';
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

<main class="container p-12">
    <div class="row">
    <div class="col-md-12">
      <h1>Reimprimir factura de ingreso</h1>
    </div>
  </div>
</main>
<main class="container p-5">
    <div class="row">
    <div class="col-md-5">
      <h3>Ingrese el número de ticket</h3>
        <table>
          <tr>
            <td>
              <form class="form-inline my-2 my-lg-0" action="reim_fac_ingreso.php" method="POST">
                <input class="form-control mr-sm-2" type="text" placeholder="Ticket" name="busqueda" id="busqueda" autofocus>
                <button class="btn btn-primary my-2 my-sm-0" type="submit" name="buscar" id="buscar">Buscar</button>&nbsp;
                 <a href="reim_fac_ingreso.php"><input class="btn btn-primary my-2 my-sm-0" type="button" name="limpiar" id="limpiar" value="Limpiar"></a>
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
        <input type="text" class="form-control" value="<?php echo $mostrar['nom_cliente']; echo " "; echo $mostrar['ape_cliente']; echo " - Ticket: "; echo $buscar; ?>" readonly="readonly">
    </div>

    <div class="col-md-3">
      <br><br>
      <a href="ticket_venta_inicial.php?id=<?php echo $mostrar['id']?>" class="btn btn-primary my-2 my-sm-0" target="_blank">Reimprimir</a>
    </div>
</main>


<?php } ?>