<?php
	session_start();	
	class EntregarPlanta
	{
		public $datos = "";
		public $ContPartidas = 1;

		public function TraerEntregaCot($IdCotizacion)
		{

			require_once($_SESSION['PathModel']."ModeloPlantaEntregar.php");			
			
			$partidas = new EntregarPTARDatos();
			$resultado = $partidas->MostrarDatosCot($IdCotizacion);
			
		
			unset($_SESSION['PTAREntregar']);							
			while($row = $resultado->fetch_array(MYSQL_BOTH))			
			{				
				$c++;				
				$this->AddEntregar($this->ContPartidas++,$row['concepto'],1);
			}//Termina el while				


		}
		
		public function CrearEntregar($tipo)
		{
			require_once($_SESSION['PathModel']."ModeloPlantaEntregar.php");			
			
			$partidas = new EntregarPTARDatos();
			$resultado = $partidas->MostrarDatos($tipo);
			
		
			unset($_SESSION['PTAREntregar']);							
			while($row = $resultado->fetch_array(MYSQL_BOTH))			
			{				
				$c++;				
				$this->AddEntregar($this->ContPartidas++,$row['concepto'],1);
			}//Termina el while				
		} // Termina la funcion	
		public function AddEntregar($Indice,$Concepto,$activa) // Si existe la modifica de lo contratrio la crea
		{			
			if($Indice==0)
			{
				$Indice = count($_SESSION['PTAREntregar'])+1;
			}
			
			$_SESSION['PTAREntregar'][$Indice]['Indice']=$Indice;
			$_SESSION['PTAREntregar'][$Indice]['Concepto']=$Concepto;
			$_SESSION['PTAREntregar'][$Indice]['Activa']=$activa;

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
		public function MostrarEntregar()
		{
			foreach ($_SESSION['PTAREntregar'] as $row) {
				$Array[] = $row;
			}			
			echo json_encode($Array);	
		} // Termina funcion	
		public function UnaPartida($Indice)
		{
			echo json_encode($_SESSION['PTARPartidas'][$Indice]);
		}		
	} // Termina la clase


	$incluye = new EntregarPlanta();	
	$accion=$_POST['Accion'];

	$TipoPlanta=$_POST['TipoPlanta'];
	settype($TipoPlanta,"int");	

	$Indice = $_POST['Indice'];
	settype($Indice,"int");	

	$IdCotizacion = $_POST['IdCotizacion'];

	// Variables para cambiar elemento incluye
	
	
	switch ($accion) {
		case 'Crear':
			$incluye->CrearEntregar($TipoPlanta);			
			$incluye->MostrarEntregar();
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
		case 'TraerEntregaCot':
			$incluye->TraerEntregaCot($IdCotizacion);			
			$incluye->MostrarEntregar();
			break;		
	}	
	
?>