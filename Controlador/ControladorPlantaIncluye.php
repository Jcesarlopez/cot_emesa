<?php
	session_start();
	class IncluyePlanta
	{
		public $datos = "";
		public $ContPartidas = 1;

		public function CrearIncluye($tipo)
		{
			require_once($_SESSION['PathModel']."ModeloPlantaIncluye.php");

			$partidas = new IncluyePTARDatos();
			$resultado = $partidas->MostrarDatos($tipo);


			unset($_SESSION['PTARIncluye']);
			while($row = $resultado->fetch_array(MYSQLI_BOTH))
			{
				$c++;
				$this->AddIncluye($this->ContPartidas++,$row['concepto'],1);
			}//Termina el while
		} // Termina la funcion
		public function TraerIncluCot($IdCotizacion)
		{
			require_once($_SESSION['PathModel']."ModeloPlantaIncluye.php");

			$partidas = new IncluyePTARDatos();
			$resultado = $partidas->MostrarDatosCot($IdCotizacion);


			unset($_SESSION['PTARIncluye']);
			while($row = $resultado->fetch_array(MYSQLI_BOTH))
			{
				$c++;
				$this->AddIncluye($this->ContPartidas++,$row['concepto'],1);
			}//Termina el while
		} // Termina la funcion







		public function AddIncluye($Indice,$Concepto,$activa) // Si existe la modifica de lo contratrio la crea
		{
			// Se el indice esta en cero quiere decir que vamos aagregar una partida mas
			// por lo tanto la variable indice se le asigna el consecutivo.
			if($Indice==0)
			{
				$Indice = count($_SESSION['PTARIncluye'])+1;
			}

			$_SESSION['PTARIncluye'][$Indice]['Indice']=$Indice;
			$_SESSION['PTARIncluye'][$Indice]['Concepto']=$Concepto;
			$_SESSION['PTARIncluye'][$Indice]['Activa']=$activa;

		} // Termina la funcion
		public function BorrarPartida($Indice)
		{
			// Borrar elemento Array1
			unset($_SESSION['PTARPartidas'][$Indice]);

			// Duplicar Array
			$PTARPartidas2=$_SESSION['PTARPartidas'];

			// Borrar Array1
			unset($_SESSION['PTARPartidas']);

			// Llenar Array1
			$this->ContPartidas=1;
			foreach ($PTARPartidas2 as $fila){
				$this->LlenarPartida($this->ContPartidas++,$fila['Descripcion'],$fila['InfoAdicional'],$fila['Cantidad'],$fila['CUnitario'],$fila['Cantidad']*$fila['CUnitario']);
			}
		} // Termina funcion
		public function MostrarIncluye()
		{
			foreach ($_SESSION['PTARIncluye'] as $row) {
				$Array[] = $row;
			}
			echo json_encode($Array);
		} // Termina funcion
		public function UnaPartida($Indice)
		{
			echo json_encode($_SESSION['PTARPartidas'][$Indice]);
		}
	} // Termina la clase


	$incluye = new IncluyePlanta();
	$accion=$_POST['Accion'];

	$TipoPlanta=$_POST['TipoPlanta'];
	settype($TipoPlanta,"int");

	$Indice = $_POST['Indice'];
	settype($Indice,"int");

	$IdCotizacion = $_POST['IdCotizacion'];

	// Variables para cambiar elemento incluye


	switch ($accion) {
		case 'Crear':
			$incluye->CrearIncluye($TipoPlanta);
			$incluye->MostrarIncluye();
			break;
		case 'Borrar':
			$incluye->BorrarPartida($Indice);
			$incluye->MostrarIncluye();
			break;
		case 'MostrarP':
			$incluye->UnaPartida($Indice);
			break;
		case 'Agregar':
			$incluye->LlenarPartida($Indice,$Descripcion,$Adicional,$Cant,$CostoU);
			$incluye->MostrarIncluye();
			break;
		case 'Cambiar':
			$incluye->LlenarPartida($Indice,$Descripcion,$Adicional,$Cant,$CostoU);
			$incluye->MostrarIncluye();
		case 'TraerIncluCot':
			$incluye->TraerIncluCot($IdCotizacion);
			$incluye->MostrarIncluye();
			break;
		case 'TraerNoIncluCot':
			$incluye->TraerNoIncluCot($IdCotizacion);
			$incluye->MostrarIncluye();
			break;
		case 'TraerEntregaCot':
			$incluye->TraerEntregaCot($IdCotizacion);
			$incluye->MostrarIncluye();
			break;
	}

?>