<?php
class ModCotizaciones{

	private $con;
	

	public function __construct()
	{
		require_once("Conexion.php");		
		$this->con = new Conexion();
	}
	function ModCotDefecto()
	{
		$usuario = $_SESSION['IdUser'];
		$PI="plantas_indice";		
		$CI="cotizaciones_indice";
		$CliIn="clientes_indice";
		$CamposPI="$PI.IdPlanta AS IdPlanta,";

		$camposCI = "$CI.IdCotizacion AS IdCot,";
		$camposCI.= "$CI.Nocliente AS NoClien,";		
		$camposCI.= "$CI.PlantaTipo AS PlantTipo,";
		$camposCI.= "$CI.PlantaSerie AS PlantSerie,";
		$camposCI.= "$CI.LPS AS LPS,";
		$camposCI.= "$CI.Fecha AS Fecha,";
		$camposCI.= "$CI.Referencia AS Ref,";
		$camposCI.= "$CI.Vendedor AS Ven,";
		$camposCI.= "if($CI.AtencionCliente IS NULL or $CI.AtencionCliente = '',$CliIn.Contacto,$CI.AtencionCliente)  AS AtnCl,";

		$camposCliIn = "$CliIn.Nombre AS NomCl";

		$WHERE = "WHERE ";
		if((int)$_SESSION['IdUser']==28)//Eduardo puede ver todas las cotizaciones
		{
			$_SESSION['sqlabrir']="Si";
		}else
		{
			$_SESSION['sqlabrir']="No";
			$WHERE.= " $CI.IdUsuario=$usuario and";

		}
		
		//$WHERE.= " $CI.Nocliente = $CliIn.IdCliente and LPS>0";
		$WHERE.= " $CI.Nocliente = $CliIn.IdCliente";
		
		

		$sql = "SELECT $camposCI $camposCliIn FROM $CI,$CliIn $WHERE";	
		$sql.= " ORDER BY IdCotizacion DESC LIMIT 10";		
		$datos =  $this->con->consultaRetorno($sql);		

		
		
		return $datos;

	}
	function ModCotBuscar($cadena)
	{
		$cadena = trim($cadena);
		$LB='"%'.$cadena.'%"';

		$CI="cotizaciones_indice";
		$CliIn="clientes_indice";

		$camposCI = "$CI.IdCotizacion AS IdCot,";
		$camposCI.= "$CI.Nocliente AS NoClien,";
		$camposCI.= "$CI.Nocliente AS NoClien,";
		$camposCI.= "$CI.PlantaTipo AS PlantTipo,";
		$camposCI.= "$CI.PlantaSerie AS PlantSerie,";
		$camposCI.= "$CI.LPS AS LPS,";
		$camposCI.= "$CI.Fecha AS Fecha,";
		$camposCI.= "$CI.Referencia AS Ref,";
		$camposCI.= "$CI.Vendedor AS Ven,";
		$camposCI.= "if($CI.AtencionCliente IS NULL or $CI.AtencionCliente = '',$CliIn.Contacto,$CI.AtencionCliente)  AS AtnCl,";
		
		$camposCliIn = "$CliIn.Nombre AS NomCl";

		$sql = "SELECT $camposCI $camposCliIn";		

		$sql.=" FROM $CI INNER JOIN $CliIn ON $CI.NoCliente=$CliIn.IdCliente ";		
		if (is_numeric($cadena))
		{
			//$sql.=" WHERE ($CI.IdCotizacion LIKE $LB) and LPS>0";
			$sql.=" WHERE $CI.IdCotizacion LIKE $LB";
		}else
		{
			//$sql.=" WHERE ($CI.AtencionCliente LIKE $LB OR $CliIn.Nombre LIKE $LB OR $CI.Referencia LIKE $LB) and LPS>0";
			$sql.=" WHERE $CI.AtencionCliente LIKE $LB OR $CliIn.Nombre LIKE $LB OR $CI.Referencia LIKE $LB";
		}

		
		
	

		$sql.="  ORDER BY $CI.IdCotizacion DESC LIMIT 0,12";		

		
		$datos =  $this->con->consultaRetorno($sql);

		return $datos;	
	}
}
?>