<?php

include 'includes/header.php';

?>

<body>
<br>
<main class="container p-1">

	<div class="row">

    <div class="col-md-12">
    	<br>
        <div class="jumbotron">
            <center>
                <h1 class="display-3">Seleccione el tipo de usuario</h1>
            </center>
            <br><br>
            <p class="lead"><a class="btn btn-primary btn-lg" href="ingreso_cliente.php" role="button"><i class="fas fa-users"></i> Clientes</a></p>
            <p class="lead">Si usted es cliente de nuestro establecimiento, lo invitamos a ingresar utilizando su número de documento en ambos campos</p>

            <hr class="my-4">
            <p class="lead"><a class="btn btn-primary btn-lg" href="ingreso_usuario.php" role="button"><i class="fas fa-user-lock"></i> Usuarios</a></p>
            <p class="lead">Su usted es empleado de nuestro establecimiento, lo invitamos a ingresar utilizando su usuario y contraseña</p>
            
        </div>
    </div>

  </div>

</main>
</body>
</html>
<?php 
include 'includes/footer.php'
?>