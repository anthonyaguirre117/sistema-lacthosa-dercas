<?php
ob_start();

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){


//conectar a base de datos
require_once ('cone.php');

  $conect = new basedatos;
  $conect -> conectarBD();

  $usuario= mysqli_real_escape_string($conect -> conectarBD(), $_POST['mail']);
  $clave= mysqli_real_escape_string($conect -> conectarBD(), $_POST['contra']);


  $consulta="SELECT * FROM user WHERE email='$usuario' and pass='$clave'";

  //mandar informacion a la base de datos
  $result=mysqli_query($conect-> conectarBD(), $consulta);

  //validar datos
  $filas=mysqli_num_rows($result);

      while($row=$result->fetch_assoc()){

             $template_id = $row['id'];
             $mush_nombre = $row['nombre'];
             $mush_email = $row['email'];
             $mush_empresa = $row['empresa'];
             $mush_tipo = $row['tipo'];
             $mush_genero = $row['genero'];
             $mush_acceso = $row['acceso'];
             $grupo = $row['grupo'];
      }


//si encuentra datos lo hace si no error.
    if ($filas>0):
    
      if ($mush_acceso == 1) {
        
          SESSION_START();

          SESSION_UNSET();

          SESSION_DESTROY();

        echo json_encode(array('error' => false, 'acceso' => 'no'));

      }elseif ($mush_acceso == 2) {

          SESSION_START();

          SESSION_UNSET();

          SESSION_DESTROY();

        echo json_encode(array('error' => false, 'acceso' => 'contra'));

      }else {

        // server should keep session data for AT LEAST 1 hour
        ini_set('session.gc_maxlifetime', 0);
        
        // each client should remember their session id for EXACTLY 1 hour
        session_set_cookie_params(0);        

        SESSION_START(['cookie_lifetime' => 0,]);

        $_SESSION['template_id']=$template_id;                    
        $_SESSION['mush_nombre']=$mush_nombre;                    
        $_SESSION['mush_email']=$mush_email;
        $_SESSION['mush_empresa']=$mush_empresa;
        $_SESSION['mush_tipo']=$mush_tipo;
        $_SESSION['mush_genero']=$mush_genero;
        $_SESSION['mush_acceso']=$mush_acceso;
        $_SESSION['grupo']=$grupo;


        echo json_encode(array('error' => false, 'acceso' => 'si', 'dirI' => $mush_tipo));
      }

    else:

          SESSION_START();

          SESSION_UNSET();

          SESSION_DESTROY();

          $dataerror = mysqli_error($conect -> conectarBD());
          echo json_encode(array('error' => true, "dataerror" => $dataerror));

    endif;

//vaciar datos
mysqli_close($conect -> conectarBD());

}

ob_end_flush();
?>
