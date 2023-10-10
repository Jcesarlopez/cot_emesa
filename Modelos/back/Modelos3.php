<?php

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
			$this->where="WHERE Nombre like '%$like%'";		 
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
		/*mysql_set_charset('utf8',$this->con);*/
		$datos =  $this->con->consultaRetorno($sql);
		/*$datos =  mysql_set_charset('uft8',$this->con->consultaRetorno($sql));		*/
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
	if (tipo==1)
	{
		$WHERE=" (IdTipo=15 or Idtipo=1) and IdModelo=".$serie;		
	}else
	{
		$WHERE=" Idtipo=2 and IdModelo=".$serie;		
	}
	$sql = "SELECT Capacidad,IdTipo,IdModelo FROM plantas_indice WHERE ".$WHERE;	
	$datos =  $this->con->consultaRetorno($sql);	
	return $datos;
}





}

?>