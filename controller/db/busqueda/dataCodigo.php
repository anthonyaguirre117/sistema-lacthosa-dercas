<?php
ob_start();
SESSION_START();
date_default_timezone_set("America/Guatemala");

$fecha = date('y-n-j');
$hora = date('H:i:s');

require_once ('../cone.php');

$dataInfo = array();

  $conect = new basedatos;
  $conect -> conectarBD();

  $queryreglaescala="SELECT nombre as 'Correo' FROM base";
  //mandar informacion a la base de datos
  $resultado=mysqli_query($conect-> conectarBD(), $queryreglaescala);
   while($row=$resultado->fetch_assoc()){

      $mail = $row['Correo'];

      array_push($dataInfo, array('name' => "".$mail.""));

  }

echo $funciondata = json_encode($dataInfo);

    //vaciar datos
mysqli_close($conect -> conectarBD());
ob_end_flush();


?>
