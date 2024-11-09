<?php
ob_start();
SESSION_START();
setlocale(LC_TIME, 'Spanish_Guatemala');
date_default_timezone_set("America/Guatemala");


//conectar a base de datos
require_once ('../cone.php');

$conect = new basedatos;
$conect -> conectarBD();



        $pm_nombre = $_SESSION['mush_nombre'];                    
        $pm_email = $_SESSION['mush_email'];
        $pm_empresa = $_SESSION['mush_empresa'];
        $pm_tipo = $_SESSION['mush_tipo'];
        $pm_genero = $_SESSION['mush_genero'];
        $pm_acceso = $_SESSION['mush_acceso'];

if ($pm_tipo != "Admin") {
  echo $funciondata = json_encode(array('error' => true, "errorI" => "No es Admin", 'datos' => "<h1> No eres Admin >:/ </h1>"));
}






$año = date('Y');
$mes = date('m');
$dia = date('d');
$fecha = date("Y-m-d");




$filtros_colocado = 0;



$armeQuery = array();


/*
if($_POST["campana"]!=""){
  $campanaRF = $_POST["campana"];// 2019;  //  //  //
array_push($armeQuery, array("campana", $campanaRF));

} else {
$filtros_colocado++;
}   
*/

if($_POST["dia"]!=""){
  $mesRF =  $_POST["dia"]; //  12; // ///
array_push($armeQuery, array("day(fecha_hora)", $mesRF));
} else {
$filtros_colocado++;
}


if($_POST["mes"]!=""){
  	    $mesRF =  $_POST["mes"]; //  12; // ///
    array_push($armeQuery, array("month(fecha_hora)", $mesRF));
  } else {
$filtros_colocado++;
  }

if($_POST["ano"]!=""){
	  	    $yearrRF = $_POST["ano"];// 2019;  //  //  //
    array_push($armeQuery, array("year(fecha_hora)", $yearrRF));

  } else {
  	$filtros_colocado++;
  }   



//var_dump($armeQuery);

$numeroDQ = count($armeQuery);
//creacion de query
if ($numeroDQ >= 2) {
  $vacia = "";
    for ($i=0; $i < $numeroDQ; $i++) {
      $atrr1 = $armeQuery[$i][0];
      $atrr2 = $armeQuery[$i][1];
      if ($i < ($numeroDQ -1)) {
        $vacia .= " $atrr1= '$atrr2' AND ";
      }else{
        $vacia .= " $atrr1= '$atrr2'";       
      }
    }   

 //$query1 = "SELECT asignacion,apertura, centro_negocios as 'centro_negocios', count(*) as total FROM mother where pr2 = 'Si' and $vacia group by centro_negocios order by total desc ";


 $query1 = "SELECT estatus, count(*) as cuenta FROM mother where $vacia group by estatus";

 $query2 = "SELECT agente,count(*) as sumaAgente FROM formulario where $vacia group by agente";
 
 

 $query3 = "SELECT * FROM mother where $vacia ";
 
$filtros = array();
array_push($filtros, $vacia);

}else{

if ($filtros_colocado == 3 ) {
//	echo "Parte Sin Filtros";


$query1 = "SELECT estatus, count(*) as cuenta FROM mother group by estatus";

$query2 = "SELECT agente,count(*) as sumaAgente FROM mother group by agente";

$query3 = "SELECT * FROM mother";





$filtros = array();
array_push($filtros, "Sin Filtros");

}else{
//echo "Parte Con un Filtro";
  $atrr1 =  $armeQuery[0][0];
  $atrr2 =  $armeQuery[0][1];
  $filtro = $atrr1." = ".$atrr2;



  $query1 = "SELECT estatus, count(*) as cuenta FROM mother where $atrr1 = '$atrr2' group by estatus";

  $query2 = "SELECT agente, count(*) as sumaAgente FROM mother  where $atrr1 = '$atrr2' group by agente";
  
  $query3 = "SELECT * FROM mother where $atrr1 = '$atrr2'";

  //$query4 = "SELECT ventas, count(*) as venta FROM mother where $atrr1 = '$atrr2' group by agente";
  


$filtros = array();
array_push($filtros, $filtro);
 }
}

//fin query




//top tipologias
$top_tipologias = array();
$cant_tipologias = array();
$resultado1 = mysqli_query($conect-> conectarBD(), $query1) or die("Error query1: ".mysqli_error($conect-> conectarBD()));
while ($row = $resultado1->fetch_assoc()) {
 $tipologias = $row['estatus'];
 $total_tipologias = number_format($row['cuenta'],0,".","");
  array_push($top_tipologias, $tipologias );
  array_push($cant_tipologias, $total_tipologias );
}


//top_sub_tipologias
$agentes = array();
$suma_agentes = array();
$suma_total= 0;
$resultado2 = mysqli_query($conect-> conectarBD(), $query2) or die("Error query2: ".mysqli_error($conect-> conectarBD()));
while ($row = $resultado2->fetch_assoc()) {
  $nombre_agente = $row['agente'];
  $suma_venta = number_format($row['sumaAgente'],2,".","");
  array_push($agentes, $nombre_agente );
  array_push($suma_agentes, $suma_venta );
  $suma_total+=$suma_venta; 
}





//tabla de tipologias por usuarios
$tabla = "<div class='col s12'>
<table class= 'striped responsive-table centered' id='tipificaciones_agente'>
<thead class='center'>
        <tr class='center'>
          <th class=' '>Nombre</th>
          <th class=''>Documento</th>
          <th class=''>Telefono</th>
          <th class=''>Entidad Prestamo</th>
          <th class=''>Estatus</th>
          <th class=''>Fecha y Hora</th>
          <th class=''>Agente</th>
          </tr>
        </thead>
";



$resultado3 = mysqli_query($conect-> conectarBD(), $query3) or die("Error: query3 ".mysqli_error($conect-> conectarBD()));

while ($row = $resultado3->fetch_assoc()) {
  
  $nombre_cliente = $row['nombre_cliente'];
  $documento = $row['documento'];
  $telefono = $row['tel'];
  $enditdad_prestamo=$row['entidad_prestamo'];
  $estatus = $row['estatus'];
  $fecha_hora = $row['fecha_hora'];
  $usuario = $row['agente'];


  $tabla .= "        
      <tr>
      
      <td>$nombre_cliente</td>
      <td>$documento</td>
      <td>$telefono</td>
      <td>$enditdad_prestamo</td>
      <td>$estatus</td>
      <td>$fecha_hora</td>
      <td>$usuario</td>
      ";
      






  $tabla.="</tr>";
}






$tabla .= "</table>";     


$tabla.="
</div>
";







$cuenta_resultado = mysqli_num_rows($resultado1);
$empty = number_format(0,2, ".", ",");
	if ($cuenta_resultado == 0) {
	array_push($top_tipologias, 'No se encontraron datos');
	array_push($cant_tipologias, $empty);	
	}

$cuenta_resultado2 = mysqli_num_rows($resultado2);
	if ($cuenta_resultado2 == 0) {
	array_push($agentes, 'No se encontraron datos');
	array_push($suma_agentes, $empty);	
  }
  
  $cuenta_resultado3 = mysqli_num_rows($resultado3);

	if ($cuenta_resultado3 == 0) {

    $tabla = "<table class= 'striped responsive-table centered white-text'>
    <table class= 'striped responsive-table centered' id='tipificaciones_agente'>
    <thead class='center'>
            <tr class='center'>
              <th class=' '>Nombre</th>
              <th class=''>Documento</th>
              <th class=''>Telefono</th>
              <th class=''>Entidad Prestamo</th>
              <th class=''>Estatus</th>
              <th class=''>Fecha y Hora</th>
              <th class=''>Agente</th>
              </tr>
            </thead>
            </table>
       
            <br>

            <br>  
            <div>
              <h3 class=''>No se encontraron Datos :C</h3>
            </div>";
	}


/*
$cuenta_resultado4 = mysqli_num_rows($resultado4);
$empty = 0;
	if ($cuenta_resultado4 == 0) {
	array_push($nombre_tipologias, 'No se encontraron Datos');
  array_push($cant_porcentaje_tipologias, $empty);
  array_push($nombre_sub_tipologias,'No se encontraron Datos');
	array_push($cant_porcentaje_sub_tipologias, $empty);		
	}
/*
$cuenta_resultado5 = mysqli_num_rows($resultado4);
$empty = 0;
	if ($cuenta_resultado5 == 0) {
	array_push($nombre_sub_tipologias,'No se encontraron Datos');
	array_push($cant_porcentaje_sub_tipologias, $empty);	
	}

*/
/*

*/


echo $funciondata = json_encode(array('top_tipologias' =>$top_tipologias, 'cant_tipologias'=>$cant_tipologias, 'agentes'=>$agentes,'suma_agentes'=>$suma_agentes,'suma_total'=>$suma_total,'tabla'=>$tabla, 'filtros'=>$filtros));





//$cadena_equipo2 = implode($array_equipo);
///echo "<br><br>El equipo sin parámetro string es el siguiente: " .$cadena_equipo2;

/*

*/
//vaciar datos
mysqli_close($conect -> conectarBD());

ob_end_flush();