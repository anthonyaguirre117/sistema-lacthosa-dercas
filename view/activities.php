<?php
setlocale(LC_ALL,"es_ES");
  $modulo = "Actividades";
  $nav = '6';

  require_once "../controller/assets/svrurl.php";
  require_once "../controller/assets/validacion.php";
  require_once "../controller/assets/inicio.php";

    //Validacion de login
  $login = new seguridad;
  $login -> seguridadLogin();

        $pm_nombre = $_SESSION['mush_nombre'];                    
        $pm_email = $_SESSION['mush_email'];
        $pm_empresa = $_SESSION['mush_empresa'];
        $pm_tipo = $_SESSION['mush_tipo'];
        $pm_genero = $_SESSION['mush_genero'];
        $pm_acceso = $_SESSION['mush_acceso'];

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
  <div class="col s12 m12">
    <h4>Actividades</h4><span>Ultimas Actividades</span>
    <div class="divider espabajo"></div>
  </div>
  <div class="col s12 m5 hide">
      <div class="input-field col s9">
        <input type="email" name="mail" id="mail" class="validate black-text search-input" placeholder="Search" required>
      </div>
      <a href="#"><i class="fas fa-search fa-2x fontP" style="margin-left: 20px; margin-top: 20px;"></i></a>
  </div>
  <div class="col s12 m4 hide">
    <div class="row center">
      <div class="col s12">
        <a class="waves-effect waves-light btn borde7 colorP" style="margin-top: 20px !important;" href="index.php"><i class="material-icons white-text right">add_box</i>Add project</a>
      </div>
    </div>
  </div>
</div>
<!-- Informacion -->

  <!--Tabla de informacion-->
  <div class="col s12">
  <!--Tabla de informacion
    <div class="card">
      <div class="card-content tablaactivities">
        <ul class="progress-tracker progress-tracker--vertical">
          <li class="progress-step is-complete">
            <span class="progress-marker"><i class="material-icons" style="">cached</i></span>
            <span class="progress-text">
              <div class="row quitarmargen">
                <div class="col s12 ">
                  <div class="center">
                    <strong>Proximo beta 1.2</strong>   
                  </div>
                </div>
              </div>
            </span>
          </li>
   
        </ul>
      </div>
    </div>

  </div>
  
  Tabla de informacion-->


<!--Tabla de informacion-->

  <div id="datos" class="col s12">

    
  </div>


  <!--Tabla de informacion-->



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
    $('#tablainformacion').DataTable();
    $('select').formSelect();
  });


  cargaDatos();

</script>

<!-- Fin HTML -->
<?php
  require_once "../controller/assets/fin.php";
?>
