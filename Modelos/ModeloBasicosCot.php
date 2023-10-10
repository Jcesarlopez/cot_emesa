<?php
	class ModDatosBasicos
	{

		private $con;
		public function __construct()
		{
			require_once("Conexion.php");		
			$this->con = new Conexion();
		}
		public function ModConsultaDatosBasicos($IdCotizacion)
		{
			$cotI = "cotizaciones_indice";
			$citI = "clientes_indice";
			$usI = "usuarios_indice";

			$campos = "$cotI.IdMoneda, $citI.IdCliente, $citI.Nombre AS NombreCl, $citI.Contacto AS ContactoCatalogoClientes, $cotI.AtencionCliente AS AtnCl, $cotI.Fecha, $cotI.Referencia,$usI.IdUsuario AS IdUser,";

			$campos.= "if ($cotI.LPS>0,'planta','material') AS TipoCot,";
			// IVA , Utulidad, TipoUtilidad 
			$campos.= "IVA, Utilidad, TipoUtil, PartidaPK, OCIlustrativa, PlantaTipo, PlantaSerie,";

			$campos.= "Lab,Vigencia,ConPago,Entrega,EntregaDias,EntregaSemanas";



			$sql = "SELECT $campos FROM $cotI,$citI,$usI WHERE IdCotizacion=$IdCotizacion and $cotI.NoCliente = $citI.IdCliente and $cotI.Vendedor = $usI.IdUsuario";

			$_SESSION['VVF']=$sql;

			$datos =  $this->con->consultaRetorno($sql);

			return $datos;

			


		}



	}


?>
