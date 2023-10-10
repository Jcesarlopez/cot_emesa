<?php
session_start();
foreach($_SESSION as $valor)
{
	echo $valor."<br><br>";
}

?>
