<?php
	require('config.php');
	class Conexion{
		protected $sistema;
		public function Conexion(){
			$this->sistema = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
			if($this->sistema->connect_errno)
			{
				echo("error en la base de datos". $this -> sistema->connect_errno." conectando la base de datos.<br>Mensaje: ". $this -> sistema->connect_error);
				exit();
			}
			$this->sistema-> set_charset(DB_CHARSET);
		}
		
	}
	
?>