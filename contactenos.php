<?php



error_reporting(0);

include 'includes/header.php';

?>
<script type="text/javascript">
function hacer_click()
{
    alert("Cita agendada correctamente");
}
</script>

<br>

<main class="container p-1">
    <div class="row">
        <div class="col-md-6">
            
            <h6 class="display-3">Contáctenos</h6>          
            <div class="jumbotron">
                <h4>Dirección: Carrera 5 # 9 - 32 Fusagasugá / Cundinamarca</h6><br>
                <h4>Email: Confeccionesletti@gmail.com</h6><br>
                <h4>Teléfono: 314 311 0948</h6><br>

            </div>
        </div>

        <div class="col-md-6">            
            <h6 class="display-3">Agende su cita</h6>

            <div class="jumbotron">
            <div class="card card-body">
                  <form action="guardarcita.php" method="POST">
                    <div class="form-group">
                      <input type="text" name="nombre" class="form-control" placeholder="Nombre completo" autofocus required>
                    </div>
                    <div class="form-group">
                      <input type="text" name="correo" class="form-control" placeholder="Correo electrónico" required>
                    </div>
                    <div class="form-group">
                      <input type="text" name="telefono" class="form-control" placeholder="Telefono" required>
                    </div>
                    <div class="form-group">
                      <label>Fecha para agendar la cita</label>
                      <input type="date" name="fecha" class="form-control" min="<?php echo date("Y-m-d");?>" value="<?php echo date("Y-m-d");?>" required>
                    </div>
                    <div class="form-group">
                      <label>Hora para agendar la cita: Entre las 09:30 a.m. y las 5:30 p.m.</label>
                      <input type="time" name="hora" class="form-control" min="09:30" max="17:30" required>
                    </div>
                    <input type="submit" name="enviar" class="btn btn-primary btn-block" value="Agendar" onclick="hacer_click()">
                  </form>
                </div>
            </div>
        </div>

    </div>
</main>
</body>
</html>
<?php 
include 'includes/footer.php'
?>