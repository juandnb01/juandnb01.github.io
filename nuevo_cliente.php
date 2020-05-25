<?php
  session_start();
  $varsession = $_SESSION['usuario'];
  
  if($varsession == null || $varsession = '')
  {
    header ("location:error_sesion.php");
    die();
  }

include 'includes/cn.php';
//recibir los datos y almacenarlos en variables

if(isset($_POST["submit"]))
{
    $revisar = getimagesize($_FILES["image"]["tmp_name"]);

    if($revisar !== false)
    {
      $doc = $_POST["documento"];
      $nom = $_POST["nombres"];
      $ape = $_POST["apellidos"];
      $dir = $_POST["direccion"];
      $tel = $_POST['telefono'];
      $cor = $_POST["correo"];

      $imagen = $_FILES['image']['tmp_name'];
      $imagenreal = addslashes(file_get_contents($imagen));

      //consulta para insertar
      $insertar = "insert into clientes(doc_cliente, nom_cliente, ape_cliente, dir_cliente, tel_cliente, correo_cliente, imagen, medidas_cliente, cod_rol) values 
      ('$doc','$nom','$ape','$dir', '$tel','$cor','$imagenreal','$doc','3')";
      //Verificar si el usuario ya existe
      $verificar_usuario = mysqli_query($conexion, "select * from clientes where doc_cliente = '$doc'");
      if (mysqli_num_rows($verificar_usuario) > 0)
      {
      	$_SESSION['message'] = 'El cliente ya se encuentra registrado en la base de datos';
        $_SESSION['message_type'] = 'warning';

        header('Location:clientes.php');
        exit;
      }
      //creamos las medidas para el cliente
      $insertarmedida = "insert into medidas (doc_medidas, a_espalda, cbusto, cpecho, cintura_cam, c_base_cam, l_manga, l_total_cam, cintura_pan, c_base_pan, rodilla, bota, l_total_pan) values ('$doc','0','0','0','0','0','0','0','0','0','0','0','0')";
      	$resultado2 = mysqli_query($conexion, $insertarmedida);
      //Ejecutar la consulta del cliente
      $resultado = mysqli_query($conexion,$insertar);
      if (!$resultado)
      {
      	echo "Error al registrar el nuevo cliente";
      }
      else
      {

      	$_SESSION['message'] = 'Cliente creado correctamente';
        $_SESSION['message_type'] = 'primary';

        header('Location:clientes.php');
      }
      //Cerrar la conexion de la base de datos
      mysqli_close($conexion);
    }
    else
    {
      $_SESSION['message'] = 'Error, no subio un archivo de imágen valido';
      $_SESSION['message_type'] = 'danger';

      header('Location:clientes.php');
    }
}
?>