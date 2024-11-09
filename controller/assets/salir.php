<?php 

ob_start();

  require_once "svrurl.php";
  require_once "inicio.php";
  require_once "scripts.php";

  
if (isset($_REQUEST["session"])) {
	$session = "Seguridad no valida, saliendo del sistema";
	$data = "error";
}else{
	$session = "Saliendo del sistema, hasta luego :D";
	$data = "success";
}

SESSION_START();

SESSION_UNSET();

SESSION_DESTROY();


?>


<script>
$(document).ready(function(){
		swal("Salir", "<?php echo $session; ?>", "<?php echo $data; ?>")
		.then((value)=>{
		  window.location.href = '../../';
		});
});
</script>

<?php

 require_once "fin.php";
ob_end_flush();
?>