<?php
session_start();
class Cotizaciones{

		public $ArrayCots = array();
		public $req;
		public $objCots;
		public function __construct()
		{
			 $this->req=$_SESSION['PathModel']."ModeloCotizaciones.php";
			require_once($this->req);
			$this->objCots = new ModCotizaciones();
		}
		function mostrarDefecto()
		{
			$Query = $this->objCots->ModCotDefecto();
			while($row = $Query->fetch_array(MYSQLI_ASSOC))
			{
				$ArrayCots[]=$row;
			}
			echo json_encode($ArrayCots);
		}
		function BuscarCots($cadena)
		{
			$Query = $this->objCots->ModCotBuscar($cadena);
			while($row = $Query->fetch_array(MYSQLI_ASSOC))
			{
				$ArrayCots[]=$row;
			}
			echo json_encode($ArrayCots);
		}
}
$cotizaciones = new Cotizaciones();
if($_POST['Accion']=='Defecto')
{
	$cotizaciones->mostrarDefecto();
}
if($_POST['Accion']=='Buscar')
{
	$cotizaciones->BuscarCots($_POST['Cadena']);
}


?>

