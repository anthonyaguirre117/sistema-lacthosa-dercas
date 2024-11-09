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
            <form action="../controller/db/reportes/subir_archivo2.php" method="POST" accept-charset="utf-8" style="padding: 20px;">
                <!-- Informacion-->
                <div class="row">
                    <div class="col s12 m12">
                        <h4>Base de Datos</h4><span>Seleccione el tipo de gestión a generar</span>
                        <div class="divider espabajo"></div>
                    </div>
                </div>
                <!-- Informacion -->


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

                </div>
               



                
                    <tr>
                        <td class="letra" width="250"><strong>Subir Archivo CSV:</strong></td>
                        <td><input type="file" name="foto" id="foto"></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><input type="submit" action="../controller/db/reportes/subir_archivo2.php" name="enviar" value="SUBIR" class="boton"></td>
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






<!--MODAL VISUAL-->
<!-- Modal Structure -->

<!--MODAL VISUAL-->



<!-- SCRIPTS CARGA -->
<?php
require_once "../controller/assets/scripts.php";
?>
<!-- SCRIPTS CARGA -->

<!-- Actualizacion de datos-->


<!-- Fin HTML -->
<?php
require_once "../controller/assets/fin.php";
?>