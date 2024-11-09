<?php 
setlocale(LC_ALL,"es_ES");  
  $modulo = "Reporteria";
  $nav = '3';

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
<a id="tipodeusuario" class="hide"><?php echo $mush_tipo ?></a>
<!-- Usuario -->
<?php
////Requerir NAVMENU
require "../controller/assets/menunav.php";
?>


<!-- BODDY -->
<div class="row animated fadeIn"><!--Datos-->
  <form action="../controller/db/reportes/reportebase.php" method="POST" accept-charset="utf-8" style="padding: 20px;"> 
  <!-- Informacion-->
<div class="row">
  <div class="col s12 m12">
    <h4>Reporteria Formularios</h4>
    <div class="divider espabajo"></div>
  </div>
</div>
<!-- Informacion -->


<!--div class="row col s8 offset-s2 center">
<div class="col s12 m4">
    <p>
      <label>
        <input name="tipoRepo" value="Base" type="radio" />
        <span>Base</span>
      </label>
    </p>
</div>

<div class="col s12 m4">
    <p>
      <label>
        <input name="tipoRepo" value="Productos" type="radio"  />
        <span>Productos</span>
      </label>
    </p>
</div>

<div class="col s12 m4">
    <p>
      <label>
        <input name="tipoRepo" value="Motoristas" type="radio" />
        <span>Motoristas</span>
      </label>
    </p>
</div>

</div> 

   <div class="row col s8 offset-s2 center">
          <div class="col s12 m4">
            <p>
              <label>
                <input name="tipoRepo" value="Pymes" type="radio" />
                <span>Pymes</span>
              </label>
            </p>
          </div>

          <div class="col s12 m4">
            <p>
              <label>
                <input name="tipoRepo" value="Fibertec" type="radio" />
                <span>Fibertec</span>
              </label>
            </p>
          </div>

          <div class="col s12 m4">
            <p>
              <label>
                <input name="tipoRepo" value="Gobierno" type="radio" />
                <span>Gobierno</span>
              </label>
            </p>
          </div>


     <div class="col s12 m4 offset-m4 ">
            <p>
              <label>
                <input name="tipoRepo" value="Formulario" type="radio" />
                <span>Formulario</span>
              </label>
            </p>
          </div>
        </div>-->

<div class="row center">
    <div class="col s12 m4 offset-m2 ">
        <span>De</span>
        <input type="text" name="fechain" class="datepicker" placeholder="Ingrese fecha de inicio" class="required">   
    </div>
    <div class="col s12 m4 offset m2 ">
        <span>Hasta</span>
        <input type="text" name="fechades" class="datepicker" placeholder="Ingrese fecha de salida" class="required">
    </div>
  </div>
<div class="row center">
      <div class="col s12">
        <button class="btn waves-effect waves-light colorP" type="submit" name="action">Generar
          <i class="material-icons right">send</i>
        </button>
      </div>

  <!--<div class="row center" style="padding-top: 2vh;">
    <h5>Accesos Rapidos</h5>
    <div class="col s12 m6">
      <a  id="RdiaI" class="btn-floating btn-large waves-effect waves-light red colorP"><i class="material-icons">insert_chart</i></a>
      <br>
      <br>
      <span>Reporte del Mes</span>
    </div>
    <div class="col s12 m6">
      <a id="RmesI" class="btn-floating btn-large waves-effect waves-light red colorP"><i class="material-icons">insert_chart_outlined</i></a>
      <br>
      <br>
      <span>Reporte del dia</span>
    </div>
  </div>-->
</form>
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
    $('select').formSelect();
    $('.sidenav').sidenav();
    $("select[required]").css({display: "block", height: 0, padding: 0, width: 0, position: 'absolute'});
    $(".dropdown-trigger").dropdown({hover: true});
    $('.tooltipped').tooltip();
    actResponsive();
    $('.datepicker').datepicker({
            firstDay: true, 
            format: 'yyyy-mm-dd',
            i18n: {
                months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Set", "Oct", "Nov", "Dic"],
                weekdays: ["Domingo","Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
                weekdaysShort: ["Dom","Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
                weekdaysAbbrev: ["D","L", "M", "M", "J", "V", "S"],
                cancel: 'Cancelar',
                done: 'Ok'
            }
      });
  });


    $("#RmesI").click(function(event) {
      event.preventDefault();
    $.ajax({
      url: '../controller/db/reportes/reportesemana.php',
      type: 'POST',
      data: "",
      beforeSend:function(){
         M.toast({html: 'Creando Reporte...', classes: 'rounded colorP', timeRemaining: "50"});
       }      
    })
    .done(function() {
      window.open('<?php echo SERVERURL; ?>controller/db/reportes/reportesemana.php','_blank' );
    })
    .fail(function() {
      console.log("error");
    })
    
  });

      $("#RdiaI").click(function(event) {
    $.ajax({
      url: '../controller/db/reportes/reportemes.php',
      type: 'POST',
      data: "",
      beforeSend:function(){
        M.toast({html: 'Creando Reporte...', classes: 'rounded colorP', timeRemaining: "50"});
       }
    })
    .done(function() {
      window.open('<?php echo SERVERURL; ?>controller/db/reportes/reportemes.php','_blank' );
    })
    .fail(function() {
      console.log("error");
    })
    
  });

</script>

<!-- Fin HTML -->
<?php
  require_once "../controller/assets/fin.php";
?>