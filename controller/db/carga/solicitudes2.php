<?php
ob_start();
SESSION_START();
setlocale(LC_TIME, 'Spanish_Guatemala');
date_default_timezone_set("America/Guatemala");


//conectar a base de datos
require_once ('../cone.php');

$conect = new basedatos;
$conect -> conectarBD();

$empresa = $_SESSION['mush_empresa'];

$agregar = "
     <table data-page-length='10' id='seguimiento' class='hover responsive-table centered'>
        <thead>
          <tr>
              <th >Nombre del cliente</th>
              <th>Documento</th>
              <th>DPI</th>            
              <th>Telefono</th>
              <th>Direccion</th>
              <th>Numero</th>
              <th>Tipo Gestion</th>
              <th>Agente</th>
              <th>Fecha y Hora</th>
              <th>Ver</th>
          </tr>
        </thead>

        <tbody>
";

$plasma="SELECT * FROM mother  where estatus = '$empresa' ORDER BY id desc" ;
$resultado= mysqli_query($conect-> conectarBD(), $plasma);

      while($row=$resultado->fetch_assoc()){
$id = $row['id'];
$nombre_cliente = utf8_decode($row['nombre_cliente']);
$documento = $row['documento'];
$nit = $row['nit'];
$telefono = $row['tel'];
$direccion = utf8_decode($row['direccion']);
$entidad_prestamo = utf8_decode($row['entidad_prestamo']);
$status = utf8_decode($row['estatus']);
$agente = utf8_decode($row['agente']);
$fecha_hora = $row['fecha_hora'];


  $agregar .="
            <tr>
            <td>$nombre_cliente</td>
            <td>$documento</td>
            <td>$nit</td>
            <td>$telefono</td>
            <td>$direccion</td>
            <td>$entidad_prestamo</td>
            <td>$status</td>
            <td>$agente</td>
            <td>$fecha_hora</td>

            <td>
              <label>

                <a href='comentario.php?id=$id'><i class='fal fa-share-square fa-2x fontP'></i></a>
              </label>
            </td>
       
          </tr>
  ";




    } 

$agregar .= "                    
        </tbody>
      </table>";

$lineas = mysqli_num_rows($resultado);


if ($lineas <= 0) {
    $error = mysqli_error($conect-> conectarBD());
    echo $funciondata = json_encode(array('error' => true));
  } else {
    echo $funciondata = json_encode(array('error' => false, 'datos' => utf8_encode($agregar)));
  }

//vaciar datos
mysqli_close($conect -> conectarBD());

ob_end_flush();