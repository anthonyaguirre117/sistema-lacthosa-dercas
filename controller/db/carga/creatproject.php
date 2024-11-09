<?php
ob_start();
SESSION_START();
setlocale(LC_TIME, 'Spanish_Guatemala');
date_default_timezone_set("America/Guatemala");


//conectar a base de datos
require_once ('../cone.php');

$conect = new basedatos;
$conect -> conectarBD();


$fecha = date("Y-m-d");
$pm_tipo = $_SESSION['mush_tipo'];
$user = $_SESSION['mush_nombre'];

$cliente =  $_POST['dato'];
$base = $_POST['base'];






 if ($base =="Ventas") {

    $query1 ="SELECT * FROM ventas where codigo = '$cliente' order by id DESC limit 1 " ;
    $resultado1= mysqli_query($conect-> conectarBD(), $query1);

  while($row=$resultado1->fetch_assoc()){

     $nombre = utf8_encode($row['nombrecliente']);
    
     $tel2 = $row['fecha'];
     $tel3 = $row['venta']; 

  }

     
} else if ($base == "Deuda Temprana") {

    $query1 ="SELECT * FROM tel_deuda_temprana where id_servicio = '$cliente'  limit 1" ;
    $resultado1= mysqli_query($conect-> conectarBD(), $query1);

  while($row=$resultado1->fetch_assoc()){

     $nombre = utf8_encode($row['razon_social']);
     $tel1 = $row['tel_1'];
     $tel2 = $row['tel_2'];
     $tel3 = $row['tel_3'];     

  }

     
 } else if ($base == "Propensos") {

    $query1 ="SELECT * FROM tel_propensos where nis_rad = '$cliente' limit 1 " ;
    $resultado1= mysqli_query($conect-> conectarBD(), $query1);

  while($row=$resultado1->fetch_assoc()){

     $nombre = utf8_encode($row['razon_social']);
     $tel1 = $row['telefono_1'];
     $tel2 = $row['telefono_2'];
     $tel3 = $row['telefono_3'];    

     
 } 

  } else if ($base == "cnr") {

    $query1 ="SELECT * FROM cnr where nis_rad = '$cliente'  limit 1" ;
    $resultado1= mysqli_query($conect-> conectarBD(), $query1);

  while($row=$resultado1->fetch_assoc()){

     $nombre = utf8_encode($row['razonsocial']);
     $tel1 = $row['tel_1'];
     $tel2 = $row['tel_2'];
     $tel3 = $row['tel_3'];    



 }





 }






 $datosArraydeClientes = array();

 $query1 ="SELECT * FROM mother WHERE nis = '$cliente' ORDER BY id desc limit 250";
 
 $resultado= mysqli_query($conect-> conectarBD(), $query1);
 
 
       while($row=$resultado->fetch_assoc()){
 
 
         $cliente_b = utf8_encode($row['nis']);
         $nombre_b = utf8_encode($row['nombre_cliente']);
         $tipologia_b=  utf8_encode($row['tipologia']);
         $fecha_b = utf8_encode($row['fecha_hora']);
         $comentario_b = utf8_encode($row['comentario']);
 
 array_push($datosArraydeClientes, array(
     'cliente_b' => $cliente_b,
     'nombre_b' => $nombre_b,
     'tipologia_b' => $tipologia_b,
     'fecha_b' => $fecha_b,
     'comentario_b'=>$comentario_b
 ));
 
     } 

     $cuenta = mysqli_num_rows($resultado1);

     
if ($cuenta == 0) {
   $error = mysqli_error($conect-> conectarBD());

   echo $funciondata = json_encode(array('error' => true));
 } else {
   echo $funciondata = json_encode(array('error'=>false,'nombre'=>$nombre, 'tel2'=>$tel2, 'tel3'=>$tel3, 'base'=>$base,'cliente'=> $cliente , 'datosCliente' => $datosArraydeClientes));
 }

//

 

//vaciar datos
mysqli_close($conect -> conectarBD());

ob_end_flush();