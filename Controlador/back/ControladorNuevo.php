<?php
session_start();

class Nuevo
{
	function CrearNuevo()
	{

		// Si es tipo planta de tratamiento o material, 1 es planta y 2 es material
		// Por default la moneda es en pesos 

		$_SESSION['USD'] = 1; // 1 si son pesos mexicanos 2 son usd
		$_SESSION['CotTipo']="";
		$_SESSION['NotaPartida']=0;

		$_SESSION['IVAPartidasMat']=16;


		$_SESSION['lustrativa']=0;
				
		$_SESSION['Estado']="Nuevo";	
		$_SESSION['NoCot']=0;
		$_SESSION['IdCliente']=0;
		$_SESSION['ContacCl']='';
		$_SESSION['mod_cot']=0;


		$_SESSION['Utilidad']=0;
		$_SESSION['TipoUtilidad']=1;
	
		$_SESSION['PTARPropiedades']['IdPlanta']=0;
		$_SESSION['PTARPropiedades']['IdCapacidad']=0;
		$_SESSION['PTARPropiedades']['Capacidad']=0;

		$_SESSION['PTARPropiedades']['IdTipo']=0;
		$_SESSION['PTARPropiedades']['IdModelo']=0;
		$_SESSION['PTARPropiedades']['AltoPlanta']=0;
		$_SESSION['PTARPropiedades']['LargoPlanta']=0;
		$_SESSION['PTARPropiedades']['AnchoPlanta']=0;
		$_SESSION['PTARPropiedades']['DiametroPlanta']=0;
		$_SESSION['PTARPropiedades']['LodosSecos']=0;
		$_SESSION['PTARPropiedades']['Lechosm2']=0;
		$_SESSION['PTARPropiedades']['HPPlanta']=0;
		$_SESSION['PTARPropiedades']['BHPPlanta']=0;
		$_SESSION['PTARPropiedades']['GrupoLPS']=0;
		$_SESSION['PTARPropiedades']['ModeloLPS']=0;
		$_SESSION['PTARPropiedades']['AltoCarcamo']=0;
		$_SESSION['PTARPropiedades']['LargoCarcamo']=0;
		$_SESSION['PTARPropiedades']['AnchoCarcamo']=0;
		$_SESSION['PTARPropiedades']['BHPCarcamo']=0;
		$_SESSION['PTARPropiedades']['HPCarcamo']=0;
		$_SESSION['PTARPropiedades']['DescModelo']=0;

		unset($_SESSION['PTARPartidas']);
		unset($_SESSION['PartidasMaterial']);
	}
}

$obj = new Nuevo();
$obj->CrearNuevo();



?>