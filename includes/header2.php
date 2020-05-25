<?php

//variable $id para hacer el if y permitir o no ver los botones
$id = $_SESSION['id'];

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!-- Inserto my propio bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    <!-- Para los iconos personalizados FONT AWESOEM -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  </head>

<?php 
if($_SESSION['rol']==1 or $_SESSION['rol']==2) 
{ 
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<?php 
} 
?>

<?php 
if($_SESSION['rol']==3) 
{ 
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<?php 
} 
?>
  
  <a class="navbar-brand" href="#"></a>
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor02">
    <ul class="navbar-nav mr-auto">

      <li class="nav-item active">
          <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            <button type="button" class="btn btn-secondary "> <i class="fas fa-users"></i> Clientes</button>
            <div class="btn-group" role="group">
              <button id="btnGroupDrop2" type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
              <div class="dropdown-menu" aria-labelledby="btnGroupDrop2" x-placement="bottom-start">
                <?php if($_SESSION['rol']==1 or $_SESSION['rol']==2) { ?>
                <a class="dropdown-item" href="clientes.php"><i class="fas fa-exchange-alt"></i> Gestion clientes</a>
                <?php } ?>
                <?php if($_SESSION['rol']==3) { ?>               
                <a class="dropdown-item" href="clientes_clientes.php">Servicios para clientes</a>
                <?php } ?>
              </div>
            </div>
          </div>
        </li>

      <?php 
      if($_SESSION['rol']==1 or $_SESSION['rol']==2) 
      { 
      ?>
        <li class="nav-item active">
          <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            <button type="button" class="btn btn-secondary "><i class="fas fa-user"></i> Empleados</button>
            <div class="btn-group" role="group">
              <button id="btnGroupDrop2" type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
              <div class="dropdown-menu" aria-labelledby="btnGroupDrop2" x-placement="bottom-start">
                <a class="dropdown-item" href="empleados.php"><i class="fas fa-exchange-alt"></i> Gestión empleados</a>
                <a class="dropdown-item" href="turnos.php"><i class="far fa-save"></i> Registro de turnos</a>
                <a class="dropdown-item" href="consultar_turnos.php"><i class="fas fa-search"></i> Consulta de turnos</a>
              </div>
            </div>
          </div>
        </li>
        
        <li class="nav-item active">
          <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            <button type="button" class="btn btn-secondary "> <i class="fas fa-user-lock"></i> Usuarios</button>
            <div class="btn-group" role="group">
              <button id="btnGroupDrop2" type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
              <div class="dropdown-menu" aria-labelledby="btnGroupDrop2" x-placement="bottom-start">
                <a class="dropdown-item" href="usuarios.php"><i class="fas fa-exchange-alt"></i> Gestión usuarios</a>          
              </div>
            </div>
          </div>
        </li>

        <li class="nav-item active">
          <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            <button type="button" class="btn btn-secondary "><i class="fas fa-cogs"></i> Servicios</button>
            <div class="btn-group" role="group">
              <button id="btnGroupDrop2" type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
              <div class="dropdown-menu" aria-labelledby="btnGroupDrop2" x-placement="bottom-start">
                <a class="dropdown-item" href="ventas.php"><i class="fas fa-clipboard-check"></i> Nuevo servicio</a>
                <a class="dropdown-item" href="consultar_arreglos.php"><i class="fab fa-servicestack"></i> Servicios por entregar</a>
                <a class="dropdown-item" href="consultar_arreglos_entregados.php"><i class="far fa-share-square"></i> Servicios entregados</a>
              </div>
            </div>
          </div>
        </li>

        <li class="nav-item active">
          <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            <button type="button" class="btn btn-secondary "><i class="fas fa-dollar-sign"></i> Caja</button>
            <div class="btn-group" role="group">
              <button id="btnGroupDrop2" type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
              <div class="dropdown-menu" aria-labelledby="btnGroupDrop2" x-placement="bottom-start">               
                <a class="dropdown-item" href="caja.php"><i class="fas fa-dollar-sign"></i> Caja diaria</a>
                <a class="dropdown-item" href="caja_mes.php"><i class="fas fa-dollar-sign"></i> Caja mensual</a>
                <a class="dropdown-item" href="caja_reporte.php"><i class="fas fa-dollar-sign"></i> Reportes de caja</a>
                <a class="dropdown-item" href="pago_turnos.php"><i class="fas fa-dollar-sign"></i> Reporte de turnos</a>
                <a class="dropdown-item" href="caja_egresos_diario.php"><i class="fas fa-dollar-sign"></i> Caja egresos diario</a>
                <a class="dropdown-item" href="caja_egresos_mensual.php"><i class="fas fa-dollar-sign"></i> Caja egresos mensual</a>
              </div>
            </div>
          </div>
        </li>

        <li class="nav-item active">
          <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            <button type="button" class="btn btn-secondary "><i class="fas fa-boxes"></i> Inventario</button>
            <div class="btn-group" role="group">
              <button id="btnGroupDrop2" type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
              <div class="dropdown-menu" aria-labelledby="btnGroupDrop2" x-placement="bottom-start">
                <a class="dropdown-item" href="inventario.php"><i class="fas fa-sign-in-alt"></i> Consultar inventario</a>         
              </div>
            </div>
          </div>
        </li>

        
      <?php 
      } 
      ?>
      

        <li class="nav-item active">
          <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            <button type="button" class="btn btn-secondary "><i class="fas fa-server"></i> Agenda</button>
            <div class="btn-group" role="group">
              <button id="btnGroupDrop2" type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
              <div class="dropdown-menu" aria-labelledby="btnGroupDrop2" x-placement="bottom-start">
                <?php if($_SESSION['rol']==3) { ?>
                <a class="dropdown-item" href="comentario.php"><i class="fas fa-calendar-plus"></i> Nuevo comentario</a>
                <?php } ?>
                <?php if($_SESSION['rol']==1 or $_SESSION['rol']==2) { ?>
                <a class="dropdown-item" href="consultar_citas.php"><i class="fas fa-search"></i> Consultar citas</a>
                <a class="dropdown-item" href="consultar_comentarios.php"><i class="fas fa-search"></i> Consultar comentarios</a>

                <?php } ?>
              </div>
            </div>
          </div>
        </li>

        <?php if($_SESSION['rol']==1 or $_SESSION['rol']==2) { ?>
        <li class="nav-item active">
          <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            <button type="button" class="btn btn-secondary "><i class="fas fa-file-invoice"></i> Facturación</button>
            <div class="btn-group" role="group">
              <button id="btnGroupDrop2" type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
              <div class="dropdown-menu" aria-labelledby="btnGroupDrop2" x-placement="bottom-start">
                <a class="dropdown-item" href="reim_fac_ingreso.php"><i class="far fa-file-pdf"></i> Reimprimir factura ingreso</a>
                <a class="dropdown-item" href="reim_fac_entrega.php"><i class="fas fa-file-pdf"></i> Reimprimir factura entrega</a>                
              </div>
            </div>
          </div>
        </li>
        <?php } ?>
        
    </ul>

    <form class="form-inline my-2 my-lg-0">
      <a class="btn btn-secondary " href="cerrar_sesion.php"><i class="fas fa-times-circle"></i> Cerrar sesión</a>
    </form>
    
  </div>
</nav>