<?php
	session_start();
	echo "Status: ".$_SESSION['mod_cot'];

	echo "<br>Estado: ".$_SESSION['Estado'];

	echo "<br>";
	print_r($_SESSION['test']);

	echo "<br>";
	print_r($_SESSION['PTARGenerales']);


	echo "Prppiedades: <br>";
	prin_r($_SESSION['PTARPropiedades']);

	echo "<br> id clien";
	echo $_SESSION['IdCliente'];
?>