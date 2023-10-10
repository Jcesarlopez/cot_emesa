<?php
session_start();
class DatosGrabar
{
	public $EstadoInicial;
	public $con;
	public $IdCliente;
	public $ContacCl;
	public $Uti;
	public $TUtil;
	public $IdUser;

	public $lustrativa;
	public $NotaPartida;


	public $IdPlanta;
	public $IdCapacidad;
	public $Capacidad;

	public $IdTipo;
	public $IdModelo;


	public $AltoPlanta;
	public $LargoPlanta;
	public $AnchoPlanta;
	public $DiamPl;
	public $LodosSecos;
	public $Lechosm2;

	public $HPPlanta;
	public $BHPPlanta;

	public $GrupoLPS;
	public $ModeloLPS;
	public $AltoCarcamo;
	public $LargoCarcamo;
	public $AnchoCarcamo;
	public $BHPCarcamo;
	public $HPCarcamo;
	public $DescModelo;
	public $Wtamano=0;


	public $mensaje;
	public $error=false;

	public $IdCotizacion;



	public function __construct()
	{
		require_once("Conexion.php");
		$this->con = new Conexion();

		$this->EstadoInicial = $_SESSION['Estado'];
		if($_SESSION['Estado']=="Cambios")
		{
			$this->IdCotizacion=$_SESSION['NoCot'];
		}


		$this->IdCliente= $_SESSION['IdCliente'];
		$this->ContacCl= $this->c($_SESSION['ContacCl']);
		$this->Uti= $_SESSION['Utilidad'];
		$this->TUtil= $_SESSION['TipoUtilidad'];
		$this->IdUser= $_SESSION['IdUser'];

		$this->lustrativa = $_SESSION['lustrativa'];
		$this->NotaPartida = $_SESSION['NotaPartida'];

		$this->IdPlanta= $_SESSION['PTARPropiedades']['IdPlanta'];
		$this->IdCapacidad= $_SESSION['PTARPropiedades']['IdCapacidad'];
		$this->Capacidad= $_SESSION['PTARPropiedades']['Capacidad'];

		$this->IdTipo = $_SESSION['PTARPropiedades']['IdTipo'];
		$this->IdModelo = $_SESSION['PTARPropiedades']['IdModelo'];


		$this->AltoPlanta = $_SESSION['PTARPropiedades']['AltoPlanta'];
		$this->LargoPlanta = $_SESSION['PTARPropiedades']['LargoPlanta'];
		$this->AnchoPlanta = $_SESSION['PTARPropiedades']['AnchoPlanta'];
		$this->DiamPl = $_SESSION['PTARPropiedades']['DiametroPlanta'];
		$this->LodosSecos = $_SESSION['PTARPropiedades']['LodosSecos'];
		$this->Lechosm2 = $_SESSION['PTARPropiedades']['Lechosm2'];
		$this->HPPlanta = $_SESSION['PTARPropiedades']['HPPlanta'];
		$this->BHPPlanta = $_SESSION['PTARPropiedades']['BHPPlanta'];
		$this->GrupoLPS = $_SESSION['PTARPropiedades']['GrupoLPS'];
		$this->ModeloLPS = $_SESSION['PTARPropiedades']['ModeloLPS'];
		$this->AltoCarcamo = $_SESSION['PTARPropiedades']['AltoCarcamo'];
		$this->LargoCarcamo = $_SESSION['PTARPropiedades']['LargoCarcamo'];
		$this->AnchoCarcamo = $_SESSION['PTARPropiedades']['AnchoCarcamo'];
		$this->BHPCarcamo = $_SESSION['PTARPropiedades']['BHPCarcamo'];
		$this->HPCarcamo = $_SESSION['PTARPropiedades']['HPCarcamo'];
		$this->DescModelo = $_SESSION['PTARPropiedades']['DescModelo'];

		
		if ($IdTipo==1 || $IdTipo==15) // Si es pk
		{
			if (($this->IdModelo==1 && $this->IdCapacidad > .25) || ($this->IdModelo=2 and $this->IdCapacidad > .35))
			{
				$this->Wtamano=1; // Grande (de acero inox)
			}else
			{
				$this->Wtamano=2; // Pequeña (de aluminio)
			}						
		}
	}
	public function envioParametros()
    {
     	$parametros = array();
     	$parametros['Error'] = $this->error;
     	$parametros['Mensaje'] = $this->mensaje;
     	$parametros['EstadoInicial'] = $this->EstadoInicial;
     	$parametros['Cotizacion'] = $this->IdCotizacion;

     	$_SESSION['test']=$parametros;

     	return $parametros;
    }
	public function BorrarTablas()
	{

		if($_SESSION['Estado']=="Cambios")
		{
			
			$sql = "DELETE FROM cotizaciones_partidas WHERE idcotizacion=$this->IdCotizacion";
			$this->con->consultaSimple($sql);	

			$sql = "DELETE FROM cotizaciones_incluye_partidas WHERE idcotizacion=$this->IdCotizacion";
			$this->con->consultaSimple($sql);	

			$sql = "DELETE FROM cotizaciones_no_incluye_partidas WHERE idcotizacion=$this->IdCotizacion";
			$this->con->consultaSimple($sql);	

			$sql = "DELETE FROM cotizaciones_grafica_partidas WHERE idcotizacion=$this->IdCotizacion";
			$this->con->consultaSimple($sql);	


			$sql = "DELETE FROM cotizaciones_entrega_partidas WHERE idcotizacion=$this->IdCotizacion";
			$this->con->consultaSimple($sql);			
		}
	}
	public function partidas()
	{
		$consultas = "";
		$_SESSION['VARI'] = array();


		
		if($_SESSION['CotTipo']==1) // Si es planta
		{
			for($c=0;$c<count($_SESSION['PTARPartidas']);$c++)
			{
				$Descripcion = $this->c($_SESSION['PTARPartidas'][$c+1]['Descripcion']);
				$InfoAdicional = $this->c($_SESSION['PTARPartidas'][$c+1]['InfoAdicional']);
				$Cantidad = $_SESSION['PTARPartidas'][$c+1]['Cantidad'];
				$CUnitario = $_SESSION['PTARPartidas'][$c+1]['CUnitario'];
				$Total = $_SESSION['PTARPartidas'][$c+1]['Total'];
				$label = $this->c($_SESSION['PTARPartidas'][$c+1]['label']);

				//el label no coincide con la base de datos;
				$sqlIn = "INSERT INTO cotizaciones_partidas (idcotizacion,orden,concepto,concepto2,cantidad,unidad,costounitario,total,utilidad,adicional,tipo)";				
				$sqlIn.= " VALUES ($this->IdCotizacion,$c+1,N$Descripcion,'',$Cantidad,'',$CUnitario,0,0,N$InfoAdicional,$label)";
				$this->con->consultaSimple($sqlIn);											
			}
		}
		if($_SESSION['CotTipo']==2) // Si es material
		{
			for($c=0;$c<count($_SESSION['PartidasMaterial']);$c++)
			{
				$Concepto = $this->c($_SESSION['PartidasMaterial'][$c]['Descripcion']);
				$Concepto2 = $this->c($_SESSION['PartidasMaterial'][$c]['Adicional']);
				
				$Cantidad = $_SESSION['PartidasMaterial'][$c]['Cantidad'];
				$Unidad = $this->c($_SESSION['PartidasMaterial'][$c]['Unidad']);
				$CUnitario = $_SESSION['PartidasMaterial'][$c]['Costo'];				
								
				$sqlIn = "INSERT INTO cotizaciones_partidas(idcotizacion,orden,concepto,concepto2,cantidad,unidad,costounitario,tipo)";				
				$sqlIn.= " VALUES ($this->IdCotizacion,$c+1,N$Concepto,N$Concepto2,$Cantidad,$Unidad,$CUnitario,'Material')";
				$this->con->consultaSimple($sqlIn);											
			}
			
		}
	}
	public function CambiosCot($IVA,$Fecha,$Ref,$IdVend,$clAtn)
	{
		$this->validar($IVA,$Fecha,$Ref,$IdVend);
		if(!$this->error)
		{
			$sql = array();
			$update = "UPDATE cotizaciones_indice SET ";
			$where = " WHERE IdCotizacion=".$_SESSION['NoCot'];


			$sql[]=$update." NoCliente=".$_SESSION['IdCliente'];

			$sql[]=$update." PlantaTipo=".$this->IdTipo;
			$sql[]=$update." PlantaSerie=".$this->IdModelo;
			$sql[]=$update." LPS=".$this->Capacidad;
			$sql[]=$update." Utilidad=".$this->Uti;
			$sql[]=$update." TipoUtil=".$this->TUtil;
			$sql[]=$update." IVA=".$IVA;
			$sql[]=$update." HPUtil=".$this->BHPPlanta;
			$sql[]=$update." HPInst=".$this->HPPlanta;
			$sql[]=$update." AnchoPl=".$this->AnchoPlanta;
			$sql[]=$update." LargoPl=".$this->LargoPlanta;
			$sql[]=$update." AltoPl=".$this->AltoPlanta;
			$sql[]=$update." AnchoPr=".$this->AnchoCarcamo;
			$sql[]=$update." LargoPr=".$this->LargoCarcamo;
			$sql[]=$update." AltoPr=".$this->AltoCarcamo;
			$sql[]=$update." Diametro=".$this->DiamPl;
			$sql[]=$update." LechoM2=".$this->Lechosm2;
			$sql[]=$update." M3Mes=".$this->LodosSecos;

			$sql[]=$update." Fecha=".$this->c($Fecha);
			$sql[]=$update." Referencia=N".$this->c($Ref);
			
			$sql[]=$update." Vendedor=".$IdVend;
			$sql[]=$update." AtencionCliente=N".$this->c($clAtn);
			$sql[]=$update." Modelo=".$this->ModeloLPS;

			//$_SESSION['desa']=$sql;

			$sql[]=$update." Lab=".$this->c($_SESSION['Franco']);
			$sql[]=$update." Vigencia=".$this->c($_SESSION['Vigencia']);
			$sql[]=$update." ConPago=".$this->c($_SESSION['Condiciones']);
			$sql[]=$update." Entrega=".$this->c($_SESSION['Entrega']);
			



			$sql[]=$update." PartidaPK=".$this->NotaPartida;
			$sql[]=$update." OCIlustrativa=".$this->lustrativa;


			$sql[]=$update." Tamanio=".$this->Wtamano;
			$sql[]=$update." IdUsuario=".$this->IdUser;

			$sql[]=$update." IdMoneda=".$_SESSION['USD'];

			
			foreach($sql as $consulta)
			{				
				$this->con->consultaSimple($consulta.$where);				
				
			}
			
			


			$this->BorrarTablas();
			
			// No grabamos partidas incluye de plantas caseras
			if($this->IdTipo!=15)
			{
				$this->grabarIncluye();
			}
			

			$this->grabarNoIncluye();
			
			if($this->IdTipo==2)
			{
				$this->Grafica();	
				$this->grabarEntrega();
			}
			
			$this->partidas();
			$this->mensaje = "¡Los cambios fueron guardados!";

		}
		
		return $this->envioParametros();
	}
	public function NuevaCot($IVA,$Fecha,$Ref,$IdVend,$clAtn)
	{

		$this->validar($IVA,$Fecha,$Ref,$IdVend);
		if(!$this->error)
		{

			

			$camposMat = '';
			if($_SESSION['CotTipo']==2) //Si es Material
			{
				$camposMat =",Lab,Vigencia,ConPago,Entrega";	
			}
					
			$sql = "INSERT INTO cotizaciones_indice (Nocliente,PlantaTipo,PlantaSerie,LPS,Utilidad,TipoUtil,IVA,HPUtil,HPInst,AnchoPl,LargoPl,AltoPl,AnchoPr,LargoPr,AltoPr,Diametro,LechoM2,M3Mes,Abierta,Fecha,Referencia,Vendedor,AtencionCliente,Modelo,PartidaPK,OCIlustrativa,Tamanio,IdUsuario".$camposMat.",IdMoneda)";
		
			
			
			
			$sql.= " VALUES (";
			$sql.= "$this->IdCliente,";

			$sql.="$this->IdTipo,";
			$sql.="$this->IdModelo,";
			$sql.="$this->Capacidad,";
			$sql.="$this->Uti,";
			$sql.="$this->TUtil,";
			$sql.="$IVA,";
			$sql.="$this->BHPPlanta,";
			$sql.="$this->HPPlanta,";
			$sql.="$this->AnchoPlanta,";
			$sql.="$this->LargoPlanta,";
			$sql.="$this->AltoPlanta,";
			$sql.="$this->AnchoCarcamo,";
			$sql.="$this->LargoCarcamo,";
			$sql.="$this->AltoCarcamo,";
			$sql.="$this->DiamPl,";
			$sql.="$this->Lechosm2,";
			$sql.="$this->LodosSecos,";
			$sql.="0,";

			$sql.=$this->c($Fecha).",";
			$sql.="N".$this->c($Ref).",";
			$sql.="$IdVend,";
			$sql.="N".$this->c($clAtn).",";
			$sql.="$this->ModeloLPS,";

			$sql.="$this->NotaPartida,";
			$sql.="$this->lustrativa,";

			$sql.="$this->Wtamano,";
			$sql.="$this->IdUser,";


			if($_SESSION['CotTipo']==2) //Si es Material
			{
				$sql.="'".$_SESSION['Franco']."',"; 
				$sql.="'".$_SESSION['Vigencia']."',"; 
				$sql.="'".$_SESSION['Condiciones']."',"; 
				$sql.="'".$_SESSION['Entrega']."',"; 
			}

			$sql.=$_SESSION['USD'];
			$sql.=")";


			$_SESSION['cccs']=$sql;



			$this->IdCotizacion = $this->con->consultaInsert($sql);
			$_SESSION['NoCot']=$this->IdCotizacion;

			$this->mensaje = "¡La cotización ".$this->IdCotizacion." se ha creado!";

			


			if($_SESSION['CotTipo']==1)
			{
				$this->grabarIncluye();
				$this->grabarNoIncluye();
				$this->grabarEntrega();
				$this->Grafica();				
			}				
			$this->partidas();
			
		}
		return $this->envioParametros();
	}
	public function grabarIncluye()
	{		
		$consultas = "";
		for($c=0;$c<count($_SESSION['PTARIncluye']);$c++)
		{

			$index=$c+1;

			$orden = $_SESSION['PTARIncluye'][$index]['Indice'];
			$concepto = "'".$_SESSION['PTARIncluye'][$index]['Concepto']."'";
			$activo = $_SESSION['PTARIncluye'][$index]['Activa'];

			$sqlIn = "INSERT INTO cotizaciones_incluye_partidas (idcotizacion,orden,concepto,activo,tipo,entrega)";				
			$sqlIn.= " VALUES ($this->IdCotizacion,$orden,N$concepto,$activo,0,0)";			


			$this->con->consultaSimple($sqlIn);	

		}
	}
	public function grabarNoIncluye()
	{
		$consultas = "";
		for($c=0;$c<count($_SESSION['PTARNoIncluye']);$c++)
		{

			$index=$c+1;

			$orden = $_SESSION['PTARNoIncluye'][$index]['Indice'];
			$concepto = "'".$_SESSION['PTARNoIncluye'][$index]['Concepto']."'";
			$activo = $_SESSION['PTARNoIncluye'][$index]['Activa'];

			$sqlIn = "INSERT INTO cotizaciones_no_incluye_partidas (idcotizacion,orden,concepto,activo)";				
			$sqlIn.= " VALUES ($this->IdCotizacion,$orden,N$concepto,$activo)";			
			$this->con->consultaSimple($sqlIn);	
		}
	}
	public function grabarEntrega()
	{
		$consultas = "";
		for($c=0;$c<count($_SESSION['PTAREntregar']);$c++)
		{
			$index=$c+1;
			$orden = $_SESSION['PTAREntregar'][$index]['Indice'];
			$concepto = "'".$_SESSION['PTAREntregar'][$index]['Concepto']."'";
			$activo = $_SESSION['PTAREntregar'][$index]['Activa'];
			$sqlIn = "INSERT INTO cotizaciones_entrega_partidas (idcotizacion,orden,concepto,activo)";				
			$sqlIn.= " VALUES ($this->IdCotizacion,$orden,N$concepto,$activo)";			
			$this->con->consultaSimple($sqlIn);	

		}
	}
	public function Grafica()
	{
			for($c=0;$c<count($_SESSION['PTARGrafica']);$c++)
			{
				$orden=$_SESSION['PTARGrafica'][$c+1]['orden'];
				$concepto=$this->c($_SESSION['PTARGrafica'][$c+1]['concepto']);
				$inicio=$_SESSION['PTARGrafica'][$c+1]['inicio'];
				$duracion=$_SESSION['PTARGrafica'][$c+1]['duracion'];

				$sqlGraf = "INSERT INTO cotizaciones_grafica_partidas(idCotizacion,orden,concepto,inicio,duracion)";				
				$sqlGraf.= " VALUES ($this->IdCotizacion,$orden,N$concepto,$inicio,$duracion)";			

				$this->con->consultaSimple($sqlGraf);	
			}
			
	}
	public function validar($IVA,$Fecha,$Ref,$IdVend)
	{
		if($_SESSION['CotTipo']==1) // Si es planta
		{
			if($this->IdCliente==0)
			{
				$this->mensaje="!Falta seleccionar el cliente¡ ";
				$this->error=true;
			}

			if($Ref=="" and !$this->error)
			{
				$this->mensaje="!Falta escribir la referencia¡";
				$this->error=true;
			}
			if(count($_SESSION['PTARPartidas'])==0 and !$this->error)
			{
				$part = count($_SESSION['PTARPartidas']);
				$this->mensaje="!No ha seleccionado una planta o no existen partidas¡";
				$this->error=true;
			}
		}	



		if($_SESSION['CotTipo']==2) // Si es material
		{
			if(empty($_SESSION['Franco']) or is_null($_SESSION['Franco']))
			{
				$this->mensaje="!Falta franco a bordo¡";
				$this->error=true;

			}
			if(empty($_SESSION['Vigencia']) or is_null($_SESSION['Vigencia']))
			{
				$this->mensaje="!Falta especificar la vigencia¡";
				$this->error=true;

			} 
			if(empty($_SESSION['Condiciones']) or is_null($_SESSION['Condiciones']))
			{
				$this->mensaje="!Falta indicar las condiciones de pago¡";
				$this->error=true;

			} 
			if(empty($_SESSION['Entrega']) or is_null($_SESSION['Entrega']))
			{
				$this->mensaje="!Falta indicar el tiempo de entrega¡";
				$this->error=true;
			} 
			if(count($_SESSION['PartidasMaterial'])==0)
			{
				
				$this->mensaje="!No existen partidas en la cotización";
				$this->error=true;
			}




		}



	}
	public function c($valor)
	{
		$valor="'".$valor."'";
		return $valor;
	}


		



}



?>