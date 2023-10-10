<?php

$Capacidad = $_SESSION['PTARPropiedades']['Capacidad'];
$m3Dia = ($Capacidad*86.4);
$hab140 = (($Capacidad*86400)/140);
$hab180 = (($Capacidad*86400)/180);

$IdTipo = $_SESSION['PTARPropiedades']['IdTipo'];
$AltoPlanta = $_SESSION['PTARPropiedades']['AltoPlanta'];
$LargoPlanta = $_SESSION['PTARPropiedades']['LargoPlanta'];
$AnchoPlanta = $_SESSION['PTARPropiedades']['AnchoPlanta'];
$AreaPlanta = $LargoPlanta*$AnchoPlanta;

$DiametroPlanta = $_SESSION['PTARPropiedades']['DiametroPlanta'];
$LodosSecos = $_SESSION['PTARPropiedades']['LodosSecos'];
$Lechosm2 = $_SESSION['PTARPropiedades']['Lechosm2']. " m3";	
$BHPPlanta = $_SESSION['PTARPropiedades']['BHPPlanta'];
$HPPlanta = $_SESSION['PTARPropiedades']['HPPlanta'];
$GrupoLPS = $_SESSION['PTARPropiedades']['GrupoLPS'];
$ModeloLPS = $_SESSION['PTARPropiedades']['ModeloLPS'];
$AltoCarcamo = $_SESSION['PTARPropiedades']['AltoCarcamo'];
$LargoCarcamo = $_SESSION['PTARPropiedades']['LargoCarcamo'];
$AnchoCarcamo = $_SESSION['PTARPropiedades']['AnchoCarcamo'];
$AreaCarcamo = $LargoCarcamo*$AnchoCarcamo;

$BHPCarcamo = $_SESSION['PTARPropiedades']['BHPCarcamo'];
$HPCarcamo = $_SESSION['PTARPropiedades']['HPCarcamo'];
$DescModelo = $_SESSION['PTARPropiedades']['DescModelo'];

?>