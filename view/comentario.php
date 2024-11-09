<?php 
setlocale(LC_ALL,"es_ES");  
  $modulo = "Seguimiento";
  $nav = '8';

  require_once "../controller/assets/svrurl.php";
  require_once "../controller/assets/inicio.php";
  require_once "../controller/assets/validacion.php";

    //Validacion de login
  $login = new seguridad;
  $login -> seguridadLogin();
  
        $mush_nombre = $_SESSION['mush_nombre'];                    
        $mush_email = $_SESSION['mush_email'];
        $mush_empresa = $_SESSION['mush_empresa'];
        $mush_tipo = $_SESSION['mush_tipo'];
        $mush_genero = $_SESSION['mush_genero'];
        $mush_acceso = $_SESSION['mush_acceso'];

       $id = $_REQUEST['id'];

if ($mush_tipo == "Admin") {
  $pluginCa = "Nohide";
}else{
  $pluginCa = "hide";
}


?>
<!-- Usuario -->
<a id="tipodeusuario" class="hide"><?php echo $mush_tipo ?></a>
<a id="id" class="hide"><?php echo $id ?></a>
<!-- Usuario -->
<?php
////Requerir NAVMENU
require "../controller/assets/menunav.php";
?>

<!-- agregar comentario -->
<script type="text/javascript" src="../controller/assets/js/comentario.js"></script>
<!-- agregar comentario -->

<!--TESTING 1-->
  <div class="row animated fadeIn" style="width: 90% !important;">
  <!--TESTING 1-->
    <div class="row" style="padding-top: 2rem;">
      <div class="col s12">
        <!-- CARD -->
          <div class="card white borde7" style="min-height: 400px; height: auto;">
            <div class="row">

            <div class="row" style="padding-top: 50px;">
              <div class="col s10 offset-s1 m7 offset-m1">
                <h5 class="hide" id="ticketinfo"><?php echo $cl_ticketrq ?></h5>
                <h4 class="comenfont nomargin" style="color:#013244 !important;" id="clticket">Solicitud #<strong id='solicitud_formulario'> <?php echo $id ?> </strong></h4>





                <div class="divider"></div>
                  <br>
                    <h4 class="comenfont nomargin" style="color:#013244 !important;" id="clticket">Estado: <strong id='estado'></strong></h4>
                <h4 class="comenfont nomargin" style="color:#013244 !important;" id="clticket">tipificacion: <strong id='estado2'></strong></h4>
              </div>

              

            </div>
            
            <div class="row col s10 offset-s1">


              <div class="col s12 l7">
                <h6 class="comenfont" style="color: #f08024;font-weight: bolder;" >Datos Del Cliente</h6>
                  
                  <div class="divider"></div>

                <div class="row" style="padding-top: 1.3rem;">
                  <div class="col s4">
                    <span class="titufont marcado" style="font-weight:bold;" >Nombre Del Cliente:</span>
                  </div>
                  <div class="col s8">
                    <span class="arrfont" id="nombre_cliente"></span>
                  </div>
                </div>  


                <div class="row" style="">
                  <div class="col s4">
                    <span class="titufont marcado" style="font-weight:bold;" >Documento:</span>
                  </div>
                  <div class="col s8">
                    <span class="arrfont" id="documento"></span>
                  </div>
                </div>  



                <div class="row" style="">
                  <div class="col s4">
                    <span class="titufont marcado" style="font-weight:bold;" >Telefono:</span>
                  </div>
                  <div class="col s8">
                    <span class="arrfont" id="tel"></span>
                  </div>
                </div>  


                <div class="row" style="">
                  <div class="col s4">
                    <span class="titufont marcado" style="font-weight:bold;" >NIT:</span>
                  </div>
                  <div class="col s8">
                    <span class="arrfont" id="nit"></span>
                  </div>
                </div>  



                <div class="row" style="">
                  <div class="col s4">
                    <span class="titufont marcado" style="font-weight:bold;" >Direccion:</span>
                  </div>
                  <div class="col s8">
                    <span class="arrfont" id="direccion"></span>
                  </div>
                </div>  




                <div class="row" style="">
                  <div class="col s4">
                    <span class="titufont marcado" style="font-weight:bold;" >Correo:</span>
                  </div>
                  <div class="col s8">
                    <span class="arrfont" id="correo"></span>
                  </div>
                </div>  




                

              </div>



              <div class="col s12 l5">
                <h6 class="comenfont" style="color: #f08024;font-weight: bolder;" >Detalle de Solicitud:</h6>
                <div class="divider"></div>

                <div class="row" style="padding-top: 1.3rem;">
                  <div class="col s4">
                    <span class="titufont marcado" style="font-weight:bold;" >Comentario:</span>
                  </div>
                  <div class="col s8">
                    <span class="arrfont" id="entidad_prestamo"></span>
                  </div>
                </div>


                <div class="row" style="padding-top: 1.3rem;">
                  <div class="col s4">
                    <span class="titufont marcado" style="font-weight:bold;" >Agente:</span>
                  </div>
                  <div class="col s8">
                    <span class="arrfont" id="agente"></span>
                  </div>
                </div>


 <div class="row" style="padding-top: 1.3rem;">
                  <div class="col s4">
                    <span class="titufont marcado" style="font-weight:bold;" >Subtipo:</span>
                  </div>
                  <div class="col s8">
                    <span class="arrfont" id="sub"></span>
                  </div>
                </div>

                <div class="row" style="padding-top: 1.3rem;">
                  <div class="col s4">
                    <span class="titufont marcado" style="font-weight:bold;" >Fecha y hora:</span>
                  </div>
                  <div class="col s8">
                    <span class="arrfont" id="fecha_hora"></span>
                  </div>
                </div>








              </div>
            </div>





            
              </div>
            </div>

            </div>

            <!-- Editar y Log -->
            <div class="row col s12" style="position: relative; top: -50px; right: 10px;">
              <div class="right">
                <a class="hide btn-floating btn-large waves-effect waves-light" id="historialticket" style="background-color: #31184a;"><i class="material-icons">history</i></a>
              </div>
            </div>
            <!-- Editar y Log -->

        
          </div>
        <!-- CARD -->
      </div>
    </div>


    <div class="row" style="position: relative; top: -50px;">
        <div class="col s12 l6">
          <div class="card borde7" style="min-height: 300px;">

            <div class="row ">
              <div class="col s10 offset-s1">
                <h6 class="titufont marcado"></h6>
                <h5 class="comenfont nomargin" style="color: #f08024;">Cambiar de Estado</h5>
                <div class="divider"></div>
              </div>
              <div class="col s10 offset-s1">

                  <div class="row"  >
                    <div class="col s10 offset-s1" style="padding-top: 10px;">
                      <h6 class="titufont" style="font-weight: bolder;" >Nuevo Estado:</h6>


                        <form id="form_edition" action="" accept-charset="utf-8">

                                    
                                    <div class="input-field col s12">
                                      <select id="status" name="status" >
                                        <option value="" disabled selected>Seleccione una opcion</option>
                                        <option value="Aprobado">Aprobado</option>
                                        <option value="Sin resoluci贸n">Sin resolucion</option>
                                        <option value="venta finalizada">finalizado</option>
                                      </select>
                                      
                                    </div>


                                    <div class="row center">
                                      <div class="col s11 m7 offset-s10"> 
                                        <input type="submit" id="edit_btn" class="btn fondoacent" value="Guardar" />
                                      </div>
                                    </div> 

    
                        </form>
    






                          <div class="collection hide">
                            <div  id="notassss" >
                            </div>
                          </div>

                    </div>
                  </div> 

                
              </div>   
            </div>

          </div>
        </div>
        <div class="col s12 l6">
           <div class="card borde7" style="min-height: 300px;">
            
            <div class="row">
              <div class="col s10 offset-s1">
                <h6 class="titufont marcado"></h6>
                <h5 class="comenfont nomargin" style="color: #f08024;">Seguimiento</h5>
                <div class="divider"></div>
                  <ul id="comentariosticket" class="collection" style="padding-top: 10px; border-style: solid; border-color: orange; border-radius: 5px; border-width: 1px;">
                    
                  </ul>
              </div>   
            </div>

          </div>         
        </div>
    </div>



  <!--TESTING 1-->  
  </div>
<!--TESTING 1-->


<!--div BOTONTES-->
<div class="fixed-action-btn" style="right: 100px">
  <a class="btn-floating btn-large colorP modal-trigger tooltipped" data-position="top" data-tooltip="Agregar Seguimiento" href="#ticketcomentarios">
    <i class="large material-icons">add_circle_outline</i>
  </a>
</div>
<!--div BOTONTES-->

<!-- MODAL Comentario -->
  <div id="ticketcomentarios" class="modal" style="width: 60% !important;">

  <form id="forcomen" name="forcomen" method="POST" accept-charset="utf-8">
    <div class="modal-content center">
    <div class="row">

    <h4>Crear Comentario</h4>

    </div>

      <div class="row">
        <div class="input-field col s8 offset-s2">
          <textarea id="comentario" name="comentario" placeholder="Comentarios" class="materialize-textarea"></textarea>
        </div>
      </div>

    </div>

      <div class="modal-footer">
        <input type="submit" id="comentar" class="btn fondoacent colorP" value="Comentar"/>
        <a href="#!" class="modal-close waves-effect waves-green btn-flat ">Cerrar</a>
      </div>

    </form>

    </div><!-- MODAL Comentario -->




<!-- SCRIPTS CARGA -->
<?php
  require_once "../controller/assets/scripts.php";
?>
<!-- SCRIPTS CARGA -->

<!-- Actualizacion de datos-->
<script type="text/javascript">
    $(document).ready(function(){
    $('select').formSelect();
    $('.sidenav').sidenav();
    $("select[required]").css({display: "block", height: 0, padding: 0, width: 0, position: 'absolute'});
    $(".dropdown-trigger").dropdown({hover: true});
     $('.tooltipped').tooltip();
  });

function cargaDatos(){

                $.ajax({
                  url: '../controller/db/carga/comentario.php',
                  type: 'POST',
                  dataType: 'json',
                  data: {id: $("#id").text()},
                  cache: 'false',
                  beforeSend:function(){
                      M.toast({html: 'Cargando...', classes: 'rounded colorP', timeRemaining: "50"});
                  }
                })
                .done(function(data){
                    if (data.error == false) {
console.log(data.company);











                      $("#nombre_cliente").text(data.nombre_cliente);
                      $("#documento").text(data.documento);
                      $("#nit").text(data.nit);
                      $("#tel").text(data.tel);
                      $("#direccion").text(data.direccion);
                      $("#correo").text(data.correo);
                      $("#entidad_prestamo").text(data.entidad_prestamo);
                      $("#estatus").text(data.estatus);
                      $("#agente").text(data.agente);
                      $("#fecha_hora").text(data.fecha_hora);
                      $("#estado").text(data.estatus);
                      $("#estado2").text(data.estado);
                      $("#sub").text(data.subtipologia);


                      
              
                      
                      cargaComentarios();

                    }else if (data.error == true){

                      swal ( "Oops" ,  "No encuentro la informacion :C" ,  "info" );

                    }
                })
                .fail(function(errordata){
                  console.log(errordata);
                });

}

function cargaComentarios(){

                $.ajax({
                  url: '../controller/db/carga/comentarios.php',
                  type: 'POST',
                  dataType: 'json',
                  data: {id: $("#id").text()},
                  cache: 'false',
                  beforeSend:function(){
                      M.toast({html: 'Cargando...', classes: 'rounded colorP', timeRemaining: "50"});
                  }
                })
                .done(function(data){
                    if (data.error == false) {

                     $("#comentariosticket").html(data.datos);

                    }
                })
                .fail(function(errordata){
                  console.log(errordata);
                });

}

cargaDatos();






$("#regresarpagina").click(function(event) {
  event.preventDefault();
   history.go(-1);
});




/////Editar ticket
jQuery(document).on('submit', '#form_edition', function(event){
  event.preventDefault();

 // edit_btn
    //$('#editarticketbtn').addClass('disabled');
    var parametros = new FormData($("#form_edition")[0]);
     parametros.append('solicitud', $("#solicitud_formulario").text() );
     parametros.append('estado_inicial', $("#estado").text() );
     parametros.append('cliente', $("#nombre_cliente").text() );
    //agrergamos el array con las guias
    //parametros.append('arrayDatos', arrayGuias);
       
          
              //console.log($("#tipologiaedicion").val());
    
                $.ajax({
                          url: '../controller/db/base/cambio_estado.php',
                          method: 'POST',
                          dataType: 'json',
                          data: parametros,
                          contentType: false,
                          processData: false,
                        
                          beforeSend:function(){

                            /*
                              swal("Editando Informacion del Expediente ", {
                                buttons: false,
                                timer: 3000,
                              });

                              */
                          },
                    
                          success: function(respuesta){
                            


                            if (respuesta.error==1) {
                              swal("Listo", "guardaron los cambios", "success");
                              cargaDatos();
                             
                            }else if(respuesta.error==2){
                              swal("Error", "ha seleccionado el mismo estado", "info");
                            }else if(respuesta.error==3){
                              swal("Alerta", "La solicitud se encuentra en estado Rechazado", "info");
                            }else if(respuesta.error==4){
                              swal("Ops...", "Debe de Seleccionar un estado", "info");
                            }else{
                              swal("Expendiente " + respuesta.expendiente , "Se modifico el expediente con exito", "success");
                              
                            }

                            //$('#editarticketbtn').removeClass('disabled');
                          },
                            error: function(data){
                              swal("Error", "Error al tratar de Editar el Expediente", "error");
                             
                           // $('#editarticketbtn').removeClass('disabled');
                          }
                    
                        });
            });
    




</script>
<!-- Actualizacion de datos-->

<!-- Fin HTML -->
<?php
  require_once "../controller/assets/fin.php";
?>