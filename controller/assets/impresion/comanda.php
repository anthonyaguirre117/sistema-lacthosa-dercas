<?php 

include 'plantilla.php';
include ('../../db/cone.php');

$conect = new basedatos;
$conect -> conectarBD();

SESSION_START();
header("Content-Type: text/html;charset=utf-8");
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
$datosJson = utf8_decode($mostrar['descripcion']);
$datosA = json_decode($datosJson);
$numDatos = count($datosA);
$tel_adicional = $mostrar['celular'];

}


$pdf =new PDF('P', 'mm', array(76,276));
$pdf->AddPage();
$pdf->SetXY(13,20);
$pdf->Setfont('arial','',18);
$pdf->Cell(100,8,"Comanda Motorista",0,1,'L');
$pdf->SetX(13);
$pdf->Setfont('arial','',10);
$pdf->MultiCell(100,8,utf8_decode("Nombre: $nombre_cliente"),0,'L',0);
$pdf->SetX(13);
$pdf->Cell(100,8,"Factura: $numero_pedido",0,1,'L');
$pdf->SetX(13);
$pdf->Cell(100,8,"Pedido: $orden",0,1,'L');
$pdf->SetX(13);
$pdf->Cell(100,8,"Tipo de pago: $tipo_pago",0,1,'L');
$pdf->SetX(13);
$pdf->Cell(100,8,utf8_decode("Telefono:  $telefono_cliente"),0,1,'L');
$pdf->SetX(13);
$pdf->Cell(100,8,utf8_decode("Numero Adicional:  $tel_adicional"),0,1,'L');
$pdf->SetX(13);
$pdf->Cell(100,8,"Total: Q. $total",0,1,'L');
$pdf->SetX(13);
$pdf->Cell(100,8,"Paga Con: Q. $cambio",0,1,'L');
$pdf->SetX(13);
$cambios =  $cambio - $total;
$pdf->Cell(100,8,"Cambio: Q. $cambios",0,1,'L');
$pdf->SetX(13);

$pdf->Cell(80,5,'-----------------------------------------',0,1,'L');
  for ($i=0; $i < $numDatos; $i++) { 
    
    $numdatosI = $datosA[$i][1];
    $dato = $datosA[$i][2];
    $precio = $datosA[$i][3];


if ($datosA[$i][0] != "Sugerido") {

$pdf->SetX(15);

$pdf->Cell(5,5, $numdatosI, 0,0, 'L');
$pdf->MultiCell(60,5, $dato, 0,'L',0);


    
    if ($datosA[$i][4] != "") {
      $pdf->SetX(15);
      $extra1 = $datosA[$i][4];
      $pdf->MultiCell(60,8, $extra1, 0,'L',0);
    }else{
      $extra1 = "";
    }

    if ($datosA[$i][5] != "") {
      $anotaciones1 = $datosA[$i][5];
      $pdf->MultiCell(60,8, $anotaciones1, 0,'L',0);
    }else{
      $anotaciones1 = "";
    }

      if ($datosA[$i][6] != "") {
          $extra2 = $datosA[$i][6];
          $pdf->MultiCell(60,8, $extra2, 0,'L',0);
    }else{
      $extra2 = "";
    }
        if ($datosA[$i][7] != "") {
          $anotaciones2 = $datosA[$i][7];
          $pdf->MultiCell(60,8, $anotaciones2, 0,'L',0);
    }else{
      $anotaciones2 = "";
    }
    
        if ($datosA[$i][8] != "") {
      $general = $datosA[$i][8];
      $pdf->MultiCell(60,8, $general, 0,'L',0);
    }else{
      $general = "";
    }

$pdf->SetX(15);

}else{

$pdf->SetX(15);

$pdf->Cell(5,5, $numdatosI, 0,0, 'L');
$pdf->MultiCell(60,5, $dato, 0,'L',0);


$pdf->SetX(15);


}
    


}
$pdf->SetX(13);
$pdf->Cell(80,5,'-----------------------------------------',0,1,'L');
$pdf->LN(2);
$pdf->SetX(13);
$pdf->MultiCell(50,8,utf8_decode("Direccion del Cliente: $direccion_cliente"), 0,'L',0);
$pdf->SetX(13);
$pdf->MultiCell(50,8,utf8_decode("Indicaciones: $indicaciones"), 0,'L',0);


$pdf->Output('Comanda_motorista.pdf','I');

 ?>



