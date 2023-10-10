<?php
	session_start();

	class USD
	{
		public static function Cambiar($valor)
		{
			if(intval($valor)==1)
			{
				$_SESSION['USD']=2;
			}				
			if(intval($valor)==0)
			{
				$_SESSION['USD']=1;
			}				
		}
		public static function Mostrar()
		{
			echo $_SESSION['USD'];
		}
	}
	class TipoCot
	{
		public static function Cambiar($valor)
		{
			$_SESSION['CotTipo']=$valor;
		}
		public static function Mostrar()
		{
			echo $_SESSION['CotTipo'];
		}
	}

	class Session
	{
		public static function MostrarSession()
		{
			echo $_SESSION['Sesion'];
		}
	}
	class Status
	{
		public static function cambiarStatus($valor)
		{
			$_SESSION['mod_cot']=$valor;

		}
		public static function mostrarStatus()
		{
			echo $_SESSION['mod_cot'];
		}

		
	}	
	class Estado
	{
		public static function cambiarEstado($valor)
		{
			$_SESSION['Estado']=$valor;

		}
		public static function mostrarEstado()
		{
			echo $_SESSION['Estado'];
		}

		
	}	

	class PTAR
	{

		public $Propiedades = array();			
		public function __construct()
		{
				 /* 0*/ $this->Propiedades[]=$_SESSION['PTARPropiedades']['IdPlanta']; 
				 /* 1*/ $this->Propiedades[]=$_SESSION['PTARPropiedades']['IdCapacidad']; 
				 /* 2*/ $this->Propiedades[]=$_SESSION['PTARPropiedades']['Capacidad']; 
				 /* 3*/ $this->Propiedades[]=$_SESSION['PTARPropiedades']['IdTipo']; 
				 /* 4*/ $this->Propiedades[]=$_SESSION['PTARPropiedades']['IdModelo']; 
				 /* 5*/ $this->Propiedades[]=$_SESSION['PTARPropiedades']['AltoPlanta']; 
				 /* 6*/ $this->Propiedades[]=$_SESSION['PTARPropiedades']['LargoPlanta']; 
				 /* 7*/ $this->Propiedades[]=$_SESSION['PTARPropiedades']['AnchoPlanta']; 
				 /* 8*/ $this->Propiedades[]=$_SESSION['PTARPropiedades']['DiametroPlanta']; 
				 /* 9*/ $this->Propiedades[]=$_SESSION['PTARPropiedades']['LodosSecos']; 
				 /* 10*/$this->Propiedades[]=$_SESSION['PTARPropiedades']['Lechosm2']; 
				 /* 11*/$this->Propiedades[]=$_SESSION['PTARPropiedades']['BHPPlanta']; 
				 /* 12*/$this->Propiedades[]=$_SESSION['PTARPropiedades']['HPPlanta']; 
				 /* 13*/$this->Propiedades[]=$_SESSION['PTARPropiedades']['GrupoLPS']; 
				 /* 14*/$this->Propiedades[]=$_SESSION['PTARPropiedades']['ModeloLPS']; 
				 /* 15*/$this->Propiedades[]=$_SESSION['PTARPropiedades']['AltoCarcamo']; 
				 /* 16*/$this->Propiedades[]=$_SESSION['PTARPropiedades']['LargoCarcamo']; 
				 /* 17*/$this->Propiedades[]=$_SESSION['PTARPropiedades']['AnchoCarcamo']; 
				 /* 18*/$this->Propiedades[]=$_SESSION['PTARPropiedades']['BHPCarcamo']; 
				 /* 19*/$this->Propiedades[]=$_SESSION['PTARPropiedades']['HPCarcamo']; 
				 /* 20*/$this->Propiedades[]=$_SESSION['PTARPropiedades']['DescModelo']; 
		}

		public function mostrarPropiedadPTAR($Propiedad)
		{
			echo $this->Propiedades[$Propiedad];
		}

	}
	class NotaPartida
	{
		public static function mostrarEstadoNotaPartida()
		{
			echo $_SESSION['NotaPartida'];

		}
		public static function cambiarEstadoNotaPartida($NotaPartida)
		{
			$_SESSION['NotaPartida']=$NotaPartida;
		}


	}
	class Ilustrativa
	{
		public static function cambiarEstadoIlustrativa($Ilustrativa)
		{
			$_SESSION['lustrativa']=$Ilustrativa;
		}
		public static function mostrarEstadoIlustrativa()
		{
			echo $_SESSION['lustrativa'];
		}

	}
	class VerWeb
	{
		public static function mostrarNoCotVerWeb()
		{
			echo $_SESSION['NoCotVerWeb'];
		}
	}

	//Status es si han hecho cambios en la cot
	if($_POST['Accion']=="CambiarStatus")
	{
		Status::cambiarStatus($_POST['status']);	
	}




	if($_POST['Accion']=="mostrarStatus")
	{
		Status::mostrarStatus();		
	}

	if($_POST['Accion']=='mostrarNoCotVerweb')
	{
		VerWeb::mostrarNoCotVerWeb();
	}
		
	// Tipocot
	if($_POST['Accion']=="cambiarTipoCot"){
		TipoCot::Cambiar(intval($_POST['tipo']));
	}
	if($_POST['Accion']=="MostrarTipoCot"){
		TipoCot::Mostrar();
	}


	if($_POST['Accion']=="cambiaUSD"){

		USD::Cambiar($_POST['valor']);
	}
		

	// Session
	if($_POST['Accion']=="estadoSession"){Session::MostrarSession($_POST['Estado']);}

	//Estado es si se trata de una cotizacion que se esta generando (Nueva) o se esta modificando (Cambios)
	if($_POST['Accion']=="cambiarEstado"){Estado::cambiarEstado($_POST['Estado']);}
	if($_POST['Accion']=="mostrarEstado"){Estado::mostrarEstado();}



	if($_POST['Accion']=="mostrarPropiedadPTAR"){$PTAR = new PTAR();$PTAR->mostrarPropiedadPTAR($_POST['Propiedad']);}




	// Nota partida
	if($_POST['Accion']=="cambiarEstadoNotaPartida"){NotaPartida::cambiarEstadoNotaPartida($_POST['NotaPartida']);}

	if($_POST['Accion']=="mostrarEstadoNotaPartida"){echo NotaPartida::mostrarEstadoNotaPartida();}

	// Ilustrativa
	if($_POST['Accion']=="cambiarEstadoIlustrativa"){Ilustrativa::cambiarEstadoIlustrativa($_POST['Ilustrativa']);}
	if($_POST['Accion']=="mostrarEstadoIlustrativa"){Ilustrativa::mostrarEstadoIlustrativa($_POST['Ilustrativa']);}
	

?>
