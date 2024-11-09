<?php
$modulo = "Login";

  require_once "controller/assets/validacion.php";

  //Validacion de login
  $login = new seguridad;
  $login -> iniciologin();

  require_once "controller/assets/svrurl.php";
  require_once "controller/assets/inicio.php";

  // numeros aleatorios de login
$num1 = rand(1,10);
$num2 = rand(1,10);


?>
<div class="row animated fadeIn fondowall" style="margin-bottom: 0; background-color: black !important;"><!-- row principal-->

<!-- logo principal-->
<div class="col s12 m5 hide-on-small-only">
  <div class="row center">
    <div class="col s12 m12 push-m3" style="margin-top: 30.5vh;">
      <img src="docs/images/caexlogin.png" alt="CONTROL LOGISTIC" height="150">
      <!--i class="hide fas fa-mountain fa-5x fontP" style="color: #005cb9 !important;" ></i-->
      <h5 class="fontP"> <strong style="color: #9f2738 !important;" >Accede a la aplicación</strong></h5>
    </div>
  </div>
</div>
<!-- logo principal--> 


<!-- CARD BLANCO -->
 <div id="bprin" class="col s12 m7 espacio-especial">

<!-- logo telefono-->
<div class="col s12 hide-on-med-and-up">
  <div class="row center" style="margin-top: 10vh;">
    <img src="docs/images/caexlogin.png" alt="CONTROL LOGISTIC" height="155">
      <!--i class="hide fas fa-mountain fa-5x fontP" style="color: #005cb9 !important;" ></i-->
      <br>
      <br>
     
  </div>
</div>
<!-- logo telefono-->

  <div class="row center">
  <div class="col s12 m12 pull-m1">
    <form id="login" accept-charset="utf-8" action="">
      <div class="row">
        <div class="col s12 m6 offset-m3 left">
          <h4 class="" style="color: black;" >Hola y bienvenido,</h4>
          <h5 class="" style="color: black;" >Por favor logueate!</h5>
        </div>


       

         

      </div>
          <div class="row">
            <div class="col s12 m4">
              <div class="right hide-on-small-only">
                <span class="black-text" style="font-size: 18px; line-height: 65px;">Usuario:</span>
              </div>
              <div class="left hide-on-med-and-up">
                <span class="black-text" style="font-size: 18px;">Correo:</span>
              </div>
            </div>
            <div class="col s12 m8">
              <div class="input-field col s11 m8">
                  <input type="email" name="mail" id="mail" class="validate black-text login-input" required>
              </div>
            </div>
            <div class="col s12 m4">
              <div class="right hide-on-small-only">
                <span class="black-text" style="font-size: 18px; line-height: 65px;">Contraseña:</span>
              </div>
              <div class="left hide-on-med-and-up">
                <span class="black-text" style="font-size: 18px;">Contraseña:</span>

              </div>
              
            </div>


            
            <div class="col s12 m8">
             <div class="input-field col s11 m8">
                <!--<input type="password" name="contra" pattern="[A-Za-z0-9]{1,20}" id="pass" required class="validate black-text login-input"> -->
                <input type="password" name="contra" id="pass" required class="validate black-text login-input" pattern=".{8,25}" title="La contraseña debe tener al menos 8 caracteres, incluyendo letras y números. No se permiten caracteres especiales no estándar.">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col s12 m4">

            </div>


             <!-- Verificador humano -->
        <div class="col s12 m4">
          <div class="left">
            <span class="black-text" style="font-size: 18px;">¿Cuánto es <?php echo $num1; ?>  + <?php echo $num2 ?></span>
          </div>
        </div>
        <div class="col s12 m6">
          <div class="input-field col s11 m6">
            <input type="number" name="human_check" id="human_check" class="validate black-text login-input" required>
            <input type=""  id="sum_result" value= "<?php echo $num1 + $num2; ?>">

          </div>
        </div>
         <!-- Verificador humano -->

         <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Chatbot de Retroalimentación</title>
</head>
<body>
    <div id="chatbot">
        <div id="chat-window">
            <div id="messages"></div>
        </div>
        <input type="text" id="user-input" placeholder="Escribe tu respuesta aquí...">
        <button onclick="sendMessage()">Enviar</button>
    </div>
    <script src="script.js"></script>
</body>
</html>

            <div class="col s12 m8">
              <div class="col s4 offset-s4 m5">
                <div class="left">
                <input type="submit" id="botonlogin" class=" colorP btn-large  white-text" value="Log In"/ style="font-size: 18px; border-radius: 7px;">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
              <div class="col s12 m3 offset-m7">
                <div class="left">
                  <a id="formReset" class="fontP" style="margin-top: 18px;">¿Olvide mi contraseña?</a>
                </div>
              </div>
          </div>
      </form>
    </div>
  </div>
 </div><!-- CARD BLANCO -->

<!-- Derechos reservados -->
<div class="row center hide-on-small-only">
  <div class="col s12" style="position: fixed; bottom: 0;">
    <h6 class="black-text" style="font-size: 12px;">Copyright © 2021 ProntoBPO. Todos los derechos reservados. / <a class="black-text" href="acuerdo.php">Acuerdos de uso de licencia</a></h6>
  </div>
</div>
<!-- Derechos reservados -->

<!-- Derechos reservados -->
<div class="row center hide-on-med-and-up">
  <div class="col s12" style="position: fixed; bottom: 0;">
    <span class="black-text" style="font-size: 12px;">Copyright © 2021 ProntoBPO. Todos los derechos reservados. / <a class="black-text" href="acuerdo.php">Acuerdos de uso de licencia</a></span>
  </div>
</div>
<!-- Derechos reservados -->

  <!-- MODAL reset contraseña -->
<div id="resetcontrasea" class="modal">
  <form  id="formreset" name="formreset" method="POST" accept-charset="utf-8">
    <div class="modal-content center">
      <h4>Reiniciar Contraseña</h4>

        <div class="row">
          <div class="input-field col s12 m8 offset-m2">
          <input type="email" name="email" id="email" required>
          <label for="nombre">Correo Electronico</label>
          </div>
        </div>
      </div>

     <div class="modal-footer">
          <input type="submit" id="resetbtn" class="btn" style="background-color:rgb(133, 13, 22)" value="Cambiar Contraseña"/>
          <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
      </div>
   </form>
</div><!-- MODAL contraseña -->

</div><!-- row principal-->
<!-- row principal-->

<!-- SCRIPTS CARGA -->
<?php
  require_once "controller/assets/scripts.php";
?>
<!-- SCRIPTS CARGA -->


<script> // Verificar si el usuario respondió correctamente a la pregunta
jQuery(document).on("submit", "#login", function (event) {
  event.preventDefault();

  // Verificar si el usuario respondió correctamente a la pregunta
  const humanCheck = parseInt(jQuery("#human_check").val());
  const sum_Check = parseInt(jQuery("#sum_result").val());
  if (humanCheck !== sum_Check) {
    swal("Oops", "Respuesta incorrecta a la pregunta de verificación!", "error");
    return;
  }

  jQuery("#botonlogin").addClass("disabled");

jQuery.ajax({
  url: "controller/db/login.php",
  type: "POST",
  dataType: "json",
  data: jQuery("#login").serialize(),
  cache: "false",
  beforeSend: function () {
    M.toast({
      html: "Cargando...",
      classes: "rounded colorP",
      timeRemaining: 50,
    });
  },
})
  .done(function (data) {
    if (data.acceso == "si") {
      console.log(data);
      window.location.href = "view/index.php";

      //swal ( "PM SCRUM" ,  "Bievenido al sistema" ,  "success" );
      jQuery("#botonlogin").removeClass("disabled");
    } else if (data.acceso == "no") {
      //Usuario Invalido
      swal("Sistema", "Usuario Bloqueado Informar a Desarollo", "info");
      jQuery("#botonlogin").removeClass("disabled");
    } else if (data.error == true) {
      swal("Oops", "Correo o contraseña incorrecta! ", "info");
      jQuery("#botonlogin").removeClass("disabled");
    }
  })
  .fail(function (errordata) {
    console.log(errordata.responseText);
  });
});
</script>

<!-- Fin HTML -->
<?php
require_once "controller/assets/fin.php";
?>
