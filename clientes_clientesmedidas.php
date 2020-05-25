<?php

  include 'includes/cn.php';
  session_start();
  $varsession = $_SESSION['cliente'];
  
  if($varsession == null || $varsession = '')
  {
    header ("location:error_sesion.php");
    die();
  }

   $cliente = $_SESSION['cliente'];

  include 'includes/cn.php';
  include 'includes/header2.php';

  $id = $_POST['consulmedidas'];

  $verificar_cliente = mysqli_query($conexion, "select * from clientes where doc_cliente = '$id' ");
  if (mysqli_num_rows($verificar_cliente) == 0)
  {
  	$_SESSION['message'] = 'El cliente no se encuentra registrado en la base de datos';
    $_SESSION['message_type'] = 'danger';

    header('Location:clientes_clientes.php');
    exit;
  }

  $consulta ="Select * from clientes inner join medidas on medidas_cliente = doc_medidas where doc_cliente = '$id'";

  $resultado = mysqli_query($conexion, $consulta);

  $mostrar = mysqli_fetch_array($resultado);

?>

<main class="container p-1">
  <div class="row">

    <div class="col-md-12">

        <h1 class="display-4">Sus medidas <?php echo $mostrar['nom_cliente']; echo " "; echo $mostrar['ape_cliente'];?></h1>
        <br>
        

    </div>
  </div>
</main>

<main class="container p-1">
    <div class="row">
    <div class="col-md-5">
      <label><h4>Camisa</h4></label>
      <div class="jumbotron">

            Ancho espalda: <input type="text" name="upalto" class="form-control" value="<?php echo $mostrar['a_espalda'].' cm'; ?>" readonly="readonly" required>
            Contorno busto blusa: <input type="text" name="upalto" class="form-control" value="<?php echo $mostrar['cbusto'].' cm'; ?>" readonly="readonly" required>
            Contorno pecho camisa: <input type="text" name="upalto" class="form-control" value="<?php echo $mostrar['cpecho'].' cm'; ?>" readonly="readonly" required>
            Cintura: <input type="text" name="upalto" class="form-control" value="<?php echo $mostrar['cintura_cam'].' cm'; ?>" readonly="readonly" required>
            Contorno base: <input type="text" name="upalto" class="form-control" value="<?php echo $mostrar['c_base_cam'].' cm'; ?>" readonly="readonly" required>
            Largo manga: <input type="text" name="upalto" class="form-control" value="<?php echo $mostrar['l_manga'].' cm'; ?>" readonly="readonly" required>
            Largo total: <input type="text" name="upalto" class="form-control" value="<?php echo $mostrar['l_total_cam'].' cm'; ?>" readonly="readonly" required>

      </div>
    </div>

    <div class="col-md-5">
      <label><h4>Pantalon</h4></label>
      <div class="jumbotron">

            Cintura: <input type="text" name="upalto" class="form-control" value="<?php echo $mostrar['cintura_pan'].' cm'; ?>" readonly="readonly" required>
            Contorno base: <input type="text" name="upalto" class="form-control" value="<?php echo $mostrar['c_base_pan'].' cm'; ?>" readonly="readonly" required>
            Rodilla: <input type="text" name="upalto" class="form-control" value="<?php echo $mostrar['rodilla'].' cm'; ?>" readonly="readonly" required>
            Bota: <input type="text" name="upalto" class="form-control" value="<?php echo $mostrar['bota'].' cm'; ?>" readonly="readonly" required>
            Largo total: <input type="text" name="upalto" class="form-control" value="<?php echo $mostrar['l_total_pan'].' cm'; ?>" readonly="readonly" required>

      </div>               
    </div>

    <div class="col-md-2">
      <div align="right">
      <p class="lead"><a class="btn btn-primary btn-lg" href="clientes_clientes.php" role="button"> Regresar</a></p>
    </div>
    </div>

  </div>
  <div class="row">
  	<div class="col-md-2">

  	</div>


  </div>
</main>