<?php
ob_start();
SESSION_START();
setlocale(LC_TIME, 'Spanish_Guatemala');
date_default_timezone_set("America/Guatemala");

        $pm_nombre = $_SESSION['mush_nombre'];                    
        $pm_email = $_SESSION['mush_email'];
        $pm_empresa = $_SESSION['mush_empresa'];
        $pm_tipo = $_SESSION['mush_tipo'];
        $pm_genero = $_SESSION['mush_genero'];
        $pm_acceso = $_SESSION['mush_acceso'];

if ($pm_tipo == "Admin") {
  $plasma="SELECT * FROM log_errores ORDER BY id DESC limit 100 ";
}else{
  $plasma="SELECT * FROM log_errores ORDER BY id DESC limit 0 ";
}

//conectar a base de datos
require_once ('../cone.php');

$conect = new basedatos;
$conect -> conectarBD();

$agregar = "<ul class='collection'>";
//$numero = $_POST['numero'];

$resultado= mysqli_query($conect-> conectarBD(), $plasma);

$numP = mysqli_num_rows($resultado);

      while($row=$resultado->fetch_assoc()){
   
      
   $modulo = utf8_encode($row['modulo']) ;
   $usuario = $row['usuario'];
   $extra = $row['extra'];
   $error = $row['error'];
   $fecha = $row['fecha_hora'];
   $fecha_esp = date("d/m/y H:m a", strtotime($fecha));

$agregar .= "
    <li class='collection-item avatar'>
      <i class='material-icons circle indigo darken-4'>update</i>



    <span class='title'><strong>Modulo: $modulo</strong></span><br>
      <span class='title'>$usuario - $fecha_esp</span><br>
      <p> <br>
         $error 
      </p>




      
      <a href='#!' class='secondary-content'><i class='material-icons'>error_outline</i></a>
    </li>
";

}

$agregar .= "</ul>";


$lineas = mysqli_num_rows($resultado);


if ($lineas <= 0) {
    $error = mysqli_error($conect-> conectarBD());
    echo $funciondata = json_encode(array('error' => true, "errorI" => $error, 'datos' => $agregar));
  } else {
    echo $funciondata = json_encode(array('error' => false, 'datos' => $agregar));
  }

//vaciar datos
mysqli_close($conect -> conectarBD());

ob_end_flush();