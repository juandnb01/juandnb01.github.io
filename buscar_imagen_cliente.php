<?php
if(!empty($_GET['id']))
{
    $id = $_GET['id'];
    //Credenciales de conexion
    include 'includes/cn.php';
    
    //Extraer imagen de la BD mediante GET
    $consulta = "SELECT imagen FROM clientes WHERE doc_cliente = $id";
    $resultado = mysqli_query($conexion, $consulta);
    
    if(mysqli_num_rows($resultado) > 0)
    {
        $imgDatos = mysqli_fetch_assoc($resultado);
        
        //Mostrar Imagen
        header("Content-type: image/jpg"); 
        echo $imgDatos['imagen']; 
    }
    else
    {
        echo 'Imagen no existe...';
    }
}
?>