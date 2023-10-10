<?php
session_start();
/*$keys_sesion = array_keys($_SESSION);
foreach ($keys_sesion as $key_sesion)
{
	$key_sesion = $_SESSION[$key_sesion];
	echo ("variable $key_sesion")."<br>";
} */


$sql = array();
$sql[]="julio";
$sql[]="julioss";
$sql[]="julisso";
$sql[]="juliaao";
foreach($sql as $valor)
{
	echo $valor."<br>";

}
?>
