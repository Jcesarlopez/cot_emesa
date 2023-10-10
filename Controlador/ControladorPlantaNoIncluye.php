<?php
	session_start();
	class NoIncluyePlanta
	{
		public $datos = "";
		public $ContPartidas = 1;

		public function TraerNoIncluCot($IdCotizacion)
		{
			require_once($_SESSION['PathModel']."ModeloPlantaNoIncluye.php");

			$partidas = new NoIncluyePTARDatos();
			$resultado = $partidas->MostrarDatosCot($IdCotizacion);


			unset($_SESSION['PTARNoIncluye']);
			while($row = $resultado->fetch_array(MYSQLI_BOTH))
			{
				$c++;
				$this->AddNoIncluye($this->ContPartidas++,$row['concepto'],1);
			}//Termina el while

		}

		public function CrearNoIncluye($tipo)
		{
			require_once($_SESSION['PathModel']."ModeloPlantaNoIncluye.php");

			$partidas = new NoIncluyePTARDatos();
			$resultado = $partidas->MostrarDatos($tipo);


			unset($_SESSION['PTARNoIncluye']);
			while($row = $resultado->fetch_array(MYSQLI_BOTH))
			{
				$c++;
				$this->AddNoIncluye($this->ContPartidas++,$row['concepto'],1);
			}//Termina el while
		} // Termina la funcion
		public function AddNoIncluye($Indice,$Concepto,$activa) // Si existe la modifica de lo contratrio la crea
		{
			// Se el indice esta en cero quiere decir que vamos aagregar una partida mas
			// por lo tanto la variable indice se le asigna el consecutivo.
			if($Indice==0)
			{
				$Indice = count($_SESSION['PTARNoIncluye'])+1;
			}

			$_SESSION['PTARNoIncluye'][$Indice]['Indice']=$Indice;
			$_SESSION['PTARNoIncluye'][$Indice]['Concepto']=$Concepto;
			$_SESSION['PTARNoIncluye'][$Indice]['Activa']=$activa;

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
		public function MostrarNoIncluye()
		{
			foreach ($_SESSION['PTARNoIncluye'] as $row) {
				$Array[] = $row;
			}
			echo json_encode($Array);
		} // Termina funcion
		public function UnaPartida($Indice)
		{
			echo json_encode($_SESSION['PTARPartidas'][$Indice]);
		}
	} // Termina la clase


	$incluye = new NoIncluyePlanta();
	$accion=$_POST['Accion'];

	$TipoPlanta=$_POST['TipoPlanta'];
	settype($TipoPlanta,"int");

	$Indice = $_POST['Indice'];
	settype($Indice,"int");

	$IdCotizacion = $_POST['IdCotizacion'];

	// Variables para cambiar elemento incluye


	switch ($accion) {
		case 'Crear':
			$incluye->CrearNoIncluye($TipoPlanta);
			$incluye->MostrarNoIncluye();
			break;
		case 'Borrar':
			$incluye->BorrarPartida($Indice);
			$incluye->MostrarPartidas();
			break;
		case 'MostrarP':
			$incluye->UnaPartida($Indice);
			break;
		case 'Agregar':
			$incluye->LlenarPartida($Indice,$Descripcion,$Adicional,$Cant,$CostoU);
			$incluye->MostrarPartidas();
			break;
		case 'Cambiar':
			$incluye->LlenarPartida($Indice,$Descripcion,$Adicional,$Cant,$CostoU);
			$incluye->MostrarPartidas();
			break;
		case 'TraerNoIncluCot':
			$incluye->TraerNoIncluCot($IdCotizacion);
			$incluye->MostrarNoIncluye();
			break;
	}

?>