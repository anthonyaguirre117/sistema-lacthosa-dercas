<?php
ob_start();

//conectar a base de datos
require_once ('../cone.php');

$conect = new basedatos;
$conect -> conectarBD();

$Extra = array();

$dato = $_POST['dato'];

$plasma="SELECT  * FROM mother WHERE orden='$dato' OR telefono='$dato' OR nombre like '%$dato' limit 20";
$resultado= mysqli_query($conect-> conectarBD(), $plasma);

$agregar = "<ul class='collection'>";

      while($row=$resultado->fetch_assoc()){

      $orden = $row['orden'];
      $nombre = utf8_decode($row['nombre']);
      $telefono = utf8_decode($row['telefono']);
      $direccion = utf8_decode($row['direccion']);
      $descripcion_factura = utf8_decode($row['descripcion_factura']);
      $fecha = $row['fecha_hora'];
      $fecha = date("d/m/y H:m a", strtotime($fecha));


$agregar .= "
    <li class='collection-item avatar'>
      <a href='comentario.php?rped=$orden'><i class='material-icons circle indigo darken-4'>search</i></a>
      <span class='title'><strong>$orden</strong></span><br>
      <span class='title'><strong>$nombre</strong> - $telefono</span>
      <span>$fecha</span>
      <p>$direccion <br>
         $descripcion_factura
      </p>
      <a href='comentario.php?rped=$orden' class='secondary-content'><i class='material-icons'>fullscreen</i></a>
    </li>
";


         }


$agregar .= "</ul>";

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
?>