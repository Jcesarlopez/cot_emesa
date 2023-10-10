<?php
function parrafoIncluye()
{

	

	
	$modelo = $_SESSION['PTARPropiedades']['IdModelo'];
	$tipo =	$_SESSION['PTARGenerales']['Tipo'];
	$Idtipo = $_SESSION['PTARGenerales']['IdTipo'];

	if($modelo==1 and !$tipo=="PK")
	{
		$texto = 'Desde la elaboración del Proyecto Arquitectónico, Proyecto Estructural tipo, Diseño, Equipamiento. Construcción. (Opcional), Puesta en Marcha y entrega de obra terminada y funcionando con garantía de un año en equipos y cumplimiento de la norma dada en las especificaciones generales de las instalaciones de Tratamiento,  y entrenamiento a operadores.';
	}else
	{
		$texto = 'Desde la elaboración del proyecto, hasta la entrega de obra terminada y funcionando con garantía de un año en equipos y cumplimiento de la norma dada en las especificaciones generales, incluyendo:';
	}

	if($Idtipo==15)
	{
		$texto="";

	}


	return $texto;


}
	


?>