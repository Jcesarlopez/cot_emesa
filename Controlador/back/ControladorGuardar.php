<?php
session_start();
class Grabar
{
	public $IVA,$Fecha,$Ref,$IdVend,$clAtn;
	public $req;
	public $resultado;
	public $Datos;


	public function __construct()
	{
		$this->clAtn = $_POST['clAtn'];		
		$this->req = $_SESSION['PathModel']."ModeloGrabar.php";
		require_once($this->req);
		$this->Datos = new DatosGrabar();

		

		if($_SESSION['CotTipo']==1) // Si es planta
		{
			$this->IVA = $_POST['IVA']; // Aqui el el IVA se toma de un campo oculto			
		}else
		{
			$this->IVA= $_SESSION['IVAPartidasMat']; // El IVA para meterial se toma de una variable de sesion
			$_SESSION['Franco'] = $_POST['Franco'];
			$_SESSION['Vigencia'] = $_POST['Vigencia'];
			$_SESSION['Condiciones'] = $_POST['Condiciones'];
			$_SESSION['Entrega'] = $_POST['Entrega'];
		}


		$this->Fecha = $_POST['Fecha'];
		$this->Ref = $_POST['Ref'];
		$this->IdVend = $_POST['IdVend'];		
	}
	public function Nuevo()
	{
		$this->resultado = $this->Datos->NuevaCot($this->IVA,$this->Fecha,$this->Ref,$this->IdVend,$this->clAtn);			
	}
	public function Cambios()
	{
		$this->resultado = $this->Datos->CambiosCot($this->IVA,$this->Fecha,$this->Ref,$this->IdVend,$this->clAtn);					
	}
	public function __destruct()
	{
		echo json_encode($this->resultado);
	}
}


$grabar = new Grabar();

if($_SESSION['Estado']=="Nuevo")
{
	$grabar->Nuevo();
}
if($_SESSION['Estado']=="Cambios")
{
	$grabar->Cambios();

}

?>