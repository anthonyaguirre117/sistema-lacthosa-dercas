<?php
ob_start();
SESSION_START();
setlocale(LC_TIME, 'Spanish_Guatemala');
date_default_timezone_set("America/Guatemala");

//conectar a base de datos
require_once ('../conexml.php');

$conectxml = new basedatosXML;
$conectxml -> conectarBDXML();

$pm_nombre = $_SESSION['mush_nombre'];  
$fecha = date("Y-m-d H:i:s");
$tiempo = date("H:i:s");

 $orden = $_POST['orden'];
 $funico = $_POST['funico'];
 $numeroFactura = $_POST['numeroFactura'];
 $serie = $_POST['serie'];
 $folio = $_POST['folio'];
 $fechaEmision = $_POST['fechaEmision'];
 $fechaCertificado = $_POST['fechaCertificado'];
 $uuidTransaccion = $_POST['uuidTransaccion'];
 $uuidCertificado = $_POST['uuidCertificado'];
 $xmlCertificado = $_POST['xmlCertificado'];
 $nit = $_POST['nit'];
 $nombre = $_POST['nombre'];
 $dir = $_POST['dir'];
 $usuario = /*$_POST['usuario']*/$pm_nombre;
 $fechaHora = /*$_POST['fechaHora']*/$fecha;

$Query = "INSERT INTO fel (orden, numeroFactura, serie, folio, fechaEmision, fechaCertificado, uuidTransaccion, uuidCertificado, xmlCertificado, usuario, fechaHora, nit, nombre, dir, funico) VALUES ('$orden', '$numeroFactura','$serie', '$folio', '$fechaEmision', '$fechaCertificado', '$uuidTransaccion', '$uuidCertificado', '$xmlCertificado', '$usuario','$fechaHora','$nit','$nombre','$dir','$funico')";

$resultado = mysqli_query ($conectxml -> conectarBDXML(), $Query) or die("Error productos: ".mysqli_error($conectxml -> conectarBDXML()));

////Query Pructos
//vaciar datos

if (!$resultado) {
    $error = mysqli_error($conectxml -> conectarBDXML());
    echo $funciondata = json_encode(array('error' => true));
  } else {
    echo $funciondata = json_encode(array('error' => false));
  }

mysqli_close($conectxml -> conectarBDXML());

ob_end_flush();
?>