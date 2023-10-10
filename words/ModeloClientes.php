<?php
session_start();

class DatosClientes{
	
	public function __construct()
	{
		require_once("Conexion.php");
		$this->con = new Conexion();
	}	
	public function ClienteNuevo($ClNombre,$ClContacto,$ClTel1,$ClTel2,$ClPais,$ClEstado,$ClCiudad,$ClDireccion,$ClCorreo,$ClRFC,$ClCP)
	{
		$ClNombre="'".$ClNombre."'";
		$ClContacto="'".$ClContacto."'";
		$ClTel1="'".$ClTel1."'";
		$ClTel2="'".$ClTel2."'";
		$ClPais="'".$ClPais."'";		
		$ClEstado="'".$ClEstado."'";
		$ClCiudad="'".$ClCiudad."'";
		$ClDireccion="'".$ClDireccion."'";
		$ClCorreo="'".$ClCorreo."'";
		$ClRFC="'".$ClRFC."'";
		$ClCP="'".$ClCP."'";	

		$campos ="Nombre, Calle,Ciudad, Estado, Pais, CP, RFC,Contacto,Telefono1, Telefono2,Correo,IdUsuario";
		$variables = "N$ClNombre,N$ClDireccion,N$ClCiudad,N$ClEstado,N$ClPais,$ClCP,$ClRFC,N$ClContacto,$ClTel1,$ClTel2,$ClCorreo,".$_SESSION['IdUser'];
	
		$sql = "INSERT INTO clientes_indice($campos) VALUES ($variables)";
	

		$this->con->consultaSimple($sql);		
		$_SESSION['cesar']=$sql;
		return "El cliente fue dado de alta";
	}


}

?>