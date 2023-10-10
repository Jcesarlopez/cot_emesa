<?php
session_start();


require_once("varPropPlanta.php");	

$AreaRequerida = 0;
$ExisteCarcamo = false;
$ExisteLecho = false;


if($IdTipo==2)
{
	$AreaRequerida = ($LargoPlanta*$AnchoPlanta);  // Si es de obra civil
}else
{
	$AreaRequerida = $DiametroPlanta*$DiametroPlanta; // Si es PK
}




for($c=0;$c<count($_SESSION['PTARPartidas']);$c++) // Comprobamos la existencia del carcamo y los lechos de secado
{
	if($_SESSION['PTARPartidas'][$c+1]['label']=="ocpr" or $_SESSION['PTARPartidas'][$c+1]['label']=="empr") // Area carcamo
	{		
		$ExisteCarcamo = true;
	}		
	if($_SESSION['PTARPartidas'][$c+1]['label']=="lese") // Area Lecho de lodos
	{		
		$ExisteLecho = true;		
	}			
}



//if($IdTipo==2)
//{
	if($ExisteCarcamo){$AreaRequerida = $AreaRequerida + ($LargoCarcamo*$AnchoCarcamo);}
	if($ExisteLecho){$AreaRequerida = $AreaRequerida + ($Lechosm2);}else{$Lechosm2 = "N/A";}
//}

$datos = array("Carcamo" => $ExisteCarcamo, "lese" => $ExisteLecho, "AreaRequerida" => $AreaRequerida );
if($_POST['accion']=="Calcular")
{
	echo json_encode($datos);		
}


?>