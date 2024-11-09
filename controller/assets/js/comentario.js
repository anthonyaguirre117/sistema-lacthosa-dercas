////Comentarios
jQuery(document).on('submit', '#forcomen', function(event){
    event.preventDefault(); 

             $('#comentar').addClass('disabled');

                //console.log(parametros);

                $.ajax({
                  url: '../controller/db/comentar.php',
                  type: 'POST',
                  dataType: 'json',
                  data: { id: $("#id").text(), comentario: $("#comentario").val()},
                  cache: 'false',
                  beforeSend:function(){
                      M.toast({html: 'Cargando...', classes: 'rounded colorP', timeRemaining: "50"});
                  }
                })
                .done(function(respuesta){
                    if(respuesta.terror == "no") {

                    $('#ticketcomentarios').modal('close');
                    $('#comentar').removeClass('disabled');

                    swal("Formulario " + respuesta.cl_pedido + " Comentado" , "Se Comento el formulario con exito", "success");
                    $('#forcomen')[0].reset();
                    cargaComentarios()
                    
                    }else if(respuesta.sesion == "0"){

                          swal("Usuario no valido", "No se reconoce el usuario, vuelva iniciar session", "info")
                          .then((value)=>{
                            window.location.href = '../';
                          });
                          $('#comentar').removeClass('disabled');

                    }else{
                      swal("Oops", "No se pudo comentar el formulario", "error");
                    $('#comentar').removeClass('disabled');
                    }

                })
                .fail(function(errordata){
                  console.log(errordata.responseText);
                  swal ( "Base de Datos" ,  "Error con base de datos, comunicarse con sistemas" ,  "error" );
                  $('#comentar').removeClass('disabled');
                });

        });
////Comentarios


