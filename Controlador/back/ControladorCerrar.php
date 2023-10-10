<?php
session_start();
class Cerrar{

	public static function cerrarCotizacion()
	{



		$_SESSION['mod_cot']=0;
		$_SESSION['Estado']="Cerrar";	
		unset($_SESSION['NoCot']);
		unset($_SESSION['IdCliente']);
		unset($_SESSION['ContacCl']);
		

		unset($_SESSION['Utilidad']);
		unset($_SESSION['TipoUtilidad']);	
		unset($_SESSION['PTARPropiedades']['IdPlanta']);
		


	}


}

$accion = $_POST['accion'];
if($accion=="cerrarCot")
{
	Cerrar::cerrarCotizacion();
}

?>