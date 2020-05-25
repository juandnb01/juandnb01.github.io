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
      $insertar = "insert into empleados(doc_empleado, nom_empleado, ape_empleado, dir_empleado, tel_empleado, correo_empleado, imagen, cod_rol) values 
      ('$doc','$nom','$ape','$dir', '$tel','$cor','$imagenreal','2')";
      //Verificar si el usuario ya existe
      $verificar_empleado = mysqli_query($conexion, "select * from empleados where doc_cliente = '$doc'");
      if (mysqli_num_rows($verificar_empleado) > 0)
      {
      	$_SESSION['message'] = 'El empleado ya se encuentra registrado en la base de datos';
        $_SESSION['message_type'] = 'warning';

        header('Location:empleados.php');
        exit;
      }
      //Ejecutar la consulta del empleado
      $resultado = mysqli_query($conexion,$insertar);
      if (!$resultado)
      {
      	echo "Error al registrar el nuevo empleado";
      }
      else
      {

      	$_SESSION['message'] = 'Empleado creado correctamente';
        $_SESSION['message_type'] = 'success';

        header('Location:empleados.php');
      }
      //Cerrar la conexion de la base de datos
      mysqli_close($conexion);
    }
    else
    {
      $_SESSION['message'] = 'Error, no subio un archivo de imágen valido';
      $_SESSION['message_type'] = 'warning';

      header('Location:empleados.php');
    }
}
?>