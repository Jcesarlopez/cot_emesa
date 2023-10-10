<?php
	session_start();
	$_SESSION['cesarin']="como estas?"
	class IncluyePlanta
	{
		public $datos = "";
		public $ContPartidas = 1;
		
		public function CrearIncluye($tipo)
		{
			require_once("/home/emesa/public_html/sap/cgi-bin/_cotptar/Modelos/ModeloPlantaIncluye.php");			

			$partidas = new IncluyePTARDatos();
			$resultado = $partidas->MostrarDatos($tipo);
			$_SESSION['alex']="Aletz";
			
			unset($_SESSION['PTARIncluye']);							
			while($row = $resultado->fetch_array(MYSQL_BOTH))			
			{
				$c++;				
				$this->AddIncluye($this->ContPartidas++,$row['concepto'],1);
			}//Termina el while				
		} // Termina la funcion	
		public function AddIncluye($Indice,$Descripcion,$activa) // Si existe la modifica de lo contratrio la crea
		{	
			// Se el indice esta en cero quiere decir que vamos aagregar una partida mas 
			// por lo tanto la variable indice se le asigna el consecutivo.
			if($Indice==0)
			{
				$Indice = count($_SESSION['PTARIncluye'])+1;
			}
			
			$_SESSION['PTARIncluye'][$Indice]['Indice']=$Indice;
			$_SESSION['PTARIncluye'][$Indice]['Descripcion']=$Descripcion;
			$_SESSION['PTARIncluye'][$Indice]['Cantidad']=$activa;

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


	$partidas = new IncluyePlanta();	
	$accion=$_POST['accion'];
	

	$Indice = $_POST['Indice'];
	settype($Indice,"int");	

	// Variables para cambiar elemento incluye
	
	
	switch ($accion) {
		case 'Crear':
			$partidas->CrearIncluye($idPTAR,$eptar,$epret,$ocptar,$ocpret,$fp,$ls);			
			$partidas->MostrarIncluye();
			break;
		case 'Borrar':
			$partidas->BorrarPartida($Indice);			
			$partidas->MostrarPartidas();
			break;		
		case 'MostrarP':			
			$partidas->UnaPartida($Indice);
			break;			
		case 'Agregar':
			$partidas->LlenarPartida($Indice,$Descripcion,$Adicional,$Cant,$CostoU);			
			$partidas->MostrarPartidas();
			break;	
		case 'Cambiar':
			$partidas->LlenarPartida($Indice,$Descripcion,$Adicional,$Cant,$CostoU);			
			$partidas->MostrarPartidas();
			break;		
	}	
	
?>