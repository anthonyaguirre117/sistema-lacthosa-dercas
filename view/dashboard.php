<?php 
setlocale(LC_ALL,"es_ES");  
  $modulo = "dashboard";
  $nav = '1';

  require_once "../controller/assets/svrurl.php";
  require_once "../controller/assets/inicio.php";
  require_once "../controller/assets/validacion.php";

  require_once ('../controller/db/cone.php');

    //Validacion de login
  $login = new seguridad;
  $login -> seguridadLogin();
  
        $mush_nombre = $_SESSION['mush_nombre'];                    
        $mush_email = $_SESSION['mush_email'];
        $mush_empresa = $_SESSION['mush_empresa'];
        $mush_tipo = $_SESSION['mush_tipo'];
        $mush_genero = $_SESSION['mush_genero'];
        $mush_acceso = $_SESSION['mush_acceso'];

if ($mush_tipo != "Admin") {
  header("Location: ".SERVERURL."controller/assets/salir.php?session=No");
}

?>
<!-- Usuario -->
<a id="tipodeusuario" class="hide"><?php echo $mush_tipo ?></a>
<!-- Usuario -->
<?php
////Requerir NAVMENU
require "../controller/assets/menunav.php";
?>








<!-- BODDY -->



<div class="col s12 m12">
  <div class="card hoverable borde7">
    <div class="row center">
      <div class=" col s12 ">
        <h5>Filtros</h5>
      </div>

   
          <form id="filtros" method="POST" accept-charset="utf-8">


            <div class="col s10 offset-s1 m4">
              <div class="input-field col s12">
                <select id="dia" name="dia" required>
                  <optgroup label="Busqueda">
                    <option value=''>Todos los dias</option>
                  </optgroup>
                  <optgroup label="Dias">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                  </optgroup>
                </select>
              </div>
            </div>


            <div class="col s10 offset-s1 m4">
              <div class="input-field col s12">
                <select id="mes" name="mes" required>
                  <optgroup label="Busqueda">
                    <option value=''>Todos los meses</option>
                  </optgroup>
                  <optgroup label="Meses">
                    <option value="1">Enero</option>
                    <option value="2">Febrero</option>
                    <option value="3">Marzo</option>
                    <option value="4">Abril</option>
                    <option value="5">Mayo</option>
                    <option value="6">Junio</option>
                    <option value="7">Julio</option>
                    <option value="8">Agosto</option>
                    <option value="9">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                  </optgroup>
                </select>
              </div>
            </div>

            <div class="col s10 offset-s1 m4">
              <div class="input-field col s11">
                <select id="ano" name="ano" required>
                  <optgroup label="Busqueda">
                    <option value=''>Todos los años</option>
                  </optgroup>
                  <optgroup label="Años">
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                  </optgroup>
                </select>
              </div>
            </div>


            <div class="col s2 offset-s5 center">
              <button type="button" class="buttorod btn-large center" id="consulta"
                style="margin-top: 5%; border-radius: 20px; background-color: #bc1119; color: white;">Consultar </button>
            </div>



          </form>
    
    </div>
  </div>
</div>




<div class="row animated fadeIn">
  <!--Datos-->






  <div class="row quitarmargen hide">


    <div class="col s12 m1 offset-m1 center" id="count1">
      <div class="card hoverable brdashcr borde7" style="background-color: white;">
        <div class="card-content" style="padding: 15px;">
          <i class="material-icons Tiny" style="color:#013244;">filter_1</i>
          <div class="row">
            <span style="font-size: 14px; color: #013244;">año</span>
          </div>
          <h4 id="count1"
            style="font-size: 1.5rem; color: #f08024; line-height: 2.0rem; margin: 0.2rem 0 0.2rem 0; font-weight: 600;">
            256</h4>
        </div>
      </div>
    </div>

    <div class="col s12  m1 offset m1 center" id="count2">
      <div class="card hoverable brdashcr borde7" style="background-color: white;">
        <div class="card-content" style="padding: 15px;">
          <i class="material-icons Tiny" style="color:#013244;">filter_2</i>
          <div class="row">
            <span style="font-size: 14px; color: #013244;">años</span>
          </div>
          <h4 id="count2"
            style="font-size: 1.5rem; color: #f08024; line-height: 2.0rem; margin: 0.2rem 0 0.2rem 0; font-weight: 600;">
            200</h4>
        </div>
      </div>
    </div>

    <div class="col s12  m1 offset m1 center" id="count3">
      <div class="card hoverable brdashcr borde7" style="background-color: white;">
        <div class="card-content" style="padding: 15px;">
          <i class="material-icons Tiny" style="color:#013244;">filter_3</i>
          <div class="row">
            <span style="font-size: 14px; color: #013244;">años</span>
          </div>
          <h4 id="count3"
            style="font-size: 1.5rem; color: #f08024; line-height: 2.0rem; margin: 0.2rem 0 0.2rem 0; font-weight: 600;">
            175</h4>
        </div>
      </div>
    </div>

    <div class="col s12  m1 offset m1 center" id="count4">
      <div class="card hoverable brdashcr borde7" style="background-color: white;">
        <div class="card-content" style="padding: 15px;">
          <i class="material-icons Tiny" style="color:#013244;">filter_4</i>
          <div class="row">
            <span style="font-size: 14px; color: #013244;">años</span>
          </div>
          <h4 id="count4"
            style="font-size: 1.5rem; color: #f08024; line-height: 2.0rem; margin: 0.2rem 0 0.2rem 0; font-weight: 600;">
            145</h4>
        </div>
      </div>
    </div>

    <div class="col s12  m1 offset m1 center" id="count5">
      <div class="card hoverable brdashcr borde7" style="background-color: white;">
        <div class="card-content" style="padding: 15px;">
          <i class="material-icons Tiny" style="color:#013244;">filter_5</i>
          <div class="row">
            <span style="font-size: 14px; color: #013244;">años</span>
          </div>
          <h4 id="count5"
            style="font-size: 1.5rem; color: #f08024; line-height: 2.0rem; margin: 0.2rem 0 0.2rem 0; font-weight: 600;">
            117</h4>
        </div>
      </div>
    </div>

    <div class="col s12  m1 offset m1 center" id="count6">
      <div class="card hoverable brdashcr borde7" style="background-color: white;">
        <div class="card-content" style="padding: 15px;">
          <i class="material-icons Tiny" style="color:#013244;">filter_6</i>
          <div class="row">
            <span style="font-size: 14px; color: #013244;">años</span>
          </div>
          <h4 id="count6"
            style="font-size: 1.5rem; color: #f08024; line-height: 2.0rem; margin: 0.2rem 0 0.2rem 0; font-weight: 600;">
            102</h4>
        </div>
      </div>
    </div>

    <div class="col s12  m1 offset m1 center" id="count7">
      <div class="card hoverable brdashcr borde7" style="background-color: white;">
        <div class="card-content" style="padding: 15px;">
          <i class="material-icons Tiny" style="color:#013244;">filter_7</i>
          <div class="row">
            <span style="font-size: 14px; color: #013244;">años</span>
          </div>
          <h4 id="count7"
            style="font-size: 1.5rem; color: #f08024; line-height: 2.0rem; margin: 0.2rem 0 0.2rem 0; font-weight: 600;">
            98</h4>
        </div>
      </div>
    </div>

    <div class="col s12  m1 offset m1 center" id="count8">
      <div class="card hoverable brdashcr borde7" style="background-color: white;">
        <div class="card-content" style="padding: 15px;">
          <i class="material-icons Tiny" style="color:#013244;">filter_8</i>
          <div class="row">
            <span style="font-size: 14px; color: #013244;">años</span>
          </div>
          <h4 id="count8"
            style="font-size: 1.5rem; color: #f08024; line-height: 2.0rem; margin: 0.2rem 0 0.2rem 0; font-weight: 600;">
            86</h4>
        </div>
      </div>
    </div>

    <div class="col s12  m1 offset m1 center" id="count9">
      <div class="card hoverable brdashcr borde7" style="background-color: white;">
        <div class="card-content" style="padding: 15px;">
          <i class="material-icons Tiny" style="color:#013244;">filter_9</i>
          <div class="row">
            <span style="font-size: 14px; color: #013244;">años</span>
          </div>
          <h4 id="count9"
            style="font-size: 1.5rem; color: #f08024; line-height: 2.0rem; margin: 0.2rem 0 0.2rem 0; font-weight: 600;">
            83</h4>
        </div>
      </div>
    </div>

    <div class="col s12  m1 offset m1 center" id="count10">
      <div class="card hoverable brdashcr borde7" style="background-color: white;">
        <div class="card-content" style="padding: 15px;">
          <i class="material-icons Tiny" style="color:#013244;">filter_9_plus</i>
          <div class="row">
            <span style="font-size: 14px; color: #013244;">años</span>
          </div>
          <h4 id="count10"
            style="font-size: 1.5rem; color: #f08024; line-height: 2.0rem; margin: 0.2rem 0 0.2rem 0; font-weight: 600;">
            74</h4>
        </div>
      </div>
    </div>

  </div>

  <div class="col s12 m2 offset-m1 center hide" id="ingresado">
    <div class="card hoverable brdashcr borde7" style="background-color: #013244;">
      <div class="card-content" style="padding: 15px;">
        <span style="font-size: 18.5px; color: white;">Ingresado</span>
        <h4 id="filasenproceso"
          style="font-size: 1.5rem; color: white; line-height: 2.0rem; margin: 0.2rem 0 0.2rem 0; font-weight: 600;">405
        </h4><i class="material-icons Tiny" style="color:white;">note_add</i>
      </div>
    </div>
  </div>


  <div class="col s12 m2 center hide" id="revisado">
    <div class="card hoverable brdashcr borde7" style="background-color: #013244;">
      <div class="card-content" style="padding: 15px;">
        <span style="font-size: 18.5px; color: white;">Revisado</span>
        <h4 id="filaspendiente"
          style="font-size: 1.5rem; color: white; line-height: 2.0rem; margin: 0.2rem 0 0.2rem 0; font-weight: 600;">356
        </h4><i class="material-icons Tiny" style="color:white;">playlist_add_check</i>
      </div>
    </div>
  </div>

  <div class="col s12 m2 center hide" id="aceptado">
    <div class="card hoverable brdashcr borde7" style="background-color: #013244;">
      <div class="card-content" style="padding: 15px;">
        <span style="font-size: 18.5px; color: white;">Aceptado</span>
        <h4 id="filaspendiente"
          style="font-size: 1.5rem; color: white; line-height: 2.0rem; margin: 0.2rem 0 0.2rem 0; font-weight: 600;">145
        </h4><i class="material-icons Tiny" style="color:white;">check</i>
      </div>
    </div>
  </div>

  <div class="col s12 m2 center hide" id="anulado">
    <div class="card hoverable brdashcr borde7" style="background-color: #013244;">
      <div class="card-content" style="padding: 15px;">
        <span style="font-size: 18.5px; color: white;">Anulado</span>
        <h4 id="filaspendiente"
          style="font-size: 1.5rem; color: white; line-height: 2.0rem; margin: 0.2rem 0 0.2rem 0; font-weight: 600;">98
        </h4><i class="material-icons Tiny" style="color:white;">close</i>
      </div>
    </div>
  </div>

  <div class="col s12 m2 center hide" id="total">
    <div class="card hoverable brdashcr borde7" style="background-color: #013244;">
      <div class="card-content" style="padding: 15px;">
        <span style="font-size: 18.5px; color: white;">Total</span>
        <h4 id="filaspendiente"
          style="font-size: 1.5rem; color: white; line-height: 2.0rem; margin: 0.2rem 0 0.2rem 0; font-weight: 600;">704
        </h4><i class="material-icons Tiny" style="color:white;">list</i>
      </div>
    </div>
  </div>

</div>



<!-- Ror 1-->
<div class="row quitarmargen">
  <!-- Ror 1-->

  <div class="col s12 m6">
    <div class="card hoverable borde7">
      <div class="row center quitarmargen">
        <div class="col s12 m12">
          <div style="margin-left: 20px;">
            <h5>Tipificaciones</h5>
          </div>
        </div>

      </div>
      <div class="card-content center" id="divC1">
        <div id="chart1" class="center"></div>
        <div class="row center">


        </div>
      </div>
    </div>
  </div>




  <div class="col s12 m6">
    <div class="card hoverable borde7">
      <div class="row center quitarmargen">
        <div class="col s12 m12">
          <div style="margin-left: 20px;">
            <h5>Ventas por Agente</h5>
          </div>
        </div>

      </div>
      <div class="card-content center" id="divC2">
        <div id="chart2" class="center"></div>
        <div class="row center">


        </div>
      </div>
    </div>
  </div>




  <!--<div class="col s12 m6">
    <div class="card hoverable borde7">
      <div class="row center quitarmargen">
        <div class="col s12 m12">
          <div style="margin-left: 20px;">
            <h5 class="">Contesta</h5>
          </div>
        </div>

      </div>
      <div class="card-content center" id="divC1">
        <div id="chart2" class="center"></div>
        <div class="row center">


        </div>
      </div>
    </div>
  </div>-->
<!--
  <div class="col s12 m6">
    <div class="card hoverable borde7">
      <div class="row center quitarmargen">
        <div class="col s12 m12">
          <div style="margin-left: 20px;">
            <h5 class="white-text">Tipificaciones %</h5>
          </div>
        </div>

      </div>
      <div class="card-content center">
        <div id="chart3" class="center"></div>
        <div class="row center">


        </div>
      </div>
    </div>
  </div>




  <div class="col s12 m6">
    <div class="card hoverable borde7">
      <div class="row center quitarmargen">
        <div class="col s12 m12">
          <div style="margin-left: 20px;">
            <h5 class="white-text">Sub Tipificaciones %</h5>
          </div>
        </div>

      </div>
      <div class="card-content center">
        <div id="chart4" class="center"></div>
        <div class="row center">


        </div>
      </div>
    </div>
  </div>
-->


  <div class="col s12 m12">
    <div class="card hoverable borde7">
      <div class="row center quitarmargen">
        <div class="col s12 m12">
          <div style="margin-left: 40px;">
            <h5 class="">Tipificaciones por Agente</h5>
          </div>
        </div>

      </div>


      <div class="card-content center" id="divC1">
        <div id="" class="center"></div>
        <div class="row ">


          <div id="tabla">

          </div>

        </div>
      </div>
    </div>
  </div>



</div> <!-- Ror 1-->
<!-- Ror 1-->



<!-- SCRIPTS CARGA -->
<?php
  require_once "../controller/assets/scripts.php";
?>
<!-- SCRIPTS CARGA -->


<script type="text/javascript" charset="utf-8">



  $(document).ready(function () {
    $('select').formSelect();
    $('.sidenav').sidenav();
    $("select[required]").css({ display: "block", height: 0, padding: 0, width: 0, position: 'absolute' });
    $(".dropdown-trigger").dropdown({ hover: false });
    $('.tooltipped').tooltip();
    $('.fixed-action-btn').floatingActionButton();
    ajaxDashboard();


  });


  /////Funcion limpiar datos
  let limpiarDatos = () => {

    $("#chart1").empty();
    $("#chart2").empty();
    $("#chart3").empty();
    $("#chart4").empty();

    $('#tabla').empty();


 
  }
  /////Funcion limpiar datos


  /////Funcion carga de Dashboard
  let ajaxDashboard = () => {

    ///Datos formulario Dashboard 
    campana = $('#campana').val();
    dia = $('#dia').val();
    mes = $('#mes').val();
    ano = $('#ano').val();

    $.ajax({
      url: '../controller/db/carga/dashboard_filtros.php',
      type: 'POST',
      async: false,
      dataType: 'JSON',
      data: { campana: campana, dia: dia, mes: mes, ano: ano },
    })
      .done(function (datos) {
        ///Parametros de Consulta
        let cantTipologias = datos.cant_tipologias;
        let topTipologias = datos.top_tipologias;
        let sumVentasAgentes = datos.suma_agentes;
        let agentes = datos.agentes;
        let datosTabla = datos.tabla;

        //LimpiarDatos
        limpiarDatos();




        //enviar datos a la funcion
        cargaModulosDashboard(cantTipologias, topTipologias, sumVentasAgentes, agentes, datosTabla);

      })
      .fail(function (datos) {
        console.log(datos);
      });


  }
  /////Funcion carga de Dashboard

  ////Carga de modulos
  let cargaModulosDashboard = (cantTipologias, topTipologias, sumVentasAgentes, agentes, datosTabla) => {

    console.log([cantTipologias, topTipologias, sumVentasAgentes, agentes, datosTabla]);


 ///Creacion Tabla
 cargaDatosModulos("tabla", datosTabla);


var cantPorcentajeTipologias = cantPorcentajeTipologias;
var cantPorcentajeSubTipologias = cantPorcentajeSubTipologias

    


var options1 = {
      chart: {
        height: 240,
        type: 'bar',
      },
      colors: ["#0000008f"],
      plotOptions: {
        bar: {
          dataLabels: {
            position: 'top', // top, center, bottom
          },
        }
      },
      dataLabels: {
        enabled: true,
        formatter: function (val) {
          return "" + val;
        },
        offsetY: -20,
        style: {
          fontSize: '10px',
          colors: ["#0000008f"]
        }
      },
      series: [{
        name: 'Cantidad',
        data: cantTipologias

      }],
      xaxis: {
        categories: topTipologias,
        position: 'bottom',
        labels: {
          offsetY: -2,

        },
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        crosshairs: {
          fill: {
            type: 'gradient',
            gradient: {
              colorFrom: '#0000008f',
              colorTo: '#0000008f',
              stops: [0, 100],
              opacityFrom: 0.4,
              opacityTo: 0.5,
            }
          }
        },
        tooltip: {
          enabled: true,
          offsetY: -35,

        }
      },
      fill: {
        gradient: {
          shade: 'light',
          type: "horizontal",
          shadeIntensity: 0.25,
          gradientToColors: undefined,
          inverseColors: true,
          opacityFrom: 1,
          opacityTo: 1,
          stops: [50, 0, 100, 100]
        },
      },
      yaxis: {
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false,
        },
        labels: {
          position: 'top',
          show: false,
          formatter: function (val) {
            return "" + val;
          }
        }

      },
    }



    ///Creacion de Dasboard 1
    cargaDatosModulos("chart1", options1);



//005CB9



  ///Opciones Dashboard 2
       var options2 = {
      chart: {
        height: 240,
        type: 'bar',
      },
      colors: ["#bc1119cf"],
      plotOptions: {
        bar: {
          dataLabels: {
            position: 'top', // top, center, bottom
          },
        }
      },
      dataLabels: {
        enabled: true,
        formatter: function (val) {
          return "" + val;
        },
        offsetY: -20,
        style: {
          fontSize: '10px',
          colors: ["#bc1119cf"]
        }
      },
      series: [{
        name: 'Ventas',
        data: sumVentasAgentes

      }],
      xaxis: {
        categories: agentes,
        position: 'bottom',
        labels: {
          offsetY: -2,

        },
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        crosshairs: {
          fill: {
            type: 'gradient',
            gradient: {
              colorFrom: '#bc1119cf',
              colorTo: '#bc1119cf',
              stops: [0, 100],
              opacityFrom: 0.4,
              opacityTo: 0.5,
            }
          }
        },
        tooltip: {
          enabled: true,
          offsetY: -35,

        }
      },
      fill: {
        gradient: {
          shade: 'light',
          type: "horizontal",
          shadeIntensity: 0.25,
          gradientToColors: undefined,
          inverseColors: true,
          opacityFrom: 1,
          opacityTo: 1,
          stops: [50, 0, 100, 100]
        },
      },
      yaxis: {
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false,
        },
        labels: {
          position: 'top',
          show: false,
          formatter: function (val) {
            return "Q" + val;
          }
        }

      },
    }

    ///Creacion Dashboard 2
    cargaDatosModulos("chart2", options2);


   
  }



////Carga de modulos
  let cargaDatosModulos = (id, opciones) => {

    if (id == "tabla") {

      $('#tabla').html(opciones);
      $('#tipificaciones_agente').DataTable({
        "order": [[1, "desc"]]
      });
      $('select').formSelect();

    } else {




  var chartCreado = new ApexCharts(
      document.querySelector("#" + id + ""),opciones);
 
      chartCreado.render();
    }


  }
 ////Carga de modulos

  $("#consulta").click(function (event) {
    event.preventDefault();
    ajaxDashboard();

  });

</script>

<!-- Fin HTML -->
<?php
  require_once "../controller/assets/fin.php";
?>