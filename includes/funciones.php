
<script type="text/javascript">
function mostrarPassword()
{
    var cambio = document.getElementById("pass");
    if(cambio.type == "password")
    {
      cambio.type = "text";
      $('.icon').removeClass('far fa-eye').addClass('fa fa-eye');
    }
    else
    {
      cambio.type = "password";
      $('.icon').removeClass('far fa-eye-slash').addClass('far fa-eye-slash');
    }
} 

function habilitararreglo(value)
{
  if(value==true)
  {
    // habilitamos
    document.getElementById("form_arreglos").hidden=false;
  }else if(value==false){
    // deshabilitamos
    document.getElementById("form_arreglos").hidden=true;
  }
}

function habilitarsobremedida(value)
{
  if(value==true)
  {
    // habilitamos
    document.getElementById("form_sobremedidas").hidden=false;
  }else if(value==false){
    // deshabilitamos
    document.getElementById("form_sobremedidas").hidden=true;
  }
}
function reporte_ingreso()
{
  window.open('ticket_venta_inicial.php');
}

function reporte_entrega()
{
  window.open('ticket_venta_final.php');
}

function reporte_caja()
{
  window.open('ticket_reporte_caja.php');
}
</script>