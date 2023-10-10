<?php
	session_start();


	echo "cl ".$_SESSION['cccs']."<br><br><br>";


	/*echo $_SESSION['VARI']."<br><br><br><br>";

	echo "Mneda ".$_SESSION['USD']."<br>";

	echo "cl ".$_SESSION['ContacCl']."<br><br><br>";*/
	print_r( $_SESSION['PartidasMaterial']);

	echo "<br><br><br>";

	do{
		echo key($_SESSION);
		echo current($_SESSION)."<br>";
	}
	while(
		next($_SESSION));

		echo "Atencion: ".$_SESSION['AtnCl'];


	//echo "dolares ".$_SESSION['USD'];

	//print_r($_SESSION['VVF']);

	
	//print_r($_SESSION['PartidasMaterial']) ;

	/*echo $_SESSION['LL'];*/


	//	echo "<br><br>Nota part:".$_SESSION['NotaPartida'];

	//echo $_SESSION['IdUser'];
	//echo "<br><br><br>";
	//print_r($_SESSION['PartidasMaterial']);
	//echo $_SESSION['ceee'];
	/*echo "Status: ".$_SESSION['mod_cot'];

	echo "<br>Estado: ".$_SESSION['Estado'];*/

	/*echo "<br>";
	print_r($_SESSION['test']);

	echo "<br>";
	echo $_SESSION['PTARGenerales']['Tipo'];


	/*echo "Propiedades: <br>";
	print_r($_SESSION['PTARPropiedades']);*/

	/*echo "<br> id clien";
	echo $_SESSION['IdCliente'];

	echo "<br>Tipo: ".$_SESSION['PTARGenerales']['IdTipo'];

	echo "<br>Ilustrativa: ".$_SESSION['lustrativa'];



	echo "<br>Nota partida: ".$_SESSION['NotaPartida'];

	echo "<br>Sarita<br>";

	echo ($_SESSION['SARITA']);

	echo "<br><br>No cot".$_SESSION['NoCot'];


	echo "Tipo: ".$_SESSION['PTARPropiedades']['IdTipo'];

	echo "Partidas<br>";
	print_r($_SESSION['PTARPartidas']);*/


	/*echo "<br>Servidor: ".$_SESSION['MySQLServidor'];
	echo "<br>User: ".$_SESSION['MySQLUser'];
	echo "<br>Pass: ".$_SESSION['MySQLPass'];
	echo "<br>Base de datos: ".$_SESSION['MySQLdb'];*/


	/*echo "<br>PathModel: ".$_SESSION['PathModel'];
	echo "<br>MySQLServidor: ".$_SESSION['MySQLServidor'];
	echo "<br>MySQLUser: ".$_SESSION['MySQLUser'];
	echo "<br>MySQLPass: ".$_SESSION['MySQLPass'];
	echo "<br>MySQLdb: ".$_SESSION['MySQLdb'];

	echo "<br><br><br>";


	print_r($_SESSION['PTARIncluye']);
	echo "<br><br><br>Noincluye: <br>";


	print_r($_SESSION['PTARNoIncluye']);
	echo "<br>";

	echo "<br><br><br>Entgrega: <br>";
	print_r($_SESSION['PTAREntregar']);

	echo "<br><br><br>Noincluye: <br>";


	echo "Partidas: <br>";
	print_r($_SESSION['PTARPartidas']);


	echo "<br><br><br>insert: <br>";
	print_r($_SESSION['VARI']);

	echo "<br><br><br><br>";
	echo "Variable Word:".$_SESSION['word1'];



	echo "abrir: ".$_SESSION['sqlabrir'];

	echo "<br><br>Where: <br>".$_SESSION['where'];*/
	/*echo "<br><br><br><br><br><br>";



	echo "Tiempo de la session:<br><br>";
	echo $_SESSION['Sesion'];*/
	//unset($_SESSION['PartidasMaterial']);	
?>