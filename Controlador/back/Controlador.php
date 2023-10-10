<?php
session_start();
	class Clientes{

		public $ClaseModCliente;

		public function __construct()
		{
			require "config.php";				
			require_once($_SESSION['PathModel']."ModeloClientes.php");	

			$this->ClaseModCliente = new DatosClientes();
		}			
		public function CNuevo($ClNombre,$ClContacto,$ClContacto2,$ClContacto3,$ClTel1,$ClTel2,$ClPais,$ClEstado,$ClCiudad,$ClDireccion,$ClCorreo,$ClRFC,$ClCP)
		{
			// Devuelve el insertId
			echo $this->ClaseModCliente->ClienteNuevo($ClNombre,$ClContacto,$ClContacto2,$ClContacto3,$ClTel1,$ClTel2,$ClPais,$ClEstado,$ClCiudad,$ClDireccion,$ClCorreo,$ClRFC,$ClCP);
		}
		public function CCambios($IdCliente,$ClContacto,$ClContacto2,$ClContacto3,$ClTel1,$ClTel2,$ClPais,$ClEstado,$ClCiudad,$ClDireccion,$ClCorreo,$ClRFC,$ClCP)
		{
			echo $this->ClaseModCliente->ClienteCambios($IdCliente,$ClContacto,$ClContacto2,$ClContacto3,$ClTel1,$ClTel2,$ClPais,$ClEstado,$ClCiudad,$ClDireccion,$ClCorreo,$ClRFC,$ClCP);
		}
		public function DatosCliente($IdCliente)
		{								

			$Query = $this->ClaseModCliente->ObtenerDatos($IdCliente);
			$ArrayDatosCliente = array();
			while($row = $Query->fetch_array(MYSQL_ASSOC))
			{			
				$ArrayDatosCliente['Nombre']=$row['Nombre'];
				$ArrayDatosCliente['Calle']=$row['Calle'];
				$ArrayDatosCliente['Colonia']=$row['Colonia'];
				$ArrayDatosCliente['Ciudad']=$row['Ciudad'];
				$ArrayDatosCliente['Estado']=$row['Estado'];
				$ArrayDatosCliente['Pais']=$row['Pais'];
				$ArrayDatosCliente['CP']=$row['CP'];
				$ArrayDatosCliente['RFC']=$row['RFC'];
				$ArrayDatosCliente['Status']=$row['Status'];
				$ArrayDatosCliente['Contacto']=$row['Contacto'];
				$ArrayDatosCliente['Contacto2']=$row['Contacto2'];
				$ArrayDatosCliente['Contacto3']=$row['Contacto3'];
				$ArrayDatosCliente['Cargo1']=$row['Cargo1'];
				$ArrayDatosCliente['Cargo2']=$row['Cargo2'];
				$ArrayDatosCliente['Cargo3']=$row['Cargo3'];
				$ArrayDatosCliente['Telefono1']=$row['Telefono1'];
				$ArrayDatosCliente['Telefono2']=$row['Telefono2'];
				$ArrayDatosCliente['Fax']=$row['Fax'];
				$ArrayDatosCliente['Nextel']=$row['Nextel'];
				$ArrayDatosCliente['Correo']=$row['Correo'];
				$ArrayDatosCliente['IdUsuario']=$row['IdUsuario'];

				
			}
			echo json_encode($ArrayDatosCliente);


		}
	}
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
		public static function mostrar($VendedorDefault)  
		{
			require_once($_SESSION['PathModel']."Modelos.php");
			$vendedores = new ListaVendedores();
			$resultado = $vendedores->listar();
			while($av = mysqli_fetch_array($resultado, MYSQL_BOTH))
			{	
					$selected="";
					if($VendedorDefault==$av['IdUsuario'])
					{
						$selected="selected";

					}
					$class = ' class="spanOpcSelec blue white-text" ';

				self::$datos.='<option id="opclVenId'.$av['IdUsuario'].'"'.$class.' value="'.$av['IdUsuario'].'"'.' '.$selected.'>'.strtoupper($av['Nombre']).' '.strtoupper($av['ApPaterno']).' '.strtoupper($av['ApMaterno']).'</option>';
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

			
			 self::$datos='<ul class="collection with-header">';			        
			while($av = mysqli_fetch_array($resultado, MYSQL_BOTH))
			{			    
		         

				self::$datos.='<li class="liLista collection-item"><div>';
				self::$datos.='<div><span id="spanNomCl">'.strtoupper($av[Nombre]).'</span><span id="spanAtnCl"> ('.$av[Contacto].')</span>'.'<a href="#!" class="up4px secondary-content">';
				self::$datos.='<i title="Editar datos de este cliente" onclick="editCliente('.$av[IdCliente].')" class="iconCliente material-icons blue-text">mode_edit</i>&nbsp;&nbsp;';
				self::$datos.='<i title="Elegir este cliente" onclick="SeleCliente('.$av[IdCliente].')" class="iconCliente material-icons blue-text">send</i></a></div></li>';
			        


			}	
			self::$datos.='</ul>';			      
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
			while($row = $Query->fetch_array(MYSQL_ASSOC))
			{
				$DataCliente[]=$row;
				$_SESSION['IdCliente']=$row['IdCliente'];
				//$_SESSION['ContacCl']=$row['Contacto'];
				$_SESSION['ContacCl1']=$row['Contacto'];
				$_SESSION['ContacCl2']=$row['Contacto2'];
				$_SESSION['ContacCl3']=$row['Contacto3'];

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
			while($row = $Query->fetch_array(MYSQL_ASSOC))
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
			while($row = $Query->fetch_array(MYSQL_ASSOC))
			{
				$ArrayPartidasPlanta[]=$row;
			}
			echo json_encode($ArrayPartidasPlanta);
		}
	}

	class Login{
		public function Verificar($user,$pass)
		{
			require "config.php";	
			//$_SESSION['PathModel']="/home/emesa/public_html/sap/cgi-bin/_cotptar/";

			require_once($_SESSION['PathModel']."Modelos.php");

			//require_once("/home/emesa/public_html/sap/cgi-bin/_cotptar/Modelos/Modelos.php");
			//require_once("/inetpub/wwwroot/cot_emesa/Modelos/Modelos.php");
			$datosLogin = new DatosLogin();
			$Query = $datosLogin->VerificarLog($user,$pass);
			$c=0;
			while($row = $Query->fetch_array(MYSQL_ASSOC))
			{$c++;
				
				$Nombre = $row['Nombre'];				
				$ApPaterno = $row['ApPaterno'];
				$ApMaterno = $row['ApMaterno'];
				$IdUsuario = $row['IdUsuario'];				
				$Mail = $row['Mail'];
				$titulo = $row['titulo'];
				$UserName = $row['UserName'];
			}

			
			if($c>0)
			{
				// Destruimos la sesion y la volvemos a crear para que la sesion tenga efecto al momento que el logeo esta validado

				session_destroy();	
				session_start();
				$_SESSION['NomUser']=$Nombre;
				$_SESSION['ApPatUser']=$ApPaterno;
				$_SESSION['ApMatUser']=$ApMaterno;
				$_SESSION['IdUser']=$IdUsuario;
				$_SESSION['MailUser']=$Mail;
				$_SESSION['TitUser']=$titulo;
				$_SESSION['NameUser']=$UserName;
				$_SESSION['Sesion']='Activo';			
				echo $_SESSION['Sesion'];
			}
			else
			{
				echo "El usuario y contraseña no coinciden";
			}
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


	$ClNombre=$_POST['ClNombre'];
	$ClContacto=$_POST['ClContacto'];
	$ClContacto2=$_POST['ClContacto2'];
	$ClContacto3=$_POST['ClContacto3'];
	$ClTel1=$_POST['ClTel1'];
	$ClTel2=$_POST['ClTel2'];
	$ClPais=$_POST['ClPais'];
	$ClEstado=$_POST['ClEstado'];
	$ClCiudad=$_POST['ClCiudad'];
	$ClDireccion=$_POST['ClDireccion'];
	$ClCorreo=$_POST['ClCorreo'];
	$ClRFC=$_POST['ClRFC'];
	$ClCP=$_POST['ClCP'];
	$Selec=$_POST['Selec'];
	$IdCliente=$_POST['IdCliente'];
	$IdClienteCambios=$_POST['IdClienteCambios'];


	


	$ClientesObj = new Clientes();
	if($_POST['Accion']=='ClienteNuevo')
	{		
		$ClientesObj->CNuevo($ClNombre,$ClContacto,$ClContacto2,$ClContacto3,$ClTel1,$ClTel2,$ClPais,$ClEstado,$ClCiudad,$ClDireccion,$ClCorreo,$ClRFC,$ClCP,$Selec);		
	}
	
	if($_POST['Accion']=='ClienteCambios')
	{
		$ClientesObj->CCambios($IdClienteCambios,$ClContacto,$ClContacto2,$ClContacto3,$ClTel1,$ClTel2,$ClPais,$ClEstado,$ClCiudad,$ClDireccion,$ClCorreo,$ClRFC,$ClCP,$Selec);		
	}
	if($_POST['Accion']=='DatosCliente')
	{
		$ClientesObj->DatosCliente($IdCliente);		
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
	if($_POST['accion']=="mostrarVendedores")
	{
		echo MostrarVendedores::mostrar($_POST["IdUsuario"]);
	}
	
?>