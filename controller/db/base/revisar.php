<?php
ob_start();

//conectar a base de datos
require_once ('./../cone.php');

$conect = new basedatos;
$conect -> conectarBD();

  session_start();

$pm_nombre = $_SESSION['mush_nombre'];                    
$pm_email = $_SESSION['mush_email'];
$fecha_solicitud = date("Y-m-d H:i:s");
$id= $_POST['solicitud'];

$query1="UPDATE formulario SET estado='Revisado' WHERE id='$id'";


$resultado1 = mysqli_query ($conect -> conectarBD(), $query1) or die("Error Agregar solicitud : ".mysqli_error($conect -> conectarBD()));




if (!isset($resultado1)) {
    $error = mysqli_error($conect-> conectarBD());
    echo $funciondata = json_encode(array('error' => true));
  } else {
    echo $funciondata = json_encode(array('error' => false, 'data'=>'se guardo de forma correcta' ));
  }


//vaciar datos
mysqli_close($conect -> conectarBD());


ob_end_flush();
?>