<?php

include 'includes/header.php';

?>
    <!-- Script para el flexslider-->
<script type="text/javascript" charset="utf-8">
    $(window).load
    (function() 
    {
      $('.flexslider').flexslider(
        {
          touch:true,
          pauseOnAction: false,
          PauseOnHover: false,
        }
        );
    }
    );
</script>

<br>

<main class="container p-1">

	<div class="row">
        <div class="col-md-12">
          <center>
          <h4 class="display-3">Confecciones letti</h4>
          </center>
                <center>
                  <div class="flexslider">
                    <ul class="slides">
                      <li>
                        <img src="imagenes/d1.png">
                        <section class="flex-caption">
                          <p>.</p>
                        </section>
                      </li>
                      <li>
                        <img src="imagenes/d2.png">
                        <section class="flex-caption">
                          <p>.</p>
                        </section>
                      </li>
                      <li>
                        <img src="imagenes/d3.png">
                        <section class="flex-caption">
                          <p>.</p>
                        </section>
                      </li>
                      <li>
                        <img src="imagenes/d4.png">
                        <section class="flex-caption">
                          <p>.</p>
                        </section>
                      </li>
                      <li>
                        <img src="imagenes/d5.png">
                        <section class="flex-caption">
                          <p>.</p>
                        </section>
                      </li>
                      <li>
                        <img src="imagenes/d6.png">
                        <section class="flex-caption">
                          <p>.</p>
                        </section>
                      </li>
                      <li>
                        <img src="imagenes/d7.png">
                        <section class="flex-caption">
                          <p>.</p>
                        </section>
                      </li>
                      <li>
                        <img src="imagenes/d8.png">
                        <section class="flex-caption">
                          <p>.</p>
                        </section>
                      </li>
                      <li>
                        <img src="imagenes/d9.png">
                        <section class="flex-caption">
                          <p>.</p>
                        </section>
                      </li>
                      <li>
                        <img src="imagenes/d10.png">
                        <section class="flex-caption">
                          <p>.</p>
                        </section>
                      </li>
                    </ul>
                  </div>
                </center>
        </div>
    </div>
</main>
</body>
</html>
<?php 
include 'includes/footer.php'
?>