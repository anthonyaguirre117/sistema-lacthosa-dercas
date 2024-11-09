<?php

ob_start();
SESSION_START();
setlocale(LC_TIME, 'Spanish_Guatemala');
date_default_timezone_set("America/Guatemala");


//conectar a base de datos
require_once ('../cone.php');

$conect = new basedatos;
$conect -> conectarBD();

$pm_nombre = $_SESSION['mush_nombre'];  
$fecha = date("Y-m-d H:i:s");
$tiempo = date("H:i:s");

 $orden = $_POST['orden'];

$Query= "UPDATE mother SET cocina='Liquidado' WHERE id='$orden'";

$resultado = mysqli_query ($conect -> conectarBD(), $Query) or die("Error: ".mysqli_error($conect -> conectarBD()));

///////////////////////////////////////////////////////////////
////Funcion orden (Esteban)
$resultado = mysqli_query($conect-> conectarBD(), "SELECT * FROM mother WHERE id = '$orden'");
$row = $resultado->fetch_assoc();
$orden = $row['orden'];
///////////////////////////////////////////////////////////////

$Query_log = "INSERT INTO log (orden, usuario, funcion, accion, fecha) VALUES ('$orden', '$pm_nombre ', 'Orden Terminada', 'El motorista termino la orden', '$fecha')";

$resultado_log = mysqli_query ($conect -> conectarBD(), $Query_log) or die("Error: ".mysqli_error($conect -> conectarBD()));

//vaciar datos
mysqli_close($conect -> conectarBD());

if (!$resultado) {
    $error = mysqli_error($conect-> conectarBD());
    echo $funciondata = json_encode(array('error' => true));
  } else {
    echo $funciondata = json_encode(array('error' => false, 'orden' => $orden));
  }

ob_end_flush();
?>


    
