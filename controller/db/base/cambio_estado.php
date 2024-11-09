<?php
ob_start();
SESSION_START();
date_default_timezone_set("America/Guatemala");

$fecha = date('y-n-j');
$hora = date('H:i:s');



///////////////////////////////////////////////////////////////
require_once ('../cone.php');

  $conect = new basedatos;
  $conect -> conectarBD();



  $pm_nombre = $_SESSION['mush_nombre'];   

  $solicitud = $_POST['solicitud'];
  //$dpi_remitente = $_POST['dpi_remitente'];
   $estado_inicial = $_POST['estado_inicial'];

if (!isset($_POST['status'])) {
    $status ="";
}else{

    $status = $_POST['status'];
}

  
   $nombre_cliente = $_POST['cliente'];



   $cl_accion = "Cambio de Estado";
      


//$numero_remitente = $_POST['numero_remitente'];
//$departamento_remitente = $_POST['departamento_remitente'];
//$municipio_remitente = $_POST['municipio_remitente'];


if ($estado_inicial == $status) {

    echo json_encode(array('error' => 2, 'terror' => 'No' ,'cl_accion' => $cl_accion));

    
}else if($estado_inicial == "Rechazado" ){



    echo json_encode(array('error' => 3, 'terror' => 'No' ,'cl_accion' => $cl_accion));

}else if($status == "" ){



    echo json_encode(array('error' => 4, 'terror' => 'No' ,'cl_accion' => $cl_accion));

}else{


    
        //comentar ticket
        $cl_terror = "no";


        $query1="UPDATE mother SET estatus = '$status'  WHERE id='$solicitud'";
        $resultado=mysqli_query($conect-> conectarBD(), $query1)or die("Error al modificar la solicitud: ".mysqli_error($conect -> conectarBD()));
       

        if (!isset($resultado)) {
            echo"Prueba 1";
        }else{
           
            $date = date('y-n-j');
            $time = date('H:i:s');
            $fecha = $date . " " . $time;
            $consultaLogasig="INSERT INTO logs (cliente, usuario, funcion, accion, fecha) VALUES ('$nombre_cliente', '$pm_nombre', 'Cambio de Estado', '$status', '$fecha')";
            $resultasig=mysqli_query($conect-> conectarBD(), $consultaLogasig)or die("Error al guardar LOG: ".mysqli_error($conect -> conectarBD()));
    


        }


        
        echo json_encode(array('error' => 1, 'terror' =>'Si' ,'cl_accion' => $cl_accion));

}
  






        
       

mysqli_close($conect -> conectarBD());

ob_end_flush();
?>