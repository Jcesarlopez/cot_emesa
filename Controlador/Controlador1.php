<?php
session_start();
	class Cotizacion{
		public $NoCot;
		public $IdCliente;
		public $IdVendedor;
		public $Fecha;
		public $PartidasPTAR;
		public $IncluyePTAR;
		public $NoIncluyePTAR;
	}
	class MostrarVendedores
	{
		public static $datos="";
		public static function mostrar()
		{
			require_once("Modelos/Modelos.php");
			$vendedores = new ListaVendedores();
			$resultado = $vendedores->listar();
			while($av = mysqli_fetch_array($resultado, MYSQLI_BOTH))
			{
				self::$datos.='<option value="'.$av['IdUsuario'].'">'.strtoupper($av['Nombre']).' '.strtoupper($av['ApPaterno']).' '.strtoupper($av['ApMaterno']).'</option>';
			}
			echo self::$datos;
		}
	}
	class MostrarCleintes
	{
		public static $datos="";
		public static function mostrar($like)
		{
			require_once($_SESSION['PathModel']."Modelos.php");
			$clientes = new ListaClientes();
			$resultado = $clientes->listar($like);
			self::$datos.='<a href="#!" class="collection-item teal lighten-2 white-text text-darken-2">Lista de clientes</a>';
			/*self::$datos.=' <li class="collection-item dismissable teal lighten-2">
		        			  <div>Lista de clientes</div>
		        		    </li>';*/
			while($av = mysqli_fetch_array($resultado, MYSQLI_BOTH))
			{
			    /*self::$datos.='
		        <li class="collection-item dismissable">
		        	<div>'.$av[Nombre].' ('.$av[Contacto].')<a href="#!" class="secondary-content"><i class="material-icons">send</i></a></div>
		        </li>';*/
		         self::$datos.='<a href="#!" onclick="SeleCliente('.$av[IdCliente].')" class="collection-item black-text text-darken-2"><b>'.$av[Nombre].'</b> ('.$av[Contacto].')</a>';
			}
			echo self::$datos;
		}
	}

	class SeleCliente{
		public static $DataCliente = array();
		public static function ObtDatosCliente($IdClienteSele)
		{
			require_once($_SESSION['PathModel']."Modelos.php");
			$Cliente = new DatosCliente(); // La clase DatosCliente de Modelos.php
			$Query = $Cliente->Datos($IdClienteSele); // Esto me devuelve el resultado de la consulta mysql
			// Esto si funciono
			while($row = $Query->fetch_array(MYSQLI_ASSOC))
			{
				$DataCliente[]=$row;
			}
			echo json_encode($DataCliente);
		}
	}

	class LpsPlantas{
		public static $ArrayLPS = array();
		public static function MostrarLPS($tipo,$serie)
		{
			require_once($_SESSION['PathModel']."Modelos.php");
			$LPS = new ListaLPS();
			$Query = $LPS->Datos($tipo,$serie);
			while($row = $Query->fetch_array(MYSQLI_ASSOC))
			{
				$ArrayLPS[]=$row;
			}
			echo json_encode($ArrayLPS);
		}
	}

	class PartidasPlanta{
		public static $ArrayPartidasPlanta = array();
		public static function MostrarPartidas($idPTAR)
		{
			require_once($_SESSION['PathModel']."Modelos.php");
			$DatosPlanta = new DatosplantaListPre();
			$Query = $DatosPlanta->PreciosPlanta($idPTAR);
			while($row = $Query->fetch_array(MYSQLI_ASSOC))
			{
				$ArrayPartidasPlanta[]=$row;
			}
			echo json_encode($ArrayPartidasPlanta);
		}
	}

	class Login{
		public function Verificar($user,$pass)
		{
			require_once($_SESSION['PathModel']."Modelos.php");
			$datosLogin = new DatosLogin();
			$Query = $datosLogin->VerificarLog($user,$pass);
			$c=0;
			while($row = $Query->fetch_array(MYSQLI_ASSOC))
			{$c++;}


			if($c>0)
			{
				$_SESSION['Sesion']='Activo';
				echo $_SESSION['Sesion'];
			}else{echo "El usuario y contraseña no coinciden";}
		}
	}



	if(isset($_POST['user']))
	{
		$user = $_POST['user'];
		$pass = $_POST['pass'];

		$log = new Login();
		$log->Verificar($user,$pass);


	}


	/*LpsPlantas::MostrarLPS(2,1);*/
	if(isset($_POST['idPTAR']))
	{
		PartidasPlanta::MostrarPartidas($_POST['idPTAR']);
	}









	/*data:'paso='+paso+'&tipo='+tipo+'&serie='+serie+'&idlps='+idlps*/
	if(isset($_POST['paso']))
	{
		if($_POST['paso']==3)
		{

			/*LpsPlantas::MostrarLPS(1,2);*/
			LpsPlantas::MostrarLPS($_POST['tipo'],$_POST['serie']);
		}
	}

	if(isset($_POST['valorCliente']))
	{
		MostrarCleintes::mostrar($_POST['valorCliente']);
	}

	if(isset($_POST['IdClienteSelect']))
	{
		SeleCliente::ObtDatosCliente($_POST['IdClienteSelect']);
	}

?>