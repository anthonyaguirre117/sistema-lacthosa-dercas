<?php
ob_start();
SESSION_START();
setlocale(LC_TIME, 'Spanish_Guatemala');
date_default_timezone_set("America/Guatemala");

//conectar a base de datos
require_once('./../cone.php');

$conect = new basedatos;
$conect->conectarBD();

$pm_nombre = $_SESSION['mush_nombre'];
$pm_email = $_SESSION['mush_email'];

$fecha_hora = date("Y-m-d H:i:s");

//DATOS RECIBIDOS
$nombre_cliente = $_POST['nombre_cliente'];
$dpi = $_POST['dpi'];
$nit = $_POST['nit'];
$tel = $_POST['tel'];
$direccion = $_POST['direccion'];
$correo = $_POST['correo'];
$entidadPrestamo = $_POST['entidadPrestamo'];

$status = $_POST['tipo_de_gestion'];
$subtipologia = $_POST['tipologia_f'];
$pais = $_POST['pais'];
$regionf = $_POST['regionf'];


$funcion = "Tipificacion";

$accion = "Ingreso Tipificacion al cliente " . $nombre_cliente;


// asignacion y destino de correo

$consulta1 = "SELECT * FROM logica WHERE pais = '$pais' and tipogestion ='$status' and tipologia= '$subtipologia' and grupo ='$regionf' LIMIT 1";
$resultado1 = mysqli_query($conect->conectarBD(), $consulta1);

while ($row = $resultado1->fetch_assoc()) {
  $escalacion = $row['escalacion'];
};

$conexion = $conect->conectarBD();
// Realizar la inserción
$query1 = "INSERT INTO mother (nombre_cliente, documento, nit, tel, direccion, correo, entidad_prestamo, estatus, subtipologia, agente, fecha_hora, pais, asignado, region) VALUES ('$nombre_cliente', '$dpi', '$nit', '$tel', '$direccion', '$correo', '$entidadPrestamo', '$status', '$subtipologia', '$pm_nombre', '$fecha_hora', '$pais', '$escalacion', '$regionf')";

// Ejecutar la consulta
$resultado1 = mysqli_query($conexion, $query1) or die("Error al agregar solicitud 1: " . mysqli_error($conexion));

// Obtener el ID del último registro insertado
$last_id = mysqli_insert_id($conexion);


$Query2 = "INSERT INTO logs (cliente, usuario,funcion,accion,fecha) VALUES ('$nombre_cliente','$pm_nombre','$funcion','$accion','$fecha_hora')";

$resultado2 = mysqli_query($conect->conectarBD(), $Query2) or die("Error Agregar solicitud 2 : " . mysqli_error($conect->conectarBD()));

if (!$resultado1) {
  $error = mysqli_error($conect->conectarBD());
  echo $funciondata = json_encode(array('error' => true));
} else {
  echo $funciondata = json_encode(array('error' => false, 'data' => 'se guardo de forma correcta', 'ticket' => $last_id));
}

//vaciar datos
mysqli_close($conect->conectarBD());


ob_end_flush();
