<?php 
setlocale(LC_ALL,"es_ES");  
  $modulo = "Configuracion";
  $nav = '7';

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
<div class="row animated fadeIn">
  <!--Datos-->
  <div class="row center centrado-porcentual" style="margin-top: 40vh;">
    <h5>Estamos para darte un mejor servicio, página en proceso.</h5>
    <i class="fas fa-globe-asia fa-3x fa-spin fontP"></i>
  </div>
</div>
<!--Datos-->
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

  $(document).ready(function () {
    $('.modal').modal();
    $('select').formSelect();
    $('.sidenav').sidenav();
    $("select[required]").css({ display: "block", height: 0, padding: 0, width: 0, position: 'absolute' });
    $(".dropdown-trigger").dropdown({ hover: true });
    $('.tooltipped').tooltip();
    actResponsive();
    $('#seguimiento').DataTable();
    $('select').formSelect();
  });


</script>

<!-- Fin HTML -->
<?php
  require_once "../controller/assets/fin.php";
?>