<?php
	session_start();
	$_SESSION['Conexion']="SAP";	

	class ClientesWeb
	{



		public function __construct()
		{
			require_once($_SESSION['PathModel']."ModeloClientesWeb.php");		
			$this->ClaseModClientesWeb = new ClaseModClientesWeb();
			$_SESSION['Conexion']="WEB";
		}	


		public function ListaDefault()
		{
			$Query = $this->ClaseModClientesWeb->ListaDefault();
			$ArrayDatosClienteWeb = array();
			$c=0;
			while($row = $Query->fetch_array(MYSQL_ASSOC))
			{
				$c++;			
				$ArrayDatosClienteWeb[$c]['cliente']=strtoupper($row['cliente']);
				$ArrayDatosClienteWeb[$c]['numero']=$row['numero'];
				$ArrayDatosClienteWeb[$c]['atencion']=$row['atencion'];
				$ArrayDatosClienteWeb[$c]['cargo']=$row['cargo'];
				$ArrayDatosClienteWeb[$c]['direccion']=$row['direccion'];
				$ArrayDatosClienteWeb[$c]['pais']=$row['pais'];
				$ArrayDatosClienteWeb[$c]['estado']=$row['estado'];
				$ArrayDatosClienteWeb[$c]['ciudad']=$row['ciudad'];
				$ArrayDatosClienteWeb[$c]['telefono']=$row['telefono'];
				$ArrayDatosClienteWeb[$c]['correo']=$row['correo'];
				$ArrayDatosClienteWeb[$c]['comentarios']=$row['comentarios'];

			}
			$_SESSION['cesar']=$ArrayDatosClienteWeb;
			echo json_encode($ArrayDatosClienteWeb);
		}
		public function unCliente($idClWeb)
		{
			$Query = $this->ClaseModClientesWeb->unCliente($idClWeb);
			$ClienteWeb = array();
			while($row = $Query->fetch_array(MYSQL_BOTH))			
			{
				$c++;				
				$ClienteWeb=$row;
				
			}
			echo json_encode($ClienteWeb);
		}
		public function filtrar($Valor)
		{
			$Query = $this->ClaseModClientesWeb->filtrar($Valor);
			$ArrayDatosClienteWeb = array();
			$c=0;
			while($row = $Query->fetch_array(MYSQL_ASSOC))
			{
				$c++;			
				$ArrayDatosClienteWeb[$c]['cliente']=strtoupper($row['cliente']);
				$ArrayDatosClienteWeb[$c]['numero']=$row['numero'];
				$ArrayDatosClienteWeb[$c]['atencion']=$row['atencion'];
				$ArrayDatosClienteWeb[$c]['cargo']=$row['cargo'];
				$ArrayDatosClienteWeb[$c]['direccion']=$row['direccion'];
				$ArrayDatosClienteWeb[$c]['pais']=$row['pais'];
				$ArrayDatosClienteWeb[$c]['estado']=$row['estado'];
				$ArrayDatosClienteWeb[$c]['ciudad']=$row['ciudad'];
				$ArrayDatosClienteWeb[$c]['telefono']=$row['telefono'];
				$ArrayDatosClienteWeb[$c]['correo']=$row['correo'];
				$ArrayDatosClienteWeb[$c]['comentarios']=$row['comentarios'];

			}			
			echo json_encode($ArrayDatosClienteWeb);


		}

	}


	$ClientesWeb = new ClientesWeb();
	if($_POST['Accion']=='ListaDefault')
	{
		$ClientesWeb->ListaDefault();

	}
	if($_POST['Accion']=='unCliente')
	{
		$ClientesWeb->unCliente($_POST['IdClWeb']);		
	}
	if($_POST['Accion']=='filtrar')
	{
		$ClientesWeb->filtrar($_POST['Valor']);				
	}	
?>
