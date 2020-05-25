<?php
  session_start();
  $varsession = $_SESSION['usuario'];
  
  if($varsession == null || $varsession = '')
  {
    header ("location:error_sesion.php");
    die();
  }

	include ('includes/cn.php');

	if(isset($_GET['id']))
	{
		$id = $_GET['id'];

		$consulta = "SELECT * from clientes WHERE doc_cliente = $id";

		$resultado = mysqli_query($conexion, $consulta);

		if(mysqli_num_rows($resultado) == 1)
		{
			$mostrar = mysqli_fetch_array($resultado);

      $doc = $mostrar["doc_cliente"];
      $nom = $mostrar["nom_cliente"];
      $ape = $mostrar["ape_cliente"];
      $dir = $mostrar["dir_cliente"];
      $tel = $mostrar['tel_cliente'];
      $cor = $mostrar["correo_cliente"];
		}
	}



  include('includes/cn.php');
  include('includes/header2.php');
?>

<main class="container p-1">
  	<div class="row">
    <div class="col-md-5">

      <div class="jumbotron">

        <div class="card card-body">
            <form action="actualizar_cliente2.php?id=<?php echo $doc; ?>" method="POST">
              <div class="form-group">
              	<label><h2>Actualizar cliente</h2></label>
                <br>

                <h6>Nombres</h6><input type="text" name="upnom" class="form-control" value="<?php echo $nom; ?>" autofocus required>

                <h6>Apellidos</h6><input type="text" name="upape" class="form-control" value="<?php echo $ape; ?>" required>
              
                <h6>Dirección</h6><input type="text" name="updir" class="form-control" value="<?php echo $dir; ?>" required>
                
                <h6>Telefono</h6><input type="text" name="uptel" class="form-control" value="<?php echo $tel; ?>" required>

                <h6>Email</h6><input type="text" name="upcor" class="form-control" value="<?php echo $cor; ?>" required>

              </div>
              <br>
              <input type="submit" class="btn btn-warning btn-block" value="Actualizar usuario">
              <br>
              <a class="btn btn-danger btn-block" href="clientes.php"><i class="fas fa-window-close"></i> Cancelar</a>
            </form>
          </div>

      </div>
    </div>

    <div class="col-md-6">
    <div align="right">
    <br>
    </div>
    <br><br><br>
    <h1>Actualizar cliente:</h2><br>
    <img src='buscar_imagen_cliente.php?id=<?php echo $mostrar['doc_cliente']?>' alt='Img blob desde MySQL' width='350' /></td>
    <br> 
    <h4><u><?php echo $nom;?></u></h4>
	</div>
