<?php
ob_start();
SESSION_START();
setlocale(LC_TIME, 'Spanish_Guatemala');
date_default_timezone_set("America/Guatemala");

//conectar a base de datos
require_once ('../cone.php');

$conect = new basedatos;
$conect -> conectarBD();

$id = $_POST['id'];


$plasma="SELECT * FROM mother WHERE id ='$id'";
$resultado= mysqli_query($conect-> conectarBD(), $plasma);


  while($row=$resultado->fetch_assoc()){
    $nombre_cliente = $row['nombre_cliente'];
    $documento = $row['documento'];
    $nit = $row['nit'];
    $tel = $row['tel'];
    $direccion = $row['direccion'];
    $correo = $row['correo'];
    $entidad_prestamo = $row['entidad_prestamo'];
    $estatus = $row['estatus'];
    $agente = $row['agente'];
    $fecha_hora = $row['fecha_hora'];




}


 
/*



*/

$lineas = mysqli_num_rows($resultado);

if ($lineas <= 0) {
    $error = mysqli_error($conect-> conectarBD());
    echo $funciondata = json_encode(array('error' => true));
  } else {
    echo $funciondata = json_encode(array('error' => false,'nombre_cliente'=>$nombre_cliente, 'documento'=>$documento, 'nit'=>$nit, 'tel'=>$tel, 'direccion'=>$direccion, 'correo'=>$correo, 'entidad_prestamo'=>$entidad_prestamo, 'estatus'=>$estatus, 'agente'=>$agente, 'fecha_hora'=>$fecha_hora ));
  }

//vaciar datos
mysqli_close($conect -> conectarBD());

ob_end_flush();