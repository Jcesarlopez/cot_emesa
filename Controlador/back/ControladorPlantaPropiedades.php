<?php
	session_start();
	class PropiedadesPlanta
	{
		public $datos = "";
		public $ContPartidas = 1;


		public function CambiarPropiedad($campo,$valor)
		{
			$_SESSION['PTARPropiedades'][$campo]=$valor;
		}
		
		public function CrearPropiedades($idPTAR)
		{
			require_once($_SESSION['PathModel']."ModeloPlantaPropiedades.php");			

			$partidas = new PropiedadesPTAR();
			$resultado = $partidas->Mostrar($idPTAR);
									
			while($row = $resultado->fetch_array(MYSQL_BOTH))			
			{
				$c++;
				unset($_SESSION['PTARPropiedades']);
				$_SESSION['PTARPropiedades']['IdPlanta']=$row['IdPlanta'];
				$_SESSION['PTARPropiedades']['IdCapacidad']=$row['IdCapacidad'];
				$_SESSION['PTARPropiedades']['Capacidad']=$row['Capacidad'];
				$_SESSION['PTARPropiedades']['IdTipo']=$row['IdTipo'];
				$_SESSION['PTARPropiedades']['IdModelo']=$row['IdModelo'];
				$_SESSION['PTARPropiedades']['AltoPlanta']=$row['AltoPlanta'];
				$_SESSION['PTARPropiedades']['LargoPlanta']=$row['LargoPlanta'];
				$_SESSION['PTARPropiedades']['AnchoPlanta']=$row['AnchoPlanta'];
				$_SESSION['PTARPropiedades']['DiametroPlanta']=$row['DiametroPlanta'];
				$_SESSION['PTARPropiedades']['LodosSecos']=$row['LodosSecos'];
				$_SESSION['PTARPropiedades']['Lechosm2']=$row['Lechosm2'];			
				$_SESSION['PTARPropiedades']['BHPPlanta']=$row['BHPPlanta'];
				$_SESSION['PTARPropiedades']['HPPlanta']=$row['HPPlanta'];
				$_SESSION['PTARPropiedades']['GrupoLPS']=$row['GrupoLPS'];
				$_SESSION['PTARPropiedades']['ModeloLPS']=$row['ModeloLPS'];
				$_SESSION['PTARPropiedades']['AltoCarcamo']=$row['AltoCarcamo'];
				$_SESSION['PTARPropiedades']['LargoCarcamo']=$row['LargoCarcamo'];
				$_SESSION['PTARPropiedades']['AnchoCarcamo']=$row['AnchoCarcamo'];
				$_SESSION['PTARPropiedades']['BHPCarcamo']=$row['BHPCarcamo'];
				$_SESSION['PTARPropiedades']['HPCarcamo']=$row['HPCarcamo'];
				$_SESSION['PTARPropiedades']['DescModelo']=$row['DescModelo'];
				

			}//Termina el while	
			
		} // Termina la funcion			
		public function MostrarPropiedades()
		{			
			echo json_encode($_SESSION['PTARPropiedades']);	
		} // Termina funcion
		public function TraerPropiedadesCot($IdCotizacion)
		{
			require_once($_SESSION['PathModel']."ModeloPlantaPropiedades.php");			
			$partidas = new PropiedadesPTAR();
			$resultado = $partidas->ModTraerPropiedadesCot($IdCotizacion);

			while($row = $resultado->fetch_array(MYSQL_BOTH))			
			{
				$c++;
				unset($_SESSION['PTARPropiedades']);

				// Estos datos al parecer ya no son necesarios
				$_SESSION['PTARPropiedades']['IdPlanta']="";
				$_SESSION['PTARPropiedades']['IdCapacidad']=="";
				$_SESSION['PTARPropiedades']['GrupoLPS']=="";
				$_SESSION['PTARPropiedades']['BHPCarcamo']=="";
				$_SESSION['PTARPropiedades']['HPCarcamo']=="";
				//////////////////////////////////////////////

				
				

				$_SESSION['PTARPropiedades']['Capacidad']=$row['LPS'];
				$_SESSION['PTARPropiedades']['IdTipo']=$row['PlantaTipo'];
				$_SESSION['PTARPropiedades']['IdModelo']=$row['PlantaSerie'];
				$_SESSION['PTARPropiedades']['AltoPlanta']=$row['AltoPl'];
				$_SESSION['PTARPropiedades']['LargoPlanta']=$row['LargoPl'];
				$_SESSION['PTARPropiedades']['AnchoPlanta']=$row['AnchoPl'];
				$_SESSION['PTARPropiedades']['DiametroPlanta']=$row['Diametro'];
				$_SESSION['PTARPropiedades']['LodosSecos']=$row['M3Mes'];
				$_SESSION['PTARPropiedades']['Lechosm2']=$row['LechoM2'];			
				$_SESSION['PTARPropiedades']['BHPPlanta']=$row['HPUtil'];
				$_SESSION['PTARPropiedades']['HPPlanta']=$row['HPInst'];

				
				$_SESSION['PTARPropiedades']['ModeloLPS']=$row['Modelo'];
				if($row['PlantaSerie']==1){$_SESSION['PTARPropiedades']['DescModelo']="SELECTOR";}
				if($row['PlantaSerie']==2){$_SESSION['PTARPropiedades']['DescModelo']="URBANA";}
				if($row['PlantaSerie']==3){$_SESSION['PTARPropiedades']['DescModelo']="PREMIUM";}

				$_SESSION['PTARPropiedades']['AltoCarcamo']=$row['AltoPr'];
				$_SESSION['PTARPropiedades']['LargoCarcamo']=$row['LargoPr'];
				$_SESSION['PTARPropiedades']['AnchoCarcamo']=$row['AnchoPr'];
				
				

			}//Termina el while	
		}		
	} // Termina la clase

	


	$accion = $_POST['accion'];
	$idPTAR = $_POST['idPTAR'];
	
	$campo = $_POST['campo'];
	$valor = $_POST['valor'];
	$IdCotizacion = $_POST['IdCotizacion'];

	//	data:'accion=TraerPartidasCot&IdCotizacion='+IdCotizacion
	
	$propiedades = new PropiedadesPlanta();


	if($accion=='CambiarDato')
	{
		$propiedades->CambiarPropiedad($campo,$valor);	
		$propiedades->MostrarPropiedades();
	}
		
	if($accion=='Crear')
	{
		$propiedades->CrearPropiedades($idPTAR);	
		$propiedades->MostrarPropiedades();
	}	

	if($accion=='TraerPropiedadesCot')
	{
		$propiedades->TraerPropiedadesCot($IdCotizacion);	
		$propiedades->MostrarPropiedades();
	}
	
?>