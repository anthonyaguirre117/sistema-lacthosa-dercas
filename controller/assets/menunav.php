
    <!--Menu Admin-->
    <!-- Dropdown Structure -->
    <ul id="menuadmin" class="dropdown-content">
      <li><a href="./settings.php" class="black-text"><i class="material-icons black-text">build</i>Configuracion</a></li>
      <li class="divider"></li>
      <li><a href="../controller/assets/salir.php" class="black-text"><i class="material-icons black-text">exit_to_app</i>Salir</a></li>
    </ul>
    <!--Menu Admin-->
    <!-- Dropdown Structure -->

  <a id="nivelUser" class="hide"><?php echo $mush_tipo ?></a>



<!-- Tickets encontrados -->
  <!-- Modal Structure -->
  <div id="busquedatickets" class="modal">
    <div class="modal-content">
      <h4>Tickets encontrados</h4>
      <div id="datosbusqueca"></div>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
    </div>
  </div>
<!-- Tickets encontrados -->




  <!-- NAV -->
    <ul id="slide-out" class="sidenav sidenav-fixed">
    <li style="height: auto;">
     <div class="user-view" style="width: 100%;">
        <div class="row center">
          <div class="col s12">
            <img src="../docs/images/caexlogin.png" alt="LACTHOSA" height="100">
          <!-- i class="fas fa-mountain  fa-7x fontP"></i-->
                  
          </div>
        </div>
     </div>
    </li>
    <li>
      <div class="user-view" style="padding: 0px 32px 0;">
       <a><span class="black-text email"><strong><?php echo $mush_nombre; ?></strong></span></a>

      </div>
    </li>
    <li>
      <?php if ($nav == "101"): ?>

    <a id="n0" class="waves-effect waves-light btn borde7 colorP" href="../index.php"><i class="material-icons white-text right">add_circle</i>Crear Solicitud</a>

        <?php else: ?>

     <a id="n0" class="waves-effect waves-light btn borde7 colorP" href="./index.php"><i class="material-icons white-text right">add_circle</i>Crear Solicitud</a>  

      <?php endif ?>
      
    </li>
    <li><a class="subheader">Menu</a></li>

    <li><a id="n8" class="truncate" href="./solicitudes3.php" ><i id="i2" class="material-icons">beenhere</i>Perfil</a></li>

    <li><a id="n1" href="./dashboard.php" ><i id="i1" class="material-icons">dashboard</i>Dashboard</a></li>
    <li><a id="n2" class="truncate" href="./solicitudes.php" ><i id="i2" class="material-icons">beenhere</i>Solicitudes</a></li>

    <li><a id="n4" class='dropdown-trigger ' href='#' data-target='dropdown1'><i id="i4" class="material-icons">assignment</i>Reporteria</a></li>
    
    <li><a id="n9" class="truncate" href="./usuario.php" ><i id="i9" class="material-icons">beenhere</i>USUARIO</a></li>


    <li><a id="n6" href="../controller/assets/salir.php"><i id="i6" class="material-icons">exit_to_app</i>Salir</a>

    </ul>
    <!-- NAV -->



      <!-- Dropdown Structure -->
  <ul id='dropdown1' class='dropdown-content'>
    <li><a id="n4" href="#" ><i id="i4" class="material-icons">assignment</i>Reporteria</a></li>
    <li><a id="n3" href="./reporteria.php" ><i id="i3" class="material-icons">markunread</i>Reporteria de Solicitudes</a></li>
    <li><a id="n7" href="./reporterialogs.php" ><i id="i7" class="material-icons">history</i>Reporteria Logs</a></li>

  </ul>
  <!-- Dropdown Structure -->


    <script type="text/javascript" charset="utf-8" async>
  let tipoUserV =  $("#nivelUser").text();

  if (tipoUserV == "Agente") {
    $("#n1, #n3, #n4, #n9, #n10, #ne1, #ne3, #ne4, #ne9, #ne10, #ne11, #n11, #n8  ").addClass('hide');
  }else if (tipoUserV == "Rutero") {
    $("#n1, #n0, #n3, #n4, #n9, #ne1, #ne0, #ne3, #ne4, #ne9, #ne11, #n11, #n2").addClass('hide');
  }else if (tipoUserV == "Cocina") {
    $("#n0, #n1, #n2, #n10, #n4, #n6, #n9, #ne0, #ne1, #ne2, #ne10, #ne4, #ne6, #ne9, #ne11, #n11").addClass('hide');
  }else if (tipoUserV == "Motorista") {
    $("#n0, #n1, #n3, #n10, #n4, #n6", "#ne0, #ne1, #ne3, #ne10, #ne4, #ne6, #ne11, #n11").addClass('hide');
  }else{
    console.log("Bienvenido a la cosola Admin, UwU senpai!");
  }
    </script>


    <!-- NAV PRINCIPAL-->
    <nav class="colorP borde7 hoverable" style="width: 97% !important; margin-left: 1.5%; margin-top: 1%; margin-bottom: 25px;">
      <div class="nav-wrapper" style="margin: 25px;">
        <a class="brand-logo" href="#"><i id="ocultarnav" class="material-icons hide-on-med-and-down">fullscreen</i><?php echo utf8_encode(strftime("%A %d de %B del %Y")); ?></a>
        <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
        <?php if ($nav == "101"): ?>

          <li><a href="../pedidos.php"><i class="fab fa-mastodon fa-2x left"></i>MUSH</a></li>
          
          
        <?php else: ?>
          <li><a class="busquedaglobal"><i class="material-icons left">search</i></a></li>
          <li><a id="zonaBienvenido" class="truncate">Bienvenido</a></li>
          <li><a id="dropdownuser" class="dropdown-trigger" data-target="menuadmin"><i class="material-icons left white-text">face</i><?php echo $mush_nombre; ?><i class="material-icons right">arrow_drop_down</i></a></li>

        <?php endif ?>
        </ul>
      </div>
    </nav>
    <!-- NAV PRINCIPAL-->




  <script type="text/javascript" charset="utf-8">

  $("#zonaBienvenido").text("Bienvenido");

  var menunavID = <?php echo $nav ?>;
  if (menunavID == "0") {
    $("#n"+menunavID+"").addClass('animated fadeOut');
    setTimeout(function(){$("#n"+menunavID+"").addClass('hide');}, 500);
  }else{
    $("#n"+menunavID+"").addClass('fontP');
    $("#i"+menunavID+"").addClass('accentfP');
  }

  $("#ocultarnav").click(function(event) {
    event.preventDefault();
    if ($("#slide-out").hasClass('sidenav-fixed')) {
      $("#ocultarnav").text('fullscreen');
      $("#slide-out").removeClass('sidenav-fixed');
      $("#bodyprin").removeClass('responsivo');
      $('.sidenav').sidenav("close");
      actResponsive();
    }else{
      $("#slide-out").addClass('sidenav-fixed');
      $("#bodyprin").addClass('responsivo');
      $('.sidenav').sidenav("open");
      $("#ocultarnav").text('fullscreen_exit');
      actResponsive();
    }
  });


</script>
