<?php 
setlocale(LC_ALL,"es_ES");  
  $modulo = "Pedidos";
  $nav = '8';

  require_once "../controller/assets/svrurl.php";
  require_once "../controller/assets/validacion.php";
  require_once "../controller/assets/inicio.php";

    //Validacion de login
  $login = new seguridad;
  $login -> seguridadLogin();
  
        $mush_nombre = $_SESSION['mush_nombre'];                    
        $pmmush_email = $_SESSION['mush_email'];
        $mush_empresa = $_SESSION['mush_empresa'];
        $mush_tipo = $_SESSION['mush_tipo'];
        $mush_genero = $_SESSION['mush_genero'];
        $mush_acceso = $_SESSION['mush_acceso'];
?>
<!-- Usuario -->
<a id="tipodeusuario" class="hide"><?php echo $pm_tipo ?></a>
<!-- Usuario -->
<?php
////Requerir NAVMENU
require "../controller/assets/menunav.php";
?>

<!-- BODDY -->
<div class="row animated fadeIn"><!--Datos-->

<!-- Informacion-->
<div class="row">
  <div class="col s8">
    <h4>Solicitudes</h4>
    <div class="divider espabajo"></div>     
  </div>
  <div class="col s4 hide">
      <div class="input-field col s9">
        <input type="email" name="mail" id="mail" class="validate black-text search-input" placeholder="Realiza tu búsqueda" required>
      </div>
      <a href="#"><i class="fas fa-search fa-2x fontP" style="margin-left: 20px; margin-top: 20px;"></i></a>     
  </div>

  <!-- Sección para el contador de solicitudes -->
  <div class="row">
    <div class="col s12">
      <div class="center" style="margin-top: 20px;">
        <h5>Total de Solicitudes activas: <span id="total_activos" class="blue-text">0</span></h5>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col s12 ">
      


    <div id= "carga_solicitudes">
    </div>
     
 
    </div>
  </div>
</div>


</div>

<?php
  require_once "../controller/assets/scripts.php";
?>
<!-- SCRIPTS CARGA -->

<!-- Actualizacion de datos-->
<script type="text/javascript">
</script>
<!-- Actualizacion de datos-->

<script type="text/javascript" charset="utf-8">

  $(document).ready(function(){
    $('.sidenav').sidenav();
    $("select[required]").css({display: "block", height: 0, padding: 0, width: 0, position: 'absolute'});
    $(".dropdown-trigger").dropdown({hover: true});
    $('.tooltipped').tooltip();
    actResponsive();
    $('select').formSelect();
  });

  $('.verData').change(function() {

  if (this.value == "Cocina") {

    $(".progress-step").removeClass('is-complete');
    $(".progress-step").removeClass('is-active');
    $("#proP").addClass('is-complete');
    $("#proC").addClass('is-active');

  }else if (this.value == "Motorista") {

    $(".progress-step").removeClass('is-complete');
    $(".progress-step").removeClass('is-active');
    $("#proP").addClass('is-complete');
    $("#proC").addClass('is-complete');
    $("#proM").addClass('is-active');

  }else if (this.value == "Entregado") {

    $(".progress-step").removeClass('is-complete');
    $(".progress-step").removeClass('is-active');
    $("#proP").addClass('is-complete');
    $("#proC").addClass('is-complete');
    $("#proM").addClass('is-complete'); 
    $("#proE").addClass('is-complete');

  }

  });
  
  cargaSolicitudes3();

  $(document).ready(function() {
    // Realiza una llamada AJAX para cargar el total de activos
    $.ajax({
        url: '../controller/db/carga/solicitudes3.php', // Cambia esto a la ruta de tu archivo PHP
        method: 'GET', // o 'POST', según necesites
        dataType: 'json',
        success: function(response) {
            if (response.error) {
                console.error('Ha ocurrido un error: ' + response.message);
                // Manejar el error si fuera necesario
            } else {
                // Actualiza el total de activos en el HTML
                $('#total_activos').text(response.total_activos);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error de AJAX: ' + error);
        }
    });
});

</script>

<!-- Fin HTML -->
<?php
  require_once "../controller/assets/fin.php";
?>