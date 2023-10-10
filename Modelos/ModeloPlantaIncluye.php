<?php
session_start();		
class IncluyePTARDatos
{
	private $con;
	public function __construct()
	{
		require_once("Conexion.php");		
		$this->con = new Conexion();
	}
	public function MostrarDatos($tipo)
	{			
		$sql="SELECT * FROM cotizaciones_lista_incluye WHERE tipo=$tipo and entrega!=1";
		$datos =  $this->con->consultaRetorno($sql);
		return $datos;
	}	
	public function MostrarDatosCot($IdCotizacion)
	{			
		$sql="SELECT * FROM cotizaciones_incluye_partidas WHERE idcotizacion=$IdCotizacion ORDER BY orden ASC";
		$datos =  $this->con->consultaRetorno($sql);
		return $datos;
	}	
}
?>