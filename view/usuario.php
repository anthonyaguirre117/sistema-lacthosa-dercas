<?php

setlocale(LC_ALL, "es_ES");

//Variables de inicio
$modulo = "Usuario";
$nav = '9';

require_once "../controller/assets/svrurl.php";
require_once "../controller/assets/validacion.php";
require_once "../controller/assets/inicio.php";

//Validacion de login
$login = new seguridad;
$login->seguridadLogin();

require "../controller/assets/session.php";

?>
<!-- Usuario -->
<a id="idUsuarioPerfil" class="hide"><?php echo $template_id ?></a>
<a id="correousuarioperfil" class="hide"><?php echo $mush_email ?></a>
<a id="nombreousuarioperfil" class="hide"><?php echo $mush_nombre ?></a>
<a id="tipoousuarioperfil" class="hide"><?php echo $mush_tipo ?></a>
<a id="accesousuarioperfil" class="hide"><?php echo $mush_acceso ?></a>
<!-- Usuario -->
<?php
// Requerir NAVMENU
require "../controller/assets/menunav.php";
?>

<!-- BODDY -->
<div id="bodysecon" class="row">
    <h1>
        <center>Usuario</center>
    </h1>
    <div class="row container">
        <form class="col s12" method="post" id="EditarUsuario">
            <div class="row">
                <!-- Campo para el nombre -->
                <div class="input-field col s6">
                    <input placeholder="Ingrese su nombre" id="template_nombre" name="template_nombre" type="text" class="validate" value="<?php echo $mush_nombre; ?>">
                    <label for="template_nombre">Nombre</label>
                </div>

                <!-- Campo para el email -->
                <div class="input-field col s6">
                    <input placeholder="Ingrese su email" id="template_email" name="template_email" type="email" class="validate" value="<?php echo $mush_email; ?>">
                    <label for="template_email">Email</label>
                </div>
            </div>

            <div class="row">
                <!-- Campo para el tipo -->
                <div class="col s6">
                    <div class="row nomargin">
                        <div class="input-field col s11">
                            <select id="template_tipo" name="template_tipo">
                                <option value="" disabled selected>Seleccione el Tipo de Usuario </option>
                                <option value="Admin" <?php echo ($mush_tipo == 'Admin') ? 'selected' : ''; ?>>Admin</option>
                                <option value="Usuario" <?php echo ($mush_tipo == 'Usuario') ? 'selected' : ''; ?>>Usuario</option>
                                <option value="Supervisor" <?php echo ($mush_tipo == 'Supervisor') ? 'selected' : ''; ?>>Supervisor</option>
                            </select>
                            <label>Tipo de Usuario</label>
                        </div>
                    </div>
                </div>

                <!-- Campo para el acceso -->
                <div class="col s6">
                    <div class="row nomargin">
                        <div class="input-field col s11">
                            <select id="template_acceso" name="template_acceso">
                                <option value="" disabled selected>Seleccione el Nivel de Acceso </option>
                                <option value="0" <?php echo ($mush_acceso == '0') ? 'selected' : ''; ?>>Desbloquear</option>
                                <option value="1" <?php echo ($mush_acceso == '1') ? 'selected' : ''; ?>>Bloquear</option>
                            </select>
                            <label>Nivel de Acceso</label>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                <!-- Campo para la contraseña -->
                <div class="input-field col s6">
                    <input placeholder="Ingrese el contraseña" id="template_contra" name="template_contra" type="password">
                    <label for="template_contra">Contraseña</label>
                </div>

                <!-- Campo para el acceso -->
                <div class="input-field col s6">
                    <input placeholder="Confirme su contraseña" id="template_contraseña" name="template_contraseña" type="password">
                    <label for="template_acceso">Confirme su contraseñá</label>
                </div>

                <div class="row">
                    <div class="col s12">
                        <blockquote>
                            Holis
                        </blockquote>
                    </div>
                </div>


            </div>

            <!-- Campo oculto para el id -->
            <input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $template_id; ?>">


            <!-- Botón para enviar el formulario -->
            <div class="row">
                <div class="input-field col s12">
                    <button type="submit" class="btn waves-effect waves-light colorP">Guardar</button>
                </div>
            </div>
        </form>
    </div>

</div>
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
    });

    jQuery(document).on("submit", "#EditarUsuario", function(event) {
        event.preventDefault();

        // Validar que las contraseñas coincidan
        const contra = jQuery("#template_contra").val();
        const confirmarContra = jQuery("#template_contraseña").val();

        //logica para validar que las contraseñas coincidan
        if (contra !== confirmarContra) {
            swal("Error", "Las contraseñas no coinciden", "error");
            return;
        }

        // Validar que los campos no estén vacíos
        //console.log(jQuery("#EditarUsuario").serializeArray());

        jQuery("#botonEditar").addClass("disabled");

        jQuery.ajax({
                url: "../controller/db/editar_usuario.php",
                type: "POST",
                dataType: "json",
                data: jQuery("#EditarUsuario").serialize(),
                cache: "false",
                beforeSend: function() {
                    M.toast({
                        html: "Guardando cambios...",
                        classes: "rounded colorP",
                        timeRemaining: 50,
                    });
                },
            })
            .done(function(data) {
                if (data.error === false) {
                    swal("Sistema", "Usuario actualizado correctamente!", "success").then(() => {
                        location.reload();
                    });
                    jQuery("#botonEditar").removeClass("disabled");
                } else {
                    swal("Oops", "No se pudo actualizar el usuario. Intenta de nuevo!", "error");
                    jQuery("#botonEditar").removeClass("disabled");
                }
            })
            .fail(function(errordata) {
                console.log(errordata.responseText);
                swal("Error", "Hubo un problema al procesar la solicitud!", "error");
                jQuery("#botonEditar").removeClass("disabled");
            });

    });
</script>
<!-- SCRIPTS  -->


<!-- Fin HTML -->
<?php
require_once "../controller/assets/fin.php";
?>