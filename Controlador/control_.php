<?php
	session_start();
	class Status
	{
		public static function cambiarStatus($valor)
		{
			$_SESSION['mod_cot']=$valor;

		}
		public static function mostrarStatus()
		{
			echo $_SESSION['mod_cot'];
		}

		
	}	
	class Estado
	{
		public static function cambiarEstado($valor)
		{
			$_SESSION['Estado']=$valor;

		}
		public static function mostrarEstado($valor)
		{
			echo $_SESSION['Estado'];
		}

		
	}

	//Status es si han hecho cambios en la cot
	if($_POST['Accion']=="CambiarStatus")
	{
		Status::cambiarStatus($_POST['status']);	
	}
	if($_POST['Accion']=="mostrarStatus")
	{
		Estado::mostrarStatus();		
	}



	//Estado es si se trata de una cotizacion que se esta generando (Nueva) o se esta modificando (Cambios)
	if($_POST['Accion']=="CambiarEstado")
	{
		Estado::mostrarEstado($_POST['Estado']);		
	}
	if($_POST['Accion']=="MostrarEstado")
	{
		Estado::mostrarEstado($_POST['Estado']);		
	}
		
	

?>
