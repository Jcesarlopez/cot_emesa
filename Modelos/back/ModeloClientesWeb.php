<?php
session_start();

	class ClaseModClientesWeb
	{
		private $con;
		

		public function __construct()
		{
			if($_SESSION['Conexion']=="WEB")
			{
				require_once("ConexionWeb.php");
			}
			if($_SESSION['Conexion']=="SAP")
			{
				require_once("ConexionWeb.php");
			}
			$this->con = new Conexion();
		}	
		
		public function ListaDefault()
		{			

			$sql = "SELECT * FROM clientes WHERE numero>0 and cliente!='' ORDER BY numero DESC LIMIT 5";
			
			 
			return $this->con->consultaRetorno($sql);

		}
		public function filtrar($valor)
		{			

			$sql = "SELECT * FROM clientes WHERE cliente like '%$valor%' or atencion like '%$valor%' ORDER BY numero DESC LIMIT 20";
			return $this->con->consultaRetorno($sql);

		}
		public function unCliente($idClWeb)
		{
			$sql = "SELECT * FROM clientes WHERE numero=$idClWeb";
			return $this->con->consultaRetorno($sql);
		}





	}

?>