<?php
header('Access-Control-Allow-Origin: https://api.smart-json.com/v1/fel/certify-dte-global-json/');
header("Access-Control-Allow-Headers: x-api-key, Content-Type, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST");
header("Allow: GET, POST");
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
  die();
}

setlocale(LC_ALL, "es_ES");
$modulo = "Formulario";
$nav = '0';

require_once "../controller/assets/svrurl.php";
require_once "../controller/assets/validacion.php";
require_once "../controller/assets/inicio.php";

//Validacion de login
$login = new seguridad;
$login->seguridadLogin();

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
<div id="bodysecon" class="row">
  <!--Datos-->

  <div class="row hide">
    <div class="col s12 m4 cardasignados">
      <div class="card">
        <div class="card-content">
          <h5> <strong> Ultimos Datos</strong></h5>
          <div id="datosDeCliente">
            <h5>Ingresa el numero de cliente.</h5>
          </div>
        </div>
      </div>
    </div>
    <div class="col s12 m8">
      <!--Elegir tipo de base -->
      <div class="row center nomargin">
        <div class="col s12">
          <div class="card">
            <div class="card-content">
              <h5>¡Selecciona la base que deseas tipificar!</h5>

              <div class="row">
                <div class="col s12 m 12">
                  <p>
                    <label>
                      <input name="base" value="Ventas" class="baseForm" type="radio" />
                      <span>Ventas</span>
                    </label>
                  </p>
                </div>


              </div>


            </div>
          </div>
        </div>
      </div>
      <!--Elegir tipo de base -->

      <!-- Editar y Log -->
      <div class="row col s12" style="position: relative; top: -50px; right: 10px;">
        <div class="right">
          <a class="hide btn-floating btn-large waves-effect waves-light" id="historialticket" style="background-color: #31184a;"><i class="material-icons">history</i></a>
        </div>
      </div>
      <!-- Editar y Log -->

      <!-- CARD -->
    </div>
    <!-- CARD -->

  </div>

</div>

</div>
</div>

<!--tipificador-->
<div id="tipificador" class="row center ">
  <div class="col s12">
    <div class="card white borde7" style="min-height: 600px; height: auto;">

      <form method="POST" accept-charset="utf-8" id="form_solicitud">

        <div class="row nomargin center">

          <div class="col s12 container centered" style="margin-top: 4vh;">

            <div class="col s12  m6 offset-4">
              <div class="input-field col s12">
                <input type="text" name="nombre_cliente" id="nombre_cliente" title="Ingrese nombre y apellidos" class="black-text project-input" autocomplete="off" placeholder="Ingrese el Nombre del cliente" required>
              </div>
            </div>

            <div class="col s12  m6">
              <div class="input-field col s12">
                <input type="text" name="dpi" id="dpi" title="Ingrese el documento del cliente " class="black-text project-input" autocomplete="off" placeholder="Ingrese el Documento del cliente" required>
              </div>
            </div>


            <div class="col s10  m6 ">
              <div class="input-field col s12">
                <input type="text" name="nit" id="nit" title="Ingrese el NIT del cliente" class="black-text project-input" autocomplete="off" placeholder="Ingrese NIT" required>
              </div>
            </div>

            <div class="col s10  m6 ">
              <div class="input-field col s12">
                <input type="text" name="tel" id="tel" title="Ingrese telefono del Cliente" class="black-text project-input" autocomplete="off" placeholder="Ingrese telefono del cliente " pattern='[0-9]+' required>
              </div>
            </div>

            <div class="col s10  m12">
              <div class="input-field col s12 m12 ">
                <textarea type="text" name="direccion" id="direccion" class="black-text project-input" placeholder="Direccion del cliente" style="height: 5rem; width: 102% !important;" required></textarea>
              </div>
            </div>

            <div class="col s12 m6 ">
              <div class="input-field col s12">
                <input type="text" name="correo" id="correo" title="Ingrese un correo valido Ej: pruebas@mail.com" class="black-text project-input" autocomplete="off" placeholder="Correo Del Cliente" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}">
              </div>
            </div>

            <div class="col s10  m6">
              <div class="input-field col s12">
                <input type="text" name="entidadPrestamo" id="entidadPrestamo" title="DUI" class="black-text project-input" autocomplete="off" placeholder="Comentario" required>
              </div>
            </div>


            <div class="col s12 m6 ">

              <div class="input-field col s12">
                <select name="pais" id="pais" required>
                  <option value="" disabled selected>Selecciona un país</option>
                  <option value="Guatemala">Guatemala</option>
                  <option value="Nicaragua">Nicaragua</option>
                  <option value="Honduras">Honduras</option>
                  <option value="El Salvador">El Salvador</option>

                  <!-- Añade más opciones según sea necesario -->
                </select>

              </div>
            </div>

            <!--Elegir tipo de gestion -->
            <div class="row center nomargin">
              <div class="col s12">
                <h6>¡Selecciona Tipo de Gestión!</h6>

                <div class="row">
                  <div class="col s2">
                    <p>
                      <label>
                        <input name="tipo_de_gestion" value="Clientes existentes" class="btnGestion" type="radio" />
                        <span>Clientes existentes</span>
                      </label>
                    </p>
                  </div>
                  <div class="col s2">
                    <p>
                      <label>
                        <input name="tipo_de_gestion" value="Clientes prospecto" class="btnGestion" type="radio" />
                        <span>Clientes prospecto</span>
                      </label>
                    </p>
                  </div>
                  <div class="col s2">
                    <p>
                      <label>
                        <input name="tipo_de_gestion" value="Informacion General" class="btnGestion" type="radio" />
                        <span>Informacion General</span>
                      </label>
                    </p>
                  </div>
                  <div class="col s2">
                    <p>
                      <label>
                        <input name="tipo_de_gestion" value="Productos" class="btnGestion" type="radio" />
                        <span>Productos</span>
                      </label>
                    </p>
                  </div>

                  <div class="col s2">
                    <p>
                      <label>
                        <input name="tipo_de_gestion" value="Promociones y campanas" class="btnGestion" type="radio" />
                        <span>Promociones y campañas</span>
                      </label>
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <!--Elegir tipo de gestion -->

            <!--Contactable-->
            <div class="input-field col m4 offset-m1">
              <select id="tipologia_f" name="tipologia_f" required>
                <option value="" disabled selected>Selecciona Tipología</option>

              </select>
            </div>

            <div class="input-field col m4 offset-m1">
              <select id="regionf" name="regionf" required>
                <option value="" disabled selected>Selecciona region</option>
              </select>
            </div>
            <!--Contactable-->

            <!---Procesos internos-->

            <!---Procesos internos-->
          </div>
        </div>

        <div class="col s12" style="margin-top: 2vh;">
          <div class="col s4 offset-s4 m12">
            <div class="center">
              <input type="submit" id="btn-formDI" name="action" class="btn-large  white-text" value="Guardar" style="font-size: 18px; border-radius: 7px;background-color:#bc1119 ;">
            </div>
          </div>

        </div>

      </form>
    </div>

  </div>

</div>
</div>
<!--tipificador-->

</div>
<!--Datos-->
<!-- BODDY -->

<!-- SCRIPTS CARGA -->
<?php
require_once "../controller/assets/scripts.php";
?>
<!-- SCRIPTS CARGA -->

<!-- SCRIPTS -->
<script>
  $(document).ready(function() {

    $('select').formSelect();
    $('.tabs').tabs();
    $('.sidenav').sidenav();
    $("select[required]").css({
      display: "block",
      height: 0,
      padding: 0,
      width: 0,
      position: 'absolute'
    });
    $("#dropdownuser").dropdown({
      hover: true
    });

    $('.datepicker').datepicker({
      firstDay: true,
      format: 'yyyy-mm-dd',
      i18n: {
        months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
        monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Set", "Oct", "Nov", "Dic"],
        weekdays: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
        weekdaysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
        weekdaysAbbrev: ["D", "L", "M", "M", "J", "V", "S"],
        cancel: 'Cancelar',
        done: 'Ok'
      }
    });


    setTimeout(function() {
      $("#bodysecon").removeClass('hide');
    }, 1);
    setTimeout(function() {
      $("#bodysecon").addClass('animated fadeIn');
    }, 1);
  });



  ///////Carga de datos

  $(".btnGestion").on('change', function() {


    var datoArreglar = this.value;

    //console.log(datoArreglar);


    $.ajax({
        url: "./../controller/db/busqueda/tipologia.php",
        type: 'POST',
        dataType: 'json',
        data: {
          datos: datoArreglar
        },
        cache: 'false',
        beforeSend: function() {
          $('#tipologia_f').empty();
        }
      })
      .done(function(data) {
        if (data.error == false) {

          var numDatosExtra = data.tipologias;
          //console.log(numDatosExtra);

          $("#tipologia_f").append('<option value="" disabled selected>Selecciona Tipología</option>');
          for (var i = 0; i < numDatosExtra.length; i++) {
            $("#tipologia_f").append(new Option(numDatosExtra[i], numDatosExtra[i]));
            $('#tipologia_f').formSelect();
          }

        }

      })
      .fail(function(errordata) {
        console.log(errordata);
      });
  });

  ///////////////////////////////////////////////////////////////////////

  $("#tipologia_f").on('change', function() {

    urlD = '../controller/db/busqueda/sub_tipologia.php';


    $.ajax({
        url: urlD,
        type: 'POST',
        dataType: 'json',
        data: {
          datos: this.value
        },
        cache: 'false',
        beforeSend: function() {
          $('#sub_tipologia_f').empty();

        }
      })
      .done(function(data) {
        if (data.error == false) {

          // producto2f();
          var numDatosExtra = data.Sub_tipologias;
          $("#sub_tipologia_f").append('<option value="" disabled selected>Selecciona Sub-Tipología</option>');
          for (var i = 0; i < numDatosExtra.length; i++) {
            $("#sub_tipologia_f").append(new Option(numDatosExtra[i], numDatosExtra[i]));
            $('#sub_tipologia_f').formSelect();
          }

        }
      })
      .fail(function(errordata) {
        console.log(errordata);
      });
  });

  ////////////////////////////////////////////////////////////////////////

  // Ejemplo de JavaScript utilizando jQuery para la solicitud AJAX
  $(document).ready(function() {
    $('#tipologia_f').change(function() {
      var pais = $('#pais').val();
      var tipo_de_gestion = $('input[name="tipo_de_gestion"]:checked').val();
      var tipologia_f = $('#tipologia_f').val();

      // Realizar solicitud AJAX
      $.ajax({
        type: 'POST',
        url: '../controller/db/busqueda/region.php', // Ruta a tu backend
        data: {
          pais: pais,
          tipo_de_gestion: tipo_de_gestion,
          tipologia_f: tipologia_f
        },
        dataType: 'json',
        success: function(response) {
          if (response.error) {
            console.error('Error al cargar regiones: ' + response.message);
          } else {
            console.log("datos que debo cargar", response.grupos);
            // Limpiar y cargar opciones en el select de regionf
            $('#regionf').empty().append('<option value="" disabled selected>Selecciona region</option>');
            $.each(response.grupos, function(index, item) {
              $('#regionf').append('<option value="' + item + '">' + item + '</option>');
              $('#regionf').formSelect();
            });
          }
        },
        error: function(xhr, status, error) {
          console.error('Error al cargar regiones: ' + error);
        }
      });
    });
  });



  ///////////////////////////////////////////////////////////////////////////

  function enviarCorreo(ticket) {

    console.log("Recibo el numero de ticket", ticket);
    // Aquí puedes recopilar cualquier dato adicional que necesites enviar, por ejemplo, campos del formulario
    // Recopila los datos desde los campos del formulario
    var pais = $('#pais').val();
    var tipo_de_gestion = $('input[name="tipo_de_gestion"]:checked').val();
    var tipologia_f = $('#tipologia_f').val();
    var regionf = $('#regionf').val();
    var ticket = ticket;

    // Envío de la solicitud AJAX
    $.ajax({
      url: "../correo/notificacion.php",
      type: "POST",
      data: {
        tipo_de_gestion: tipo_de_gestion,
        tipologia_f: tipologia_f,
        pais: pais,
        regionf: regionf,
        ticket: ticket
      },
      success: function(response) {
        console.log("Respuesta del servidor: ", response);
        $('#form_solicitud')[0].reset();
        swal("Listo", "Se ha guardado los datos de forma Correcta", "success");
        $("#btn-formDI").prop("disabled", false);
      },
      error: function(xhr, status, error) {
        console.error("Error en la solicitud: ", error);
      }
    });
  }

  ///////////////////////////////////////////////////////////////////////////
</script><!-- SCRIPTS  -->


<!-- Fin HTML -->
<?php
require_once "../controller/assets/fin.php";
?>