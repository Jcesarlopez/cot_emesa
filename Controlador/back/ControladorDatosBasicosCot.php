<?php
session_start();

	class CotizacionBasicos
	{
		public function TraerBasicos($IdCotizacion)
		{

			require_once($_SESSION['PathModel']."ModeloBasicosCot.php");			

			$basicos = new ModDatosBasicos();
			$resultado = $basicos->ModConsultaDatosBasicos($IdCotizacion);
								
			$datos = array();	
			while($row = $resultado->fetch_array(MYSQL_BOTH))			
			{
				$datos['IdCl']= $row['IdCliente'];

				$_SESSION['IdCliente']=$datos['IdCl'];
				$datos['NombreCl']= $row['NombreCl'];
				$datos['AtnCl'] = $row['AtnCl'];
				$datos['ContactoCatalogoClientes'] = $row['ContactoCatalogoClientes'];
				//$_SESSION['AtnCl']=$datos['AtnCl'];

				$datos['Fecha'] = $row['Fecha'];
				$datos['Referencia'] = $row['Referencia'];
				$datos['IdUser'] = $row['IdUser'];	


				$datos['IVA'] = $row['IVA'];
				$datos['Utilidad'] = $row['Utilidad'];
				$datos['TipoUtil'] = $row['TipoUtil'];
				$datos['PlantaTipo'] = $row['PlantaTipo'];
				$datos['TipoCot'] = $row['TipoCot'];
				$datos['Moneda'] = $row['IdMoneda'];


				// Datos de las cotizaciones de material
				$datos['Lab'] = $row['Lab'];
				$datos['Vigencia'] = $row['Vigencia'];
				$datos['ConPago'] = $row['ConPago'];
				$datos['Entrega'] = $row['Entrega'];
				$datos['EntregaDias'] = $row['EntregaDias'];
				$datos['EntregaSemanas'] = $row['EntregaSemanas'];

				

				


				
				$_SESSION['USD'] = $row['IdMoneda'];
				$_SESSION['PTARPropiedades']['IdTipo']=$row['PlantaTipo'];
				$_SESSION['PTARPropiedades']['IdModelo']=$row['PlantaSerie'];


				$_SESSION['NoCot']=$IdCotizacion;
				

				$_SESSION['NotaPartida']=$row['PartidaPK'];
				

				$_SESSION['lustrativa']=$row['OCIlustrativa'];


				


			}
			echo json_encode($datos);

		}


	}
	$accion = $_POST['accion'];
	$IdCotizacion = $_POST['IdCotizacion'];



	$classCotiBasicos = new CotizacionBasicos();

	if($accion='TraerBasicos')
	{
		$DatosCotBasicos = $classCotiBasicos->TraerBasicos($IdCotizacion);

	}

?>