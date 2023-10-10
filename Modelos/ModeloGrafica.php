<?php


	class DatosGrafica
	{

		public function __construct()
		{
			require_once("Conexion.php");
			$this->con = new Conexion();
		}
		function CrearDatosGraficaCot($IdCotizacion)
		{
			$sql = "SELECT * FROM cotizaciones_grafica_partidas WHERE iDCotizacion=$IdCotizacion ORDER BY orden ASC";
			return $this->con->consultaRetorno($sql);
		}
		function CrearDatosGrafica($idplanta)
		{
			// Obtenemos el grupo al que pertenece segun la capacidad



			$pi = "plantas_indice";
			$ccg = "cotizaciones_criterios_grafica";
			$cg = "cotizaciones_grafica";


			// Obtenemos la capacidad
			$QueryCapacidad = "SELECT Capacidad FROM $pi WHERE IdPlanta=$idplanta";
			$datos =  $this->con->consultaRetorno($QueryCapacidad);
			while($row = $datos->fetch_array(MYSQLI_BOTH))
			{
				$capacidad = $row['Capacidad'];
			}

			// Obtenemos el grupo
			$QueryGrupo = "SELECT $ccg.grupo FROM $ccg WHERE $ccg.capacidadInicio<=$capacidad and $ccg.capacidadFinal>=$capacidad";
			$datos =  $this->con->consultaRetorno($QueryGrupo);
			while($row = $datos->fetch_array(MYSQLI_BOTH))
			{
				$grupo = $row['grupo'];
			}

			// Obtenemos los conceptos de la Grafica
			$sql = "SELECT concepto,inicio,duracion,orden FROM $cg WHERE grupolps=$grupo ORDER BY orden ASC";

			$datos =  $this->con->consultaRetorno($sql);


			return $datos;


		}


	}
	/*$grafica = new GraficaDatos();
	$grafica->DatosGrafica(100);*/
?>

