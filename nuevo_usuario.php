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
      $user = $_POST["usuario"];
      $nombre = $_POST["nombre"];
      $correo = $_POST["correo"];
      $pass = $_POST["contra"];
      $rol = $_POST['cod_rol'];

      $imagen = $_FILES['image']['tmp_name'];
      $imagenreal = addslashes(file_get_contents($imagen));

      //consulta para insertar
      $insertar = "insert into usuarios(nick, nombre, correo, contra, imagen, cod_rol) values ('$user','$nombre','$correo','$pass', '$imagenreal','$rol')";
      //Verificar si el usuario ya existe
      $verificar_usuario = mysqli_query($conexion, "select * from usuarios where nick = '$user'");
      if (mysqli_num_rows($verificar_usuario) > 0)
      {
      	$_SESSION['message'] = 'El usuario ya se encuentra registrado en la base de datos';
        $_SESSION['message_type'] = 'warning';

        header('Location:usuarios.php');
        exit;
      }
      //Ejecutar la consulta
      $resultado = mysqli_query($conexion,$insertar);
      if (!$resultado)
      {
      	echo "Error al registrar el nuevo usuario";
      }
      else
      {
      	$_SESSION['message'] = 'Usuario creado correctamente';
        $_SESSION['message_type'] = 'success';

        header('Location:usuarios.php');
      }
      //Cerrar la conexion de la base de datos
      mysqli_close($conexion);
    }
    else
    {
      $_SESSION['message'] = 'Error, no subio un archivo de imágen valido';
      $_SESSION['message_type'] = 'warning';

      header('Location:usuarios.php');
    }
}
?>