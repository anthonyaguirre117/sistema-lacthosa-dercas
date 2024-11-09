<?php
ob_start();
SESSION_START();
setlocale(LC_TIME, 'Spanish_Guatemala');
date_default_timezone_set("America/Guatemala");

//conectar a base de datos
require_once ('../cone.php');
$conect = new basedatos;
$conect -> conectarBD();




$año = date('Y');
$mes = date('m');
$dia = date('d');
$hora = date('h');
//echo "<br>";
$minuto = date('m');

//echo "<br>";
$fecha_actual = date("Y-m-d");
//echo "<br>";
$fecha_24h = date("Y-m-d",strtotime($fecha_actual."- 1 days"));
//echo "<br>";

$fecha_hora = $fecha_24h ." ".$hora.":".$minuto; 




$filtros = 0;


$armeQuery = array();

if($_POST["cl"] !=""){
    $clienteRF = $_POST["cl"]; //  "";  ///$_POST["nit"];
    array_push($armeQuery, array("nombre", $clienteRF));
  } else {
 $filtros++; 	
  }

if($_POST["dia"] != "" ){
  	    $diaRF = $_POST["dia"]; // 03; /// 
    array_push($armeQuery, array("dayofmonth(fecha)", $diaRF));
  } else {
$filtros++;
  }


if($_POST["mes"] !=""){
  	    $mesRF =  $_POST["mes"]; //  12; // ///
    array_push($armeQuery, array("month(fecha)", $mesRF));
  } else {
$filtros++;
  }

if($_POST["ano"] !=""){
	  	    $yearrRF = $_POST["ano"];// 2019;  //  //  //
    array_push($armeQuery, array("year(fecha)", $yearrRF));

  } else {
  	$filtros++;
  }   


//echo $filtros;

//$años = $_POST["ano"];

//var_dump($armeQuery);

//echo "Numero de datos del array: " . count($armeQuery) . "<br>";


//comienza lo engasado


  $numeroDQ = count($armeQuery);


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



$query_1 = "SELECT month(fecha_hora) mes, count(guia) total_mes FROM mother where $vacia group by mes";

$query_2 = "SELECT weekday(fecha_hora) dia, count(guia) total_dia, dayname(fecha_hora) FROM mother where $vacia group by dia";

$query_3 = "SELECT weekday(fecha_hora) dia, SUM(numero_paquete) total_paquetes FROM mother where $vacia group by dia";

$query_4 = "SELECT month(fecha_hora) mes, sum(numero_paquete) total_paquetes_mes FROM mother where $vacia group by mes";

$query_5 = "SELECT year(fecha_hora) ano, SUM(numero_paquete) total_paquetes FROM mother WHERE year(fecha_hora) =  $año";

$query_6 = "SELECT year(fecha_hora) ano, count(guia) total_guias FROM mother WHERE year(fecha_hora) =  $año";

$query_7 = "SELECT SUM(numero_paquete) total_paquetes FROM mother where $vacia";

$query_8 = "SELECT count(guia) total_guias FROM mother where $vacia ";

$query_9 = "SELECT count(id) as Actividades FROM log ";

$query_10 = "SELECT * FROM mother where fecha_hora  <= '$fecha_hora' and  estado_guia != 'Completo' and estado_guia != 'Anulado' order by fecha_hora desc";

$query_11 = "SELECT month(fecha_hora) mes, count(guia) total_mes, sum(numero_paquete) total_paquetes FROM mother WHERE $vacia and estado_guia != 'completo' and estado_guia !='Anulado'";

$query_12 = "SELECT month(fecha_hora) mes, count(guia) total_mes, sum(numero_paquete) total_paquetes FROM mother WHERE $vacia and estado_guia = 'completo'";


$query_13 = "SELECT weekday(fecha_hora) dia, count(guia) total_mes, sum(numero_paquete) total_paquetes FROM mother WHERE $vacia and estado_guia != 'completo' and estado_guia !='Anulado'";

$query_14 = "SELECT weekday(fecha_hora) dia, count(guia) total_mes, sum(numero_paquete) total_paquetes FROM mother WHERE $vacia and estado_guia = 'completo'";

$query_15 = "SELECT count(rutero) as Cuenta, rutero FROM mother where $vacia group by rutero ";


$filtros = array();
array_push($filtros, $vacia);


  }else{




if ($filtros == 4 ) {



//	echo "Parte Sin Filtros";

$query_1 = "SELECT month(fecha_hora) mes, count(guia) total_mes FROM mother group by mes";

$query_2 = "SELECT weekday(fecha_hora) dia, count(guia) total_dia, dayname(fecha_hora) FROM mother group by dia";

$query_3 = "SELECT weekday(fecha_hora) dia, SUM(numero_paquete) total_paquetes FROM mother group by dia";

$query_4 = "SELECT month(fecha_hora) mes, sum(numero_paquete) total_paquetes_mes FROM mother group by mes";

$query_5 = "SELECT year(fecha_hora) ano, SUM(numero_paquete) total_paquetes FROM mother WHERE year(fecha_hora) =  $año";

$query_6 = "SELECT year(fecha_hora) ano, count(guia) total_guias FROM mother WHERE year(fecha_hora) =  $año";

$query_7 = "SELECT SUM(numero_paquete) total_paquetes FROM mother";

$query_8 = "SELECT count(guia) total_guias FROM mother ";

$query_9 = "SELECT count(id) as Actividades FROM log";

$query_10 = "SELECT * FROM mother where fecha_hora  <= '$fecha_hora' and  estado_guia != 'Completo' and estado_guia != 'Anulado' order by fecha_hora desc";

$query_11 = "SELECT month(fecha_hora) mes, count(guia) total_mes, sum(numero_paquete) total_paquetes FROM mother WHERE estado_guia != 'completo' and 
estado_guia !='Anulado'";

$query_12 = "SELECT month(fecha_hora) mes, count(guia) total_mes, sum(numero_paquete) total_paquetes FROM mother WHERE estado_guia = 'completo'";

$query_13 = "SELECT weekday(fecha_hora) dia, count(guia) total_mes, sum(numero_paquete) total_paquetes FROM mother WHERE estado_guia != 'completo' and estado_guia !='Anulado'";

$query_14 = "SELECT weekday(fecha_hora) dia, count(guia) total_mes, sum(numero_paquete) total_paquetes FROM mother WHERE estado_guia = 'completo'";

$query_15 = "SELECT count(rutero) as Cuenta, rutero FROM mother group by rutero ";

$filtros = array();
array_push($filtros, "Sin Filtros");





}else{



//echo "Parte Con un Filtro";

    $atrr1 =  $armeQuery[0][0];
    $atrr2 =  $armeQuery[0][1];
    $filtro = $atrr1." = ".$atrr2;


$query_1 = "SELECT month(fecha_hora) mes, count(guia) total_mes FROM mother where $atrr1 = '$atrr2' group by mes";

$query_2 = "SELECT weekday(fecha_hora) dia, count(guia) total_dia, dayname(fecha_hora) FROM mother where $atrr1 = '$atrr2' group by dia";

$query_3 = "SELECT weekday(fecha_hora) dia, SUM(numero_paquete) total_paquetes FROM mother where $atrr1 = '$atrr2' group by dia";

$query_4 = "SELECT month(fecha_hora) mes, sum(numero_paquete) total_paquetes_mes FROM mother where $atrr1 = '$atrr2' group by mes";

$query_5 = "SELECT year(fecha_hora) ano, SUM(numero_paquete) total_paquetes FROM mother WHERE year(fecha_hora) =  $año";

$query_6 = "SELECT year(fecha_hora) ano, count(guia) total_guias FROM mother WHERE year(fecha_hora) =  $año";

$query_7 = "SELECT SUM(numero_paquete) total_paquetes FROM mother where $atrr1 = '$atrr2'";

$query_8 = "SELECT count(guia) total_guias FROM mother where $atrr1 = '$atrr2' ";

$query_9 = "SELECT count(id) as Actividades FROM log ";

$query_10 = "SELECT * FROM mother where fecha_hora  <= '$fecha_hora' and  estado_guia != 'Completo' and estado_guia != 'Anulado' order by fecha_hora desc";

$query_11 = "SELECT month(fecha_hora) mes, count(guia) total_mes, sum(numero_paquete) total_paquetes FROM mother WHERE $atrr1 = '$atrr2' and estado_guia != 'completo' and estado_guia !='Anulado'";

$query_12 = "SELECT month(fecha_hora) mes, count(guia) total_mes, sum(numero_paquete) total_paquetes FROM mother WHERE $atrr1 = '$atrr2' and estado_guia = 'completo'";

$query_13 = "SELECT weekday(fecha_hora) dia, count(guia) total_mes, sum(numero_paquete) total_paquetes FROM mother WHERE $atrr1 = '$atrr2' and estado_guia != 'completo' and estado_guia !='Anulado'";

$query_14 = "SELECT weekday(fecha_hora) dia, count(guia) total_mes, sum(numero_paquete) total_paquetes FROM mother WHERE $atrr1 = '$atrr2' and estado_guia = 'completo'";

$query_15 = "SELECT count(rutero) as Cuenta, rutero FROM mother where $atrr1 = '$atrr2' group by rutero ";

$filtros = array();
array_push($filtros, $filtro);





}






  }




$resultado_1 = mysqli_query($conect-> conectarBD(), $query_1)or die("Error: ".mysqli_error($conect-> conectarBD()));
$meses = array();
$total_guias_mes = array();
while($row=$resultado_1->fetch_assoc()){
	 $mes  = number_format($row['mes'],0, ".", ",");
	 $total_mes  = number_format($row['total_mes'], 0, ".", ",");
	array_push($meses, $mes);
	array_push($total_guias_mes, $total_mes);
	}

$cuenta_resultado = mysqli_num_rows($resultado_1);
$empty = 0;
	if ($cuenta_resultado == 0) {
	array_push($meses, number_format($empty,0, ".", ","));
	array_push($total_guias_mes, number_format($empty,0, ".", ","));	
	}



$resultado_2 = mysqli_query($conect-> conectarBD(), $query_2)or die("Error: ".mysqli_error($conect-> conectarBD()));
$total_guias_dia = array();
$dias = array();
while($row=$resultado_2->fetch_assoc()){
 $dias_num = number_format($row['dia'],0, ".", ",");
 $total = number_format($row['total_dia'],0, ".", ",");
array_push($total_guias_dia, $total);
array_push($dias, $dias_num);
}

$cuenta_resultado2 = mysqli_num_rows($resultado_2);
$empty = 0;

	if ($cuenta_resultado2 == 0) {
	array_push($total_guias_dia, number_format($empty,0, ".", ","));
	array_push($dias, number_format($empty,0, ".", ","));	
	
	}



$resultado_3 = mysqli_query($conect-> conectarBD(), $query_3)or die("Error: ".mysqli_error($conect-> conectarBD()));
$total_paquetes_dia =  array();
while($row=$resultado_3->fetch_assoc()){
 $dia = 	
 $total = number_format($row['total_paquetes'],0, ".", ",");
array_push($total_paquetes_dia, $total);

}




$cuenta_resultado3 = mysqli_num_rows($resultado_3);
$empty = 0;
	if ($cuenta_resultado3 == 0) {
	array_push($total_paquetes_dia, number_format($empty,0, ".", ","));

	}





$resultado_4 = mysqli_query($conect-> conectarBD(), $query_4)or die("Error: ".mysqli_error($conect-> conectarBD()));
$total_paquetes_mes = array();

while ($row=$resultado_4->fetch_assoc()) {
	$total = number_format($row['total_paquetes_mes'],0,".",",");
	array_push($total_paquetes_mes, $total);
}




$cuenta_resultado = mysqli_num_rows($resultado_4);
$empty = 0;

	if ($cuenta_resultado == 0) {
	array_push($total_paquetes_mes, number_format($empty,0, ".", ","));

	
	
	}





$resultado_5 = mysqli_query($conect-> conectarBD(), $query_5)or die("Error: ".mysqli_error($conect-> conectarBD()));

$total_paquetes_ano = array();


while ($row = $resultado_5->fetch_assoc()) {
	$total = number_format($row['total_paquetes'],0,".",",");
	array_push($total_paquetes_ano, $total);
}
$cuenta_resultado = mysqli_num_rows($resultado_5);
$empty = 0;

	if ($cuenta_resultado == 0) {
	array_push($total_paquetes_ano, number_format($empty,0, ".", ","));	
	}



$resultado_6 = mysqli_query($conect-> conectarBD(), $query_6)or die("Error: ".mysqli_error($conect-> conectarBD()));

$total_guias_ano = array();

while ($row = $resultado_6->fetch_assoc()) {
	$total = number_format($row['total_guias'],0,".",",");
	array_push($total_guias_ano, $total);
}
$cuenta_resultado = mysqli_num_rows($resultado_6);
$empty = 0;

	if ($cuenta_resultado == 0) {
	array_push($total_guias_ano, number_format($empty,0, ".", ","));

	
	}



$resultado_7 = mysqli_query($conect-> conectarBD(), $query_7)or die("Error: ".mysqli_error($conect-> conectarBD()));
$total_paquetes = array();
while ($row = $resultado_7->fetch_assoc()) {
	$total = number_format($row['total_paquetes'],0,".",",");
	array_push($total_paquetes, $total);
}
$cuenta_resultado = mysqli_num_rows($resultado_7);
$empty = 0;

	if ($cuenta_resultado == 0) {
	array_push($total_paquetes, number_format($empty,0, ".", ","));	
	}


$resultado_8 = mysqli_query($conect-> conectarBD(), $query_8)or die("Error: ".mysqli_error($conect-> conectarBD()));
$total_guias = array();
		while ($row = $resultado_8->fetch_assoc()) {
			$total = number_format($row['total_guias'],0,".",",");
			array_push($total_guias, $total);
						}
						$cuenta_resultado = mysqli_num_rows($resultado_8);
						$empty = 0;
							if ($cuenta_resultado == 0) {
							array_push($total_guias, number_format($empty,0, ".", ","));
							}



$resultado_9 = mysqli_query($conect-> conectarBD(), $query_9)or die("Error: ".mysqli_error($conect-> conectarBD()));
$total_actividades = array();
while ($row = $resultado_9->fetch_assoc()) {
	$total = number_format($row['Actividades'],0,".",",");
	array_push($total_actividades, $total);
}

$cuenta_resultado = mysqli_num_rows($resultado_9);
$empty = 0;

	if ($cuenta_resultado == 0) {
	array_push($total_actividades, number_format($empty,0, ".", ","));
	}



$resultado_10 = mysqli_query($conect-> conectarBD(), $query_10)or die("Error: ".mysqli_error($conect-> conectarBD()));

$guias_mayores_24h = array();
$resultado_10_num_rows = number_format(mysqli_num_rows($resultado_10),0,".",",");

array_push($guias_mayores_24h, $resultado_10_num_rows);



$cuenta_resultado = mysqli_num_rows($resultado_10);
$empty = 0;

	if ($cuenta_resultado == 0) {
	array_push($guias_mayores_24h, number_format($empty,0, ".", ","));
	}





$porcentaje_guias = array();
$porcentaje_paquetes = array();


$resultado_11 = mysqli_query($conect-> conectarBD(), $query_11)or die("Error: ".mysqli_error($conect-> conectarBD()));
while($row=$resultado_11->fetch_assoc()){
	  $total_mes_11  = number_format($row['total_mes'], 0, ".", ",");
	  $total_mess_11_paquetes = $row['total_paquetes'];

	}

$resultado_12 = mysqli_query($conect-> conectarBD(), $query_12)or die("Error: ".mysqli_error($conect-> conectarBD()));
while($row=$resultado_12->fetch_assoc()){
	 $total_mes_12  = number_format($row['total_mes'], 0, ".", ",");
     $total_mes_12_paquetes = $row['total_paquetes'];
	}




$porcentaje1 = number_format(($total_mes_11 * $total_mes_12 / 100),2,".",",");; 
$porcentaje2 = number_format(($total_mess_11_paquetes * $total_mes_12_paquetes / 100),2,".",",");

	 array_push($porcentaje_guias, $porcentaje1);
     array_push($porcentaje_paquetes, $porcentaje2);







$porcentaje_guias_dia = array();
$porcentaje_paquetes_dia = array();


$resultado_13 = mysqli_query($conect-> conectarBD(), $query_13)or die("Error: ".mysqli_error($conect-> conectarBD()));
while($row=$resultado_13->fetch_assoc()){
	  $total_mes_13  = number_format($row['total_mes'], 0, ".", ",");
	  $total_mess_13_paquetes = $row['total_paquetes'];

	}

$resultado_14 = mysqli_query($conect-> conectarBD(), $query_14)or die("Error: ".mysqli_error($conect-> conectarBD()));
while($row=$resultado_14->fetch_assoc()){
	 $total_mes_14  = number_format($row['total_mes'], 0, ".", ",");
     $total_mes_14_paquetes = $row['total_paquetes'];
	}




$porcentaje1 = number_format(($total_mes_13 * $total_mes_14 / 100),2,".",",");; 
$porcentaje2 = number_format(($total_mess_13_paquetes * $total_mes_14_paquetes / 100),2,".",",");

	 array_push($porcentaje_guias_dia, $porcentaje1);
     array_push($porcentaje_paquetes_dia, $porcentaje2);


$resultado_15 = mysqli_query($conect-> conectarBD(), $query_15)or die("Error: ".mysqli_error($conect-> conectarBD()));
$cuenta_pilotos = array();
$pilotos = array();
				while ($row = $resultado_15->fetch_assoc()) {
					$cuenta = number_format($row['Cuenta'],0,".",",");
					$piloto = $row['rutero'];
					array_push($cuenta_pilotos, $cuenta);
					array_push($pilotos, $piloto);
				}
					$cuenta_resultado = mysqli_num_rows($resultado_15);
					$empty = 0;

						if ($cuenta_resultado == 0) {
						array_push($cuenta_pilotos, number_format($empty,0, ".", ","));
						array_push($pilotos, number_format($empty,0, ".", ","));
						
						}



/*
if () {
	
}
*/

$dias = str_replace('0', "Lunes", $dias);
$dias = str_replace('1', "Martes", $dias);
$dias = str_replace('2', "Miercoles", $dias);
$dias = str_replace('3', "Jueves", $dias);
$dias = str_replace('4', "Viernes", $dias);
$dias = str_replace('5', "Sabado", $dias);
$dias = str_replace('6', "Domingo", $dias);


echo $funciondata2 = json_encode(array("total_guias_dia" => $total_guias_dia, "dias" => $dias, "meses" => $meses, "total_guias_mes" => $total_guias_mes, "total_paquetes_dia" =>$total_paquetes_dia,"total_paquetes_mes" => $total_paquetes_mes, "total_paquetes_ano" => $total_paquetes_ano, "total_guias_ano" =>$total_guias_ano, "paquetes_totales"=>$total_paquetes, "guias_totales"=>$total_guias, "total_actividades" =>$total_actividades, "cant_guias_24h"=>$guias_mayores_24h, "porcentaje_guias" =>$porcentaje_guias, "porcentaje_paquetes"=>$porcentaje_paquetes, "porcentaje_guias_dia" => $porcentaje_guias_dia, "porcentaje_paquetes_dia" => $porcentaje_paquetes_dia, 'cuenta_pilotos' => $cuenta_pilotos, 'pilotos'=> $pilotos , "filtros" => $filtros ));




//vaciar datos
mysqli_close($conect -> conectarBD());

ob_end_flush();


 ?>
