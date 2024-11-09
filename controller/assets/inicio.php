<?php 

setlocale(LC_TIME, 'Spanish_Guatemala');
date_default_timezone_set("America/Guatemala");

if (!isset($modulo)) {
      $modulo = "Home";
} 

?>

<!DOCTYPE html>
<html lang="es">
<head>
      <link type="text/css" rel="stylesheet" href="<?php echo SERVERURL; ?>app/css/local.css"  media="screen,projection"/>  
      <!--Import Google Icon Font-->
      <meta charset="UTF-8" />
      <!-- Chrome, Firefox OS y Opera -->
       <meta name="theme-color" content="#6428a1"/>
       <!-- Windows Phone -->
       <meta name="msapplication-navbutton-color" content="#6428a1"/>
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" href="<?php echo SERVERURL; ?>app/css/materialize.css"  rel="stylesheet" media="screen,projection"/>
      <link type="text/css" href="<?php echo SERVERURL; ?>app/css/progress-tracker.css" rel="stylesheet"/>
      <link type="text/css" href="<?php echo SERVERURL; ?>app/css/local.css" rel="stylesheet" media="screen,projection" />
      <link type="text/css" href="<?php echo SERVERURL; ?>app/css/animate.css" rel="stylesheet"/>
      <link type="text/css" href="<?php echo SERVERURL; ?>app/css/fa/css/all.css" rel="stylesheet"/>
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css"/>
      <script type="text/javascript" src="<?php echo SERVERURL; ?>app/js/jquery-3.2.1.min.js"></script>
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <!-- Icono !-->
      <link rel="icon" type="image/x-icon" href="<?php echo SERVERURL; ?>docs/iconos/icono.ico" />
  <title><?php echo $modulo; ?> - PM Scrum - Pronto BPO</title>
</head>

<?php if($modulo == "Login"){
      ?>
      <body>
      <?php
} else {
      ?>
      <body id="bodyprin" class="fondowall2 responsivo">
      <?php
}


