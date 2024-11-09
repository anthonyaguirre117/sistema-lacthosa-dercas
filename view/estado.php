<?php
setlocale(LC_ALL, "es_ES");
$modulo = "Estado";
$nav = '9';

require_once "../controller/assets/svrurl.php";
require_once "../controller/assets/validacion.php";
require_once "../controller/assets/inicio.php";

//Validacion de login
$login = new seguridad;
$login->seguridadLogin();

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
<div id="bodySecun" class="row animated fadeIn">
  <!--Datos-->


  <div class="row">
    <div class="row animated fadeIn">
      <!--Datos-->
      <form action="../controller/db/reportes/subir_archivo2.php" method="POST" accept-charset="utf-8" style="padding: 20px;" enctype="multipart/form-data">
        <!-- Informacion-->
        <div class="row">
          <div class="col s12 m12">
            <h4>Base de Datos</h4><span>Seleccione el tipo de gestión a subir</span>
            <div class="divider espabajo"></div>
          </div>
        </div>

        <!-- Informacion -->
        <div class="row col s8 offset-s5 center">
          <div class="col s12 m3">
            <p>
              <label>
                <input name="tipoRepo" value="ventas" type="radio" />
                <span>ventas</span>
              </label>
            </p>
          </div>

          

        

          


        </div>




        <table>
          <tr>
            <td class="letra" width="250"><strong>Subir Archivo CSV:</strong></td>
            <td><input type="file" name="archivo"></td>
          </tr>
          <tr>
            <td colspan="2" align="center"><input type="submit" name="enviar" value="SUBIR" class="boton"></td>
          </tr>
        </table>


      </form>
    </div>
    <!--Datos-->
    <!-- BODDY -->




  </div>
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
  $(document).ready(function() {
    $('select').formSelect();
    $('.sidenav').sidenav();
    $("select[required]").css({
      display: "block",
      height: 0,
      padding: 0,
      width: 0,
      position: 'absolute'
    });
    $(".dropdown-trigger").dropdown({
      hover: true
    });
    $('.tooltipped').tooltip();
    actResponsive();
    $('#seguimiento').DataTable();
    $('select').formSelect();
  });

  function responsiveAct() {
    var $masonry = $('#mansoryDiv');
    $masonry.masonry({
      // set itemSelector so .grid-sizer is not used in layout
      ///itemSelector: '.row',
      // use element for option
      columnWidth: '.col',
      // no transitions
      transitionDuration: 0,
      horizontalOrder: true,
    });
  }

  $("#btnAlarm").click(function() {
    $("#notificacionIm").modal("open");
    if ($("#bodySecun").hasClass("animated shake")) {
      $("#bodySecun").removeClass('animated shake');
    } else {
      $("#bodySecun").removeClass('animated fadeIn');
      $("#bodySecun").addClass('animated shake');
    }
    //$("#bodySecun").removeClass('animated shake');
  });
</script>

<!-- Fin HTML -->
<?php
require_once "../controller/assets/fin.php";
?>