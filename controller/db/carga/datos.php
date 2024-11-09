<?php
ob_start();
SESSION_START();
setlocale(LC_TIME, 'Spanish_Guatemala');
date_default_timezone_set("America/Guatemala");


//conectar a base de datos
require_once ('../cone.php');

$conect = new basedatos;
$conect -> conectarBD();

$agregar = "";

$cliente_b = "0";

$lineas = mysqli_num_rows($resultado);



if ($lineas <= 0) {
    $error = mysqli_error($conect-> conectarBD());
    echo $funciondata = json_encode(array('error' => true));
  } else {
    echo $funciondata = json_encode($datosArraydeClientes);
  }



//vaciar datos
mysqli_close($conect -> conectarBD());

ob_end_flush();