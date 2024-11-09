<?php

ob_start();
SESSION_START();
setlocale(LC_TIME, 'Spanish_Guatemala');
date_default_timezone_set("America/Guatemala");

//conectar a base de datos
require_once ('../cone.php');

$conect = new basedatos;
$conect -> conectarBD();



//$orden = /*$_REQUEST['orden']*/'2';



					//$orden = 39459;
					$id = 1;
					$limited = 2588;



for ($o=2; $o < $limited; $o++) { 




					$plasma = "SELECT * FROM mother WHERE id = '$id'";
					    $result= mysqli_query($conect-> conectarBD(), $plasma);

					    while($mostrar=$result->fetch_assoc()){

					$orden = ['orden'];
					$restaurante = $mostrar ['restaurante'];
					$fecha_mala = $mostrar['fecha_hora'];
					$factura = $mostrar['factura'];
					$fecha_mala = $mostrar['fecha_hora'];
					
					$fecha = date("Y/m/d",strtotime("+$fecha_mala"));
					//$fecha = $fecha = date("Y/m/d");
					
				//	$hora = $fecha = date("H:i:s");
					$hora = date("H:i:s",strtotime("+$fecha_mala"));

					$tipo_doc = "F";
					$turno = $hora;
					$cortesia = 0;
					$transimitida = 1;
					$taza_descuento = "00.00";
					$pgrabo = $hora;
					$produc_serv = "P";
					$total = $mostrar['total'];



					$datosJson = utf8_decode($mostrar['descripcion']);
					$datosA = json_decode($datosJson);
					$numDatos = count($datosA);

					  $datosJson;
					  $datosA;
					  $numDatos;


					       
					    }


$correlativo = 1;

 for ($i=0; $i < $numDatos; $i++) {

$tipo = $datosA[$i][0];


  if ($tipo == "Normal") {
   	$precio_unitario = $datosA[$i][10];
   	
   }else{
   	$precio_unitario = $datosA[$i][5];

   }
    
  
		 $dato = $datosA[$i][2];
    	 $cantidad = $datosA[$i][1];
    	 $precio_unitario;
   
///muestra el PLU Y EL PRDUCTO AL QUE SE REFIERE 



$plasma2 = "SELECT * FROM info_productos WHERE producto = '$dato'";
    $result2= mysqli_query($conect-> conectarBD(), $plasma2);

    while($mostrar=$result2->fetch_assoc()){

    	$plu = $mostrar['id_producto'];







    $plasma3 = "SELECT * FROM xml_facturas WHERE ORDENDELDIA = '$factura'";

    		$result3= mysqli_query($conect-> conectarBD(), $plasma3);

				    while($mostrar=$result3->fetch_assoc()){

				    			$serie = $mostrar['Serie'];
				    			$tienda = $mostrar['tienda'];

				    			}

				    			$funico = $tienda.$serie.$factura;
				    			$punico = $tienda.$serie.$factura.$correlativo;



$correlativo ++;



/*

echo $punico." / ";
echo $factura." / ";
echo $funico." / ";
echo $fecha." / ";
echo $hora." / ";
echo $tipo_doc." / ";
echo $plu." / ";
echo $cantidad." / ";
echo $total." / ";
echo $total." / ";
echo $turno." / ";
echo $cortesia." / ";
echo $transimitida." / ";
echo $taza_descuento." / ";
echo $pgrabo." / ";
echo $produc_serv." / ";
echo $dato." / ";

*/




$Query = "INSERT INTO xml_productos (PUnico, ORDENDELDIA, FUnico, FECHA, Hora, Tipdoc, PLU, Cantidad, Precio, PrecioVenta, Turno, Cortesia, Trasmitida, TasaDeDescuento, Pgrabo, ProdOServ, Descripcion) VALUES ('$punico','$factura','$funico','$fecha','$hora','$tipo_doc','$plu','$cantidad','$precio_unitario','$precio_unitario','$turno','$cortesia','$transimitida','$taza_descuento','$pgrabo','$produc_serv','$dato')";

$resultado = mysqli_query ($conect -> conectarBD(), $Query) or die("Error productos: ".mysqli_error($conect -> conectarBD()));



}

}

$id++;
echo "se agrego la factura ".$factura . "<br>" ;

	
}


//vaciar datos
mysqli_close($conect -> conectarBD());

?>
