<?php
class PropiedadesPTAR
{
	private $con;
	public function __construct()
	{
		require_once("Conexion.php");		
		$this->con = new Conexion();
	}
	public function ModTraerPropiedadesCot($IdCotizacion)
	{
		$sql = "SELECT * FROM cotizaciones_indice WHERE IdCotizacion=$IdCotizacion";
		$datos =  $this->con->consultaRetorno($sql);
		
		return $datos;

	}
	public function Mostrar($idPTAR)
	{


		$PI="plantas_indice";
		$PC="plantas_carcamos";
		$PM="plantas_modelos";
	
		$CamposPI="$PI.IdPlanta AS IdPlanta,";
		$CamposPI.="$PI.IdCapacidad AS IdCapacidad,";
		$CamposPI.="$PI.Capacidad AS Capacidad,";	
		$CamposPI.="$PI.IdTipo AS IdTipo,";
		$CamposPI.="$PI.IdModelo AS IdModelo,";
		$CamposPI.="$PI.Alto AS AltoPlanta,";
		$CamposPI.="$PI.Largo AS LargoPlanta,";
		$CamposPI.="$PI.Ancho AS AnchoPlanta,";
		$CamposPI.="$PI.Diametro AS DiametroPlanta,";
		$CamposPI.="$PI.LodosSecos AS LodosSecos,";
		$CamposPI.="$PI.Lechosm2 AS Lechosm2,";
		$CamposPI.="$PI.BHP AS BHPPlanta,";
		$CamposPI.="$PI.HP AS HPPlanta,";
		$CamposPI.="$PI.GrupoLPS AS GrupoLPS,";
		$CamposPI.="$PI.ModeloLPS AS ModeloLPS,";

		// Carcamo
		$CamposPC="$PC.Alto AS AltoCarcamo,$PC.Largo AS LargoCarcamo, $PC.Ancho AS AnchoCarcamo,";
		$CamposPC.="$PC.BHP AS BHPCarcamo, $PC.HP AS HPCarcamo,";

		
		$sql="SELECT $CamposPI $CamposPC";

		$sql.=" $PM.Descripcion AS DescModelo";
		$sql.=" FROM $PI,$PC,$PM";
		$sql.=" WHERE $PI.IdPlanta=$idPTAR and $PI.IdCapacidad = $PC.IdCapacidad and $PI.IdTipo = $PC.IdTipo and $PI.IdModelo = $PM.IdModelo";

		$datos =  $this->con->consultaRetorno($sql);
		return $datos;
	}	
}
?>