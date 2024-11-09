<?php 

SESSION_START();
header("Content-Type: text/html;charset=utf-8");
date_default_timezone_set('America/Guatemala');
setlocale(LC_TIME, 'Spanish_Guatemala');



$dd = date("d/m/Y");
$hh = date("H:m:s");
$mes = date("m");
$dia = date("d");

$fechaarchivo = $dia.$mes;


$mush_tipo = $_SESSION['mush_tipo'];
$mush_empresa = $_SESSION['mush_empresa'];

$rest = $mush_empresa;

if ($mush_tipo == "Admin") {
  $solicitud ="SELECT factura, total, fecha_hora as 'Fecha', forma_pago as 'Forma de Pago', restaurante, cocina FROM mother WHERE MONTH(fecha_hora) = '$mes' AND DAY(fecha_hora)= '$dia' ORDER BY fecha ASC";  
  $detectarZona = "Todos los Restaurantes";
}elseif ($mush_tipo == "Rutero") {
 $solicitud ="SELECT factura, total, fecha_hora as 'Fecha', forma_pago as 'Forma de Pago', restaurante, cocina FROM mother WHERE MONTH(fecha_hora) = '$mes' AND DAY(fecha_hora)= '$dia' AND restaurante = '$rest' ORDER BY fecha ASC";
 $detectarZona = "$mush_empresa";
}else{
$solicitud ="SELECT factura, total, fecha_hora as 'Fecha', forma_pago as 'Forma de Pago', restaurante FROM mother WHERE restaurante = 'Ninguno'"; 
 $detectarZona = "Ninguno";
}

include ('../../db/cone.php');
include 'plantilla.php';

$conect = new basedatos;
$conect -> conectarBD();

$direccion = "6 avenida 9-75 Zona 1 Guatemala, Guatemala";
$zona = "$detectarZona";

$pdf =new PDF('P', 'mm', array(75,250));
$pdf->AddPage();
$pdf->SetFont('arial','b',15);
$pdf->setxy(10,35);
$pdf->cell(55,10,'Corte Financiero',0,1,'C',0);
$pdf->ln(5);
$pdf->setx(10);
$pdf->SetFont('arial','',10);
$pdf->cell(55,10,'RESTAURANTES Y SERVICIOS S,A.',0,1,'C',0);
$pdf->setx(10);
$pdf->SetFont('arial','b',15);
$pdf->cell(55,10,'"LOS CEBOLLINES"',0,1,'C',0);
$pdf->setx(10);


$pdf->SetFont('arial','',10);
$pdf->setx(10);
$pdf->cell(55,10,$zona,0,1,'C',0);
$pdf->setx(10);
$pdf->cell(55,10,"Fecha: ".$dd,0,1,'r',0);
$pdf->setx(10);
$pdf->cell(55,10,"Hora: ".$hh,0,1,'r',0);


$pdf->SetFont('arial','',7);
$pdf->ln(10);
$pdf->setx(8);
$pdf->cell(11,8,'Factura',0,0,'C',0);
$pdf->cell(11,8,'Monto',0,0,'C',0);
$pdf->cell(15,8,'Fecha',0,0,'C',0);
$pdf->cell(13,8,'Status',0,0,'C',0);
$pdf->cell(13,8,'restaurante',0,1,'C',0);


$resultado =mysqli_query($conect -> conectarBD(),$solicitud);

 while($mostrar = mysqli_fetch_array($resultado)) {

 		$numero = $mostrar['factura'];
	 	$total = $mostrar['total'];
	 	$fechaincorrecta = $mostrar['Fecha'];
	 	$fechacorrecta = $fechaincorrecta =date("d/m/Y");
	 	$cocina  = $mostrar['cocina'];
	 	if ($cocina == "Liquidado") {
	 		$status = "Liquidado";
	 	}else{
			$status = "Emitido";	
	 	}
	 	
	 	$restaurante = $mostrar['restaurante'];


$pdf->setx(8);
$pdf->cell(11,8,$numero,0,0,'C',0);
$pdf->cell(11,8,"Q".$total,0,0,'C',0);
$pdf->cell(15,8,$fechacorrecta,0,0,'C',0);
$pdf->cell(13,8,$status,0,0,'C',0);
$pdf->cell(13,8,$restaurante,0,1,'C',0);
$pdf->setx(20);




}

$pdf->ln(10);
$pdf->setx(8);
$pdf->cell(20,8,"Total de Facturas",0,0,'C',0);
$pdf->cell(20,8,"Forma de Pago",0,0,'C',0);
$pdf->cell(20,8,"Total Facturado",0,1,'C',0);




if ($mush_tipo == "Admin") {

$solicitud_2 = "SELECT count(id) as 'numero', sum(total) as 'Total', fecha_hora as 'fecha', forma_pago FROM mother WHERE MONTH(fecha_hora) = '$mes' AND DAY(fecha_hora)='$dia' AND forma_pago ='Efectivo' ORDER BY fecha ASC";

}elseif ($mush_tipo == "Rutero") {

$solicitud_2 = "SELECT count(id) as 'numero', sum(total) as 'Total', fecha_hora as 'fecha', forma_pago FROM mother WHERE MONTH(fecha_hora) = '$mes' AND DAY(fecha_hora)='$dia' AND forma_pago ='Efectivo' AND restaurante LIKE '%$rest%' ORDER BY fecha ASC";

}else{
$solicitud ="SELECT factura, total, fecha_hora as 'Fecha', forma_pago as 'Forma de Pago', restaurante FROM mother WHERE restaurante = 'Ninguno'"; 
}


$resultado_2 =mysqli_query($conect -> conectarBD(),$solicitud_2);



while($mostrar = mysqli_fetch_array($resultado_2)) {


 		$total_facturas = $mostrar['numero'];
	 	$total = $mostrar['Total'];
	 	$forma  = $mostrar['forma_pago'];
if ($total  > 0 ) {
$pdf->setx(8);
$pdf->cell(20,8,$total_facturas,0,0,'C',0);
$pdf->cell(20,8,$forma,0,0,'C',0);
$pdf->cell(20,8,"Q".number_format($total, 2,".", ","),0,1,'C',0);
}


}

$pdf->setx(10);


if ($mush_tipo == "Admin") {

$solicitud_2 = "SELECT count(id) as 'numero', sum(total) as 'Total', fecha_hora as 'fecha', forma_pago FROM mother WHERE MONTH(fecha_hora) = '$mes' AND DAY(fecha_hora)='$dia' AND forma_pago ='Tarjeta' ORDER BY fecha ASC";

}elseif ($mush_tipo == "Rutero") {

$solicitud_2 = "SELECT count(id) as 'numero', sum(total) as 'Total', fecha_hora as 'fecha', forma_pago FROM mother WHERE MONTH(fecha_hora) = '$mes' AND DAY(fecha_hora)='$dia' AND restaurante = '$rest' AND forma_pago ='Tarjeta' ORDER BY fecha ASC";

}else{
$solicitud ="SELECT factura, total, fecha_hora as 'Fecha', forma_pago as 'Forma de Pago', restaurante FROM mother WHERE restaurante = 'Ninguno'"; 
}

$resultado_2 =mysqli_query($conect -> conectarBD(),$solicitud_2);

while($mostrar = mysqli_fetch_array($resultado_2)) {


 		$total_facturas2 = $mostrar['numero'];
	 	$total = $mostrar['Total'];
	 	$forma  = $mostrar['forma_pago'];


	 	if ($total  > 0 ) {

$pdf->setx(8);
$pdf->cell(20,8,$total_facturas2,0,0,'C',0);
$pdf->cell(20,8,$forma,0,0,'C',0);
$pdf->cell(20,8,"Q.".number_format($total, 2,".", ","),0,1,'C',0);
$pdf->setx(8);

	 	}
}

$pdf->ln(5);




if ($mush_tipo == "Admin") {

$solicitud_2 = "SELECT count(id) as 'numero', sum(total) as 'Total', fecha_hora as 'fecha', forma_pago FROM mother WHERE MONTH(fecha_hora) ='$mes' AND DAY(fecha_hora)='$dia'  ORDER BY fecha ASC";

}elseif ($mush_tipo == "Rutero") {

$solicitud_2 = "SELECT count(id) as 'numero', sum(total) as 'Total', fecha_hora as 'fecha', forma_pago FROM mother WHERE MONTH(fecha_hora) ='$mes' AND DAY(fecha_hora)='$dia' AND restaurante = '$rest' ORDER BY fecha ASC";

}else{
$solicitud ="SELECT factura, total, fecha_hora as 'Fecha', forma_pago as 'Forma de Pago', restaurante FROM mother WHERE restaurante = 'Ninguno'"; 
}


$resultado_2 =mysqli_query($conect -> conectarBD(),$solicitud_2);

while($mostrar = mysqli_fetch_array($resultado_2)) {




$total = $mostrar['Total'];
$pdf->setx(8);
$pdf->cell(40,8,"Total Numero Facturas: ",0,0,'C',0);
$sumas_total = $total_facturas2 + $total_facturas;
$pdf->cell(20,8,$sumas_total,0,1,'C',0);
$pdf->setx(8);
$pdf->cell(40,8,"Total Facturado: ",0,0,'C',0);
$pdf->cell(20,8,"Q.". number_format($total, 2,".", ","),0,1,'C',0);
$pdf->setx(8);
$pdf->cell(40,8,"Total Sin Iva: ",0,0,'C',0);

$sinIva = number_format($total / 1.12, 2,".", ",");

$pdf->cell(20,8,"Q.".$sinIva,0,1,'C',0);

}

$pdf->Output("Cierre_$fechaarchivo.php",'I');

