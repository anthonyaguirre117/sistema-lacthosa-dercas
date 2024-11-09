<?php
	ob_start();

	SESSION_START();

	date_default_timezone_set("America/Guatemala");
	setlocale(LC_TIME, 'Spanish_Guatemala');

	    //conectar a base de datos
	    require_once ('cone.php');

	  $cl_dato = $_POST['dato'];

  	$conect = new basedatos;
  	$conect -> conectarBD();

  //Calcular buscar ticket
    $consultatabla="SELECT * FROM mother WHERE documento ='$cl_dato' or nombre_cliente like '%$cl_dato%' group by id";
	//mandar informacion a la base de datos
  $resultado=mysqli_query($conect-> conectarBD(), $consultatabla);


  
  $datos = "<table>
        <thead>
          <tr>
              <th>Solicitud</th>
              <th>Cliente</th>
              <th>Documento</th>
              <th>Opcion</th>
          </tr>
        </thead>
        <tbody>";


    while($row=$resultado->fetch_assoc()){
             $cl_solicitud = $row['id'];
             $cl_cliente = $row['nombre_cliente'];
             $cl_documento = $row['documento'];
    //         $cl_nombre = utf8_encode($row['nombre_cliente']);            
            // $cl_fecha = $row['fecha'];
  //           $cl_hora = $row['hora'];
//

             
      $datos .= "<tr>
            <td>$cl_solicitud</td>
            <td>$cl_cliente</td>
            <td>$cl_documento</td>
            <td><a href='comentario.php?id=$cl_solicitud' target='_blank'><i class='material-icons icoacent'>launch</i></a></td>
          </tr>";

      }

      $datos .= "</tbody>
      </table>";
  
  
  
  
      $lineasdebusqueda = mysqli_num_rows($resultado);

 if ($lineasdebusqueda == 1) {

 		echo $funciondata = json_encode(array('error' => false, 'datos' => "1", 'cl_solicitud' => "$cl_solicitud"));


 	////No se encontro ningun ticket
 		///Busqueda por numero
 }else if($lineasdebusqueda > 1){


	echo $funciondata = json_encode(array('error' => false, 'datos' => "$datos", 'cl_solicitud' => "$cl_solicitud"));

 }
 
 /* 
 elseif ($lineasdebusqueda == 0){

  //Calcular buscar Numero
	$consultatabla="SELECT * FROM guias WHERE guia ='$cl_dato' ORDER BY id  DESC limit 25";
	//mandar informacion a la base de datos
  $resultado=mysqli_query($conect-> conectarBD(), $consultatabla);

  $datos = "<table>
        <thead>
          <tr>
          <th>Ticket</th>    
          <th>Guia</th>
          <th>opcion</th>
          </tr>
        </thead>
        <tbody>";


    while($row=$resultado->fetch_assoc()){
             $cl_ticket = $row['ticket'];
             $cl_guia = $row['guia'];

      $datos .= "<tr>
            <td>$cl_ticket</td>
            <td>$cl_guia</td>
            <td><a href='comentario.php?ticket=$cl_ticket' target='_blank'><i class='material-icons icoacent'>launch</i></a></td>
          </tr>";
      }

      $datos .= "</tbody>
      </table>";

   $busquedanumero = mysqli_num_rows($resultado);


   if ($busquedanumero == 1) {

 		echo $funciondata = json_encode(array('error' => false, 'datos' => '1', 'ticket' => "$cl_ticket"));

	////No se encontro ningun ticket
   }else if($busquedanumero >=2){


    echo $funciondata = json_encode(array('error' => false, 'datos' => $datos, 'ticket' => "$cl_ticket"));


   }
   
   /*
  	///Busqueda por nombre 
   elseif ($busquedanumero == 0){

  $cl_dato = utf8_decode($cl_dato);
   	  //Calcular buscar Numero
	$consultatabla="SELECT * FROM ticket WHERE nombre_cliente ='$cl_dato' ORDER BY fecha DESC limit 25";
	//mandar informacion a la base de datos
  $resultado=mysqli_query($conect-> conectarBD(), $consultatabla);

  $datos = "<table>
        <thead>
          <tr>
              <th>Nombre</th>
              <th>Ticket</th>
              <th>Creacion</th>
              <th>opcion</th>
          </tr>
        </thead>
        <tbody>";


    while($row=$resultado->fetch_assoc()){
             $cl_ticket = $row['ticket'];
             $cl_nombre = utf8_encode($row['nombre_cliente']);
             $cl_email = utf8_encode($row['email']);
             $cl_telefono = $row['telefono'];
             $cl_tipologia = utf8_encode($row['tipologia']);
             $cl_niveltipologia = $row['niv_tipologia'];
             $cl_guia = utf8_encode($row['guia']);
             $cl_ubicacion = utf8_encode($row['ubicacion']);
             $cl_capital = utf8_encode($row['capital']);
             $cl_status = $row['status'];
             $cl_asignacion = utf8_encode($row['asignacion']);
             $cl_comentarios = utf8_encode($row['comentarios']);
             $cl_agente = utf8_encode($row['agente']);
             $cl_archivo = $row['archivo'];
             $cl_log = $row['log'];       
             $cl_fecha = $row['fecha'];
             $cl_hora = $row['hora'];

      $datos .= "<tr>
            <td>$cl_nombre</td>
            <td>$cl_ticket</td>
            <td>$cl_fecha $cl_hora</td>
            <td><a href='comentario.php?ticket=$cl_ticket' target='_blank'><i class='material-icons icoacent'>launch</i></a></td>
          </tr>";
      }

      $datos .= "</tbody>
      </table>";

   $busquedanombre = mysqli_num_rows($resultado);

	   if ($busquedanombre >= 1) {
	   		echo $funciondata = json_encode(array('error' => false, 'datos' => $datos, 'ticket' => "$cl_ticket"));
	   }else{
	   		echo $funciondata = json_encode(array('error' => true, 'datos' => "No hay datos."));
	   }


   }
  */

//}
 else{
 	echo $funciondata = json_encode(array('error' => true, 'datos' => "No hay datos."));
 }

  //vaciar datos
mysqli_close($conect -> conectarBD());
ob_end_flush();
 ?>