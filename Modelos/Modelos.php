<?php
session_start();

class DatosLogin{
	private $con;

	public function __construct()
	{
		require_once("Conexion.php");
		$this->con = new Conexion();
	}
	public function VerificarLog($user,$pass){

	$pass = crypt($pass,"we");
	$_SESSION['jj']=$pass;
	$sql = "SELECT * FROM usuarios_indice WHERE UserName='$user' and Password='$pass'";
	$_SESSION['consul']=$sql;
	$datos =  $this->con->consultaRetorno($sql);
	return $datos;
	}
}
class ListaVendedores{
	private $id;
	private $mombre;
	private $apPaterno;
	private $apMaterno;
	private $mail;
	private $User;
	private $pass;
	private $cargo;
	private $con;
	public function __construct()
	{
		require_once("Conexion.php");
		// Al iniciar se instancia un objeto que se almacena en la propiedad con de la clase ListaVendedores
		$this->con = new Conexion();
	}

	public function listar(){
	$sql = "SELECT IdUsuario,Nombre,ApPaterno,ApMaterno,Mail,UserName,Password,ventas,cargo FROM usuarios_indice WHERE ventas=1 ORDER BY Nombre ASC";
	// En la variable datos almacenamos el resultado de la consulta declarada en la variable sql y finalmente retornamos el valor;
	$datos =  $this->con->consultaRetorno($sql);
	return $datos;
	}
}
class DatosUsuarios{
	private $con;
	public function __construct()
	{
		require_once("Conexion.php");
		$this->con = new Conexion();
	}
	public function usuario($IdUsuario)
	{
		$sql = "SELECT * FROM usuarios_indice WHERE IdUsuario=$IdUsuario";
		$datos =  $this->con->consultaRetorno($sql);
		return $datos;
	}
}
class ListaClientes{
	public $nombreCliente;
	public $idCliente;
	private $con;
	private $where;

	public function __construct()
	{
		require_once("Conexion.php");
		// Al iniciar se instancia un objeto que se almacena en la propiedad con de la clase ListaVendedores
		$this->con = new Conexion();
	}

	public function listar($like){
	if($like=="")
	{
		$this->where="";
	}else
	{
		$likeConComodin = str_replace(" ","%",$like);

		$this->where="WHERE Nombre like '%$likeConComodin%'";
	}
	$sql = "SELECT *  FROM clientes_indice $this->where ORDER BY IdCliente DESC LIMIT 8";
	$datos =  $this->con->consultaRetorno($sql);

	return $datos;
	}
}
class DatosCliente{
	public $DatosCliente = array();
	private $con;
	public function __construct()
	{
		require_once("Conexion.php");
		$this->con = new Conexion();
	}
	public function Datos($IdCliente){
		$sql = "SELECT *  FROM clientes_indice WHERE IdCliente = $IdCliente";

		$datos =  $this->con->consultaRetorno($sql);

		return $datos;
		}
	}
class ListaLPS
{
	private $con;
	public function __construct()
	{
		require_once("Conexion.php");
		$this->con = new Conexion();
	}
	public function Datos($tipo,$serie){
		/*Si es PK*/




		if ($tipo==1)
		{
			$WHERE=" (IdTipo=15 or Idtipo=1) and IdModelo=".$serie;
		}else
		{
			$WHERE=" Idtipo=2 and IdModelo=".$serie;
		}




		$sql = "SELECT IdPlanta,Capacidad,IdTipo,IdModelo FROM plantas_indice WHERE ".$WHERE;
		$datos =  $this->con->consultaRetorno($sql);
		return $datos;
	}
}

class DatosplantaListPre
{
	private $con;
	public function __construct()
	{
		require_once("Conexion.php");
		$this->con = new Conexion();
	}
	public function PreciosPlanta($idPTAR)
	{

		$campos=" plantas_indice.PrecioEquipo*.85 AS PlantaEquipo, plantas_indice.PrecioObra*.85 AS PlantaObra,";
		$campos.=" plantas_carcamos.PrecioEquipo*.85 AS EquipoCarcamo, plantas_carcamos.PrecioObra*.85 AS ObraCarcamo,";
		$campos.=" plantas_indice.CostoFiltro*.85 AS CostoFiltro, plantas_indice.CostoLecho*.85 AS CostoLecho";

		$sql = "SELECT ".$campos;
		$sql.= " FROM plantas_indice,plantas_carcamos WHERE plantas_indice.IdPlanta=".$idPTAR." and plantas_indice.IdCapacidad = plantas_carcamos.Idcapacidad";
		$datos =  $this->con->consultaRetorno($sql);
		return $datos;
	}
}

?>