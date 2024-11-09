<?php
ob_start();

// Conectar a la base de datos
require_once('../cone.php');
$conect = new basedatos;
$conexion = $conect->conectarBD();

// Obtener los parámetros del POST (país, tipo de gestión, tipología)
$pais = $_POST['pais'];
$tipoGestion = $_POST['tipo_de_gestion'];
$tipologia = $_POST['tipologia_f'];

// Consulta SQL para obtener los grupos de la tabla 'logica'
$query = "SELECT grupo FROM logica WHERE pais = '$pais' AND tipogestion = '$tipoGestion' AND tipologia = '$tipologia' GROUP BY grupo";
$resultado = mysqli_query($conexion, $query);

if (!$resultado) {
    // Si hay un error en la consulta, enviar un mensaje de error
    echo json_encode(array('error' => true, 'message' => 'Error en la consulta SQL: ' . mysqli_error($conexion)));
} else {
    $grupos = array();
    while ($row = mysqli_fetch_assoc($resultado)) {
        array_push($grupos, $row['grupo']);
    }

    if (count($grupos) <= 0) {
        // Si no se encontraron resultados, enviar un mensaje de error
        echo json_encode(array('error' => true, 'message' => 'No se encontraron grupos para los parametros proporcionados.'));
    } else {
        // Si se encontraron resultados, enviar los grupos encontrados
        echo json_encode(array('error' => false, 'grupos' => $grupos));
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);

ob_end_flush();
?>
