<?php 
setlocale(LC_ALL,"es_ES");  
  $modulo = "Pedidos";
  $nav = '2';

  require_once "../controller/assets/svrurl.php";
  require_once "../controller/assets/validacion.php";
  require_once "../controller/assets/inicio.php";

    //Validacion de login
  $login = new seguridad;
  $login -> seguridadLogin();
  
  $mush_nombre = $_SESSION['mush_nombre'];                    
  $mush_email = $_SESSION['mush_email'];
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
  <div class="row hide">
    <div class="col s10 offset-s1">
      <div class="center">        
        <ul class="progress-tracker progress-tracker--text progress-tracker--text-inline progress-tracker--spaced">
          <li id="proP" class="progress-step is-complete">
            <span class="progress-marker"><i class="material-icons Small">input</i></span>
            <span class="progress-text">
              <h5 class="progress-title truncate tooltipped" data-position="top" data-tooltip="Ingreso">Ingresados <h5>0</h5> </h5>              
            </span>
          </li>

          <li id="proC" class="progress-step is-complete">
            <span class="progress-marker"><i class="material-icons Small">done_all</i></span>
            <span class="progress-text">
              <h5 class="progress-title truncate tooltipped" data-position="top" data-tooltip="Revisión">Revisada <h5>0</h5></h5>
            </span>
          </li>

          <li id="proM" class="progress-step is-complete">
            <span class="progress-marker"><i class="material-icons Small">beenhere</i></span>
            <span class="progress-text">
              <h5 class="progress-title truncate tooltipped" data-position="top" data-tooltip="Confirmada">Aceptada <h5>0</h5></h5>
            </span>
          </li>

          <li id="proE" class="progress-step is-complete">
            <span class="progress-marker"><i class="material-icons Small">clear</i></span>
            <span class="progress-text">
              <h5 class="progress-title truncate tooltipped" data-position="top" data-tooltip="Denegada">Rechazada<h5>0</h5></h5>
            </span>
          </li>

        </ul>       
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col s12 ">
      

    
    <div id= "carga_solicitudes">
    </div>
     
      <!--
     <table id="seguimiento" class="striped responsive-table centered">
        <thead>
          <tr>
              <th>Codigo</th>
              <th>No.</th>
              <th>Empresa</th>
              <th>Nombre</th>
              <th>Estado</th>
              <th>Puesto</th>
              <th>Centro de Costo</th>
              <th>Días a la fecha</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td colspan="8"><strong>Proximo beta 1.2</strong>     
          </tr>               
        </tbody>
      </table>
 
  -->
    </div>
  </div>
</div>
<!-- Informacion -->


</div><!--Datos-->
<!-- BODDY -->





<!-- SCRIPTS CARGA -->
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
  
  cargaSolicitudes();

</script>

<!-- Fin HTML -->
<?php
  require_once "../controller/assets/fin.php";
?>