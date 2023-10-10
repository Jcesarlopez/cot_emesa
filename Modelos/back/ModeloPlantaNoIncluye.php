<?php
session_start();		
class NoIncluyePTARDatos
{
	private $con;
	public function __construct()
	{
		require_once("Conexion.php");		
		$this->con = new Conexion();
	}
	public function MostrarDatosCot($IdCotizacion)
	{	
		$sql="SELECT * FROM  cotizaciones_no_incluye_partidas WHERE idcotizacion=$IdCotizacion ORDER BY orden ASC";
		$datos =  $this->con->consultaRetorno($sql);
		return $datos;
	}	
	public function MostrarDatos($tipo)
	{

		$sql="SELECT * FROM  cotizaciones_lista_no_incluye WHERE tipo=$tipo";
		$_SESSION['sqlNoin']=$sql;
		$datos =  $this->con->consultaRetorno($sql);
		return $datos;
	}	
}
?>