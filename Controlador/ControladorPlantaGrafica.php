<?php
	session_start();
	class Grafica
	{
		function TraerGraficaCot($IdCotizacion)
		{
			require_once($_SESSION['PathModel']."ModeloGrafica.php");
			$partidas = new DatosGrafica();
			$resultado = $partidas->CrearDatosGraficaCot($IdCotizacion);
			unset($_SESSION['PTARGrafica']);

			$c=0;
			while($row = $resultado->fetch_array(MYSQLI_BOTH))
			{	$c++;
				$this->CrearConcepto($row['concepto'],$row['inicio'],$row['duracion'],$c,$row['orden']);

			}

			foreach ($_SESSION['PTARGrafica'] as $row) {
				$Array[] = $row;
			}
			echo json_encode($Array);



		}
		function CrearGrafica($idplanta)
		{
			require_once($_SESSION['PathModel']."ModeloGrafica.php");
			$partidas = new DatosGrafica();
			$resultado = $partidas->CrearDatosGrafica($idplanta);
			unset($_SESSION['PTARGrafica']);

			$c=0;
			while($row = $resultado->fetch_array(MYSQLI_BOTH))
			{	$c++;
				$this->CrearConcepto($row['concepto'],$row['inicio'],$row['duracion'],$c,$row['orden']);

			}

			foreach ($_SESSION['PTARGrafica'] as $row) {
				$Array[] = $row;
			}
			echo json_encode($Array);
		}
		function CrearConcepto($concepto,$inicio,$duracion,$indice,$orden)
		{

			settype($orden,"string");
			$_SESSION['PTARGrafica'][$indice]['concepto']=$concepto;
			$_SESSION['PTARGrafica'][$indice]['inicio']=$inicio;
			$_SESSION['PTARGrafica'][$indice]['duracion']=$duracion;
			$_SESSION['PTARGrafica'][$indice]['orden']=$orden;
		}
		function MostrarConcepto($orden)
		{
			$indice=$orden;

			$Array['concepto']=$_SESSION['PTARGrafica'][$indice]['concepto'];
			$Array['inicio']=$_SESSION['PTARGrafica'][$indice]['inicio'];
			$Array['duracion']=$_SESSION['PTARGrafica'][$indice]['duracion'];
			$Array['orden']=$_SESSION['PTARGrafica'][$indice]['orden'];
			echo json_encode($Array);
		}
		function CambiarConcepto($Concepto,$Inicio,$Duracion,$Orden)
		{
			$indice = $Orden;

			$_SESSION['PTARGrafica'][$indice]['concepto']=$Concepto;
			$_SESSION['PTARGrafica'][$indice]['inicio']=$Inicio;
			$_SESSION['PTARGrafica'][$indice]['duracion']=$Duracion;
			$_SESSION['PTARGrafica'][$indice]['orden']=$Orden;
		}
		function MostrarConceptos()
		{
			foreach ($_SESSION['PTARGrafica'] as $row) {
				$Array[] = $row;
			}
			echo json_encode($Array);
		}
		function BorrarConcepto($Orden)
		{
			// Clonamos
			$_SESSION['PTARGrafica2']=$_SESSION['PTARGrafica'];

			//Borramos el arreglo original
			unset($_SESSION['PTARGrafica']);


			// Recorremos el arreglo2 y nos saltamos la partida a borrar
			$c=0;
			foreach ($_SESSION['PTARGrafica2'] as $row) {
				$c++;

				if($Orden!==$c)
				{
					$this->CrearConcepto($row['concepto'],$row['inicio'],$row['duracion'],$c,$row['orden']);
				}
			}
			unset($_SESSION['PTARGrafica2']);
		}
		function DownConcepto($Orden)
		{
			$indice=$Orden;
			$_SESSION['PTARGrafica'][$Orden]['orden']=$Orden+1;
			$_SESSION['PTARGrafica'][$Orden+1]['orden']=$Orden;

			$_SESSION['PTARGrafica2']=$_SESSION['PTARGrafica'];
			unset($_SESSION['PTARGrafica']);


			$c=0; // Recorremos el arreglo Clon
			foreach ($_SESSION['PTARGrafica2'] as $row) {
				$c++;

				$saltar = false;
				if($Orden==$c)		// si estamos en el arreglo afectado, ponemos los datos del elemento que esta arriba
				{
					$itemaPasar=$_SESSION['PTARGrafica2'][$c];
					$_SESSION['PTARGrafica'][$c]=$_SESSION['PTARGrafica2'][$c+1];
					$saltar = true;
				}
				if($Orden+1==$c)  // Si estamos en el arreglo arriba del afectado, ponemos los datos
				{
					$_SESSION['PTARGrafica'][$c]=$itemaPasar;
					$saltar = true;
				}
				if(!$saltar)
				{
					$_SESSION['PTARGrafica'][$c] = $_SESSION['PTARGrafica2'][$c];
				}


			}
		}

		function UpConcepto($Orden)
		{

			$indice=$Orden;
			$_SESSION['PTARGrafica'][$Orden-1]['orden']=$Orden;
			$_SESSION['PTARGrafica'][$Orden]['orden']=$Orden-1;

			$_SESSION['PTARGrafica2']=$_SESSION['PTARGrafica'];
			unset($_SESSION['PTARGrafica']);

			// Recorremos el arreglo2 y nos saltamos la partida a borrar
			$c=0;
			foreach ($_SESSION['PTARGrafica2'] as $row) {
				$c++;

				$saltar = false;
				if($Orden-1==$c)		// si estamos en el arreglo secundario afectado
				{
					$itemaPasar=$_SESSION['PTARGrafica2'][$c];
					$_SESSION['PTARGrafica'][$c]=$_SESSION['PTARGrafica2'][$c+1];
					$saltar = true;
				}
				if($Orden==$c)         // Si estamos en el arreglo principalmente afectado
				{
					$_SESSION['PTARGrafica'][$c]=$itemaPasar;
					$saltar = true;
				}
				if(!$saltar)
				{
					$_SESSION['PTARGrafica'][$c] = $_SESSION['PTARGrafica2'][$c];
				}
			}

		}

	}

	$grafica = new Grafica();

	$Orden = $_POST['Orden'];
	settype($Orden,"int");

	$Concepto=$_POST['Concepto'];
	$Inicio=$_POST['Inicio'];
	$Duracion=$_POST['Duracion'];
	$IdCotizacion=$_POST['IdCotizacion'];


	if($_POST['Accion']=="Crear")
	{
		$grafica->CrearGrafica($_POST['IdPlanta']);

	}
	if($_POST['Accion']=="Mostrar")
	{
		$grafica->MostrarConcepto($Orden);

	}

	if($_POST['Accion']=="Cambiar")
	{
		$grafica->CambiarConcepto($Concepto,$Inicio,$Duracion,$Orden);
		$grafica->MostrarConceptos();
	}

	if($_POST['Accion']=="Borrar")
	{
		$grafica->BorrarConcepto($Orden);
		$grafica->MostrarConceptos();
	}
	if($_POST['Accion']=="Agregar")
	{
		$grafica->CrearConcepto($Concepto,$Inicio,$Duracion,count($_SESSION['PTARGrafica'])+1,count($_SESSION['PTARGrafica'])+1);
		$grafica->MostrarConceptos();
	}
	if($_POST['Accion']=="Down")
	{
		$grafica->DownConcepto($Orden);
		$grafica->MostrarConceptos();
	}
	if($_POST['Accion']=="Up")
	{
		$grafica->UpConcepto($Orden);
		$grafica->MostrarConceptos();
	}
	if($_POST['Accion']=="TraerGraficaCot")
	{
		$grafica->TraerGraficaCot($IdCotizacion);
	}


?>