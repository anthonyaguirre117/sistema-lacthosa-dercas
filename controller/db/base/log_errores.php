<?php

ob_start();
SESSION_START();
setlocale(LC_TIME, 'Spanish_Guatemala');
date_default_timezone_set("America/Guatemala");

//conectar a base de datos
require_once ('../cone.php');

$conect = new basedatos;
$conect -> conectarBD();

$fecha_hora = date("Y-m-d H:i:s");
$pm_nombre = $_SESSION['mush_nombre'];  

$usuario_codigo =$_POST['usuario_codigo'];
$estado = $_POST['estado'];
$accion = utf8_decode($_POST['accion']);

$Query = "INSERT INTO logs (usuario_codigo, accion, estado) VALUES ('$usuario_codigo','$estado','$accion')";

$resultado = mysqli_query ($conect -> conectarBD(), $Query) or die("Error: ".mysqli_error($conect -> conectarBD()));

echo $funciondata = json_encode(array('error' => false));

mysqli_close($conect -> conectarBD());

ob_end_flush();
?>