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

$agregar ="";

$plasma="SELECT * FROM info_comentarios WHERE solicitud ='$id'";

$resultado= mysqli_query($conect-> conectarBD(), $plasma);

      while($row=$resultado->fetch_assoc()){

$titulo = $row['titulo'];
$usuario = $row['persona'];
$comentario = $row['comentario'];

$fecha = $row['fecha_hora'];


$creado = date("d/m/y H:m a", strtotime($fecha));


    $agregar .= "<li class='collection-item avatar'  style='padding-left: 10px !important;'>
                <span class='title titufont'>".$usuario."</span>
                  <p class='arrfont' style='margin-bottom: 10px;'>$creado<br><br>
                               ".$comentario."
                               <br>
                    </p></li> 
              ";

  }


$lineas = mysqli_num_rows($resultado);

if ($lineas <= 0) {
    $error = mysqli_error($conect-> conectarBD());
    echo $funciondata = json_encode(array('error' => true));
  } else {
    echo $funciondata = json_encode(array('error' => false, 'datos' => $agregar));
  }

//vaciar datos
mysqli_close($conect -> conectarBD());

ob_end_flush();