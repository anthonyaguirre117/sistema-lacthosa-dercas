<?php 

SESSION_START();
header("Content-Type: text/html;charset=utf-8");
date_default_timezone_set('America/Guatemala');
setlocale(LC_TIME, 'Spanish_Guatemala');

$mush_tipo = $_SESSION['mush_tipo'];
$mush_empresa = $_SESSION['mush_empresa'];

$dd = date("d/m/Y");
$hh = date("H:m:s");
$mes = date("m");
$dia = date("d");
$rest = "$mush_empresa";
$pago = "Tarjeta";

$fechaarchivo = $dia.$mes;

if ($mush_tipo == "Admin") {

$solicitud ="SELECT factura, total, fecha_hora as 'Fecha', forma_pago as 'Forma de Pago', restaurante, cocina FROM mother WHERE MONTH(fecha_hora) = '$mes' AND forma_pago = '$pago' AND DAY(fecha_hora)= '$dia' ORDER BY fecha ASC";

$solicitud_1 = "SELECT count(id) as 'numero', sum(total) as 'Total', fecha_hora as 'fecha', forma_pago FROM mother WHERE MONTH(fecha_hora) = '$mes' AND DAY(fecha_hora)='$dia' AND forma_pago ='Tarjeta' ORDER BY fecha ASC";

$solicitud_2 = "SELECT count(id) as 'numero', sum(total) as 'Total', fecha_hora as 'fecha', forma_pago FROM mother WHERE MONTH(fecha_hora) = '$mes' AND DAY(fecha_hora)='$dia' AND forma_pago ='Tarjeta'  ORDER BY fecha ASC";

$solicitud_3 = "SELECT count(id) as 'numero', sum(total) as 'Total', fecha_hora as 'fecha', forma_pago FROM mother WHERE MONTH(fecha_hora) ='$mes' AND DAY(fecha_hora)='$dia' AND forma_pago ='Tarjeta' ORDER BY fecha ASC";

  $detectarZona = "Todos los Restaurantes";

}elseif ($mush_tipo == "Rutero") {

$solicitud ="SELECT factura, total, fecha_hora as 'Fecha', forma_pago as 'Forma de Pago', restaurante, cocina FROM mother WHERE MONTH(fecha_hora) = '$mes' AND forma_pago = '$pago' AND DAY(fecha_hora)= '$dia' AND restaurante = '$rest' ORDER BY fecha ASC";

$solicitud_1 = "SELECT count(id) as 'numero', sum(total) as 'Total', fecha_hora as 'fecha', forma_pago FROM mother WHERE MONTH(fecha_hora) = '$mes' AND DAY(fecha_hora)='$dia' AND forma_pago ='Tarjeta' AND restaurante =  '$rest' ORDER BY fecha ASC";

$solicitud_2 = "SELECT count(id) as 'numero', sum(total) as 'Total', fecha_hora as 'fecha', forma_pago FROM mother WHERE MONTH(fecha_hora) = '$mes' AND DAY(fecha_hora)='$dia' AND forma_pago ='Tarjeta' AND restaurante = '$rest' ORDER BY fecha ASC";

$solicitud_3 = "SELECT count(id) as 'numero', sum(total) as 'Total', fecha_hora as 'fecha', forma_pago FROM mother WHERE MONTH(fecha_hora) ='$mes' AND DAY(fecha_hora)='$dia' AND restaurante = '$rest' AND forma_pago ='Tarjeta' ORDER BY fecha ASC";

 $detectarZona = "$mush_empresa";

}else{

$solicitud ="SELECT factura, total, fecha_hora as 'Fecha', forma_pago as 'Forma de Pago', restaurante FROM mother WHERE MONTH(fecha_hora) = '$mes' AND forma_pago = '$pago' AND DAY(fecha_hora)= '$dia' AND restaurante = 'Ninguno' ORDER BY fecha ASC";

$solicitud_1 = "SELECT count(id) as 'numero', sum(total) as 'Total', fecha_hora as 'fecha', forma_pago FROM mother WHERE MONTH(fecha_hora) = '$mes' AND DAY(fecha_hora)='$dia' AND forma_pago ='Tarjeta' AND restaurante =  'Ninguno' ORDER BY fecha ASC";

$solicitud_2 = "SELECT count(id) as 'numero', sum(total) as 'Total', fecha_hora as 'fecha', forma_pago FROM mother WHERE MONTH(fecha_hora) = '$mes' AND DAY(fecha_hora)='$dia' AND forma_pago ='Tarjeta' AND restaurante = 'Ninguno' ORDER BY fecha ASC";

$solicitud_3 = "SELECT count(id) as 'numero', sum(total) as 'Total', fecha_hora as 'fecha', forma_pago FROM mother WHERE MONTH(fecha_hora) ='$mes' AND DAY(fecha_hora)='$dia' AND restaurante = 'Ninguno' AND forma_pago ='Tarjeta' ORDER BY fecha ASC";

 $detectarZona = "Ninguno";

}

include ('../../db/cone.php');
include 'plantilla.php';

$conect = new basedatos;
$conect -> conectarBD();

$zona = "$detectarZona";

$pdf =new PDF('P', 'mm', array(75,210));
$pdf->AddPage();
$pdf->SetFont('arial','b',10);
$pdf->setxy(8,25);
$pdf->cell(60,10,'Corte Financiero',0,1,'C',0);
$pdf->ln(5);
$pdf->setx(8);
$pdf->SetFont('arial','',10);
$pdf->cell(60,10,'RESTAURANTES Y SERVICIOS S,A.',0,1,'C',0);
$pdf->setx(8);
$pdf->SetFont('arial','b',10);
$pdf->cell(60,10,'"LOS CEBOLLINES"',0,1,'C',0);
$pdf->setx(10);


$pdf->SetFont('arial','',7);
$pdf->setx(8);
$pdf->cell(60,10,$zona,0,1,'C',0);
$pdf->setx(8);
$pdf->cell(60,10,"Fecha: ".$dd,0,1,'r',0);
$pdf->setx(8);
$pdf->cell(60,1,"Hora: ".$hh,0,1,'r',0);



$pdf->ln(10);
$pdf->setx(8);
$pdf->cell(10,8,'Factura',0,0,'C',0);
$pdf->cell(10,8,'Monto',0,0,'C',0);
$pdf->cell(13,8,'Fecha',0,0,'C',0);
$pdf->cell(13,8,'Status',0,0,'C',0);
$pdf->cell(13,8,'Restaurante',0,1,'C',0);
$pdf->setx(8);

$pdf->SetFont('arial','',7);

$resultado =mysqli_query($conect -> conectarBD(),$solicitud);

 while($mostrar = mysqli_fetch_array($resultado)) {

 		$numero = $mostrar['factura'];
	 	$total = $mostrar['total'];
	 	$fechaincorrecta  = $mostrar['Fecha'];
	 	$fechacorrecta = $fechaincorrecta =date("d/m/Y");
	 	$cocina  = $mostrar['cocina'];
	 	if ($cocina == "Liquidado") {
	 		$status = "Liquidado";
	 	}else{
			$status = "Emitido";	
	 	}	
	 	$restaurante = $mostrar['restaurante'];

$pdf->setx(8);
$pdf->cell(10,8,$numero,0,0,'C',0);
$pdf->cell(10,8,"Q".$total,0,0,'C',0);
$pdf->cell(13,8,$fechacorrecta,0,0,'C',0);
$pdf->cell(13,8,$status,0,0,'C',0);
$pdf->cell(13,8,$restaurante,0,1,'C',0);
$pdf->setx(8);


}

$pdf->ln(10);
$pdf->setx(8);
$pdf->cell(19,8,"Total de Facturas",0,0,'C',0);
$pdf->cell(27,8,"Forma de Pago",0,0,'C',0);
$pdf->cell(10,8,"Total Facturado",0,0,'C',0);


$resultado_1 =mysqli_query($conect -> conectarBD(),$solicitud_1);



while($mostrar = mysqli_fetch_array($resultado_1)) {


 		$total_facturas = $mostrar['numero'];
	 	$total = $mostrar['Total'];
	 	$forma  = $mostrar['forma_pago'];

if ($total  > 0 ) {
$pdf->ln(10);
$pdf->setx(8);
$pdf->cell(19,8,$total_facturas,0,0,'C',0);
$pdf->cell(27,8,$forma,0,0,'C',0);
$pdf->cell(15,8,$total,0,1,'C',0);
}


}


$pdf->ln(5);
$pdf->setx(8);
$pdf->cell(32,8,"Total Facturado:",0,0,'C',0);

$resultado_3 =mysqli_query($conect -> conectarBD(),$solicitud_3);

while($mostrar = mysqli_fetch_array($resultado_3)) {

$total = $mostrar['Total'];
$pdf->cell(10,8,"Q.".$total,0,1,'C',0);

}

$pdf->cell(30,8,"Total Sin Iva:",0,0,'C',0);
$sin_iva = number_format($total / 1.12, 2,".", ",");
$pdf->cell(10,8,"Q.".$sin_iva,0,1,'C',0);


$pdf->Output("Cierre$fechaarchivo.pdf",'I');

