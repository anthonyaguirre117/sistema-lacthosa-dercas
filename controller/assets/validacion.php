<?php

ob_start();

/**
* SEGURIDAD DE SERVIDOR
*/
class seguridad
{
  
  function __construct()
  {
    SESSION_START();
  }


  public function seguridadLogin(){
    if(isset($_SESSION['mush_nombre'])){

      return $inicio = true;

    }else{
        session_destroy();
      
      ?>
    
      <script>
      
      console.log("Se verifico que no hay datos");
      window.location.href = '../';

      </script>

      <?php 
      


    }
  }

  public function iniciologin(){
    if(isset($_SESSION['mush_nombre'])){
      header('location: ./view/');
    } else {
      session_destroy();
    }
  }


      
}

ob_end_flush();
?>