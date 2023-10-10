<?php
	
	class DatosMatPartidas
	{

		public function __construct()
		{
			require_once("Conexion.php");		
			$this->con = new Conexion();
		}
		public function unidades()
		{
			$sql = "SELECT * FROM unidades";
			return $this->con->consultaRetorno($sql);
		}
		public function PartidasCot($IdCotizacion)
		{

			$sql = "SELECT * FROM cotizaciones_partidas WHERE IdCotizacion = $IdCotizacion ORDER BY orden ASC";
			$_SESSION['LL'] = $sql;
			return $this->con->consultaRetorno($sql);

		}
	}


?>