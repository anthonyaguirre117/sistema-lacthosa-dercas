<?php 

include 'plantilla.php';
include ('../../db/cone.php');

$conect = new basedatos;
$conect -> conectarBD();

SESSION_START();
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set('America/Guatemala');
setlocale(LC_TIME, 'Spanish_Guatemala');

$fecha = date("d/m/Y H:i:s");

$orden = $_REQUEST['orden'];

$solicitud = "SELECT * FROM mother WHERE id ='$orden'";

$solicitud =mysqli_query($conect -> conectarBD(),$solicitud);

while($mostrar = mysqli_fetch_array($solicitud)) {

$orden = $mostrar['orden'];
$numero_pedido = $mostrar['factura'];
$nombre_cliente = $mostrar['nombre'];
$tipo_pago = $mostrar['forma_pago'];
$telefono_cliente = $mostrar['telefono'];
$cambio = $mostrar['cambio'];
$motorista = $mostrar['motorista'];
$direccion_cliente = $mostrar['direccion'];
$indicaciones = $mostrar['indicaciones'];
$total = $mostrar['total'];
$datosJson = $mostrar['descripcion'];
$datosA = json_decode($datosJson);
$numDatos = count($datosA);

}


$pdf =new PDF('P', 'mm', array(76,276));
$pdf->AddPage();
$pdf->SetXY(12,15);
$pdf->Setfont('arial','',18);
$pdf->Cell(100,8,"Comanda Cocina",0,1,'L');
$pdf->SetX(12);
$pdf->Setfont('arial','',10);
$pdf->MultiCell(100,8,utf8_decode("Nombre: $nombre_cliente"),0,'L',0);
$pdf->SetX(12);
$pdf->Cell(100,8,"Factura: $numero_pedido",0,1,'L');
$pdf->SetX(12);
$pdf->Cell(100,8,"Pedido: $orden",0,1,'L');
$pdf->SetX(8);

$pdf->Cell(80,5,'------------------------------------------------',0,1,'L');
  for ($i=0; $i < $numDatos; $i++) { 
    
    $numdatosI = $datosA[$i][1];
    $dato = $datosA[$i][2];
    $precio = $datosA[$i][3];


if ($datosA[$i][0] != "Sugerido") {

$pdf->SetX(10);

$pdf->Cell(10,5, utf8_decode($numdatosI), 0,0, 'L');
$pdf->MultiCell(50,5, utf8_decode($dato),0,'L',0);


    if ($datosA[$i][4] != "") {
      $extra1 = utf8_decode($datosA[$i][4]);
      $pdf->MultiCell(50,8, $extra1,  0,'L',0);
    }else{
      $extra1 = "";
    }

    if ($datosA[$i][5] != "") {
      $anotaciones1 = utf8_decode($datosA[$i][5]);
      $pdf->MultiCell(50,8, $anotaciones1,  0,'L',0);
    }else{
      $anotaciones1 = "";
    }

      if ($datosA[$i][6] != "") {
          $extra2 = utf8_decode($datosA[$i][6]);
          $pdf->MultiCell(50,8, $extra2,  0,'L',0);
    }else{
      $extra2 = "";
    }
        if ($datosA[$i][7] != "") {
          $anotaciones2 = utf8_decode($datosA[$i][7]);
          $pdf->MultiCell(50,8, $anotaciones2,  0,'L',0);
    }else{
      $anotaciones2 = "";
    }
    
        if ($datosA[$i][8] != "") {
      $general = utf8_decode($datosA[$i][8]);
      $pdf->MultiCell(50,8, $general, 0,'L',0);
    }else{
      $general = "";
    }



}else{

$pdf->SetX(10);

$pdf->Cell(10,5, utf8_decode($numdatosI), 0,0, 'L');
$pdf->MultiCell(90,5, $dato, 0,'L',0);

$pdf->SetX(10);


}
    


}
$pdf->SetX(8);
$pdf->Cell(80,5,'------------------------------------------------',0,1,'L');

$pdf->Output('Comanda_cocina.pdf','I');
 ?>



