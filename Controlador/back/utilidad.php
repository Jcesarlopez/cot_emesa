<?php
	session_start();
	class Utilidad
	{		
		function CambiarUtilidad($utilidad,$TipoUtilidad)
		{
			$_SESSION['TipoUtilidad']=0;
			if($TipoUtilidad=="true")
			{
				$_SESSION['TipoUtilidad'] = 1;
			}
			$_SESSION['Utilidad']=$utilidad;
			
		}
		function MostrarUtilidad()
		{
			//Lo enviamos en formato json			
			if(!isset($_SESSION['Utilidad']))
			{
				$_SESSION['Utilidad']=0;
				$_SESSION['TipoUtilidad']=1;			
			}
			$json='{"utilidad":'.$_SESSION['Utilidad'].',"tipoUtilidad":'.$_SESSION['TipoUtilidad'].'}';
			echo $json;
		}
	}
	
	$accion = $_POST['accion'];
	
	$utilidad = $_POST['utilidad'];
	$TipoUtilidad = $_POST['TipoUtilidad'];
	settype($utilidad,"int");
	//settype($TipoUtilidad,"int");
	$_SESSION['TipoUtilidada']=$TipoUtilidada;			

	$C_Util = new Utilidad();

	if($accion=="Cambiar")
	{
		$C_Util->CambiarUtilidad($utilidad,$TipoUtilidad);
		$C_Util->MostrarUtilidad();
	}
	if($accion=="Mostrar")
	{
		$C_Util->MostrarUtilidad();
	}



?>