<?php
	session_start();
	class PartidasPlanta
	{
		public $datos = "";
		public $ContPartidas = 1;
		public $TipoPTAR = 0;
		public $ModeloPTAR = 0;
		public $Capacidad = 0;

		// Estas variables dedinen el tipo real de la planta ya que desde la vista solo usa pk y oc
		public $PTARCasera = false;
		public $PTAR_PK = false;
		public $PTAR_OC = false;
		
		public function CrearPartidas($idPTAR,$eptar,$epret,$ocptar,$ocpret,$fp,$ls)
		{
			require_once($_SESSION['PathModel']."ModeloPlanta.php");			

			$partidas = new PartitasPTAR();
			$resultado = $partidas->Mostrar($idPTAR);
									
			while($row = $resultado->fetch_array(MYSQL_BOTH))			
			{
					$this->TipoPTAR = $row['IdTipo'];
					$WDescuentoEquip=1;
					$WDescuentoObra=1;

					// if($_SESSION['IdUser']==68) // Tio Juan de Eduardo ** ASI ESTABA ANTES DEL 6 DE NOV. 2019***
					// {
					// 	if($this->TipoPTAR != 2) // Si es pk (1) o casera (15)
					// 	{
					// 		$WDescuentoEquip=.85;
					// 		$WDescuentoObra=.85;
					// 	}else
					// 	{
					// 		$WDescuentoEquip=.88;
					// 		$WDescuentoObra=.98;
					// 	}
					// }


					if($_SESSION['IdUser']==68) // Tio Juan de Eduardo
					{
						if($this->TipoPTAR != 2) // Si es pk (1) o casera (15)
						{
							$WDescuentoEquip=.9;
							$WDescuentoObra=.9;
						}else
						{
							$WDescuentoEquip=.9;
							$WDescuentoObra=.98;
						}
					}




				$c++;
				unset($_SESSION['PTARPartidas']);		
				unset($_SESSION['PTARGenerales']);
				$_SESSION['PTARGenerales']['IdTipo']=$row['IdTipo'];

				$_SESSION['PTARGenerales']['Tipo']="";
				$PK=false;

				$this->TipoPTAR = $_SESSION['PTARGenerales']['IdTipo'];
				$this->ModeloPTAR = $row['IdModelo'];
				$this->Capacidad = $row['Capacidad'];
				if($_SESSION['PTARGenerales']['IdTipo']==1 or $_SESSION['PTARGenerales']['IdTipo']==15)
				{					
					$_SESSION['PTARGenerales']['Tipo']="PK";
					$PK=true;
				}					
				if($eptar=="true") // Equipamiento planta
				{					
					// Tipo 2 es igual a obra civil
					if($this->TipoPTAR==2)
					{
						$this->PTAR_OC = true;	
					}

					
					// Tipo 15 o 1 es PK
					if($this->TipoPTAR==1 or $this->TipoPTAR==15)
					{						
						// Caso urbana												// Caso Selector
						if(($this->ModeloPTAR == 2 and $this->Capacidad <= .35) or ($this->ModeloPTAR == 1 and $this->Capacidad <= .25))
						{
							$this->PTARCasera = true;
						}else
						{
							$this->PTAR_PK = true;
						}						
					}

					// Si es de obra civil
					if($this->PTAR_OC)
					{
						$infoAdicional="Soplador, Redes de aireación, Equipo de Control, Desnatadores, Sistema de Retorno de Lodos, Equipo de Dosificación de Cloro, Equipo hidráulico y neumático y todo lo necesario para su correcta instalación.";															
					}
					$WTabletasCloro='';
					if($this->ModeloPTAR==1){$WTabletasCloro='sistema de desinfección de paso por medio de tabletas de cloro, ';} // Si es selector



					

					if($this->PTARCasera) // Casera
					{
						$infoAdicional =' Fabricada en aluminio. ';
						$infoAdicional.= 'Incluye piso, tapa, soplador de aireación montado sobre la planta, caseta protectora de soplador, ' ;
						$infoAdicional.= 'control de encendido del soplador cableado dentro de caseta protectora, registro de inspección, ';								
						$infoAdicional.= 'reactor de aireación, sistema sedimentador,  '.$WTabletasCloro;
						$infoAdicional.= 'registro para entrada de agua negra, conectores de salida cementables ';
						$infoAdicional.= '(3" de diámetro para plantas menores o igual a .65 LPS y mayores a .65 LPS serán 4" de diámetro), ';
						$infoAdicional.= 'manuales de operación  y mantenimiento e inoculo para arranque.';	
					}
					if($this->PTAR_PK) // PK y no Casera
					{
						$infoAdicional = "Fabricada en acero inoxidable. Incluye controles de encendido para el soplador  así como cableado, todo se encuentra colocado dentro de la caseta protectora, ";
						$infoAdicional.= "reactor de aireación, sistema sedimentador, ".$WTabletasCloro;
						$infoAdicional.= " registro para entrada de agua negra, conectores de ";
						$infoAdicional.= 'salida cementables (3" de diámetro para plantas menores o igual a .65 LPS y mayores a .65 LPS serán 4" de diámetro), manuales de operación  y mantenimiento e ';
						$infoAdicional.= "inoculo para arranque. ";
					}
					
					$lps = $this->Capacidad;
					if($this->PTAR_OC)
					{
						$sGasto="PARA UN GASTO DE $lps L.P.S.";				
					}else
					{
						$sGasto="PARA UN GASTO DE ".number_format($lps*86.4)." M3/DIA ($lps L.P.S).";										
					}
					

					$this->LlenarPartida($this->ContPartidas++,"PLANTA EMESA SERIE ".$row['DescModelo'].' '.$_SESSION['PTARGenerales']['Tipo']." ".$sGasto,$infoAdicional,1,$row['PlantaEquipo']*$WDescuentoEquip,"empl");						
				}
				if($epret=="true") // Equipamiento pretratamiento
				{
					$infoAdicional = "";
					
					if($this->TipoPTAR==2) // Si es de obra civil
					{
						$texto = 'EQUIPO PARA PRETRATAMIENTO DE LA PLANTA';
					}else
					{
						$texto = 'EQUIPAMIENTO DE CÁRCAMO DE BOMBEO DE AGUA NEGRA A LA PLANTA.';
						$infoAdicional = 'Suministro e instalación de Bomba sumergible con flotador, Sistema de Izaje fabricada en Acero Inoxidable, anclado a la base del cárcamo. Tablero de control con arrancador para la protección de la bomba sumergible.  Tubería de PVC en el contacto directo con el agua y tubería  galvanizado  en el exterior con dirección hacia la planta, cuenta con un By-pass para regular el caudal a la PTAR. Suministro e instalación de rejilla de desbaste fina con charola de escurrimiento, fabricada en Acero Inoxidable 304 con solera de 1/8” x 1 ¼” con una separación de ½” pulgada entre soleras.';
					}
					$this->LlenarPartida($this->ContPartidas++,$texto,$infoAdicional,1,$row['EquipoCarcamo']*$WDescuentoEquip,"empr");
				}
				if($ocptar=="true") 
				{

					if($this->TipoPTAR==2) // Si es de obra civil
					{
						$infoAdicional = "Incluye barandales y escaleras";
					}else
					{
						$infoAdicional = "";
					}
					
					$this->LlenarPartida($this->ContPartidas++,"OBRA CIVIL PLANTA EMESA",$infoAdicional,1,$row['PlantaObra']*$WDescuentoObra,"ocpl");
				}
				if($ocpret=="true")
				{

					if($this->TipoPTAR==2) // Si es de obra civil
					{
						$infoAdicional = "A una profundidad máxima de 2 metros";
					}else
					{
						$infoAdicional = "";
					}
					
					$this->LlenarPartida($this->ContPartidas++,"OBRA CIVIL CÁRCAMO CON PRETRATAMIENTO",$infoAdicional,1,$row['ObraCarcamo']*$WDescuentoObra,"ocpr");
				}


				if($fp=="true") // Filtro prensa
				{
					$this->LlenarPartida($this->ContPartidas++,"FILTRO PRENSA","",1,$row['CostoFiltro'],"filt");
				}
				if($ls=="true")
				{
					$this->LlenarPartida($this->ContPartidas++,"LECHO DE SECADO DE LODOS","",1,$row['CostoLecho'],"lese");
				}
			}//Termina el while	
			
		} // Termina la funcion	
		public function LlenarPartida($Indice,$Descripcion,$Adicional,$Cant,$CostoU,$label) // Si existe la modifica de lo contratrio la crea
		{	

			// Se el indice esta en cero quiere decir que vamos a agregar una partida mas 			
			if($Indice==0){$Indice = count($_SESSION['PTARPartidas'])+1;}

			$CantInt=$Cant;
			$CostoUInt=$CostoU;
			settype($CantInt,"int");
			settype($CostoUInt,"int");

			
			$descEquip=1;
			$descEquip=1;
			$descObra=1;
			$descObra=1;


			/*if($_SESSION['accionPartidas']=="Crear")
			{
				//if(juan){

				$descEquip=.88;
				$descObra=.98;

				if($_SESSION['PTARGenerales']['Tipo']=="PK") // Si es paquete
				{
					$descEquip=.85;
					$descObra=.85;
				}
				//
			}*/

			/*if($label=='empl'){$CostoUInt=$CostoUInt*$descEquip;}
			if($label=='empr'){$CostoUInt=$CostoUInt*$descEquip;}
			if($label=='ocpl'){$CostoUInt=$CostoUInt*$descObra;}
			if($label=='ocpr'){$CostoUInt=$CostoUInt*$descObra;}*/
			

			$_SESSION['PTARPartidas'][$Indice]['Descripcion']=$Descripcion.$elementos;
			$_SESSION['PTARPartidas'][$Indice]['InfoAdicional']=$Adicional;
			$_SESSION['PTARPartidas'][$Indice]['Cantidad']=round($CantInt);
			$_SESSION['PTARPartidas'][$Indice]['CUnitario']=round($CostoUInt);
			$_SESSION['PTARPartidas'][$Indice]['Total']=round($CantInt*$CostoUInt);
			if($_SESSION['accionPartidas']!=="Cambiar")
			{
				$_SESSION['PTARPartidas'][$Indice]['label']=$label;				
			}			
		} // Termina la funcion 
		public function BorrarPartida($Indice)
		{
			$_SESSION['cesar1']=$_SESSION['PTARPartidas'];
			// Borrar elemento Array1
			unset($_SESSION['PTARPartidas'][$Indice]);

			// Duplicar Array
			$PTARPartidas2=$_SESSION['PTARPartidas'];

			
			// Borrar Array1
			unset($_SESSION['PTARPartidas']);
			$_SESSION['cesar2']=$PTARPartidas2;
			
			// Llenar Array1
			$this->ContPartidas=1;			
			foreach ($PTARPartidas2 as $fila){
				$this->LlenarPartida($this->ContPartidas++,$fila['Descripcion'],$fila['InfoAdicional'],$fila['Cantidad'],$fila['CUnitario'],$fila['label']);				
			}
			$_SESSION['cesar3']=$_SESSION['PTARPartidas'];

		} // Termina funcion
		public function MostrarPartidas()
		{
			foreach ($_SESSION['PTARPartidas'] as $row) {
				$Array[] = $row;
			}			
			echo json_encode($Array);	
		} // Termina funcion	
		public function UnaPartida($Indice)
		{
			echo json_encode($_SESSION['PTARPartidas'][$Indice]);
		}
		public function TotalPartidasPlanta()
		{
			$Subtotal=0;
			foreach ($_SESSION['PTARPartidas'] as $fila){
				$Subtotal=$Subtotal+($fila['Cantidad']*$fila['CUnitario']);
			}
			echo $Subtotal;
		}
		function TraerPartidasCot($IdCotizacion)
		{
			$this->TipoPTAR = $_SESSION['PTARPropiedades']['IdTipo'];
			$this->ModeloPTAR = $_SESSION['PTARPropiedades']['IdModelo'];

			$WTabletasCloro='';
			if($this->ModeloPTAR==1){$WTabletasCloro='sistema de desinfección de paso por medio de tabletas de cloro, ';} // Si es selector
			
			require_once($_SESSION['PathModel']."ModeloPlanta.php");
			$partidas = new PartitasPTAR();
			$resultado = $partidas->MostrarPartCot($IdCotizacion);	

			
			unset($_SESSION['PTARPartidas']);		
			$datos = array();
			while($row = $resultado->fetch_array(MYSQL_BOTH))
			{			
			
				$orden = $row['orden'];
				$concepto = $row['concepto'];
				$adicional = $row['adicional'];
				$cant = $row['cantidad'];
				$costoU = $row['costounitario'];
				$label = $row['tipo'];

				if($label=="empl" && $this->TipoPTAR==15 && $adicional=="")
				{
					$adicional =' Fabricada en aluminio. ';
					$adicional.= 'Incluye piso, tapa, soplador de aireación montado sobre la planta, caseta protectora de soplador, ' ;
					$adicional.= 'control de encendido del soplador cableado dentro de caseta protectora, registro de inspección, ';								
					$adicional.= 'reactor de aireación, sistema sedimentador,  '.$WTabletasCloro;
					$adicional.= 'registro para entrada de agua negra, conectores de salida cementables ';
					$adicional.= '(3" de diámetro para plantas menores o igual a .65 LPS y mayores a .65 LPS serán 4" de diámetro), ';
					$adicional.= 'manuales de operación  y mantenimiento e inoculo para arranque.';	
				}
				if($label=="empl" && $this->TipoPTAR==1 && $adicional=="")
				{
					$adicional = "Fabricada en acero inoxidable. Incluye controles de encendido para el soplador  así como cableado, todo se encuentra colocado dentro de la caseta protectora, ";
					$adicional.= "reactor de aireación, sistema sedimentador, ".$WTabletasCloro;
					$adicional.= " registro para entrada de agua negra, conectores de ";
					$adicional.= 'salida cementables (3" de diámetro para plantas menores o igual a .65 LPS y mayores a .65 LPS serán 4" de diámetro), manuales de operación  y mantenimiento e ';
					$adicional.= "inoculo para arranque. ";
				}
				$this->LlenarPartida($orden,$concepto,$adicional,$cant,$costoU,$label);
			}
		}
	} // Termina la clase
	$partidas = new PartidasPlanta();	
	$accion=$_POST['accion'];
	$_SESSION['accionPartidas']=$accion;
	$idPTAR = $_POST['idPTAR'];



	$Indice = $_POST['Indice'];
	settype($Indice,"int");
	

	$eptar = $_POST['eptar'];
	$epret = $_POST['epret'];
	$ocptar = $_POST['ocptar'];
	$ocpret = $_POST['ocpret'];
	$fp = $_POST['fp'];
	$ls = $_POST['ls'];


	// Variables para cambiar partida
	$Descripcion = $_POST['Descrip'];
	$Cant = $_POST['Cant'];
	$Adicional = $_POST['InfoAdicional'];
	$CostoU = $_POST['Costo'];
	$IdCotizacion = $_POST['IdCotizacion'];
	


	switch ($accion) {
		case 'Crear':
			$partidas->CrearPartidas($idPTAR,$eptar,$epret,$ocptar,$ocpret,$fp,$ls);			
			$partidas->MostrarPartidas();
			break;
		case 'Mostrar':
			$partidas->MostrarPartidas();
			break;		
		case 'Borrar':
			$partidas->BorrarPartida($Indice);			
			$partidas->MostrarPartidas();
			break;		
		case 'MostrarP':			
			$partidas->UnaPartida($Indice);
			break;			
		case 'Agregar':
			$partidas->LlenarPartida($Indice,$Descripcion,$Adicional,$Cant,$CostoU,'');	// El elemento vacio es label, que dentro de la funcion se omite		
			$partidas->MostrarPartidas();
			break;	
		case 'Cambiar':
			$partidas->LlenarPartida($Indice,$Descripcion,$Adicional,$Cant,$CostoU,'');	// El elemento vacio es label, que dentro de la funcion se omite		
			$partidas->MostrarPartidas();
			break;
		case 'Totalizar':
			$partidas->TotalPartidasPlanta();
			break;
		case 'TraerPartidasCot':			
			$partidas->TraerPartidasCot($IdCotizacion);
			$partidas->MostrarPartidas();
			break;
	}	
	
?>