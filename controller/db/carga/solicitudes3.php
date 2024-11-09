<?php
ob_start();
SESSION_START();
setlocale(LC_TIME, 'Spanish_Guatemala');
date_default_timezone_set("America/Guatemala");

// Conectar a base de datos
require_once ('../cone.php');

$conect = new basedatos;
$conect -> conectarBD();

$empresa = $_SESSION['grupo'];

$agregar = "
     <table data-page-length='10' id='seguimiento' class='hover responsive-table centered'>
        <thead>
          <tr>
              <th>Ticket</th>
              <th>Nombre del cliente</th>
              <th>Documento</th>
              <th>DNI</th>            
              <th>Telefono</th>
              <th>Comentario</th>
              <th>Tipo Gestion</th>
              <th>Agente</th>
              <th>Fecha y Hora</th>
              <th>Ver</th>
          </tr>
        </thead>
        <tbody>
";

$plasma = "SELECT * FROM mother WHERE asignado = '$empresa' ORDER BY id DESC";
$resultado = mysqli_query($conect->conectarBD(), $plasma);

// Contador de tickets activos
$contador_activos_query = "SELECT COUNT(*) AS activos FROM mother WHERE asignado = '$empresa' and estatus ='Activo'";
$contador_result = mysqli_query($conect->conectarBD(), $contador_activos_query);
$contador_row = mysqli_fetch_assoc($contador_result);
$contador_activos = $contador_row['activos'];




while ($row = $resultado->fetch_assoc()) {
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

    $agregar .= "
            <tr>
            <td>$id</td>
            <td>$nombre_cliente</td>
            <td>$documento</td>
            <td>$nit</td>
            <td>$telefono</td>
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
    $error = mysqli_error($conect->conectarBD());
    echo $funciondata = json_encode(array('error' => true));
} else {
    echo $funciondata = json_encode(array('error' => false, 'datos' => utf8_encode($agregar), 'total_activos' => $contador_activos));
}

// Vaciar datos
mysqli_close($conect->conectarBD());

ob_end_flush();