<?php
$modulo = "Login";

  require_once "controller/assets/validacion.php";

  //Validacion de login
  $login = new seguridad;
  $login -> iniciologin();

  require_once "controller/assets/svrurl.php";
  require_once "controller/assets/inicio.php";

?>
<div class="row animated fadeIn fondowall" style="margin-bottom: 0;"><!-- row principal-->

<!-- logo principal-->
<div class="col s12 m4 hide-on-small-only">
  <div class="row center">
    <div class="col s12 m12 push-m3" style="margin-top: 27.5vh;">
      <i class="fab fa-rebel  fa-10x fontP"></i>
      <h2 class="fontP"> <strong>RR<strong class="accentfP">H</strong>H</strong></h2>
      <span class="fontP">Acuerdos de uso de licencia</span>
    </div>
  </div>
</div>
<!-- logo principal--> 


<!-- CARD BLANCO -->
 <div id="bprin" class="col s12 m8 espacio-especial">

<!-- logo telefono-->
<div class="col s12 hide-on-med-and-up">
  <div class="row center" style="margin-top: 10vh;">
      <i class="fab fa-rebel  fa-5x fontP"></i>
      <br>
      <br>
      <span class="fontP"> <strong>RR<strong class="accentfP">H</strong>H</strong></span>
  </div>
</div>
<!-- logo telefono-->

  <div class="row center">
  <div class="col s12 m12 pull-m1">
      <div class="row">
        <div class="col s12 m10 offset-m2 left">
          <h4 class="fontP">Acuerdos de uso de licencia</h4>
          <iframe  src = "./docs/acuerdo.pdf" allowfullscreen webkitallowfullscreen style="width: 100%; height: 50vh;"></iframe>
        </div>
      </div>
    </div>
  </div>
 </div><!-- CARD BLANCO -->




</div><!-- row principal-->
<!-- row principal-->

<!-- SCRIPTS CARGA -->
<?php
  require_once "controller/assets/scripts.php";
?>
<!-- SCRIPTS CARGA -->
<script type="text/javascript" src="<?php echo SERVERURL; ?>app/js/login.js"></script>

<script type="text/javascript">
   $(document).ready(function(){
      $('select').formSelect();
      $('#resetcontrasea').modal();
      $("select[required]").css({display: "block", height: 0, padding: 0, width: 0, position: 'absolute'});
    });
</script>



<!-- Fin HTML -->
<?php
  require_once "controller/assets/fin.php";
?>
