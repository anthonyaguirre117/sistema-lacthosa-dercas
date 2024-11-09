<?php
ob_start(); // sirve para que no se muestre el contenido de la página hasta que se haya procesado todo el código PHP

// Si la petición es una petición AJAX
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

    //conectar a base de datos
    require_once('cone.php');

    $conect = new basedatos;
    $conect->conectarBD();

    $id_usuario = mysqli_real_escape_string($conect->conectarBD(), $_POST['id_usuario']);
    $mush_nombre = mysqli_real_escape_string($conect->conectarBD(), $_POST['mush_nombre']);
    $mush_email = mysqli_real_escape_string($conect->conectarBD(), $_POST['mush_email']);
    $mush_tipo = mysqli_real_escape_string($conect->conectarBD(), $_POST['mush_tipo']);
    $mush_acceso = mysqli_real_escape_string($conect->conectarBD(), $_POST['mush_acceso']);
    $contra = !empty($_POST['template_contra']) ? mysqli_real_escape_string($conect->conectarBD(), $_POST['mush_contra']) : null;

    // Actualizar usuario con o sin contraseña
    if ($contra) {
        $consulta = "UPDATE user SET nombre='$mush_nombre', email='$mush_email', tipo='$mush_tipo', acceso='$mush_acceso', pass='$contra' WHERE id='$id_usuario'";
    } else {
        $consulta = "UPDATE user SET nombre='$mush_nombre', email='$mush_email', tipo='$mush_tipo', acceso='$mush_acceso' WHERE id='$id_usuario'";
    }

    // Ejecutar consulta
    if (mysqli_query($conect->conectarBD(), $consulta)) {
            // Actualizar valores en la sesión
            session_start();
            $_SESSION['template_nombre'] = $template_nombre;
            $_SESSION['template_email'] = $template_email;
            $_SESSION['template_tipo'] = $template_tipo;
            $_SESSION['template_acceso'] = $template_acceso;
            
        echo json_encode(array('error' => false, 'mensaje' => 'Usuario actualizado correctamente'));
    } else {
        $dataerror = mysqli_error($conect->conectarBD());
        echo json_encode(array('error' => true, 'dataerror' => $dataerror));
    }

    // Vaciar datos
    mysqli_close($conect->conectarBD());
} //cerrar la petición AJAX


ob_end_flush(); // sirve para que se muestre el contenido de la página después de que se haya procesado todo el código PHP