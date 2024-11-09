<?php
ob_start();

	/**
	* POO Conectar

	*/


	class basedatos
	{

		/*///

		///datos Productivo
		private $host = "localhost";
		private $dbname = "pronto17_motocity";
		private $user = "pronto17_formulario";
		private $pass = "Pronto2018";


 		
		////datos Prueba
		private $host = "10.11.100.144";
		private $dbname = "pronto17_motocity";
		private $user = "root";
		private $pass = "";
*/
	



		///datos Productivo
		private $host = "localhost";
		private $dbname = "pronto17_lacthosa";
		private $user = "root";
		private $pass = "";


 		
			  


 		
		//funcion de conexion publica
		public function conectarBD(){

		$conect = mysqli_connect($this->host, $this->user, $this->pass, $this->dbname) or die ('Error Conexion base de datos' .  mysqli_error($conect));

		//retornar funcion de conexion
		return $conect;

		}


	}

ob_end_flush();

?>