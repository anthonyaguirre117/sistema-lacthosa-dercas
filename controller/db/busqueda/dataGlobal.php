<?php
ob_start();
SESSION_START();
date_default_timezone_set("America/Guatemala");

$fecha = date('y-n-j');
$hora = date('H:i:s');

require_once ('../cone.php');

  $conect = new basedatos;
  $conect -> conectarBD();

$usuario = $_POST["nombre"];

  $queryreglaescala="SELECT * FROM base WHERE nombre = '$usuario' ";
  //mandar informacion a la base de datos
  $resultado=mysqli_query($conect-> conectarBD(), $queryreglaescala);
   while($row=$resultado->fetch_assoc()){

    $centro_costo = $row['centro_costo'];
    $codigo = $row['codigo'];

  }

echo $funciondata = json_encode(array('centroCosto' => $centro_costo, 'codigo' => $codigo));

    //vaciar datos
mysqli_close($conect -> conectarBD());
ob_end_flush();


?>
