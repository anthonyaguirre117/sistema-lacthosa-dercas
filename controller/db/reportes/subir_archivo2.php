<?php


$tiporepo = $_POST["tipoRepo"];
echo $tiporepo;

if ($tiporepo=="ventas") {

    $conect = mysqli_connect("localhost", "pronto17_formulario", "Pronto2018", "pronto17_caexForm") or die('Error Conexion base de datos' .  mysqli_error($conect));
    $ruta = "./upload/";

 
//$tiporepo = $_POST["tipoRepo"];

var_dump($_FILES);
var_dump($tiporepo);

foreach ($_FILES as $key) {
    # code...
    $nombre = $key["name"];
    $ruta_temporal = $key["tmp_name"];
    $fecha = getdate();
    $nombre_v = $fecha["mday"] . "-" . $fecha["mon"] . "-" . $fecha["year"] . "_" . $fecha["hours"] . "-" . $fecha["minutes"] . "-" . $fecha["seconds"] . ".csv";

    $destino = $ruta . $nombre_v;
    $explo = explode(".", $nombre);

    if ($explo[1] != "csv") {
        $alert = 1;
    } else {

        if (move_uploaded_file($ruta_temporal, $destino)) {

            $alert = 2;
        }
    }
}

$x = 0;
$data = array();
$fichero = fopen($destino, "r");

$datetime = date("Y-m-d H:m:s");

while (($datos = fgetcsv($fichero, 1000)) != FALSE) {
    $x++;
    if ($x > 1) {



        ///Parametros	

        
        $fecha = date("Y-m-d", strtotime($datos[0]));
        $boleta = utf8_decode($datos[1]); 
        $codigo = utf8_decode($datos[2]); 
        $codigoc = utf8_decode($datos[3]); 
        $nit = utf8_decode($datos[4]); 
        $fac = utf8_decode($datos[5]); 
        $venta = utf8_decode($datos[6]); 
        $ventas = utf8_decode($datos[7]); 
        $fecha2 = date("Y-m-d", strtotime($datos[8]));
        $nombrecliente = utf8_decode($datos[9]); 
        $serienumero = utf8_decode($datos[10]); 
        $numerofactura = utf8_decode($datos[11]); 
        $fechaemision = date("Y-m-d", strtotime($datos[12]));
        $mes = utf8_decode($datos[13]); 
        $dia = utf8_decode($datos[14]); 
        $diasemana = utf8_decode($datos[15]); 
        $nombre = utf8_decode($datos[16]); 
        $banco = utf8_decode($datos[17]); 
        $codasesor = utf8_decode($datos[18]); 
        $nombreasesor = utf8_decode($datos[19]); 
        $semanames = utf8_decode($datos[20]); 
        $acap = utf8_decode($datos[21]); 
        $nombreacap = utf8_decode($datos[22]);
        $nuevoasesor = utf8_decode($datos[23]);
        $asesortmk = utf8_decode($datos[24]);   















   

       

        ////Json
        $data[] = '("'. $fecha . '" , "'. $boleta . '" , "'. $codigo . '" , "'. $codigoc . '", "'. $nit . '", "'. $fac . '", "'. $venta . '", "'. $ventas . '" , "'. $fecha2 . '", "'. $nombrecliente . '" , "'. $serienumero . '" , "'. $numerofactura . '", "'. $fechaemision . '", "'. $mes . '" , "'. $dia . '" , "'. $diasemana . '" , "'. $nombre . '" , "'. $banco . '", "'. $codasesor . '" , "'. $nombreasesor . '" , "'. $semanames . '" , "'. $acap . '" , "'. $nombreacap . '" , "'. $nuevoasesor . '" , "'. $asesortmk . '")';
    }
}

$implode = implode(",", $data);

mysqli_query($conect, "INSERT INTO ventas (fecha,boleta,codigo,codigoc,nit,fac,venta,ventas,fecha2,nombrecliente,serienumero,numerofactura,fechaemision,mes,dia,diasemana,nombre,banco,codasesor,nombreasesor,semanames,acap,nombreacap,nuevoasesor,asesortmk)

    VALUES " . $implode) or die("Error: " . mysqli_error($conect));

print_r("<prev>");
print_r($data);
print_r("</prev>");
fclose($fichero);

}  elseif ($tiporepo == "tel_deuda_temprana") {

    $conect = mysqli_connect("localhost", "pronto17_formulario", "Pronto2018", "pronto17_energuate_form") or die('Error Conexion base de datos' .  mysqli_error($conect));

var_dump($_FILES);
var_dump($tiporepo);


    $ruta = "./upload/";

    foreach ($_FILES as $key) {
        # code...
        $nombre = $key["name"];
        $ruta_temporal = $key["tmp_name"];
        $fecha = getdate();
        $nombre_v = $fecha["mday"] . "-" . $fecha["mon"] . "-" . $fecha["year"] . "_" . $fecha["hours"] . "-" . $fecha["minutes"] . "-" . $fecha["seconds"] . ".csv";

        $destino = $ruta . $nombre_v;
        $explo = explode(".", $nombre);

        if ($explo[1] != "csv") {
            $alert = 1;
        } else {

            if (move_uploaded_file($ruta_temporal, $destino)) {

                $alert = 2;
            }
        }
    }

    $x = 0;
    $data = array();
    $fichero = fopen($destino, "r");

    $datetime = date("Y-m-d H:m:s");

    while (($datos = fgetcsv($fichero, 1000)) != FALSE) {
        $x++;
        if ($x > 1) {



            ///Parametros	
            $primero = $datos[0]; ///Numero
            $cliente = $datos[1]; ///Numero
            $nombre = utf8_decode($datos[2]); 
            $mora = utf8_decode($datos[3]); 
            $total = $datos[4]; //Numero
            $pagos = $datos[5]; //Numero
            $porcentaje = $datos[6]; //Numero
            $tipificacion = utf8_decode($datos[7]); 
            $subtipologia = utf8_decode($datos[8]); 
            $comentario = utf8_decode($datos[9]); 
            $telefono = $datos[10];
            $contactodirecto = $datos[11];
            $correo = $datos[12];
            $fecha = $datos[13];
            $asignacion = utf8_decode($datos[14]); 


            ////Json
            $data[] = '("' . $primero . '","' . $cliente . '", "' . $nombre . '", "' . $mora . '","' . $total . '","' . $pagos . '","' . $porcentaje . '","' . $tipificacion . '", "' . $subtipologia . '","' . $comentario . '","' . $telefono . '","' . $contactodirecto . '","' . $correo . '","' . $fecha . '","' . $asignacion . '")';
        }
    }

    $implode = implode(",", $data);

    mysqli_query($conect, "INSERT INTO tel_deuda_temprana (id_servicio,nis_rad,razon_social,tel_1,tel_2,tel_3,region,departamento,municipio,tipo_gd,operacion,importe_deuda,cant_rec,rango_deuda,script) VALUES " . $implode) or die("Error: " . mysqli_error($conect));

    print_r("<prev>");
    print_r($data);
    print_r("</prev>");
    fclose($fichero);

}   elseif ($tiporepo == "tel_propensos") {
    $conect = mysqli_connect("localhost", "pronto17_formulario", "Pronto2018", "pronto17_energuate_form") or die('Error Conexion base de datos' .  mysqli_error($conect));

var_dump($_FILES);
var_dump($tiporepo);


    $ruta = "./upload/";

    foreach ($_FILES as $key) {
        # code...
        $nombre = $key["name"];
        $ruta_temporal = $key["tmp_name"];
        $fecha = getdate();
        $nombre_v = $fecha["mday"] . "-" . $fecha["mon"] . "-" . $fecha["year"] . "_" . $fecha["hours"] . "-" . $fecha["minutes"] . "-" . $fecha["seconds"] . ".csv";

        $destino = $ruta . $nombre_v;
        $explo = explode(".", $nombre);

        if ($explo[1] != "csv") {
            $alert = 1;
        } else {

            if (move_uploaded_file($ruta_temporal, $destino)) {

                $alert = 2;
            }
        }

        echo "tipo de alerta: " .  $alert;
    }


    $x = 0;
    $data = array();
    $fichero = fopen($destino, "r");

    $datetime = date("Y-m-d H:m:s");

    while (($datos = fgetcsv($fichero, 1000)) != FALSE) {
        $x++;
        if ($x > 1) {



            ///Parametros	

            $cliente = $datos[0]; ///Numero
            $nombre = mysqli_real_escape_string($conect, $datos[1]);
             $mora = date("Y-m-d", strtotime($datos[2]));
            $total = $datos[3]; //Numero
            $pagos = $datos[4]; //Numero
            $porcentaje = $datos[5]; //Numero
            $tipificacion = mysqli_real_escape_string($conect, $datos[6]);
            $subtipologia = mysqli_real_escape_string($conect, $datos[7]);
            $comentario = mysqli_real_escape_string($conect, $datos[8]);
            $telefono = $datos[9];
            $contactodirecto = mysqli_real_escape_string($conect, $datos[10]);
            $correo = $datos[11];
            $fecha = utf8_decode($datos[12]); 
            $proyecto = $datos[13];
            $acu_juridico = $datos[14];





            ////Json
            $data[] = '("' . $cliente . '", "' . $nombre . '", "' . $mora . '","' . $total . '","' . $pagos . '","' . $porcentaje . '","' . $tipificacion . '", "' . $subtipologia . '","' . $comentario . '","' . $telefono . '","' . $contactodirecto . '","' . $correo . '","' . $fecha . '","' . $proyecto . '","' . $acu_juridico . '")';
        }
    }

    $implode = implode(",", $data);

    mysqli_query($conect, "INSERT INTO tel_propensos (nis_rad,nis_rad_Sec,f_del_acuerdo,importe,cuotas_pendientes,region,estado_servicio,telefono_1,telefono_2,telefono_3,telefono_4,telefono_5,razon_social,proyecto,acu_juridico) VALUES " . $implode) or die("Error: " . mysqli_error($conect));

    print_r("<prev>");
    print_r($data);
    print_r("</prev>");
    fclose($fichero);

}elseif ($tiporepo=="CNR") {
   









 $conect = mysqli_connect("localhost", "pronto17_formulario", "Pronto2018", "pronto17_energuate_form") or die('Error Conexion base de datos' .  mysqli_error($conect));
    $ruta = "./upload/";

 
//$tiporepo = $_POST["tipoRepo"];

var_dump($_FILES);
var_dump($tiporepo);

foreach ($_FILES as $key) {
    # code...
    $nombre = $key["name"];
    $ruta_temporal = $key["tmp_name"];
    $fecha = getdate();
    $nombre_v = $fecha["mday"] . "-" . $fecha["mon"] . "-" . $fecha["year"] . "_" . $fecha["hours"] . "-" . $fecha["minutes"] . "-" . $fecha["seconds"] . ".csv";

    $destino = $ruta . $nombre_v;
    $explo = explode(".", $nombre);

    if ($explo[1] != "csv") {
        $alert = 1;
    } else {

        if (move_uploaded_file($ruta_temporal, $destino)) {

            $alert = 2;
        }
    }
}

$x = 0;
$data = array();
$fichero = fopen($destino, "r");

$datetime = date("Y-m-d H:m:s");

while (($datos = fgetcsv($fichero, 1000)) != FALSE) {
    $x++;
    if ($x > 1) {



        ///Parametros   

        $nis_rad = $datos[0]; ///Numero
        $cantrec = mysqli_real_escape_string($conect, $datos[1]);
        $importedeuda = $datos[2]; //text
        $importedeudam1 = $datos[3]; //Numero
        $importefraude = utf8_decode($datos[4]); //text
        $menorsetecientos = utf8_decode($datos[5]); //text
        $mayorsetecientos = mysqli_real_escape_string($conect, $datos[6]);
        $descuentocontado = utf8_decode($datos[7]); //text
        $porcendescuento = mysqli_real_escape_string($conect, $datos[8]);
        $descuentoconvenio = utf8_decode($datos[9]); //text
        $porcentajedescuentoconvenio = mysqli_real_escape_string($conect, $datos[10]);
        $deudasindescuento = $datos[11];
        $cuotainicial = utf8_decode($datos[12]); //text
        $cantidaddecuotas = mysqli_real_escape_string($conect, $datos[13]);
        $importecuotas =  mysqli_real_escape_string($conect, $datos[14]);
        $razonsocial = utf8_decode($datos[15]); 
        $tel_1 = mysqli_real_escape_string($conect, $datos[16]);
        $tel_2 = mysqli_real_escape_string($conect, $datos[17]);
        $tel_3 = utf8_decode($datos[18]); //text
        $telefono = utf8_decode($datos[19]); 
        $departamento = utf8_decode($datos[20]); //text
        $municipio = utf8_decode($datos[21]); 
        $id_localidad = mysqli_real_escape_string($conect, $datos[22]);
        $localidad = utf8_decode($datos[23]); 
        $tipogd = utf8_decode($datos[24]); //text
        $operacion = utf8_decode($datos[25]); 

       

        ////Json
        $data[] = '("' . $nis_rad . '", "' . $cantrec . '", "' . $importedeuda . '","' . $importedeudam1 . '","' . $importefraude . '","' . $menorsetecientos . '","' . $mayorsetecientos . '", "' . $descuentocontado . '","' . $porcendescuento . '","' . $descuentoconvenio . '","' . $porcentajedescuentoconvenio . '","' . $deudasindescuento . '","' . $cuotainicial . '","' . $cantidaddecuotas . '","' . $importecuotas . '","' . $razonsocial . '","' . $tel_1 . '","' . $tel_2 . '","' . $tel_3 . '","' . $telefono . '","' . $departamento . '","' . $municipio . '","' . $id_localidad . '","' . $localidad . '","' . $tipogd . '","' . $operacion . '")';
    }
}

$implode = implode(",", $data);

mysqli_query($conect, "INSERT INTO cnr (nis_rad,cantrec,importedeuda,importedeudam1,importefraude,menorsetecientos,mayorsetecientos,descuentocontado,porcendescuento,descuentoconvenio,porcentajedescuentoconvenio,deudasindescuento,cuotainicial,cantidaddecuotas,importecuotas,razonsocial,tel_1,tel_2,tel_3,telefono,departamento,municipio,id_localidad,localidad,tipogd,operacion)

    VALUES " . $implode) or die("Error: " . mysqli_error($conect));

print_r("<prev>");
print_r($data);
print_r("</prev>");
fclose($fichero);
















};

mysqli_close($conect);
