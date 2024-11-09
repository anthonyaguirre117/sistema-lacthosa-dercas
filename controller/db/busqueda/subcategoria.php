<?php
ob_start();

//conectar a base de datos
require_once ('../cone.php');

$conect = new basedatos;
$conect -> conectarBD();

$datos = $_POST['datos'];

$datos = utf8_decode($datos);

$categorias = array();

$plasma="SELECT subcategoria FROM info_productos WHERE categoria = '$datos' GROUP BY subcategoria";
$resultado= mysqli_query($conect-> conectarBD(), $plasma);

      while($row=$resultado->fetch_assoc()){
            array_push($categorias,  utf8_encode($row['subcategoria']));
         }

$lineas = mysqli_num_rows($resultado);

if ($lineas <= 0) {
    $error = mysqli_error($conect-> conectarBD());
    echo $funciondata = json_encode(array('error' => true));
  } else {
    echo $funciondata = json_encode(array('error' => false, 'categorias' => $categorias), JSON_UNESCAPED_UNICODE);
  }

//vaciar datos
mysqli_close($conect -> conectarBD());

ob_end_flush();
?>