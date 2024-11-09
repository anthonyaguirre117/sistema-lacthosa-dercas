<?php
ob_start();
SESSION_START();
date_default_timezone_set("America/Guatemala");

$fecha = date('y-n-j');
$hora = date('H:i:s');


require_once ('cone.php');

  $conect = new basedatos;
  $conect -> conectarBD();

$comentario = $_POST["comentario"];
$id = $_POST["id"];


        ////////////////Log
        $cl_name = $_SESSION['mush_nombre'];
        $date = date('y-n-j');
        $time = date('H:i:s');
        $fecha = $date . " " . $time;
        //$consultaLogasig="INSERT INTO log (orden, usuario, funcion, accion, fecha) VALUES ('$pedido', '$cl_name', 'Pedido Comentado', 'Se Comento el Pedido', '$fecha')";
        //$resultasig=mysqli_query($conect-> conectarBD(), $consultaLogasig);
        ///////////////////Log
    
        //comentar ticket
        $cl_terror = "no";
       $consulta="INSERT INTO info_comentarios (solicitud, titulo, comentario, persona, fecha_hora) values ('$id', 'Solicitud Comentada', '$comentario', '$cl_name', '$fecha')";


        $resultado=mysqli_query($conect-> conectarBD(), $consulta) or die("Error Agregar el comentario : ".mysqli_error($conect-> conectarBD()));;

        $cl_accion = "Comentado";
      
       if (!$resultado) {

          
          echo $funciondata = json_encode(array('error' => true, 'terror' => $cl_terror , 'cl_pedido' => $id, 'cl_accion' => $cl_accion));
        } else {
          echo $funciondata = json_encode(array('error' => false, 'terror' => $cl_terror , 'cl_pedido' => $id, 'cl_accion' => $cl_accion));
        }

mysqli_close($conect -> conectarBD());

ob_end_flush();
?>