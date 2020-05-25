<?php
  
  include 'includes/cn.php';
  session_start();
  $varsession = $_SESSION['usuario'];
  
  if($varsession == null || $varsession = '')
  {
    header ("location:error_sesion.php");
    die();
  }

  include('includes/cn.php');
  include('includes/header2.php');

  $id = $_GET['id'];

  //Consultamos los datos del Usuario
  $sql = "SELECT * from clientes inner join medidas on medidas_cliente = doc_medidas where doc_cliente = '$id' ";
  $result = mysqli_query($conexion, $sql);
  $row = mysqli_fetch_array($result);

  $id = $row['doc_cliente'];

?>
<form action="actualizar_medidas_cliente.php?id=<?php echo $id; ?>" method="POST">
<main class="container p-1">
  <div class="row">

    <div class="col-md-7">

        <h1 class="display-4">Las medidas</h1>
        
        <br>

    </div>

    <div class="col-md-5">
      <?php
          if(isset($_SESSION['message']))
          { ?>
            <div class="alert alert-<?= $_SESSION['message_type'];?> alert-dismissible fade show" role="alert">
              <?= $_SESSION['message']?>

              <button type="button" class="close" data-dismiss="alert" arial-label="Close">
                <span arial-hidden="true">&times;</span>
              </button>
            </div>
            <?php
            $_SESSION['message_type'] = 0;
          }?>
    </div>
  </div>
</main>

<main class="container p-1">
    <div class="row">
    <div class="col-md-5">
      <label><h4>Camisa</h4></label>
      <div class="jumbotron">

            Ancho espalda: <input type="text" name="upaespalda" class="form-control" value="<?php echo $row['a_espalda'].' cm'; ?>" required>
            Contorno busto blusa: <input type="text" name="upcbusto" class="form-control" value="<?php echo $row['cbusto'].' cm'; ?>" required>
            Contorno pecho camisa: <input type="text" name="upcpecho" class="form-control" value="<?php echo $row['cpecho'].' cm'; ?>" required>
            Cintura: <input type="text" name="upcintura_cam" class="form-control" value="<?php echo $row['cintura_cam'].' cm'; ?>" required>
            Contorno base: <input type="text" name="upc_base_cam" class="form-control" value="<?php echo $row['c_base_cam'].' cm'; ?>" required>
            Largo manga: <input type="text" name="upl_manga" class="form-control" value="<?php echo $row['l_manga'].' cm'; ?>" required>
            Largo total: <input type="text" name="upl_total_cam" class="form-control" value="<?php echo $row['l_total_cam'].' cm'; ?>" required>

      </div>              
    </div>

    <div class="col-md-5">
      <label><h4>Pantalon</h4></label>
      <div class="jumbotron">

            Cintura: <input type="text" name="upcintura_pan" class="form-control" value="<?php echo $row['cintura_pan'].' cm'; ?>" required>
            Contorno base: <input type="text" name="upc_base_pan" class="form-control" value="<?php echo $row['c_base_pan'].' cm'; ?>" required>
            Rodilla: <input type="text" name="uprodilla" class="form-control" value="<?php echo $row['rodilla'].' cm'; ?>" required>
            Bota: <input type="text" name="upbota" class="form-control" value="<?php echo $row['bota'].' cm'; ?>" required>
            Largo total: <input type="text" name="upl_total_pan" class="form-control" value="<?php echo $row['l_total_pan'].' cm'; ?>" required>

      </div>              
    </div>

    <div class="col-md-2">

          <div class="form-group">
            <input type="submit" name="submit" class="btn btn-warning btn-block" value="Actualizar medidas">
          </div>
          <a class="btn btn-danger btn-block" href="clientes.php"><i class="fas fa-window-close"></i> Cancelar</a>
    </div>              

  </div>
</main>
</form>