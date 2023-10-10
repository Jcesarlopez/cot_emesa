<?php
session_start();

class DatosClientes{
	
	public function __construct()
	{
		require_once("Conexion.php");
		$this->con = new Conexion();
	}	
	public function ClienteNuevo($ClNombre,$ClContacto,$ClContacto2,$ClContacto3,$ClTel1,$ClTel2,$ClPais,$ClEstado,$ClCiudad,$ClDireccion,$ClCorreo,$ClRFC,$ClCP)
	{
		$ClNombre="'".$ClNombre."'";
		$ClContacto="'".$ClContacto."'";
		$ClContacto2="'".$ClContacto2."'";
		$ClContacto3="'".$ClContacto3."'";
		$ClTel1="'".$ClTel1."'";
		$ClTel2="'".$ClTel2."'";
		$ClPais="'".$ClPais."'";		
		$ClEstado="'".$ClEstado."'";
		$ClCiudad="'".$ClCiudad."'";
		$ClDireccion="'".$ClDireccion."'";
		$ClCorreo="'".$ClCorreo."'";
		$ClRFC="'".$ClRFC."'";
		$ClCP="'".$ClCP."'";	

		$campos ="Nombre, Calle,Ciudad, Estado, Pais, CP, RFC,Contacto,Contacto2,Contacto3,Telefono1, Telefono2,Correo,IdUsuario";
		$variables = "N$ClNombre,N$ClDireccion,N$ClCiudad,N$ClEstado,N$ClPais,$ClCP,$ClRFC,N$ClContacto,N$ClContacto2,N$ClContacto3,$ClTel1,$ClTel2,$ClCorreo,".$_SESSION['IdUser'];
	
		$sql = "INSERT INTO clientes_indice($campos) VALUES ($variables)";
		$_SESSION['cesar']=$sql;

		$lastId = $this->con->consultaInsert($sql);

		return $lastId;
	}
	public function ClienteCambios($IdCliente,$ClContacto,$ClContacto2,$ClContacto3,$ClTel1,$ClTel2,$ClPais,$ClEstado,$ClCiudad,$ClDireccion,$ClCorreo,$ClRFC,$ClCP)
	{
		$ClContacto="'".$ClContacto."'";
		$ClContacto2="'".$ClContacto2."'";
		$ClContacto3="'".$ClContacto3."'";
		$ClTel1="'".$ClTel1."'";
		$ClTel2="'".$ClTel2."'";
		$ClPais="'".$ClPais."'";		
		$ClEstado="'".$ClEstado."'";
		$ClCiudad="'".$ClCiudad."'";
		$ClDireccion="'".$ClDireccion."'";
		$ClCorreo="'".$ClCorreo."'";
		$ClRFC="'".$ClRFC."'";
		$ClCP="'".$ClCP."'";

		$sql ="UPDATE clientes_indice SET Calle=N$ClDireccion,Ciudad=N$ClCiudad,Estado=N$ClEstado";
		$sql.=",Pais=N$ClPais,CP=N$ClCP,RFC=$ClRFC,Contacto=N$ClContacto,Contacto2=N$ClContacto2,Contacto3=N$ClContacto3,Telefono1=N$ClTel1";
		$sql.=",Telefono2=$ClTel2,Correo=$ClCorreo WHERE IdCliente = $IdCliente";

		

		$this->con->consultaSimple($sql);

		return "cambio realizado";
		

	}
	public function ObtenerDatos($IdCliente)
	{
		$sql = "SELECT * FROM clientes_indice WHERE IdCliente=$IdCliente";

		return $this->con->consultaRetorno($sql);

		 



	}


}

?>