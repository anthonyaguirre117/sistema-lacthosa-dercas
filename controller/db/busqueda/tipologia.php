<?php
ob_start();

//conectar a base de datos
require_once ('../cone.php');

$conect = new basedatos;
$conect -> conectarBD();

$datos = $_POST['datos'];

$datos = utf8_decode($datos);

$tipologias = array();

$plasma="SELECT tipificaciones FROM tipificaciones WHERE contacto = '$datos' GROUP BY tipificaciones";
$resultado= mysqli_query($conect-> conectarBD(), $plasma);

      while($row=$resultado->fetch_assoc()){
            array_push($tipologias,  utf8_encode($row['tipificaciones']));
         }

$lineas = mysqli_num_rows($resultado);

if ($lineas <= 0) {
    $error = mysqli_error($conect-> conectarBD());
    echo $funciondata = json_encode(array('error' => true));
  } else {
    echo $funciondata = json_encode(array('error' => false, 'tipologias' => $tipologias), JSON_UNESCAPED_UNICODE);
  }

//vaciar datos
mysqli_close($conect -> conectarBD());

ob_end_flush();
?>