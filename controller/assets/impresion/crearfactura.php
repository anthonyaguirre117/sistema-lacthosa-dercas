<?php 

include 'plantilla.php';
include ('../../db/cone.php');
require_once ('../../db/conexml.php');

$conect = new basedatos;
$conect -> conectarBD();

$conectxml = new basedatosXML;

SESSION_START();
header("Content-Type: text/html;charset=utf-8");
date_default_timezone_set('America/Guatemala');
setlocale(LC_ALL, 'Spanish_Guatemala');

$fecha = date("d/m/Y H:i:s");

$orden = $_REQUEST['orden'];
$tipo = $_REQUEST['tipo'];


$solicitud = "SELECT * FROM fel WHERE orden ='$orden'";

$resultado =mysqli_query($conectxml -> conectarBDXML(),$solicitud);

while($mostrar = mysqli_fetch_array($resultado)) {


$fechaCertificado =$mostrar['fechaCertificado'];
$fechaEmision = $mostrar['fechaEmision'];
$folio = $mostrar['folio'];
$numeroFactura = $mostrar['numeroFactura'];
$serie = $mostrar['serie'];
$uuidCertificado =$mostrar['uuidCertificado'];
$uuidTransaccion =$mostrar['uuidTransaccion'];
$nit = $mostrar['nit'];
$direccion_cliente = $mostrar['dir'];
$nombre_cliente = $mostrar['nombre'];

}



$solicitud = "SELECT * FROM mother WHERE id ='$orden'";

$resultado =mysqli_query($conect -> conectarBD(),$solicitud);

while($mostrar = mysqli_fetch_array($resultado)) {

$factura_numero = $mostrar['factura'];
$nombre_cliente2 = $mostrar['nombre_factura'];
$telefono_cliente = $mostrar['telefono'];
//$nit = $mostrar['nit'];
//$direccion_cliente = $mostrar['direccion'];
$total = $mostrar['total'];
$datosJson = utf8_decode($mostrar['descripcion']);
$datosA = json_decode($datosJson);
$numDatos = count($datosA);
$rest = $mostrar['restaurante'];
$fecha_emision_ = $mostrar['fecha_hora'];




}

if (isset($nombre_cliente)) {
  $nombre_cliente;
}else{
  $nombre_cliente= "$nombre_cliente2";
}

if (!isset($nit)||$nit=="") {
$nit_cliente = "C/F";

}else{
$nit_cliente = $nit;  
}


$solicitud2 = "SELECT * FROM codigos_restaurantes WHERE ubicacion ='$rest'";



$resultado2 =mysqli_query($conect -> conectarBD(),$solicitud2);

while($mostrar2 = mysqli_fetch_array($resultado2)) {

	$direccion_Rest = $mostrar2['domicilio_comercial'];


}



$pdf =new PDF('P', 'mm', array(76,276));
$pdf->AddPage();
$pdf->SetXY(13,10);
$pdf->Setfont('arial','',10);

$pdf->SetX(13);

$pdf->Setfont('arial','',10);
$pdf->Cell(50,5,'Factura',0,1,'C');



$pdf->Setfont('arial','',9);
$pdf->Cell(50,5,'FEL Documento Tributario Electronico',0,1,'C');



$pdf->Setfont('arial','',10);
$pdf->Cell(50,5,$fecha,0,1,'C');
$pdf->SetX(13);
$pdf->Cell(50,5,'RESTAURANTES Y SERVICIOS, S.A.',0,1,'C');
$pdf->SetX(13);
$pdf->Cell(50,5,'"LOS CEBOLLINES"',0,1,'C');
$pdf->SetX(13);
$pdf->Cell(50,5,'NIT 3882314',0,1,'C');

$pdf->Setfont('arial','',10);
$pdf->MultiCell(50,5,$direccion_Rest, 0,'C',0);
$pdf->Setfont('arial','',10);
$pdf->Ln(8);

if ( !isset($uuidCertificado) || $uuidCertificado == "") {


$pdf->SetX(13);
$pdf->Cell(50,5,'FACTURA NO.'.$factura_numero,0,1,'C');


}else{

$pdf->SetX(13);
$pdf->Cell(50,5,'FACTURA NO.'.$numeroFactura,0,1,'C');

$pdf->Cell(50,5,'Serie '.$serie,0,1,'C');

$pdf->Cell(50,5,'Folio '.$folio,0,1,'C');

$pdf->Setfont('arial','',10);
$pdf->Cell(50,5,'Numero de Cerficado ',0,1,'C');
$pdf->Setfont('arial','',10);
$pdf->MultiCell(50,5,$uuidCertificado, 0,'C',0);


}



$pdf->Setfont('arial','',10);

$pdf->SetX(13);
$pdf->Cell(50,5,'Original Cliente',0,1,'C');

$pdf->SetX(13);
$pdf->Cell(50,5,'Copia Contabilidad',0,1,'C');
$pdf->SetX(13);

$pdf->Ln(8);



$pdf->SetX(13);
$pdf->Cell(50,5,'NOMBRE:',0,1,'C');
$pdf->SetX(13);
$pdf->Multicell(50,5,$nombre_cliente,0,'C',0);
$pdf->SetX(13);
//$pdf->Cell(50,5,'TELEFONO: '.$telefono_cliente,0,1,'C');
$pdf->SetX(13);
$pdf->Cell(50,5,'NIT: '.$nit_cliente,0,1,'C');
$pdf->SetX(13);
$pdf->Cell(50,5,'Direccion: ',0,1,'C');
$pdf->ln(3);
$pdf->SetX(13);
$pdf->Cell(50,5,'____________________________ ',0,1,'C');
$pdf->SetX(13);
$pdf->Ln(5);

$pdf->SetX(8);
$pdf->Cell(60,5,'-----------------------------------------------------',0,1,'C');
$pdf->Ln(5);

$pdf->SetX(7);


$valor = 0;



  for ($i=0; $i < $numDatos; $i++) {

$tipo = $datosA[$i][0];


  if ($tipo == "Normal") {
   	$precio_unitario = $datosA[$i][10];
   	
   }else{
   	$precio_unitario = $datosA[$i][5];

   }
    
    $precio = $datosA[$i][3];
    $numdatosI = $datosA[$i][1];
    $dato = $datosA[$i][2];





//$posicion = $pdf->getY()+5;

$pdf->Cell(5,5, $numdatosI, 0,0, 'L');
$pdf->MultiCell(40,5, $dato, 0,'L',0);


$pdf->setX(50);
$pdf->Cell(20,5,"Precio Unitario ".$precio_unitario, 0,1,'R');
$pdf->setX(50);
$pdf->Cell(20,5,"Descuento 00.00", 0,1,'R');

$pdf->setX(50);
$pdf->Cell(20,5,"Sub total ".$precio, 0,1,'R');

$pdf->SetX(7);

}





$pdf->Ln(5);
$pdf->SetX(8);
$pdf->Cell(60,5,'-----------------------------------------------------',0,1,'C');


$total = $total; 


$pdf->SetX(8);
$pdf->Cell(45,5,'Descuento',0,0,'L');
$pdf->Cell(15,5,"00.00",0,1,'R');
$pdf->SetX(8);
$pdf->Cell(45,5,'Total',0,0,'L');
$pdf->Cell(15,5,$total,0,1,'R');
$pdf->Ln(10);





$pdf->SetX(13);
$pdf->Cell(50,5,'Cajero Express',0,1,'C');
$pdf->SetX(13);
$pdf->MultiCell(50,5,"Fecha Emision",0,'C',0);


if (!isset($uuidCertificado) || $uuidCertificado == "" ) {
	


	$pdf->MultiCell(50,5,$fecha_emision_,0,'C',0);


}else{


$pdf->SetX(13);
$pdf->MultiCell(50,5,$fechaEmision,0,'C',0);

$pdf->SetX(13);
$pdf->MultiCell(50,5,"Fecha DTE",0,'C',0);

$pdf->SetX(13);
$pdf->MultiCell(50,5,$fechaCertificado,0,'C',0);


$pdf->SetX(13);
$pdf->Cell(50,5,'Agente de Retencion Iva',0,1,'C');
$pdf->SetX(13);
$pdf->Cell(50,5,'SUJETO A PAGO TRIMESTRALES',0,1,'C');
$pdf->SetX(13);
$pdf->Cell(50,5,'Segun Articulo No. 72 del ISR ',0,1,'C');
$pdf->SetX(13);
$pdf->Cell(50,5,'Moneda GTQ',0,1,'C');
$pdf->Cell(50,5,'Frase "1"',0,1,'C');
$pdf->cell(50,5,"NIT Certificador 50510231",0,1,"C");
$pdf->cell(50,5,"Certificador Megaprint S,A.",0,1,"C");

}

$pdf->Ln(5);
$pdf->Setfont('arial','B',25);
$pdf->cell(50,5,"EXPRESS",0,1,"C");
$pdf->Ln(5);
$pdf->cell(50,5,"1715",0,1,"C");

$pdf->SetAutoPageBreak(true,0);
$pdf->Output('Factura.pdf','I');

 ?>



