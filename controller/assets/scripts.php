<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="<?php echo SERVERURL; ?>app/js/sweetalert.min.js"></script>
<script type="text/javascript" src="<?php echo SERVERURL; ?>app/js/push.min.js"></script>
<script type="text/javascript" src="<?php echo SERVERURL; ?>app/js/masonry.min.js"></script>
<script type="text/javascript" src="<?php echo SERVERURL; ?>app/js/materialize.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
  $('.modal').modal({
    startingTop: '10%',
  });

  $('.collapsible').collapsible();

  function actResponsive() {
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

  /* oculto por cambios pruebas vladimir
  function ajaxBusquedaGlobal(){
    //alert("Presionado papa");
    var numeroForm = $("#busquedaOrden").val();
    //console.log("Numero: " + numeroForm);

                    $.ajax({
                    url: '../controller/db/busqueda/busquedaGlobal.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {dato: numeroForm},
                    cache: 'false',
                    beforeSend:function(){
                        M.toast({html: 'Buscando Cliente...', classes: 'rounded colorP', timeRemaining: "50"});
                    }
                  })
                  .done(function(data){
                      if (data.error == false) {

                        $("#busquedaDivA").html(data.datos);

                      }else if (data.error == true){

                        $("#busquedaDivA").html("<span>No hay datos</span>");
                        swal ( ":C" ,  "Error no se encuentra el Cliente" ,  "info" );

                      }
                  })
                  .fail(function(errordata){
                    console.log(errordata);
                  });
  }  


  */



  $("#busquedaOrden").on('keypress', function(e) {
    if (e.which == 13) {
      ajaxBusquedaGlobal();
    }
  });

  $("#busquedaOrdenButton").click(function() {
    ajaxBusquedaGlobal();
  });


  jQuery(document).on('submit', '#form_solicitud', function(event) {
    event.preventDefault();

    var parametros = new FormData($("#form_solicitud")[0]);

    parametros.append("nis", $("#cliente_b").val());
    parametros.append("campana", $("input[name='base']:checked").val());
    parametros.append("tel_1", $("#Ptel_1").text());
    parametros.append("tel_2", $("#Ptel_2").text());
    parametros.append("tel_3", $("#Ptel_3").text());

    $("#btn-formDI").prop("disabled", true);

    console.log('Parametros que estoy mandando en el envio del correo', parametros);

    $.ajax({
        data: parametros,
        url: '../controller/db/base/solicitud.php',
        type: 'POST',
        contentType: false,
        processData: false,
        dataType: 'json',
        beforeSend: function() {
          M.toast({
            html: 'Enviando Solicitud...',
            classes: 'rounded',
            timeRemaining: 50
          });

        }
      })
      .done(function(data) {
        console.log("Datos del response de guardado de ticket", data);
        enviarCorreo(data.ticket);
      })
      .fail(function(errordata) {
        console.log(errordata.responseText + errordata);
        swal("Base de Datos", "Error con base de datos, comunicarse con sistemas", "error");
        $('#buscarformulariousuario').removeClass('disabled');
      });

  });


  //jquery para busqueda de datos
  jQuery(document).on('submit', '#form_busqueda', function(event) {
    event.preventDefault();
    // $('#buscarformulariousuario').addClass('disabled');


    var base = document.querySelector('input[name=base]:checked').value;
    var cliente = $("#cliente_b").val();



    $.ajax({
        data: {
          dato: cliente,
          base: base
        },
        url: '../controller/db/carga/creatproject.php',
        type: 'POST',
        dataType: 'json',
        beforeSend: function() {
          M.toast({
            html: 'Buscando Informacion...',
            classes: 'rounded',
            timeRemaining: 50
          });

        }
      })
      .done(function(data) {
        console.log(data.base);


        if (data.error == false) {

          $("#Pcliente").html(data.cliente);
          $("#Pnombre").html(data.nombre);
          //$("#Pcorreo").html(data.cliente);
          $("#Ptel_1").html(data.tel1);
          $("#Ptel_2").html(data.tel2);
          $("#Ptel_3").html(data.tel3);


          $("#nombre_cliente").val(data.nombre);
          $("#tel_1e").val(data.tel1);
          $("#tel_2e").val(data.tel2);
          $("#tel_3e").val(data.tel3);





          /////Carga de datos cliente
          $("#datosDeCliente").empty();

          console.log(data.datosCliente);

          data.datosCliente.forEach(element => {

            console.log(element);


            $("#datosDeCliente").append(`

  <div class="divider"></div> 
  <div class="row">
            <div class="col s12">
              <h6>Tipologia</h6>
              <span>` + element.tipologia_b + `</span>
            </div>
            <div class="col s12">
              <h6>Nombre del Cliente</h6>
              <span>` + element.nombre_b + `</span>
            </div>
            <div class="col s12">
              <h6>Fecha</h6>
              <span>` + element.fecha_b + `</span>
            </div>
            <div class="col s12">
              <span>Cliente ` + element.cliente_b + `</span>
            </div>
            <div class="col s12">
              <h6>Comentario</h6>
              <span>` + element.comentario_b + `</span>
            </div>                                 
    </div>
    <div class="divider"></div> 
  
  `);
          });


        } else {
          swal("Info", "No se encontraron datos del cliente, valide la informacion", "info");

        }



        /*
        $('#form_solicitud')[0].reset();
        swal ( "Listo" ,  "Se ha guardado los datos de forma Correcta" ,  "success" );
        $("#btn-formDI").prop("disabled", false);
        */
      })
      .fail(function(errordata) {
        console.log(errordata.responseText + errordata);
        swal("Base de Datos", "Error con base de datos, comunicarse con sistemas", "error");
        $('#buscarformulariousuario').removeClass('disabled');
      });

  });


  function cargaDatos() {

    $.ajax({
        url: '../controller/db/carga/actividades.php',
        type: 'POST',
        dataType: 'json',
        data: {},
        cache: 'false',
        beforeSend: function() {
          M.toast({
            html: 'Cargando datos...',
            classes: 'rounded colorP',
            timeRemaining: "50"
          });
        }
      })
      .done(function(data) {
        if (data.error == false) {

          $("#datos").html(data.datos);

        } else if (data.error == true) {

          M.toast({
            html: 'No hay actividades',
            classes: 'rounded colorP',
            timeRemaining: "50"
          });
          $("#datos").html(data.datos);

        }
      })
      .fail(function(errordata) {
        console.log(errordata);
      });
  }


  function cargaSolicitudes() {

    $.ajax({
        url: '../controller/db/carga/solicitudes.php',
        type: 'POST',
        dataType: 'json',
        data: {},
        cache: 'false',
        beforeSend: function() {
          M.toast({
            html: 'Cargando datos...',
            classes: 'rounded colorP',
            timeRemaining: "50"
          });
        }
      })
      .done(function(data) {
        if (data.error == false) {

          $("#carga_solicitudes").html(data.datos);
          $('#seguimiento').DataTable();
          $('select').formSelect();

        } else if (data.error == true) {

          M.toast({
            html: 'No hay datos',
            classes: 'rounded colorP',
            timeRemaining: "50"
          });
          $("#carga_solicitudes").html(data.datos);
          $('#seguimiento').DataTable();
          $('select').formSelect();

        }
      })
      .fail(function(errordata) {
        console.log(errordata);
      });
  }




  function cargaSolicitudes2() {

    $.ajax({
        url: '../controller/db/carga/solicitudes2.php',
        type: 'POST',
        dataType: 'json',
        data: {},
        cache: 'false',
        beforeSend: function() {
          M.toast({
            html: 'Cargando datos...',
            classes: 'rounded colorP',
            timeRemaining: "50"
          });
        }
      })
      .done(function(data) {
        if (data.error == false) {

          $("#carga_solicitudes").html(data.datos);
          $('#seguimiento').DataTable();
          $('select').formSelect();

          console.log("Cargue las solicitudes 2");

        } else if (data.error == true) {

          M.toast({
            html: 'No hay datos',
            classes: 'rounded colorP',
            timeRemaining: "50"
          });
          $("#carga_solicitudes").html(data.datos);
          $('#seguimiento').DataTable();
          $('select').formSelect();

        }
      })
      .fail(function(errordata) {
        console.log(errordata);
      });
  }



  function cargaSolicitudes3() {

    $.ajax({
        url: '../controller/db/carga/solicitudes3.php',
        type: 'POST',
        dataType: 'json',
        data: {},
        cache: 'false',
        beforeSend: function() {
          M.toast({
            html: 'Cargando datos...',
            classes: 'rounded colorP',
            timeRemaining: "50"
          });
        }
      })
      .done(function(data) {
        if (data.error == false) {

          $("#carga_solicitudes").html(data.datos);
          $('#seguimiento').DataTable();
          $('select').formSelect();

          console.log("Cargue las solicitudes 2");

        } else if (data.error == true) {

          M.toast({
            html: 'No hay datos',
            classes: 'rounded colorP',
            timeRemaining: "50"
          });
          $("#carga_solicitudes").html(data.datos);
          $('#seguimiento').DataTable();
          $('select').formSelect();

        }
      })
      .fail(function(errordata) {
        console.log(errordata);
      });
  }



  ///////////boton de busqueda
  $(".busquedaglobal").click(function(event) {
    event.preventDefault();

    swal({
        title: "Busqueda de Solicitud",
        text: "Busqueda por Documento o Nombre.",
        content: "input",
        buttons: {
          cancel: {
            text: "Cancelar",
            value: null,
            visible: true,
            className: "",
            closeModal: true,
          },
          confirm: {
            text: "Buscar",
            value: true,
            visible: true,
            className: "",
            closeModal: false
          }
        },
      })
      .then((value) => {
        if (value == "") {
          swal('No hay datos', "No se ingreso ningun dato", "info");
        } else if (value == null) {

        } else {
          var parametros = {
            "dato": value,
          }
          $.ajax({
            url: '../controller/db/busqueda.php',
            method: 'POST',
            dataType: 'json',
            data: parametros,
            beforeSend: function() {
              /*
                swal("Buscando ticket", {
                  buttons: false,
                  timer: 1500,
                }); */
            },
            success: function(respuesta) {
              var url = "comentario.php";
              if (respuesta.error == false) {

                if (respuesta.datos == "1") {

                  swal.close()
                  window.open(url + '?id=' + respuesta.cl_solicitud, '_blank');

                } else {
                  swal.close()
                  $('#datosbusqueca').html(respuesta.datos);
                  $('#busquedatickets').modal('open');
                }

              } else {
                swal("Oops", "No se encontro ningun ticket", "error");
              }
            },

            error: function(data) {
              swal("Error", "Error busqueda base de datos", "error");
              console.log(data);
            }
          });

        }


      });
  });
  ///////////boton de busqueda
</script>