<?php 
SESSION_START();
header("Content-Type: text/html;charset=utf-8");
date_default_timezone_set('America/Guatemala');
setlocale(LC_TIME, 'Spanish_Guatemala');

include ('../../db/cone.php');
include 'plantilla.php';

$mush_tipo = $_SESSION['mush_tipo'];
$mush_empresa = $_SESSION['mush_empresa'];


$mes = date("m");
$dia = date("d");
$rest = "$mush_empresa";
$Fech = date("d/m/Y H:m:s");

if ($mush_tipo == "Admin") {
$solicitud3 = "SELECT count(id) as 'numero', categoria, restaurante, fecha_hora as 'fecha' FROM r_productos WHERE MONTH(fecha_hora) = '$mes' AND DAY(fecha_hora)='$dia' GROUP BY categoria";

  $detectarZona = "Todos los Restaurantes";
}elseif ($mush_tipo == "Rutero") {
$solicitud3 = "SELECT count(id) as 'numero', categoria, restaurante, fecha_hora as 'fecha' FROM r_productos WHERE MONTH(fecha_hora) = '$mes' AND restaurante = '$rest' AND DAY(fecha_hora)='$dia' GROUP BY categoria";

 $detectarZona = "$mush_empresa";
}else{
$solicitud3 = "SELECT count(id) as 'numero', categoria, restaurante, fecha_hora as 'fecha' FROM r_productos WHERE MONTH(fecha_hora) = '$mes' AND restaurante LIKE 'Ninguno' AND DAY(fecha_hora)='$dia' GROUP BY categoria";

 $detectarZona = "Ninguno";
}




$conect = new basedatos;
$conect -> conectarBD();




$pdf =new PDF('P', 'mm', array(75,210));
$pdf->AddPage();
$pdf->SetFont('arial','B',10);
$pdf->setxy(8,35);
$pdf->cell(60,10,'Corte De Caja',0,1,'C',0);
$pdf->ln(5);
$pdf->setx(8);
$pdf->cell(60,10,'RESTAURANTES Y SERVICIOS S,A.',0,1,'C',0);
$pdf->setx(8);
$pdf->cell(60,10,'"LOS CEBOLLINES"',0,1,'C',0);
$pdf->setx(10);
$pdf->ln(10);

$pdf->SetFont('arial','',8);



$resultado3 =mysqli_query($conect -> conectarBD(),$solicitud3);



 while($mostrar = mysqli_fetch_array($resultado3)) {


 		$categoria = $mostrar['categoria'];
		$numero3 = $mostrar['numero'];
	 	$restaurante3  = $mostrar['restaurante'];
	 	$fecha3  = $mostrar['fecha'];



$pdf->setx(8);
$pdf->cell(35,8,"Categoria: ".$categoria,0,1,'L',0);


if ($mush_tipo == "Admin") {


$solicitud_4 = "SELECT count(id) as 'numero', categoria, producto, sum(cantidad) as 'Cantidad', sum(precio) as 'Total',sum(precio) as 'Total', restaurante, fecha_hora as 'fecha' FROM r_productos WHERE MONTH(fecha_hora) = '$mes'AND categoria = '$categoria' AND  DAY(fecha_hora)='$dia'  GROUP BY producto";

  $detectarZona = "Todos los Restaurantes";

}elseif ($mush_tipo == "Rutero") {


$solicitud_4 = "SELECT count(id) as 'numero', categoria, producto, sum(cantidad) as 'Cantidad', sum(precio) as 'Total',sum(precio) as 'Total', restaurante, fecha_hora as 'fecha' FROM r_productos WHERE MONTH(fecha_hora) = '$mes'AND categoria = '$categoria' AND restaurante = '$rest' AND DAY(fecha_hora)='$dia'  GROUP BY producto";

 $detectarZona = "$mush_empresa";

}else{


$solicitud_4 = "SELECT count(id) as 'numero', categoria, producto, sum(cantidad) as 'Cantidad', sum(precio) as 'Total',sum(precio) as 'Total', restaurante, fecha_hora as 'fecha' FROM r_productos WHERE MONTH(fecha_hora) = '$mes'AND categoria = '$categoria' AND restaurante = 'Ninguno' AND DAY(fecha_hora)='$dia'  GROUP BY producto";

 $detectarZona = "Ninguno";
}

$resultado_4 =mysqli_query($conect -> conectarBD(),$solicitud_4);
$pdf->setx(8);
$pdf->cell(13,8,'Cantidad',0,0,'C',0);
$pdf->cell(10,8,'Total   ',0,0,'C',0);
$pdf->cell(40,8,'Producto',0,1,'L',0);
//$pdf->cell(10,8,'Fecha De Factura',1,1,'C',0);




$pdf->SetFont('arial','',8);

 while($mostrar = mysqli_fetch_array($resultado_4)) {
	 	$producto = $mostrar['producto'];
	 	$cantidad  = $mostrar['Cantidad'];
	 	$total3 = $mostrar['Total'];	
	 	$restaurante3  = $mostrar['restaurante'];
	 	$fecha3  = $mostrar['fecha'];

$pdf->setx(8);
//$position_Y = $pdf->getY();

$pdf->cell(13,6,$cantidad,0,0,'C',0);
$pdf->cell(10,6,$total3,0,0,'C',0);

$pdf->Multicell(40,6,$producto, 0,'L',0);
$position_Y = $pdf->getY();

$pdf->setY($position_Y);


$pdf->setx(8);


}
//
$pdf->ln(10);

	 }


if ($mush_tipo == "Admin") {


$solicitud_5 = "SELECT sum(cantidad) as 'Cantidad', sum(precio) as 'Total', fecha_hora FROM r_productos WHERE MONTH(fecha_hora) = '$mes' AND DAY(fecha_hora)='$dia'";
$solicitud_6 = "SELECT count(id) as 'num' FROM mother WHERE MONTH(fecha_hora) = '$mes' AND DAY(fecha_hora)='$dia'";

  $detectarZona = "Todos los Restaurantes";
}elseif ($mush_tipo == "Rutero") {


$solicitud_5 = "SELECT sum(cantidad) as 'Cantidad', sum(precio) as 'Total', fecha_hora FROM r_productos WHERE MONTH(fecha_hora) = '$mes' AND DAY(fecha_hora)='$dia' AND restaurante = '$rest'";
$solicitud_6 = "SELECT count(id) as 'num' FROM mother WHERE MONTH(fecha_hora) = '$mes' AND DAY(fecha_hora)='$dia' AND restaurante = '$rest'";

 $detectarZona = "$mush_empresa";
}else{


$solicitud_5 = "SELECT sum(cantidad) as 'Cantidad', sum(precio) as 'Total', fecha_hora FROM r_productos WHERE MONTH(fecha_hora) = '$mes' AND DAY(fecha_hora)='$dia' AND restaurante =  'Ninguno'";
$solicitud_6 = "SELECT count(id) as 'num' FROM mother WHERE MONTH(fecha_hora) = '$mes' AND DAY(fecha_hora)='$dia' AND restaurante =  'Ninguno' ";
 $detectarZona = "Ninguno";
}


$resultado_5 =mysqli_query($conect -> conectarBD(),$solicitud_5);

while($mostrar = mysqli_fetch_array($resultado_5)) {

	$totalextra = $mostrar['Total']; 


$resultado_6 =mysqli_query($conect -> conectarBD(),$solicitud_6);
while($mostrar6 = mysqli_fetch_array($resultado_6)) {
	$num = $mostrar6['num']; 
}

$pdf->setx(8);
$pdf->cell(20,8,"Fecha De Emision: ".$Fech,0,1,'L',0);
$pdf->setx(8);
$pdf->cell(20,8,"Numero de Pedidos: ".$num,0,1,'L',0);
$pdf->setx(20);
$pdf->cell(8,8,"Total Facturado: Q".$totalextra,0,1,'L',0);
$pdf->setx(20);
$sin_iva = number_format($totalextra / 1.12, 2,".", ",");
$pdf->cell(10,1,"Total Sin Iva: Q".$sin_iva,0,1,'L',0);

	}




$pdf->Output('Cierre','I');





 ?>