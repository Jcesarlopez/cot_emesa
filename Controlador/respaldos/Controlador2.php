<?php
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
			while($av = mysqli_fetch_array($resultado, MYSQL_BOTH))
			{	
				self::$datos.='<option value="'.$av['IdUsuario'].'">'.strtoupper($av['Nombre']).' '.strtoupper($av['ApPaterno']).strtoupper($av['ApMaterno']).'</option>';
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
			while($av = mysqli_fetch_array($resultado, MYSQL_BOTH))
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
			while($row = $Query->fetch_array(MYSQL_ASSOC))
			{
				$DataCliente[]=$row;
			}
			echo json_encode($DataCliente);





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