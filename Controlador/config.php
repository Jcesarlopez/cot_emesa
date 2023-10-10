<?php
session_start();
$_SESSION['meses']= array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$_SESSION['NoCotVerWeb']=23056; // A partir de esta version funciona la version Web


//unset($_SESSION['Utilidad']);
//$_SESSION['Estado']="Cerrar";
//$_SESSION['mod_cot']=0;	



/// CONSTANTES DE SERVIDOR

// Configigacion Servidor prrueba
/*$_SESSION['PathModel']="/home/emesa/public_html/sap/cgi-bin/_cotptar/Modelos/";
$_SESSION['MySQLServidor']="localhost";
$_SESSION['MySQLUser']="emesa_saptest";
$_SESSION['MySQLPass']="Equipos123#";
$_SESSION['MySQLdb']="emesa_saptest";*/


// // Configigacion Servidor Real
// $_SESSION['PathModel']="/home/emesa/public_html/sap/cgi-bin/_cotptar/Modelos/";
// $_SESSION['MySQLServidor']="localhost";
// $_SESSION['MySQLUser']="emesa_iessus";
// $_SESSION['MySQLPass']="Equipos4125#";
// $_SESSION['MySQLdb']="emesa_sap";


// Configigacion Local PC
$_SESSION['PathModel']="/inetpub/wwwroot/cotizaciones_emesa/Modelos/";
$_SESSION['MySQLServidor']="localhost";
$_SESSION['MySQLUser']="cesar";
$_SESSION['MySQLPass']="cesar";
$_SESSION['MySQLdb']="emesa_sap";




	
	
	
?>
