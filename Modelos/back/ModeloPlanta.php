<?php
class PartitasPTAR
{
	private $con;
	public function __construct()
	{
		require_once("Conexion.php");		
		$this->con = new Conexion();
	}
	public function MostrarPartCot($IdCotizacion)
	{

		$sql = "SELECT * FROM cotizaciones_partidas WHERE IdCotizacion=$IdCotizacion ORDER BY orden ASC";
		$datos =  $this->con->consultaRetorno($sql);
		$_SESSION['pasoddmode']=$sql;
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
		$CamposPI.="$PI.PrecioEquipo AS PlantaEquipo,";
		$CamposPI.="$PI.PrecioObra AS PlantaObra,";
		$CamposPI.="$PI.Alto AS Alto,";
		$CamposPI.="$PI.Largo AS Largo,";
		$CamposPI.="$PI.Ancho AS Ancho,";
		$CamposPI.="$PI.Diametro AS Diametro,";
		$CamposPI.="$PI.LodosSecos AS LodosSecos,";
		$CamposPI.="$PI.BHP AS BHP,";
		$CamposPI.="$PI.HP AS HP,";
		$CamposPI.="$PI.CostoFiltro AS CostoFiltro,";
		$CamposPI.="$PI.CostoLecho AS CostoLecho,";
		$CamposPI.="$PI.GrupoLPS AS GrupoLPS,";
		$CamposPI.="$PI.ModeloLPS AS ModeloLPS,";

		
		$sql.="SELECT $CamposPI";


		/*$sql.=" $PI.CostoFiltro*.85 AS CostoFiltro, $PI.CostoLecho*.85 AS CostoLecho,";
		$sql.=" $PC.PrecioEquipo*.85 AS EquipoCarcamo, $PC.PrecioObra*.85 AS ObraCarcamo, ";*/

		$sql.=" $PI.CostoFiltro AS CostoFiltro, $PI.CostoLecho AS CostoLecho,";
		$sql.=" $PC.PrecioEquipo AS EquipoCarcamo, $PC.PrecioObra AS ObraCarcamo, ";


		$sql.=" $PM.Descripcion AS DescModelo";
		$sql.=" FROM $PI,$PC,$PM";
		$sql.=" WHERE $PI.IdPlanta=$idPTAR and $PI.IdCapacidad = $PC.IdCapacidad and $PI.IdTipo = $PC.IdTipo and $PI.IdModelo = $PM.IdModelo";

		$_SESSION['PPOS']=$sql;

		$datos =  $this->con->consultaRetorno($sql);
		
	
		return $datos;
	}	
}

$planta = new PartitasPTAR();


?>

